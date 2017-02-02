<?php
  header('Content-Type: text/html; charset=utf-8');
  require_once 'vendor/autoload.php';
  use allpaykz\webshop_integration\allpay;

  //Путь до приватных и публичных ключей к папке allpay_key.
  //По умолчанию возьмет из папки: src/allpay_key/
  $key_path =  dirname(__FILE__).'/vendor/allpaykz/webshop_integration/tests'; //Тестовые ключи.
  //Инициализируем класс allpay.
  $allpay = new allpay($key_path);
  //Задать URL для возврата если все хорошо прошло. Обязательное для заполнения
  $allpay->set_success_url('http://www.shop_name.kz/success.html');
  //Задать URL для возврата если оплата не прошла. Обязательное для заполнения
  $allpay->set_fail_url('http://www.shop_name.kz/fail.html');
  //Задать идентификатор магазина в ПС. Выдается в момент заключения договора.  Обязательное для заполнения
  $allpay->set_merchant_id('75551234569');
  // Делаем xml объект из POST запроса.
  $allpay->load_xml(base64_decode(file_get_contents('php://input')));
  // Проверка на подпись.
  if($allpay->verify_security())
  {
     $text.=  "Signature validated!".$allpay->get_status();
     if($allpay->get_status() === $allpay::STATUS_COMPLETED)
     {
       $text .= ' InvoiceNumber = '.$allpay->get_invoice();
       $text .= ' TransactionId = '.$allpay->get_transaction_id();
       $text .= ' Status = '.$allpay->get_status();
       $text .= ' StatusDescription = '.$allpay->get_status_description();
     }
  }
  else
  {
   $text =  $allpay->get_error_text(); //вывод сообщения об ошибке
  }
 //Сохраняем в файл для тестирования
 $open = fopen (dirname(__FILE__)."/text.txt","wr+");
 fwrite($open, $text);
 fclose($open);
?>