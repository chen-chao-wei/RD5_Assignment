<?php
session_start();
// if (isset($_GET["logout"])) {
//     session_unset();    
//     $sUserName = "Guest";
//     //setcookie("userName", "Guest", time() - 3600);
//     header("Location: login.php");
//     exit();
// }

// if (isset($_POST["btnHome"])) {
//     header("Location: index.php");
//     exit();
// }


class HomeController extends Controller
{
    function index()
    {
        echo "home page of HomeController";
    }
    function hello()
    {
        if (isset($_POST["logout"])) {
            
            $message = $_SESSION["userName"]."您已登出.";
                        
            unset($_SESSION['userName']);
            //$this->Redirect("login");
            //setcookie("userName", "Guest", time() - 3600);
            // header("Location: index.php");
            // exit();
        }  
        if (isset($_SESSION["userName"])) {
            $sUserName = $_SESSION["userName"];  
            $user = $this->model("Users");
            $user->name = $sUserName;        
            $this->view("Home/hello",$user);            
            exit();
        }
        else{           
            
            unset($_SESSION['userName']);
            $this->Redirect("login");
            echo ("123r");
        }
        
        
        //echo "Hello! $user->name";
    }

    function register()
    {
        $user = $this->model("Users");
        
    }
    function login()
    {
        $user = $this->model("Users");
        
        //註冊動作
        if (isset($_POST['account'] , $_POST['password'] , $_POST['personID'])) {
            $userName = $_POST['account'];
            $userPass = $_POST['password'];
            $userID = $_POST['personID'];
            $userPass = password_hash($_POST['password'], PASSWORD_DEFAULT);
            if ($user->register($userName, $userPass, $userID)) {
                echo '<script>alert("註冊成功 請重新登入")</script>';             
                $this->view("Home/login",$user);
                exit();
            } else {                
                $user->flag = false;                
                echo '<script>alert("註冊失敗！！ 請重新註冊")</script>';             
                $this->view("Home/login",$user);
                exit();
            }
        }//登入動作
        elseif (isset($_POST['account'] , $_POST['password']) && isset($_POST['personID'])==false) {
            $userName = $_POST['account'];
            $userPass = $_POST['password'];
            if ($user->loginVerify($userName, $userPass)) {                
                $sUserName = $_POST["account"];
                if (trim($sUserName) != "") {
                    $_SESSION["userName"] = $sUserName; 
                }                
                $this->Redirect("hello",$user);
                exit();
            } else {          
                echo '<script>alert("帳號或密碼錯誤")</script>';      
                $user->flag = false;
                $this->view("Home/login", $user);
                exit();
            }
        } else {
            
            $user->flag = true;
            $this->view("Home/login", $user);
            exit();
        }
              
        
       
        

    }
}
