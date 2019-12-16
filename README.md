** DEMO **

##說明

##安裝步驟
*於命令列執行下列指令*
1. `$ git clone`
2. `$ cp ./.env.example ./.env`
3. `$ docker-compose run --rm --no-deps php composer install`
4. `$ docker-compose run --rm --no-deps php php artisan key:generate`
5. `copy APP_KEY in ./php/.env to .env's APP_KEY`
6. `$ docker-compose up -d`

##注意事項
DB帳密，請提前自行於.env設定