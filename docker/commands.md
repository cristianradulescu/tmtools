Docker commands cheatsheet
==========================

### Composer
```
docker run --rm -v $(pwd):/app -v ~/.ssh:/root/.ssh composer/composer install
```

### PHP
```
docker run --rm -v $(pwd):/app php:fpm php -v
docker exec -t tmtools_php_1 bin/console
```