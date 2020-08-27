<?php
session_start();
require_once 'Database.php';
class transactionInfo{
    var $amount;
    var $actionName;
    var $status;
    var $accountBalance;
    function __construct($actionName,$amount){
        $this->amount=$amount;
        $this->actionName=$actionName;
    }
}
function deposit($userName, $actionName,$amount){
    $tableName = array("users");
    $fieldName = array("money");
    $info=new transactionInfo($actionName,$amount);
    try {
        $conn = new DB();
        $sqlCkeckMoney = <<<block
            select {$fieldName[0]} from {$tableName[0]} WHERE account='$userName';
            block;
        $accountBalance = $conn->select($sqlCkeckMoney);
        $accountBalance[0]['money'] += $amount;
        $sqlUpdateMoney = <<<block
                UPDATE {$tableName[0]} SET {$fieldName[0]}={$accountBalance[0]['money']}  WHERE account='$userName';
                block;
        $conn->update($sqlUpdateMoney);
        $monaccountBalanceey = $conn->select($sqlCkeckMoney);
        $info->accountBalance = $accountBalance[0]['money'];
        $info->status = "success";
        return $info;
    } catch (\Throwable $th) {
        return $th;
    }
}
function withdraw($userName, $actionName,$amount){
    $tableName = array("users");
    $fieldName = array("money");
    $info=new transactionInfo($actionName,$amount);
    try {
        $conn = new DB();
        $sqlCkeckMoney = <<<block
            select {$fieldName[0]} from {$tableName[0]} WHERE account='$userName';
            block;
        $accountBalance = $conn->select($sqlCkeckMoney);
        //提款金額 大於 存款
        if($amount > $accountBalance[0]['money'] ){
            $info->accountBalance = $accountBalance[0]['money'];
            $info->status = "ERROR:帳戶金額不足".$info->amount;
            return $info;
        }
        elseif($amount <= $accountBalance[0]['money'] ){
            $accountBalance[0]['money'] -= $amount;
            $sqlUpdateMoney = <<<block
                    UPDATE {$tableName[0]} SET {$fieldName[0]}={$accountBalance[0]['money']}  WHERE account='$userName';
                    block;
            $conn->update($sqlUpdateMoney);
            $money = $conn->select($sqlCkeckMoney);
            $info->accountBalance = $money[0]['money'];
            $info->status = "success";
            return $info;
        }
    } catch (\Throwable $th) {
        return $th;
    }
}
header('Content-Type: application/json; charset=UTF-8'); //設定資料類型為 json，編碼 utf-8
if ($_SERVER['REQUEST_METHOD'] == "POST") { //如果是 POST 請求
    @$userName = $_POST["userName"];
    @$actionName = $_POST["actionName"]; //取得 nickname POST 值
    @$amount = $_POST["amount"]; //取得 gender POST 值
    if ($actionName != null && $amount != null) { //如果 nickname 和 gender 都有填寫
        $info = new transactionInfo($actionName,$amount);
        switch ($actionName) {
            case 'withdraw':
                $info = withdraw($userName,$actionName,$amount);
            break;
            case 'deposit':
                $info = deposit($userName,$actionName,$amount);
            break;
           
        }
            
        echo json_encode(array(
            'userName' => $userName,
            'actionName' => $actionName,
            'amount' => $amount,
            'info' => $info
        ));
    } else {
        //回傳 errorMsg json 資料
        echo json_encode(array(
            'errorMsg' => '請輸入金額！'
        ));
    }
} else {
    //回傳 errorMsg json 資料
    echo json_encode(array(
        'errorMsg' => '請求無效，只允許 POST 方式訪問！'
    ));
}
