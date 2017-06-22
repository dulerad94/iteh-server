<?php

require_once 'Connection.php';

class ReceiptItem{

    public $receipt;
    public $receiptItemID;
    public $amount;
    public $product;
    public $quantity;

    /**
     * Receipt constructor.
     * @param $receipt
     * @param $receiptItemID
     * @param $amount
     * @param $product
     * @param $quantity
     */
    public function __construct($receipt, $receiptItemID, $amount, $product, $quantity)
    {
        $this->receipt = $receipt;
        $this->receiptItemID = $receiptItemID;
        $this->amount = $amount;
        $this->product = $product;
        $this->quantity = $quantity;
    }


    public static function getAllItems($receipt){
        $items=array();
        try {
            $sql = "Select * from receipt_item where receiptID=$receipt->receiptID";
            global $conn;
            $result = $conn->query($sql);

            while ($row = $result->fetch_assoc()) {
                $item = new ReceiptItem($receipt, $row['receiptItemID'], $row['amount'], $row['product'], $row['quantity']);
                
                array_push($items,$item);
            }

        }catch(Exception $e){
            return '{"success":"false"}';
        }
        $receipt->items=$items;
        return  '{"success":"true","items":'.json_encode($items).'}';
    }
    public function insertItem(){
        try {
            $sql = "INSERT INTO receipt_item values(".$this->receipt->receiptID.",null,$this->amount,'$this->product',$this->quantity)";
            global $conn;
            $conn->query($sql);
            $this->receiptItemID = $conn->insert_id;
        }catch(Exception $e){
            return '{"success":"false"}';
        }
        return '{"success":"true"}';
    }
    public function deleteItem(){
        $sql="DELETE FROM receipt where receiptID=$this->receipt->receiptID and receiptItemID=$this->receiptItemID";
        global $conn;
        $conn->query($sql);
    }
    public function updateItem(){
        $sql="UPDATE receipt SET amount=$this->amount,product='$this->product',quantity=$this->quantity where receiptID=$this->receipt->receiptID and receiptItemID=$this->receiptItemID";
        global $conn;
        $conn->query($sql);
    }

}