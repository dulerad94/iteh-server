<?php
require_once 'BaseController.php';
require_once 'Receipt.php';
class ReceiptController extends BaseController{

    private static $controller;

    public static function getController(){
        if(!self::$controller){
            self::$controller=new ReceiptController();
        } return self::$controller;
    }

    public function doAction($method)
    {
        return parent::action($method, self::$controller);
    }

    public function select()
    {
        $sort="ASC";

        if (isset($_GET['sort'])){
            $sort=$_GET['sort'];
        }

        return Receipt::getAllReceipts($sort);
    }

    public function insert()
    {
        if (isset($_POST['person']) && isset($_POST['amount']) && isset($_POST['tableNumber']) ){
            $receipt=new Receipt(null, date("Y-m-d h:i:s"),$_POST['person'], $_POST['tableNumber'], $_POST['amount']);
            return $receipt->insertReceipt();
        }
        return '{"success":"false"}';
    }

    public function update()
    {
        parse_str(file_get_contents("php://input"),$_POST);
        if (isset($_POST['receiptID'])  &&  isset($_POST['person']) && isset($_POST['amount']) && isset($_POST['tableNumber']) ){
            $receipt=new Receipt($_POST['receiptID'], Receipt::getReceipt($_POST['receiptID'])->time,$_POST['person'], $_POST['tableNumber'], $_POST['amount']);
            return $receipt->updateReceipt();
        }
        return '{"success":"false"}';
    }

    public function delete()
    {
        parse_str(file_get_contents("php://input"),$_GET);
        if (isset($_GET['receiptID'])){
            $receipt=new Receipt($_GET['receiptID'],null,null,null,null);
            return $receipt->deleteReceipt();
        }
        return '{"success":"false"}';
    }
}