# DEMO

<p>
  <img src="https://camo.githubusercontent.com/fdf2982b9f5d7489dcf44570e714e3a15fce6253e0cc6b5aa61a075aac2ff71b/68747470733a2f2f696d672e736869656c64732e696f2f62616467652f4c6963656e73652d4d49542d79656c6c6f772e737667" alt="License: MIT" data-canonical-src="https://img.shields.io/badge/License-MIT-yellow.svg" style="max-width: 100%;">
</p>

本專案是以 Laravel 建置的電商範例應用，包含公開 storefront、會員登入流程，以及以獨立 admin guard 保護的後台管理介面。公開頁面目前仍保留部分範例資料與開發中的功能，適合作為 Laravel、Blade、Vue 與 Docker 整合的示範專案。

## 已實作功能

### 公開前台

- 首頁與商品展示頁，使用專案內的範例商品與圖片資料。
- 商品分類、商品詳細頁，以及客服聯絡與 FAQ 頁面。
- Laravel UI 驅動的登入、註冊與密碼重設路由；專案也保留信箱驗證 Controller 與頁面。
- 會員專區路由，需通過使用者驗證後才能存取。
- 購物車路由已建立，但加入購物車與購物車頁目前仍是開發中骨架。

### 後台管理

- 後台登入、登出、dashboard 與獨立 admin authentication guard。
- 商品、訂單、會員、新聞與活動的列表、建立或編輯流程。
- 後台帳號、角色與權限管理。
- 依角色權限篩選後台選單與管理操作。
- 以 Yajra DataTables 提供後台列表的 JSON 資料端點。
- 透過 Laravel File Manager 管理圖片與附件。

## 技術棧

- **Backend**：PHP 8.3、Laravel Framework 12.x
- **Frontend**：Blade、Vue.js 2.7.16、Bootstrap 3.4.1、jQuery 3.7.1
- **Admin UI**：Laravel AdminLTE 3.x、Font Awesome 5.15.4
- **Asset Build**：Webpack 5、Laravel Mix 6.0
- **Database**：MySQL（由 Docker Compose 提供）
- **Testing**：PHPUnit 11；測試連線使用 SQLite `:memory:`
- **Runtime**：Docker Compose（PHP-FPM、Nginx、MySQL、phpMyAdmin）

## 專案結構

```text
.
├── docker-compose.yml        # PHP、Nginx、MySQL 與 phpMyAdmin 服務
├── dockerfile/php/8.3/       # PHP 8.3-FPM 映像設定
├── web/conf.d/               # Nginx 虛擬主機設定
├── db/                       # MySQL 設定與資料掛載目錄
└── php/                      # Laravel 應用程式
    ├── app/                  # Controllers、Models、Policies 與 Services
    ├── database/             # Migrations、Factories 與 Seeders
    ├── resources/            # Blade、CSS、JavaScript 與 Vue 元件
    ├── routes/               # Web、API 與 Console routes
    └── tests/                # Unit 與 Feature tests
```

## 開發環境需求

- Docker Engine 與 Docker Compose
- Node.js 與 npm（用於前端資源編譯，建議 Node.js 18+）
- Git

## 安裝與啟動

### 1. 取得程式碼與設定環境變數

```bash
git clone <repo_url>
cd demo
cp .env.example .env
```

Docker Compose 會讀取根目錄的 `.env`。請確認其中的 `DB_HOST=db`、`DB_DATABASE`、`DB_USERNAME` 與 `DB_PASSWORD` 與本地設定一致。

### 2. 安裝 PHP 依賴並產生 application key

```bash
docker compose run --rm --no-deps php composer install
docker compose run --rm --no-deps php php artisan key:generate --show
```

將 `key:generate --show` 輸出的值寫入根目錄 `.env` 的 `APP_KEY`。

### 3. 啟動服務並初始化資料庫

```bash
docker compose up -d
docker compose exec php php artisan migrate --seed
```

若要停止服務：

```bash
docker compose down
```

### 4. 安裝與編譯前端資源

```bash
cd php
npm ci
```

開發模式：

```bash
npm run development
# 或使用監看模式
npm run watch
```

生產模式：

```bash
npm run production
```

## 測試

測試使用 `php/phpunit.xml` 設定的 `sqlite_testing` 連線，資料庫為 SQLite in-memory，因此不需要連線到 MySQL。執行環境必須提供 PHP `pdo_sqlite` extension。

請回到專案根目錄執行：

```bash
docker compose run --rm --no-deps php vendor/bin/phpunit
```

也可以只執行指定測試套件：

```bash
docker compose run --rm --no-deps php vendor/bin/phpunit --testsuite Unit
docker compose run --rm --no-deps php vendor/bin/phpunit --testsuite Feature
```

測試目前涵蓋公開頁面、會員驗證、後台權限、後台頁面渲染、CRUD 流程與 DataTables JSON 端點。

## 服務存取

- Web 應用程式：<http://localhost:8084>
- phpMyAdmin：<http://localhost:8085>
- 後台登入：<http://localhost:8084/admin/login>

## 開發注意事項

- 首頁、分類與商品詳細頁仍使用 Controller 內的範例資料，並非完整的商品資料流程。
- 購物車加入、購物車內容與部分會員詳細頁仍包含開發中 placeholder，不應視為完整電商結帳流程。
- `php/.env.example` 是 Laravel 應用程式範本；使用 Docker Compose 時，服務連線設定以根目錄 `.env` 為準。
- `docker-compose.yml` 使用 `./php` 掛載 Laravel 原始碼，請在 `php/` 目錄執行 Composer 與 npm 相關命令。

## License

本專案採用 [MIT License](./LICENSE)。
