#!/bin/bash

# 進到 laradock 資料夾
cd /web/laradock

# 關閉 docker
docker-compose down

# 重啟 nginx
docker-compose build nginx

# 啟動 docker
docker-compose up -d nginx mysql phpmyadmin certbot