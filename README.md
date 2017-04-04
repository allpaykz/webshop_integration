# Если вы не используете Composer, [здесь есть](https://github.com/allpaykz/webshop-service-examples/tree/master/webshop-integration-php-demo) самостоятельный PHP проект 

# Демо сервисы на PHP

Если получаете сообщение `Exception [ 500 ]: Failure Signing Data: - 1`, скорее всего нужно подключить библиотеку `extension=php_openssl.dll`. Её нужно закачивать отдельно, соответствующей вашей версии `PHP`.

### Использование

#### Для вызова сервиса используйте файл [request_allpay.php](tests/request_allpay.php)

Файл [request_allpay.php](tests/request_allpay.php)

#### Для получения ответа WebshopResponse.xml используйте файл [response_allpay.php](tests/response_allpay.php)

После того как Покупатель оплатит Ваш заказ ПС Allpay высылает WebshopResponse.xml файл, принять XML-ку можно используя сервис [response_allpay.php](tests/response_allpay.php)

#### Техническое описание

[Здесь](https://github.com/allpaykz/documentation/tree/master/webshop-integration)

### Ключи/Цифровая подпись

Ключи можно получить в личном кабинете ПС "Allpay". Доступ можно получить в тех поддержке

### Доступ к тестовой системе

Для тестирования сервисов можно подключится к тестовой инфраструктуре ПС Allpay. Запрос на получение доступа к тестовому серверу отправляйте на почту techsupport@allpay.kz
