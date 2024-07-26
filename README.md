# Сервис объявлений

#### dev - запуск
```sh
 ./vendor/bin/sail up -d
docker exec -it ads-back-laravel.test-1 sh -c "php artisan migrate"
```

#### Исправить стиль кода
```sh
docker exec -it ads-back-laravel.test-1 sh -c "php ./vendor/bin/php-cs-fixer fix"
```

#### Тестирование
```sh
./vendor/bin/sail test
```
