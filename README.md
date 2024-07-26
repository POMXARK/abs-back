# Сервис объявлений

#### dev - запуск
```shell
 ./vendor/bin/sail up -d
docker exec -it ads-back-laravel.test-1 sh -c "php artisan migrate"
```

#### Генерация api документации (Scribe)
```shell
docker exec -it ads-back-laravel.test-1 sh -c "php artisan scribe:generate"
```

#### Исправить стиль кода
```shell
docker exec -it ads-back-laravel.test-1 sh -c "php ./vendor/bin/php-cs-fixer fix"
```

#### Тестирование
```shell
./vendor/bin/sail test
```
