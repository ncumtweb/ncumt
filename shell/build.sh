# 進到 laradock 資料夾
cd ../laradock

#!/bin/bash

# 進入 workspace 並執行多個指令
docker-compose exec workspace bash -c "
    php artisan migrate && \
    php artisan livewire:discover && \
    php artisan view:cache && \
    php artisan route:cache
"
