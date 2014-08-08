<?php
class adminController extends baseController{

    function __construct() {
        parent::__construct();    
        $this->load->model('admin');
        $_SESSION['user'] = 'admin';
        $_SESSION['body_title'] ='admin';
    }
    function index(){
       if(isset($_SESSION['logged_in'])){
        $data['body_title'] = 'admin';
        $data['maincontent'] = 'adminPage.php';
        $data['sidecontent']='menuAdmin.php';
        $this->load->view('template',$data);
       }
       else{
       $data['title'] = 'Test Online';
       $data['body_title'] = 'admin';
       //$data['maincontent'] = 'login.php';
       $data['label_id'] = 'username';
       $this->load->view('login',$data);//memanggil view/template
      
       }
    }
    function process_login(){
        if(!empty($_POST['id']) && !empty($_POST['password'])){
            if($this->registry->admin->check_user()==TRUE){ 
                $_SESSION['logged_in'] = TRUE;
                $_SESSION['id_user'] = $_POST['id']; //menyimpan id user (NIM/NIP/username)
                header('location: '.BASE_URL.'admin');
                exit;
        }
        else{
        $data['body_title'] = 'admin';
        $data['maincontent'] = 'login.php';
        $data['label_id'] = 'username';
        $data['msg'] = 'username atau password salah';
        $this->load->view('login',$data);
        }
    }
    else{
       if(empty($_POST['id']))
                $data['err_id'] = 'Masukkan username';
            if(empty($_POST['password']))
                $data['err_pass'] = 'Masukkan password';
            $data['body_title'] = 'admin';
            $data['label_id'] = 'username';
            $this->load->view('login',$data);  
    }
    }
        
    function logout(){
        session_unset();
        session_destroy();
        header('location: '.BASE_URL);
        exit;
        
    }
    function lihatUser($args=null){
       if (!empty($args)){
        foreach ($args as $arg){
            $us=$arg;
        }
       }
        $data['body_title'] = 'admin';
        $data['lihatUser']=$this->registry->admin->lihatUser();
        $data['sidecontent']='menuAdmin.php';
        $data['maincontent']='adminPage.php';
        $data['body']='lihatUser.php';
        $this->load->view('template',$data);
    }
}
?>
