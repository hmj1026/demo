** DEMO **

## 說明
本專案為使用 Laravel 5.8 與 Vue.js 2.7 開發的範例應用。

## 技術棧 (Tech Stack)
- **Backend**: Laravel Framework 5.8.*
- **Frontend**: Vue.js 2.7.16, Bootstrap 3.4.1
- **Build Tool**: Webpack 5.89+, Laravel Mix 6.0+

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

## 注意事項
- **DB帳密**：請提前自行於 `.env` 設定資料庫連線資訊。
- **Node.js 版本**：建議使用 Node.js 14+ 或 16+ 以配合 Webpack 5。
