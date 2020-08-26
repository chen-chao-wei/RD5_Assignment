<?php
    class HomeController extends Controller{
        function index(){
            echo "home page of HomeController";
        }
        function hello($name){
            $user = $this->model("Users");
            $user->name = $name;
            $this->view("Home/hello",$user);
            //echo "Hello! $user->name";
        }
        
        function register(){
            $user = $this->model("Users");
            $userName = $_POST['account'];
            $userPass = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $userID = $_POST['personID'];
            $user->register($userName,$userPass,$userID);
            $this->view("Home/register");
        }
        function login(){
            $user = $this->model("Users");
            
            $userName = $_POST['account'];
            $userPass = $_POST['password'];
            $this->view("Home/login");
            if(isset($_POST['account'])){
                if($user->loginVerify($userName,$userPass)){
                    $this->Redirect("hello/$userName");                    
                }
                else{
                    $user->flag=false;
                    $this->view("Home/login",$user->flag);
                }
            }
            
        }
        
        
        
    }
    
    
?>