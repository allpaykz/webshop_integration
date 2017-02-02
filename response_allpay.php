<?php
  header('Content-Type: text/html; charset=utf-8');
  require_once 'vendor/autoload.php';
  use allpaykz\webshop_integration\allpay;

  //���� �� ��������� � ��������� ������ � ����� allpay_key.
  //�� ��������� ������� �� �����: src/allpay_key/
  $key_path =  dirname(__FILE__).'/vendor/allpaykz/webshop_integration/tests'; //�������� �����.
  //�������������� ����� allpay.
  $allpay = new allpay($key_path);
  //������ URL ��� �������� ���� ��� ������ ������. ������������ ��� ����������
  $allpay->set_success_url('http://www.shop_name.kz/success.html');
  //������ URL ��� �������� ���� ������ �� ������. ������������ ��� ����������
  $allpay->set_fail_url('http://www.shop_name.kz/fail.html');
  //������ ������������� �������� � ��. �������� � ������ ���������� ��������.  ������������ ��� ����������
  $allpay->set_merchant_id('75551234569');
  // ������ xml ������ �� POST �������.
  $allpay->load_xml(base64_decode(file_get_contents('php://input')));
  // �������� �� �������.
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
   $text =  $allpay->get_error_text(); //����� ��������� �� ������
  }
 //��������� � ���� ��� ������������
 $open = fopen (dirname(__FILE__)."/text.txt","wr+");
 fwrite($open, $text);
 fclose($open);
?>