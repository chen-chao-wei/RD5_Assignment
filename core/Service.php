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
//存款
function setDeposit($userName, $actionName, $amount)
{
    $tableName = array("users");
    $fieldName = array("money", "id");
    $info = new transactionInfo($userName, $actionName, $amount);
    try {
        $conn = new DB();
        $sqlCkeckMoney = <<<block
            select {$fieldName[1]},{$fieldName[0]} from {$tableName[0]} WHERE account='$userName';
            block;
        $accountBalance = $conn->select($sqlCkeckMoney);
        $accountBalance[0]['money'] += $amount;
        $sqlUpdateMoney = <<<block
                UPDATE {$tableName[0]} SET {$fieldName[0]}={$accountBalance[0]['money']}  WHERE account='$userName';
                block;
        $conn->update($sqlUpdateMoney);
        $monaccountBalanceey = $conn->select($sqlCkeckMoney);
        $info->accountBalance = $accountBalance[0]['money'];
        $info->status = "SUCCESS";
        $sqlInsertInfo = <<<block
                insert into userTransactionInfo (id,account,actionName,amount,status,accountBalance)
                values({$accountBalance[0]['id']},'$info->userName','$info->actionName','$info->amount','$info->status','$info->accountBalance');
                block;
        $conn->insert($sqlInsertInfo);
        return $info;
    } catch (\Throwable $th) {
        return $th;
    }
}
function setWithdraw($userName, $actionName, $amount)
{
    $tableName = array("users");
    $fieldName = array("money", "id");
    $info = new transactionInfo($userName, $actionName, $amount);
    try {
        $conn = new DB();
        $sqlCkeckMoney = <<<block
            select {$fieldName[1]},{$fieldName[0]} from {$tableName[0]} WHERE account='$userName';
            block;
        $accountBalance = $conn->select($sqlCkeckMoney);
        //提款金額 大於 存款
        if ($amount > $accountBalance[0]['money']) {
            $info->accountBalance = $accountBalance[0]['money'];
            $info->status = "ERROR:帳戶金額不足";
            $sqlInsertInfo = <<<block
                insert into userTransactionInfo (id,account,actionName,amount,status,accountBalance)
                values({$accountBalance[0]['id']},'$info->userName','$info->actionName','$info->amount','$info->status','$info->accountBalance');
                block;
            $conn->insert($sqlInsertInfo);
            return $info;
        } elseif ($amount <= $accountBalance[0]['money']) {
            $accountBalance[0]['money'] -= $amount;
            $sqlUpdateMoney = <<<block
                UPDATE {$tableName[0]} SET {$fieldName[0]}={$accountBalance[0]['money']}  WHERE account='$userName';
                block;
            $conn->update($sqlUpdateMoney);
            $money = $conn->select($sqlCkeckMoney);
            $info->accountBalance = $money[0]['money'];
            $info->status = "SUCCESS";
            $sqlInsertInfo = <<<block
                insert into userTransactionInfo (id,account,actionName,amount,status,accountBalance)
                values({$accountBalance[0]['id']},'$info->userName','$info->actionName','$info->amount','$info->status','$info->accountBalance');
                block;
            $conn->insert($sqlInsertInfo);
            return $info;
        }
    } catch (\Throwable $th) {
        return $th;
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
        }else{
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
    @$actionName = $_POST["actionName"]; //取得 nickname POST 值
    @$amount = $_POST["amount"]; //取得 gender POST 值
    if ($actionName != null && $amount != null) { //如果 nickname 和 gender 都有填寫
        $info = new transactionInfo($userName, $actionName, $amount);
        switch ($actionName) {
            case 'withdraw':
                $info = setWithdraw($userName, $actionName, $amount);
                break;
            case 'deposit':
                $info = setDeposit($userName, $actionName, $amount);
                break;
        }

        echo json_encode(array(
            'userName' => $userName,
            'actionName' => $actionName,
            'amount' => $amount,
            'info' => $info
        ));
    } else if ($actionName == "checkRecords") {
        $result = getTransactionInfo($userName, $actionName,true);
        echo json_encode(array(
            'TransactionInfo' => $result
        ));
    } else {
        //回傳 errorMsg json 資料
        if ($actionName == null) {
            $actionName = "無效";
            $result = sendErrorMsg($userName, $actionName, $amount, "無效交易操作,ERROR CODE:444");
        } else {
            $amount = 0;
            $result = sendErrorMsg($userName, $actionName, $amount, "無效交易操作,ERROR CODE:1");
        }
        echo json_encode(array(
            'errorMsg' => "請輸入金額！"
        ));
    }//系統初始化
} elseif ($_SERVER['REQUEST_METHOD'] == "GET") {
    $capi = 'https://tw.rter.info/capi.php';
    $content = file_get_contents($capi);
    $currency = json_decode($content);
    $result = getTransactionInfo($_SESSION['userName'], "sys",false);
    if ($currency ) {
        echo json_encode(array(
            'currency' => $currency,
            'accountBalance' =>$result
        ));
    } else {
        echo json_encode(array(
            'errorMsg' => "查詢失敗,ERROR CODE:2"
        ));
    }
} else {
    //回傳 errorMsg json 資料
    echo json_encode(array(
        'errorMsg' => '請求無效，只允許 POST 方式訪問！'
    ));
}
