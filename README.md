# Если вы не используете Composer, [здесь есть](https://github.com/allpaykz/webshop-service-examples/tree/master/webshop-integration-php-demo) самостоятельный PHP проект 

# Демо сервисы на PHP

Если получаете сообщение `Exception [ 500 ]: Failure Signing Data: - 1`, скорее всего нужно подключить библиотеку `extension=php_openssl.dll`. Её нужно закачивать отдельно, соответствующей вашей версии `PHP`.

### Использование

#### Для вызова сервиса используйте файл [request_allpay.php](tests/request_allpay.php)

Пример 1 вызова сервиса. Файл [request_allpay.php](tests/request_allpay.php)

Пример 2 вызова сервиса. Файл [request_allpay.php](tests/request_allpay.php)

#### Для получения ответа WebshopResponse.xml используйте файл [response_allpay.php](tests/response_allpay.php)

После того как Покупатель оплатит Ваш заказ ПС Allpay высылает WebshopResponse.xml файл, принять XML-ку можно используя сервис [response_allpay.php](tests/response_allpay.php)
