** DEMO **

## 說明
本專案為使用 Laravel 12 與 Vue.js 2.7 開發的電商範例應用（含後台管理）。

## 技術棧 (Tech Stack)
- **Backend**: Laravel Framework 12.x（PHP 8.3）
- **Frontend**: Vue.js 2.7.16、Bootstrap 3.4.1（前台）/ AdminLTE 3（後台）
- **Build Tool**: Webpack 5.89+, Laravel Mix 6.0+
- **Database**: MySQL（透過 Docker）
- **Testing**: PHPUnit 11（SQLite in-memory）
- **執行環境**: Docker（PHP-FPM + Nginx + MySQL + phpMyAdmin）

## 安裝步驟
*於命令列執行下列指令*

### 1. 後端環境建置
1. `$ git clone <repo_url>`
2. `$ cp ./.env.example ./.env`
3. `$ docker-compose run --rm --no-deps php composer install`
4. `$ docker-compose run --rm --no-deps php php artisan key:generate`
5. 設定 `.env` 中的 `APP_KEY` (通常上一步會自動設定，若無請手動複製)
6. `$ docker-compose up -d`

### 2. 前端資源建構 (Frontend Build)
本專案使用 Webpack 5 與 Laravel Mix 6 進行資源編譯。

1. 安裝前端依賴：
   ```bash
   $ cd php
   $ npm install
   ```
2. 開發模式編譯 (Development)：
   ```bash
   $ npm run dev
   # 或與監聽模式
   $ npm run watch
   ```
3. 生產模式編譯 (Production)：
   ```bash
   $ npm run production
   ```

## 測試 (Testing)
本專案使用 PHPUnit 11，測試資料庫為 SQLite in-memory（設定於 `php/phpunit.xml`），無需另外準備 MySQL。

```bash
# 完整測試套件
$ docker-compose run --rm php vendor/bin/phpunit

# 單一測試套件
$ docker-compose run --rm php vendor/bin/phpunit --testsuite Unit
$ docker-compose run --rm php vendor/bin/phpunit --testsuite Feature
```

## 服務存取
- Web 應用：`localhost:8084`
- phpMyAdmin：`localhost:8085`

## 注意事項
- **PHP 版本**：執行環境為 PHP 8.3（由 `dockerfile/php/8.3/Dockerfile` 建置）。
- **DB帳密**：請提前自行於 `.env` 設定資料庫連線資訊。
- **Node.js 版本**：建議使用 Node.js 18+ 以配合 Webpack 5。
