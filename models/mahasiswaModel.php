<?php
class mahasiswaModel extends baseModel{

    function __construct() {
        parent::__construct();
    }
    function index(){

    }
    /*Mengecek apakah user ada dalam database*/
    function check_user(){
        $nim = $_POST['id'];
        $pass = base64_encode($_POST['password']);
        $result = $this->db->query("SELECT * from mahasiswa WHERE `NIM` = '".$nim."' AND `password` = '".$pass."'");
        if($result->rowCount() == 1){
        return true;
        }
    }
    function check_email_user($email,$id){
        $query = $this->db->query("SELECT * FROM mahasiswa WHERE NIM = '$id' AND email = '$email'");
        if($query->rowCount() > 0){
            return TRUE;
        }
        else{
            return FALSE;
        }
    }
    function get_user_name($id){
        $result = $this->db->query("SELECT nama_lengkap FROM mahasiswa WHERE NIM ='$id'");
         $row = $result->fetch(PDO::FETCH_ASSOC);
         return $row['nama_lengkap'];
    }
    /*Menambahkan data user baru ke dalam database*/
    function new_register($id,$nama,$email,$password){
        
        if($this->db->query("INSERT INTO mahasiswa VALUES( '".$id."', '".$nama."', '".$email."', '".$password."' )"))
                return true;
        return false;
    }
    /*Mengambil password user*/
    function getPassword(){
        $email = $_POST['email'];
        $id_reg = $_POST['id_reg'];
        $result = $this->db->query("SELECT password from mahasiswa WHERE `NIM` = '" .$id_reg."'");
        $row = $result->fetch(PDO::FETCH_ASSOC);
        return base64_decode($row['password']);
    }
    /*Mengirim password yang diminta melalui email*/
    function sent_reset_password(){
        $to = $_POST['email'];
        $subject = 'Reset Password';
        $body = 'Klik link dibawah untuk mereset password <br><a href="'.BASE_URL.'mahasiswa/view_reset_password/'.$to.'">Reset Password</a>';
       
        if(mail($to, $subject, $body)){
            return TRUE;
        }
        else{
            return FALSE;
        }
    }
    function reset_password($email,$password){
        $sql = "UPDATE mahasiswa SET password='".base64_encode($password)."' WHERE email = '$email'";
        if($this->db->query($sql))
            return TRUE;
        else
            return FALSE;
    }
    /*--------------------------------------------------------------------*/
    function getJadwal(){
      $sql = "SELECT `nama_matkul`, `nama_kategori`, `tanggal_tes`, `waktu_mulai`,`waktu_tes` FROM kategori_tes";  
      $query = $this->db->prepare($sql);
      $query->execute();
      $result = $query->fetchAll();
      return $result;
    }
    function cek_status_tes($kategori,$nim){
        $sql = "SELECT * FROM hasil_tes WHERE nama_kategori= '$kategori' AND NIM='$nim'";
        $query = $this->db->query($sql);
        if ($query->rowCount() == 0){
            return TRUE;
        }
        else{
            return FALSE;
        }
    }
    function getNilai(){
      $nim = $_SESSION['id_user'];
      $sql = "SELECT kategori_tes.nama_matkul, hasil_tes.nama_kategori, hasil_tes.poin FROM kategori_tes INNER JOIN hasil_tes ON kategori_tes.nama_kategori = hasil_tes.nama_kategori WHERE hasil_tes.`NIM` = '$nim'";  
      $query = $this->db->prepare($sql);
      $query->execute();
      $result = $query->fetchAll();
      return $result;
    }
    function ambilSoal($kate){
            $query=$this->db->prepare("SELECT * FROM `soal_tes` WHERE `nama_kategori`='$kate'");
            $query->execute();
            $result = $query->fetchAll();
            return $result; 
        }
    function getJmlSoal($kate=null){
            $result=$this->db->query("SELECT * FROM `soal_tes` WHERE `nama_kategori`='$kate'");            
            return $result->rowCount();
        }
        function getWaktuMulai($kate=null){
            $result = $this->db->query("SELECT waktu_mulai FROM kategori_tes WHERE nama_kategori = '$kate'");
            return $result->fetchColumn();
        }
        function getJangkaWaktu($kate=null)
        {
            $result = $this->db->query("SELECT waktu_tes FROM kategori_tes WHERE nama_kategori = '$kate'");
            return $result->fetchColumn();
        }
    function inputNilai($nilai,$kategori){
    
            $this->db->query("INSERT INTO `hasil_tes`(`NIM` ,`nama_kategori` ,`poin`) VALUES('".$_SESSION['id_user']."','$kategori','$nilai')");
        }
}

?>
