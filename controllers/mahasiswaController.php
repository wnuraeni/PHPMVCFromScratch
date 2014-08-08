<?php
class mahasiswaController extends baseController{

    function __construct() {
        parent::__construct();
        //self::$counter = new self;
       
        
        $this->load->model('mahasiswa'); //panggil model yang diperlukan
        $_SESSION['user'] = 'mahasiswa'; //set user sebagai mahasiswa
        $_SESSION['body_title'] ='mahasiswa';
    }
    
    function index($arg=null){
              
        /*Bila user tercatat sudah login*/
        if(isset($_SESSION['logged_in'])){
            $data['body_title'] = 'mahasiswa';
            $data['sidecontent'] = 'menuMahasiswa.php';
            $data['maincontent'] = 'mahasiswaPage.php'; //arahkan ke main page
            $this->load->view('template',$data);
        }
        /*Bila user belum melakukan login*/
        else{
            $data['body_title'] = 'mahasiswa';
            //$data['maincontent'] = 'login.php'; //arahkan ke login page
            $data['label_id'] = 'NIM';
            $this->load->view('login',$data);
        }
        
        
    }
    function process_login(){
        /*Bila field id dan password tidak kosong, cek user untuk login*/
        if(!empty($_POST['id']) && !empty($_POST['password'])){
//           if(!preg_match('%[0-9]{4}[a-zA-Z]%', $_POST['id'])){
//            $data['err_id'] = 'Format NIM salah';
//            $data['body_title'] = 'mahasiswa';
//                $data['maincontent'] = 'login.php';
//                $data['label_id'] = 'NIM';
//                $this->load->view('login',$data);
//           }else{
                if($this->registry->mahasiswa->check_user()==TRUE){ 
                    $_SESSION['logged_in'] = TRUE;
                    $_SESSION['id_user'] = $_POST['id'];
                    $_SESSION['user_name'] = $this->registry->mahasiswa->get_user_name($_POST['id']);
                    header('location: '.BASE_URL.'mahasiswa');
                    exit;
                }
                else{
                    $data['body_title'] = 'mahasiswa';
                    $data['maincontent'] = 'login.php';
                    $data['label_id'] = 'NIM';
//                    $data['msg'] = 'NIM atau password salah, atau belum terdaftar';
                    $data['msg'] = 'alert("NIM / Password salah");';
                    $this->load->view('login',$data);
                }
        }
        
        /*Form validasi*/
        else{
            if(empty($_POST['id']))
                $data['err_id'] = '* required';
            if(empty($_POST['password']))
                $data['err_pass'] = '* required';
            $data['body_title'] = 'mahasiswa';
            $data['label_id'] = 'NIM';
            $data['maincontent'] = 'login.php';
            $this->load->view('login',$data);
        }
     
    }
    function process_register(){
        /*Bila field form tidak kosong*/
        if(!empty($_POST['id_reg'])&&!empty($_POST['nama_lngkp'])&&!empty($_POST['email'])&&!empty($_POST['password'])){
            $id_reg = $_POST['id_reg'];
            $nama_lngkp = $_POST['nama_lngkp'];
            $email = $_POST['email'];
            $password = base64_encode($_POST['password']);
//            if(!filter_var($email,FILTER_VALIDATE_EMAIL))
//                    $data['err_email'] = 'Email not valid';
//            if(!preg_match('%[0-9]{4}[a-zA-Z]%', $_POST['id_reg']))
//                    $data['err_id_reg'] = 'Format NIM salah';
//            if(!preg_match('%[a-zA-Z]%', $_POST['nama_lngkp']))
//                    $data['err_nama_lngkp'] = 'Hanya karakter alfabet yang diperbolehkan';
//            if(!preg_match('%[0-9][a-zA-Z]%', $_POST['password']))
//                    $data['err_pass_reg'] = 'Hanya karakter angka dan alfabet yang diperbolehkan';
//            else{
                
            if($this->registry->mahasiswa->new_register($id_reg,$nama_lngkp,$email,$password)==TRUE){ //panggil model untuk insert data
                $data['reg_msg'] = 'Registrasi telah berhasil';
            }
            else{
                $data['reg_msg'] = 'Registrasi tidak berhasil, sudah terdaftar?'; 
            }
//            }
        }
        /*Form validasi*/
        else{
            if(empty($_POST['id_reg']))
                $data['err_id_reg'] = '* required';
            if(empty($_POST['nama_lngkp']))
                $data['err_nama_lngkp'] = '* required';
            if(empty($_POST['email']))
                $data['err_email'] = '* required';
            if(empty($_POST['password']))
                $data['err_pass_reg'] = 'Masukkan password';
        }
        $data['body_title'] = 'mahasiswa';
        $data['label_id'] = 'NIM';
        $this->load->view('login',$data);
       }
    function process_password(){
        /*Mengecek apakah email yang berisi password berhasil dikirimkan*/  
        $email = $_POST['email'];
        $id = $_POST['id_reg'];
        
        //mengecek email valid atau tidak
        if(!filter_var($email,FILTER_VALIDATE_EMAIL))
            $data['err_email_pass'] = 'Email tidak valid';
//        if(!preg_match('%[0-9]{4}[a-zA-Z]%', $_POST['id_reg']))
//            $data['err_id_pass'] = 'Format NIM salah';
        else{
            //cek email dan id user, ada atau tidak
            if($this->registry->mahasiswa->check_email_user($email,$id) == TRUE){
                if($this->registry->mahasiswa->sent_reset_password() == TRUE){
                    $data['msg'] = 'Email konfirmasi password telah dikirim';
                }
                else{
                    $data['msg'] = 'Email gagal dikirim, masukkan alamat email yang valid';
                }
            }  
            else {
               $data['msg'] = 'Email tidak terdaftar';
            }
        }
//        echo $this->registry->mahasiswa->getPassword();
        $data['body_title'] = 'mahasiswa';
        $data['label_id'] = 'NIM';
        $this->load->view('login',$data);
    }
    function view_reset_password($email=null){
        $data['email'] = $email[0];
        $this->load->view('reset_password',$data);
    }
    function process_reset_password(){
        $email = $_POST['email'];
        $pass = $_POST['password'];
        $conf_pass = $_POST['conf_password'];
        if($pass != $conf_pass){
            $data['error_msg'] = 'Konfirmasi password dan password baru tidak sama';
            $this->load->view('reset_password',$data);
        }
        else{
            if($this->registry->mahasiswa->reset_password($email,$pass)==TRUE){
            $data['success'] = '<script type="text/javascript">alert("Password berhasil di reset, coba login lagi!"); window.location.href="http://localhost/testOnline/mahasiswa";</script>';
            $this->load->view('reset_password',$data);
            }
            else{
                $data['success'] = '<script type="text/javascript">alert("Password tidak berhasil di reset!"); </script>';
                $this->load->view('reset_password',$data);
            }
        }
    }
    function logout(){
        /*Bersihkan session*/
        session_unset();
        session_destroy();
        /*Arahkan kembali ke halaman utama*/
        header('location: '.BASE_URL);
        exit;
    }
    /*-------------------------------------------------------------------------------*/
    function jadwalTes(){
        $_SESSION['counter']=1;
        if(isset($_SESSION['soal']))
            unset($_SESSION['soal']);
            if(isset($_SESSION['total']))
            unset($_SESSION['total']);
            if(isset($_SESSION['kategori']))
            unset($_SESSION['kategori']);
            
        $data['body_title'] = 'mahasiswa';
        $data['sidecontent'] = 'menuMahasiswa.php';
        $data['maincontent'] = 'mahasiswaJadwal.php';
        $data['jadwal'] = $this->registry->mahasiswa->getJadwal();
        $this->load->view('template',$data);
    }
    function show_per_table(){
        $_SESSION['limit'] = $_POST['row'];
        $data['body_title'] = 'mahasiswa';
        $data['nilai'] = $this->registry->mahasiswa->getNilai(0,$_SESSION['limit']);
        $data['sidecontent'] = 'menuMahasiswa.php';
        $data['maincontent'] = 'mahasiswaGetNilai.php';
        $this->load->view('template',$data);
    }
    function lihatNilai(){
        if(isset($_POST['next'])){
        $_SESSION['offset'] += $_SESSION['limit']; 
      
        }
        $data['body_title'] = 'mahasiswa';
        $data['nilai'] = $this->registry->mahasiswa->getNilai();
        $data['sidecontent'] = 'menuMahasiswa.php';
        $data['maincontent'] = 'mahasiswaGetNilai.php';
        $this->load->view('template',$data);
    }
    function mulaiTes($kate=null){
        $arg = $kate[0];
       if($this->registry->mahasiswa->cek_status_tes($arg,$_SESSION['id_user']) == TRUE){
        //$arg = $kate[0];
        $_SESSION['kategori'] = $arg;
        $data['body_title'] = 'mahasiswa';
        $data['waktu'] = $this->registry->mahasiswa->getWaktuMulai($arg);
        $data['jangka'] = $this->registry->mahasiswa->getJangkaWaktu($arg);
        $data['soal']=$this->registry->mahasiswa->ambilSoal($arg);
        $data['kategori']=$arg;
        $data['max'] = $this->registry->mahasiswa->getJmlSoal($arg);
       
        $this->load->view('mulaiTes',$data);
       }
       else{
        $data['alert'] = '<script type="text/javascript">alert("Tes sudah diambil")</script>';
        $data['body_title'] = 'mahasiswa';
        $data['sidecontent'] = 'menuMahasiswa.php';
        $data['maincontent'] = 'mahasiswaJadwal.php';
        $data['jadwal'] = $this->registry->mahasiswa->getJadwal();
        $this->load->view('template',$data);
        
       }
    }

