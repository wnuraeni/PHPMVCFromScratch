<?php
class dosenController extends baseController{
    
    function __construct() {
        parent::__construct();
        $this->load->model('dosen'); //panggil model yang diperlukan
        $_SESSION['user'] = 'dosen'; //set user sebagai mahasiswa
        $_SESSION['body_title'] ='admin';

    }
    
    function index(){
        /*Bila user tercatat sudah login*/
        if(isset($_SESSION['logged_in'])){
            $data['body_title'] = 'dosen';
            $data['sidecontent'] ='menuDosen.php';
            $data['maincontent'] = 'dosenHome.php'; //arahkan ke main page
            $this->load->view('template',$data);
         
         }
        /*Bila user belum melakukan login*/
        else{
            $data['body_title'] = 'dosen';
            $data['maincontent'] = 'login.php'; //arahkan ke login page
            $data['label_id'] = 'NIP';
            $this->load->view('login',$data);
        }
        
       
    }
    /*------------------------------------------Proses login, logout, register baru----------------------------*/
    function process_login(){
        /*Bila field id dan password tidak kosong, cek user untuk login*/
        if(!empty($_POST['id']) && !empty($_POST['password'])){
//            if(!preg_match('%[0-9]{4}[a-zA-Z]%', $_POST['id'])){
//            $data['err_id'] = 'Format NIP salah';
//            $data['body_title'] = 'dosen';
//                $data['maincontent'] = 'login.php';
//                $data['label_id'] = 'NIP';
//                $this->load->view('login',$data);
//        }else{
          
            if($this->registry->dosen->check_user()==TRUE){
                $_SESSION['logged_in'] = TRUE;
                $_SESSION['id_user'] = $_POST['id']; //menyimpan id user (NIM/NIP/username)
                header('location: '.BASE_URL.'dosen');
                exit;
            }
            else{
                $data['body_title'] = 'dosen';
                $data['maincontent'] = 'login.php';
                $data['label_id'] = 'NIP';
                $data['msg'] = 'NIP atau password salah, atau belum terdaftar';
                $this->load->view('login',$data);
            }
//           }
        }
        /*Form validasi*/
        else{
            if(empty($_POST['id']))
                $data['err_id'] = 'Masukkan NIP';
            if(empty($_POST['password']))
                $data['err_pass'] = 'Masukkan password';
            $data['body_title'] = 'dosen';
            $data['label_id'] = 'NIP';
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
             if(!filter_var($email,FILTER_VALIDATE_EMAIL))
                    $data['err_email'] = 'Email not valid';
            if(!preg_match('%[0-9]{4}[a-zA-Z]%', $_POST['id_reg']))
                    $data['err_id_reg'] = 'Format NIP salah';
            if(!preg_match('%[a-zA-Z]%', $_POST['nama_lngkp']))
                    $data['err_nama_lngkp'] = 'Hanya karakter alfabet yang diperbolehkan';
            if(!preg_match('%[0-9][a-zA-Z]%', $_POST['password']))
                    $data['err_pass_reg'] = 'Hanya karakter angka dan alfabet yang diperbolehkan';
            else{
                if(!filter_var($email,FILTER_VALIDATE_EMAIL))
                     $data['err_email'] = 'Email not valid';
                else{
                    if($this->registry->dosen->new_register($id_reg,$nama_lngkp,$email,$password)==TRUE){ //panggil model untuk insert data
                        $data['reg_msg'] = 'Registrasi telah berhasil';
                    }
                    else{
                        $data['reg_msg'] = 'Registrasi tidak berhasil, sudah terdaftar?'; 
                    }
                }
            }
         
         }
         else{
        /*Form validasi*/
//        
            if(empty($_POST['id_reg']))
                $data['err_id_reg'] = 'Masukkan NIP';
            if(empty($_POST['nama_lngkp']))
                $data['err_nama_lngkp'] = 'Masukkan nama lengkap';
            
            if(empty($_POST['email']))
                $data['err_email'] = 'Masukkan email';
            if(empty($_POST['password']))
                $data['err_pass_reg'] = 'Masukkan password';
        }
         $data['body_title'] = 'dosen';
         $data['label_id']='NIP';
         $this->load->view('login',$data);
             }
    function process_password(){
        if(!filter_var($email,FILTER_VALIDATE_EMAIL))
            $data['err_email_pass'] = 'Email tidak valid';
//        if(!preg_match('%[0-9]{4}[a-zA-Z]%', $_POST['id_reg']))
//            $data['err_id_pass'] = 'Format NIP salah';
        else{
            if($this->registry->dosen->sent_password() == TRUE){
                $data['msg'] = 'Email konfirmasi password telah dikirim';
            }
            else{
                $data['msg'] = 'Email gagal dikirim, masukkan alamat email yang valid';
            }
        }
        $data['body_title'] = 'dosen';
        $data['label_id'] = 'NIM';
        $this->load->view('login',$data);
    }
    function logout(){
        /*Bersihkan session*/
        session_unset();
        session_destroy();
        /*Arahkan kembali ke halaman utama*/
        header('location: '.BASE_URL);
        exit;
    }
    /*-------------------------------------------------------------------------------------------------------------------*/
/*tampilan membuat soal*/
    function buatTes(){
        $data['body_title'] = 'dosen';
        $data['sidecontent'] ='menuDosen.php';
        $data['maincontent'] = 'buatTes.php';
        $this->load->view('template',$data);
    }
    /*proses add matakuliah dan kategori*/
    function setTes(){
       
//        if(($this->registry->dosen->buatMatkul()==TRUE)&&($this->registry->dosen->buatKategori()==TRUE)){
        $_SESSION['matkul'] = $_POST['mata_kuliah'];
        $_SESSION['kategori'] = $_POST['nama_kategori'];
        $_SESSION['tgl_tes'] = $_POST['tgl_tes'];
        $_SESSION['wkt_mulai'] = $_POST['wkt_mulai'];
        $_SESSION['wkt_tes'] = $_POST['wkt_tes'];      
         header('location: '.BASE_URL.'dosen/buatTes');
        exit;   
//        }
//           else if($this->registry->dosen->buatMatkul()==FALSE){
//                $data['body_title'] = 'dosen';
//                $data['sidecontent'] ='menuDosen.php';
//                $data['maincontent'] = 'buatTes.php';
//                $data['error'] = 'Mata kuliah sudah ada';
//                $this->load->view('template',$data);
//           }
//           else if($this->registry->dosen->buatKategori()==FALSE){
//                $data['body_title'] = 'dosen';
//                $data['sidecontent'] ='menuDosen.php';
//                $data['maincontent'] = 'buatTes.php';
//                $data['error'] = 'Kategori sudah ada';
//                $this->load->view('template',$data);
//           }
        
    }
    function unsetTes(){
        unset($_SESSION['matkul']);
        unset($_SESSION['kategori']);
        unset($_SESSION['tgl_tes']);
        unset($_SESSION['wkt_mulai']);
        unset($_SESSION['wkt_tes']);
        header('location: '.BASE_URL.'dosen/buatTes');
        exit;
    }
    function proses_buatSoal(){
        $this->registry->dosen->tambahSoal();
        header('location: '.BASE_URL.'dosen/buatTes');
        exit;   
    }
    function lihatHasilTes($kategori=null){
        //print_r($kategori);
        if(!empty($kategori)){
        foreach($kategori as $arg){
        $param = $arg;
        }
        }
        $_SESSION['kategori'] = $param;
        $data['body_title'] = 'dosen';
        $data['sidecontent'] ='menuDosen.php';
        $data['maincontent'] = 'lihatHasilTes.php';
        $data['matkul'] = $this->registry->dosen->getMatkul();
        //print_r($this->registry->dosen->getMatkul());
        $data['infotes'] = $this->registry->dosen->getInfoTes($param);
        $data['data']=$this->registry->dosen->lihatHasilTes($param);
        //print_r($this->registry->dosen->lihatHasilTes($arg));
        $this->load->view('template',$data);
    }
    
