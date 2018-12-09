<?php
    
    require('database.php');

    class User{
        private $user_order;
        private $user_id;



        public function get_id(){
            return $this->user_id;
        }
        public function get_order(){
            return $this->user_order;
        }
        private function instantation($user_array){
            $this->user_order=$user_array['orderNumber'];
            $this->user_id=$user_array['id'];
        }
        private function admin_instantation($user_array){
            $this->user_order=$user_array['user'];
            $this->user_id=$user_array['user'];
        }
        public function get_user_by_id($id){
            global $database;
            $result_set=$database->query("select orderNumber,id,checkInDate,checkOutDate from Guests where id='".$id."'");
            $found_user=$result_set->fetch_assoc();
            $this->instantation($found_user);
            return $this;
        }
        public static function add_user($orderNumber,$id,$name,$lastName,$password,$rePassword,$email,$phone,$address,$type,$holder,$cardNum,$expireMonth,$expireYear,$cvv,$passName,$pass,$visaName,$visa){
            global $database;
            $sql="INSERT INTO Guests (orderNumber,id,name,lastName,password,rePassword,email,phone,address,type,holder,cardNum,expireMonth,expireYear,cvv,passName,pass,visaName,visa) VALUES ('".$orderNumber."','".$id."','".$name."','".$lastName."','".$password."','".$rePassword."','".$email."','".$phone."','".$address."','".$type."','".$holder."','".$cardNum."','".$expireMonth."','".$expireYear."','".$cvv."','".$passName."','".$pass."','".$visaName."','".$visa."');";

            $result=$database->query($sql);
            
            if($result){
                
                $new_user=new user($orderNumber,$id);
                return true;            
                
            }
            else
                return null;
        }
        public function user_login($user, $pass){
            global $database;
            $sql="select orderNumber,id from Guests where orderNumber='".$user."' and password='".$pass."'";
            $result_set=$database->query($sql);
            echo ($result_set==null);
            if($result_set->num_rows==0){
                return null;
            }
            else{
                echo "user is found!";
            }
            $found_user=$result_set->fetch_assoc();
            $this->instantation($found_user);
            return $this;
        }
        public function admin_login($user, $pass){
            global $database;
            $sql="select user from admin where user='".$user."' and password='".$pass."'";
            $result_set=$database->query($sql);
            echo ($result_set==null);
            if($result_set->num_rows==0){
                return null;
            }
            else{
                echo "user is found!";
            }
            $found_user=$result_set->fetch_assoc();
            $this->admin_instantation($found_user);
            return $this;
        }
    }
    
    
    ?>