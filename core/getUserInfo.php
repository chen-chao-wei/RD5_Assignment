<?php
session_start();
require_once 'Database.php';
class transactionInfo
{
    var $userName;
    var $amount;
    var $actionName;
    var $status;
    var $accountBalance;
    function __construct($userName, $actionName, $amount)
    {
        $this->userName = $userName;
        $this->amount = $amount;
        $this->actionName = $actionName;
    }
}

function getTransactionInfo($userName, $actionName, $flag)
{
    $tableName = array("users");
    $fieldName = array("money", "id");
    $info = new transactionInfo($userName, $actionName, null);
    try {
        $conn = new DB();
        $sqlCkeckMoney = <<<block
            select {$fieldName[1]},{$fieldName[0]} from {$tableName[0]} WHERE account='$userName';
            block;
        $user = $conn->select($sqlCkeckMoney);
        //flag 0 系統顯示存款
        //flag 1 使用者查詢明細
        if ($flag) {
            $sqlInsertInfo = <<<block
                insert into userTransactionInfo (id,account,actionName,amount,status,accountBalance)
                values({$user[0]['id']},'$info->userName','$info->actionName','$info->amount','$info->status',{$user[0]['money']});
                block;
            $conn->insert($sqlInsertInfo);
            $sqlSelectInfo = <<<block
            SELECT * FROM 	userTransactionInfo WHERE account='$info->userName' order by datatime desc;
            block;
            $result = $conn->select($sqlSelectInfo);

            return $result;
        } else {
            return $user[0]['money'];
        }
    } catch (\Throwable $th) {
        return $th;
    }
}
function sendErrorMsg($userName, $actionName, $amount, $errorMsg)
{
    try {
        $conn = new DB();
        $sqlUserInfo = <<<block
                select id,account,money from users WHERE account='$userName';
                block;

        $user = $conn->select($sqlUserInfo);
        $sqlInsertInfo = <<<block
        insert into userTransactionInfo (id,account,actionName,amount,status,accountBalance)
        values({$user[0]['id']},"{$user[0]['account']}",'$actionName','$amount','$errorMsg',{$user[0]['money']});
        block;
        $conn->insert($sqlInsertInfo);
    } catch (\Throwable $th) {
        return $th;
    }
}
header('Content-Type: application/json; charset=UTF-8'); //設定資料類型為 json，編碼 utf-8
if ($_SERVER['REQUEST_METHOD'] == "POST") { //如果是 POST 請求    
    @$userName = $_POST["userName"];
    @$actionName = $_POST["actionName"];
    if ($userName != null) {
        $result = getTransactionInfo($userName, $actionName, true);
        echo json_encode(array(
            'TransactionInfo' => $result
        ));
    } else {
        echo json_encode(array(
            'errorMsg' => "查詢失敗,ERROR CODE:2"
        ));
    }
    //系統初始化
} elseif ($_SERVER['REQUEST_METHOD'] == "GET") {

    $result = getTransactionInfo($_SESSION['userName'], "sys", false);
    if ($result>=0) {
        echo json_encode(array(
            'accountBalance' => $result
        ));
    } else {
        echo json_encode(array(
            'errorMsg' => "查詢失敗,ERROR CODE:2"
        ));
    }
} else {
    //回傳 errorMsg json 資料
    echo json_encode(array(
        'errorMsg' => '請求無效！'
    ));
}