    function proses_nilai(){
        $kategori = $_SESSION['kategori'];
        //tambah counter session dengan 1
        $_SESSION['counter']=$_SESSION['counter']+1;
        //
        if($_SESSION['counter'] <= $this->registry->mahasiswa->getJmlSoal($kategori)){
            $pil_jwbn = $_POST['plhn_jwbn'];
            $kunci_jwbn = $_POST['kunci_jawaban']; //a dan b
            $poin = $_POST['poin'];
            $total = 0;
            $value = '';
            //menggabungkan dua jawaban
            foreach ($pil_jwbn as $pil) {
               if(count($pil_jwbn)> 1){
                  
                $value .= $pil.' ';   //a' '.b' '
               }
               
               else{
               echo $value = $pil;
               }
               }
               $newval = trim($value);
           if($newval == $kunci_jwbn){
               $_SESSION['total'] += $poin;
           }
               header('location: '.BASE_URL.'mahasiswa/mulaiTes/'.$_SESSION['kategori']);
               exit;
           }else{
               $pil_jwbn = $_POST['plhn_jwbn'];
            $kunci_jwbn = $_POST['kunci_jawaban'];
            $poin = $_POST['poin'];
            $total = 0;
            $value = '';
            foreach ($pil_jwbn as $pil) {
               if(count($pil_jwbn)> 1){
                $value .= $pil.' ';
               }
               else{
               echo $value = $pil;
               }
               }
               $newval = trim($value);
              if($newval == $kunci_jwbn){
               $_SESSION['total'] += $poin;
           }
                $this->registry->mahasiswa->inputNilai($_SESSION['total'],$_SESSION['kategori']);
    
                unset($_SESSION['total']);
                unset($_SESSION['counter']);
                unset($_SESSION['kategori']);
                unset($_SESSION['soal']);
                header('location: '.BASE_URL.'mahasiswa/');
               exit;
           }
           
       }
       
        
       
       //menghentikan tes secara paksa bila waktu telah habis
       function akhiri_tes(){
            $pil_jwbn = $_POST['plhn_jwbn'];
            $kunci_jwbn = $_POST['kunci_jawaban'];
            $poin = $_POST['poin'];
            $total = 0;
            $value = '';
            foreach ($pil_jwbn as $pil) {
               if(count($pil_jwbn)> 1){
                $value .= $pil.' ';
               }
               else{
               echo $value = $pil;
               }
               }
      $newval = trim($value);
           if($newval == $kunci_jwbn){
               $_SESSION['total'] += $poin;
           }
                $this->registry->mahasiswa->inputNilai($_SESSION['total'],$_SESSION['kategori']);
                unset($_SESSION['total']);
                unset($_SESSION['counter']);
                unset($_SESSION['kategori']);
                unset($_SESSION['soal']);
                header('location: '.BASE_URL.'mahasiswa/');
               exit;
           }
       
          
  }   

?>
