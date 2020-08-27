<?php 
session_start();
$tableName ="user";
$fieldName ="money";
include_once '/RD5_Assignment/models/Money.php';
header('Content-Type: application/json; charset=UTF-8'); //設定資料類型為 json，編碼 utf-8
if ($_SERVER['REQUEST_METHOD'] == "POST") { //如果是 POST 請求
    @$actionName = $_POST["actionName"]; //取得 nickname POST 值
    @$amount = $_POST["amount"]; //取得 gender POST 值
    if ($actionName != null && $amount != null) { //如果 nickname 和 gender 都有填寫
        $user= new Money;
        $sql = $user->deposit("1234",$tableName,$fieldName,$amount);
        //回傳 nickname 和 gender json 資料
        echo json_encode(array(
            'actionName' => $actionName,
            'amount' => $amount,
            'sql' => $sql            
        ));
    } else { 
        //回傳 errorMsg json 資料
        echo json_encode(array(
            'errorMsg' => '請輸入金額！'
        ));
    }
    // if(isset($_SESSION['userName'])){
    //     switch ($actionName) {
    //         case 'value':
                
                
    //             break;
            
    //         default:
    //             # code...
    //             break;
    //     }
    // }
    
} else {
    //回傳 errorMsg json 資料
    echo json_encode(array(
        'errorMsg' => '請求無效，只允許 POST 方式訪問！'
    ));
}
?>