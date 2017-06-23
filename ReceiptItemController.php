<?php
require_once 'BaseController.php';
require_once 'ReceiptItem.php';
class ReceiptItemController extends BaseController{

    private static $controller;

    public static function getController(){
        if(!self::$controller){
            self::$controller=new ReceiptItemController();
        } return self::$controller;
    }
    public function doAction($method)
    {
        return parent::action($method, self::$controller);
    }

    public function select()
    {
        if(isset($_GET['receiptID'])){
            $receipt=Receipt::getReceipt($_GET['receiptID']);
            return ReceiptItem::getAllItems($receipt);
        }
        return '{"success":"false"}';
    }

    public function insert()
    {
        if (isset($_POST['receiptID']) && isset($_POST['amount']) && isset($_POST['product']) && isset($_POST['quantity']) ){
            $item=new ReceiptItem(Receipt::getReceipt($_POST['receiptID']),null, $_POST['amount'],$_POST['product'], $_POST['quantity']);
            return $item->insertItem();
        }
        return '{"success":"false"}';
    }

    public function update()
    {

        parse_str(file_get_contents("php://input"),$_POST);
        if (isset($_POST['receiptID']) && isset($_POST['receiptItemID']) && isset($_POST['amount']) && isset($_POST['product']) && isset($_POST['quantity']) ){
            $item=new ReceiptItem(Receipt::getReceipt($_POST['receiptID']),$_POST['receiptItemID'], $_POST['amount'],$_POST['product'], $_POST['quantity']);
            return $item->updateItem();
        }
        return '{"success":"false"}';
    }

    public function delete()
    {
        parse_str(file_get_contents("php://input"),$_GET);
        if (isset($_GET['receiptID']) && isset($_GET['receiptID'])){
            $receipt=new ReceiptItem(Receipt::getReceipt($_GET['receiptID']),$_GET['receiptItemID'],null,null,null);
            return $receipt->deleteItem();
        }
        return '{"success":"false"}';
    }


}