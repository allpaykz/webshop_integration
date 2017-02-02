<?php
  header('Content-Type: text/html; charset=utf-8');
  require_once 'vendor/autoload.php';
  use allpaykz\webshop_integration\allpay;


  //���� �� ��������� � ��������� ������ � ����� allpay_key.
  //�� ��������� ������� �� �����: src/allpay_key/
  $key_path =  dirname(__FILE__).'/vendor/allpaykz/webshop_integration/tests';  // �������� �����.
  //********�����: ������������ ���� ��� __construct.********//
  $allpay = new allpay($key_path);
  //********������������ ���� ��� ���������� xml.********//
    //������ URL ��� �������� ���� ��� ������ ������. ������������ ��� ����������
    $allpay->set_success_url('http://www.shop_name.kz/success.html');
    //������ URL ��� �������� ���� ������ �� ������. ������������ ��� ����������
    $allpay->set_fail_url('http://www.shop_name.kz/fail.html');
    //������ URL ��� ���������� ����������. ��� ��� ����� �������� �� �����������.. ������������ ��� ����������
    $allpay->set_response_url('http://www.shop_name.kz/response_allpay.php');
    //������ ������������� �������� � ��. �������� � ������ ���������� ��������.  ������������ ��� ����������
    $allpay->set_merchant_id('75551234569');
    //�������� ��������, ������� ����� ������ ���������� �� �������� ������������� ��������. ������������ ��� ����������
    $allpay->set_shop_name('TOO NAME SHOP');
    //������������� ����� � ��. �� ���� ���� ����� ����������� ������ �� ����������. �������� � ������ ���������� ��������. ������������ ��� ����������
    $allpay->set_wallet('25252');
    //����� ������, ���� ������ ���� ���������� � ���� ������ ��������. ������������ ��� ����������
    $allpay->set_invoice('number_invoice'.rand(0,999));
    //����� ����� � ������. ������������ ��� ����������
    $allpay->set_amount('5');
  //********�����: ������������ ���� ��� ���������� xml.********//
  //********�� ������������ ���� ��� ���������� xml. ��������� ������������� ���� �� ��������� � xml �����.********//
    //������� ����������. ����������� �������� 600, ������������ 86400. ������������ ��� ����������
    $allpay->set_time_out('1024');
    //���������� ���������� ����������. �� ��������� �������� false. ���� �������� true, �� �� ���� ��������� ����������. ���� �������� false, �� �� ������������ ������ �� ����� ����������.
    $allpay->set_auto_transaction('true');
    //********��������� ����, ����������� ������ � ������� ����������.  �� ������������ ��� ����������.********//
      //��� ������
      $carts[0]['Code'] = 'string';
      //�������� ������
      $carts[0]['Name'] = 'string';
      //�������� ������
      $carts[0]['Description'] = 'string';
      //���������� ������ � ��������������� ���� ���������
      $carts[0]['Quantity'] = '10';
      //��������� ������
      $carts[0]['Cost'] = '1000';
      //��� ������ �2
      $carts[1]['Code'] = 'string1';
      //�������� ������ �2
      $carts[1]['Name'] = 'string1';
      //�������� ������ �2
      $carts[1]['Description'] = 'string1';
      //���������� ������ � ��������������� ���� ��������� �2
      $carts[1]['Quantity'] = '8';
      //��������� ������ �2
      $carts[1]['Cost'] = '2000';
      $allpay->set_cart($carts);
    //********�����: ��������� ����, ����������� ������ � ������� ����������.  �� ������������ ��� ����������.********//
  //********�����: �� ������������ ���� ��� ���������� xml. ��������� ������������� ���� �� ��������� � xml �����.********//
  //�������� xml ���������
  $allpay->create_xml();
  //���� ����� ������� ������. ����� ������ ��� ��������  xml ���������
  //echo $allpay->get_error_text();
  //�������� xml ������ � base64 ��� ������� � ������.
  $webshopRequest = $allpay->get_xml_base64();
  //������� �������� �������� ����� ��� method="post"  � enctype="application/x-www-form-urlencoded"
  echo '<form enctype="application/x-www-form-urlencoded" method="post" action="http://alpha.allpay.kz/mfs/WebShopPayment.xhtml" name="all-pay_'.time().'" id="all-pay_'.time().'">
          <input type="hidden" id="webshopRequest" name="webshopRequest" value="'.$webshopRequest.'" />
          <input type="submit" value="SEND" />
        </form>';
?>