<?php 
    class User{
        public $name;
    }
    // class UserInfo{
    //     public $account
    //     personID
    //     password
    // }
    class Users extends DB{
        function register($acct,$pass,$ID){            
            $sql = <<<block
            insert into user (account,PASSWORD,personID,deposit) 
            values('$acct','$pass','$ID','0');
            block;
            return $this->insert($sql);
        }
        function get(){
            return $this->select("SELECT * FROM `user`");
          }
        function loginVerify($userName,$userPass){
            $hash = $this->select("SELECT password FROM `user` WHERE account = '$userName'");
            
            return password_verify($userPass, $hash[0]['password']);
        }
    }
?>