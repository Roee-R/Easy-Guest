<?php
require_once('init.php');

class Session{
    private $signed_in;
    private $user_order;
    
    
    public function __construct(){
        session_start();
        $this->check_login();
    }
    private function check_login(){
        if(isset($_SESSION['user_order'])){
            $this->user_order=$_SESSION['user_order'];
            $this->signed_in=true;
        }
        else{
            unset($this->user_order);
            $this->signed_in=false;
        }}
        public function login($user){
            if($user){
                $this->user_order=$user->get_order();
                $_SESSION['user_order']=$user->get_order();
                $this->signed_in=true;
            }
        }
        public function logout(){

            echo "logout";
            unset($_SESSION['user_order']);
            unset($this->user_order);
            $this->signed_in=false;
            session_unset(); 
session_destroy(); 
        }
        public function is_login(){
            return $_SESSION['user_order']==true;
        }
        public function get_signet_in(){
            return $this->signed_in;
        }
        public function get_user_order(){
            return $this->user_order;
        }
    }

$session=new Session();


?>