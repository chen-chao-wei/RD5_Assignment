<?php 
    class User{
        
    }
    // class UserInfo{
    //     public $account
    //     personID
    //     password
    // }
    class Users extends DB{
        public $name;
        public $flag;
        //檢查註冊資料
        function register($acct,$pass,$ID){            
            $sqlCheckAcct = <<<block
            Select count(account) from users WHERE account='$acct';
            block;
            $sqlCheckID = <<<block
            Select count(personID) from users WHERE personID='$ID';
            block;
            $checkAcct  = $this->select($sqlCheckAcct);
            $checkID    = $this->select($sqlCheckID);
            var_dump($checkID[0]['count(personID)']);
            if($checkAcct[0]['count(account)']+$checkID[0]['count(personID)']==0){
                $sql = <<<block
                insert into users (account,password,personID,money) 
                values('$acct','$pass','$ID','0');
                block;
                return $this->insert($sql);
            }
            else{
                echo '<script>alert("帳號或身分證重複")</script>'; 
                return false;
            }
            
        }
        function get(){
            return $this->select("SELECT * FROM `user`");
          }
        //驗證帳密
        function loginVerify($userName,$userPass){
            $hash = $this->select("SELECT password FROM `users` WHERE account = '$userName'");            
            if(isset($hash[0]['password'])){
                return password_verify($userPass, $hash[0]['password']);
            }
            else{
                return false;
            }
            
        }
    }
?>