    function lihatSoal($kategori=null){
        if(!empty($kategori)){
        foreach($kategori as $arg){
        $arg; // kategori
        }
        }
        $_SESSION['kategori'] = $arg;
        $data['body_title'] = 'dosen';
        $data['sidecontent'] ='menuDosen.php';
        $data['maincontent'] = 'lihatSoal.php';
        $data['matkul'] = $this->registry->dosen->getMatkul();
        $data['infotes'] = $this->registry->dosen->getInfoTes($arg);
        $data['data'] = $this->registry->dosen->lihatSoal($arg);
        $this->load->view('template',$data);
    }
  function editSoal($id=null){
        $idsoal = $id[0];
        $data['body_title'] = 'dosen';
        $data['sidecontent'] ='menuDosen.php';
        $data['maincontent'] = 'editSoal.php';
        $data['data'] = $this->registry->dosen->ambilSoal($idsoal);
        $this->load->view('template',$data);
  }
  function deleteSoal($id=null){
      $idsoal = $id[0];
      $this->registry->dosen->delete($idsoal);
      header('location: '.BASE_URL.'dosen/lihatSoal/'.$_SESSION['kategori']);
      exit;
  }
  function updateSoal(){
      $idsoal = $_POST['id_soal'];
      $kategori = $_POST['nama_kategori'];
      $deskripsi = $_POST['deskripsi'];
      $soal=$_POST['soal'];
      $pilihan1 = $_POST['pilihan1'];
      $pilihan2 = $_POST['pilihan2'];
      $pilihan3 = $_POST['pilihan3'];
      $pilihan4 = $_POST['pilihan4'];
      $pilihan5 = $_POST['pilihan5'];
      $kuncijawaban = $_POST['kunci_jawaban'];
      $poin = $_POST['poin'];
      $this->registry->dosen->update($idsoal,$kategori,$deskripsi,$soal,$pilihan1,$pilihan2,$pilihan3,$pilihan4,$pilihan5,$kuncijawaban,$poin);
      header('location: '.BASE_URL.'dosen/lihatSoal/'.$_SESSION['kategori']);
      exit;
  }
  function addSoal(){
      $kategori = $_POST['kategori'];
      $deskripsi = $_POST['deskripsi'];
      $soal = $_POST['soal'];
      $pilihan1 = $_POST['pilihan1'];
      $pilihan2 = $_POST['pilihan2'];
      $pilihan3 = $_POST['pilihan3'];
      $pilihan4 = $_POST['pilihan4'];
      $pilihan5 = $_POST['pilihan5'];
      $kunci = $_POST['kunci_jawaban'];
      $poin = $_POST['poin'];
      $this->registry->dosen->addSoal($kategori,$deskripsi,$soal,$pilihan1,$pilihan2,$pilihan3,$pilihan4,$pilihan5,$kunci,$poin);
      header('location: '.BASE_URL.'dosen/lihatSoal/'.$kategori);
     exit;
  }
  function view_addSoal(){
        $kategori = $_POST['kategori'];      
        $data['body_title'] = 'dosen';
        $data['sidecontent'] ='menuDosen.php';
        $data['maincontent'] = 'tambahSoal.php';
        $data['matkul'] = $this->registry->dosen->getMatkul();
        $data['infotes'] = $this->registry->dosen->getInfoTes($kategori);
        $data['data']=$this->registry->dosen->lihatHasilTes($kategori);
        $this->load->view('template',$data);
  }
}   

?>
