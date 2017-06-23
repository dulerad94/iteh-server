<?php

require_once 'Connection.php';

class Receipt{


    public $receiptID;
    public $time;
    public $person;
    public $tableNumber;
    public $amount;
    public $items;



    /**
     * Receipt constructor.
     * @param $receiptID
     * @param $time
     * @param $person
     * @param $tableNumber
     * @param $amount
     * @param $items
     */
    public function __construct($receiptID, $time, $person, $tableNumber, $amount)
    {
        $this->receiptID = $receiptID;
        $this->time = $time;
        $this->person = $person;
        $this->tableNumber = $tableNumber;
        $this->amount = $amount;
    }
    public static function getReceipt($receiptID){
        try {
            $sql = "Select * from receipt where receiptID=$receiptID";
            global $conn;
            $result = $conn->query($sql);

            $row = $result->fetch_assoc();
            $receipt = new Receipt($row['receiptID'], $row['time'], $row['person'], $row['tableNumber'], $row['amount']);

            return $receipt;

        } catch (Exception $e) {
            return null;
        }
    }
    public static function getAllReceipts($sort,$filter)
    {
        $receipts = array();
        try {
            $sql = "Select * from receipt where person like '%".$filter."%' order by time $sort";
            global $conn;
            $result = $conn->query($sql);

            while ($row = $result->fetch_assoc()) {
                $receipt = new Receipt($row['receiptID'], $row['time'], $row['person'], $row['tableNumber'], $row['amount']);
                $sqlItems = "Select count(*) as count from receipt_item where receiptID=$receipt->receiptID";
                $itemsCount = $conn->query($sqlItems)->fetch_assoc();
                $receipt->items = $itemsCount['count'];
                array_push($receipts, $receipt);
            }

        } catch (Exception $e) {
            return '{"success":"false"}';
        }
        return '{"success":"true","receipts":' . json_encode($receipts) . '}';
    }

    public function insertReceipt()
    {
        try {
            $sql = "INSERT INTO receipt values(null,'".$this->time."','".$this->person."',".$this->amount.",".$this->tableNumber.")";
            global $conn;
            $conn->query($sql);
            $this->receiptID = $conn->insert_id;
        } catch (Exception $e) {
            return '{"success":"false"}';
        }
        return '{"success":"true","receipt":'.json_encode($this).'}';
    }

    public function deleteReceipt()
    {
        try {
            $sql = "DELETE FROM receipt where receiptID=$this->receiptID";
            global $conn;
            $conn->query($sql);
        } catch (Exception $e) {
            return '{"success":"false"}';
        }
        return '{"success":"true","id":"'.$this->receiptID.'"}';
    }

    public function updateReceipt()
    {
        try {
            $sql = "UPDATE receipt SET person='$this->person',amount=$this->amount,tableNumber=$this->tableNumber where receiptID=$this->receiptID";
            global $conn;
            $conn->query($sql);
        } catch (Exception $e) {
            return '{"success":"false"}';
        }
        return '{"success":"true","receipt":'.json_encode($this).'}';
    }

}