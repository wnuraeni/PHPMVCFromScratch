<?php
class adminModel extends baseModel{

    function __construct() {
        parent::__construct();
    }
    function index(){

    }
    function check_user(){
        $nim = $_POST['id'];
        $pass = base64_encode($_POST['password']);
        $result = $this->db->query("SELECT * from admin WHERE `username` = '".$nim."' AND `password` = '".$pass."'");
        if($result->rowCount() == 1){
        //echo $result->rowCount();
        return true;
        }
    }
    function lihatUser($args=null){
            $query=$this->db->prepare("SELECT * from mahasiswa");
            $query->execute();
            $result = $query->fetchAll();
            return $result; 
        }
}

?>
