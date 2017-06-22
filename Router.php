<?php

require_once 'ReceiptController.php';
require_once 'ReceiptItemController.php';


    $method=$_SERVER['REQUEST_METHOD'];
    $route=getRoute();

    $response=null;
    switch($route){
        case "receipt": {
            $response=ReceiptController::getController()->doAction($method);
            break;
        }
        case "receipt-item": {
            $response=ReceiptItemController::getController()->doAction($method);
            break;
        }
        default: $response='{"success":"false"}';
    }
    header('Content-Type: application/json');
    echo $response;


    function getRoute(){
        return substr($_SERVER['PHP_SELF'],strpos($_SERVER['PHP_SELF'],"router.php/")+11);
    }
