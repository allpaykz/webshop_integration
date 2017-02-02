<?php
  header('Content-Type: text/html; charset=utf-8');
  require_once 'vendor/autoload.php';
  use allpaykz\webshop_integration\allpay;


  //Путь до приватных и публичных ключей к папке allpay_key.
  //По умолчанию возьмет из папки: src/allpay_key/
  $key_path =  dirname(__FILE__).'/vendor/allpaykz/webshop_integration/tests';  // Тестовые ключи.
  //********Конец: Обязательное поле для __construct.********//
  $allpay = new allpay($key_path);
  //********Обязательное поле для заполнения xml.********//
    //Задать URL для возврата если все хорошо прошло. Обязательное для заполнения
    $allpay->set_success_url('http://www.shop_name.kz/success.html');
    //Задать URL для возврата если оплата не прошла. Обязательное для заполнения
    $allpay->set_fail_url('http://www.shop_name.kz/fail.html');
    //Задать URL для завершения транзакции. Там где будет проверка на подлинность.. Обязательное для заполнения
    $allpay->set_response_url('http://www.shop_name.kz/response_allpay.php');
    //Задать идентификатор магазина в ПС. Выдается в момент заключения договора.  Обязательное для заполнения
    $allpay->set_merchant_id('75551234569');
    //Название магазина, которое будет видеть Покупатель на странице подтверждения платежей. Обязательное для заполнения
    $allpay->set_shop_name('TOO NAME SHOP');
    //Идентификатор счета в ПС. На этот счет будут переводится деньги от Покупателя. Выдается в момент заключения договора. Обязательное для заполнения
    $allpay->set_wallet('25252');
    //Номер заказа, поле должно быть уникальным в базе данных магазина. Обязательное для заполнения
    $allpay->set_invoice('number_invoice'.rand(0,999));
    //Общая сумма к оплате. Обязательное для заполнения
    $allpay->set_amount('5');
  //********Конец: Обязательное поле для заполнения xml.********//
  //********Не обязательные поле для заполнения xml. Ставиться автоматически либо не создаются в xml файле.********//
    //Таймаут транзакции. Минимальное значение 600, максимальное 86400. Обязательное для заполнения
    $allpay->set_time_out('1024');
    //Автономное проведение транзакции. По умолчанию значение false. Если значение true, то ПС сама завершает транзакцию. Если значение false, то ПС замораживает деньги на счету Покупателя.
    $allpay->set_auto_transaction('true');
    //********Составное поле, описывающее товары в корзине Покупателя.  Не обязательное для заполнения.********//
      //Код товара
      $carts[0]['Code'] = 'string';
      //Название товара
      $carts[0]['Name'] = 'string';
      //Описание товара
      $carts[0]['Description'] = 'string';
      //Количество товара в соответствующей мере измерения
      $carts[0]['Quantity'] = '10';
      //Стоимость товара
      $carts[0]['Cost'] = '1000';
      //Код товара №2
      $carts[1]['Code'] = 'string1';
      //Название товара №2
      $carts[1]['Name'] = 'string1';
      //Описание товара №2
      $carts[1]['Description'] = 'string1';
      //Количество товара в соответствующей мере измерения №2
      $carts[1]['Quantity'] = '8';
      //Стоимость товара №2
      $carts[1]['Cost'] = '2000';
      $allpay->set_cart($carts);
    //********Конец: Составное поле, описывающее товары в корзине Покупателя.  Не обязательное для заполнения.********//
  //********Конец: Не обязательные поле для заполнения xml. Ставиться автоматически либо не создаются в xml файле.********//
  //Создание xml документа
  $allpay->create_xml();
  //Если нужно вывести ошибку. Вывод ошибок при создании  xml документа
  //echo $allpay->get_error_text();
  //Получить xml данные в base64 для вставки в форуму.
  $webshopRequest = $allpay->get_xml_base64();
  //Главный критерий отправки формы это method="post"  и enctype="application/x-www-form-urlencoded"
  echo '<form enctype="application/x-www-form-urlencoded" method="post" action="http://alpha.allpay.kz/mfs/WebShopPayment.xhtml" name="all-pay_'.time().'" id="all-pay_'.time().'">
          <input type="hidden" id="webshopRequest" name="webshopRequest" value="'.$webshopRequest.'" />
          <input type="submit" value="SEND" />
        </form>';
?>