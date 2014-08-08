<?php
class dosenModel extends baseModel{

    function __construct() {
        parent::__construct();
        $_SESSION['user'] = 'dosen';
        
    }
    function index(){

    }
    function check_user(){
        $nim = $_POST['id'];
        $pass = base64_encode($_POST['password']);
        $result = $this->db->query("SELECT * from dosen WHERE `NIP` = '".$nim."' AND `password` = '".$pass."'");
        if($result->rowCount() == 1){
        return true;
        }
    }
    //daftar anggota baru
    function new_register($id,$nama,$email,$password){
        if($this->db->query("INSERT INTO dosen VALUES( '".$id."', '".$nama."', '".$email."', '".$password."' )")){
                return true;
        }
        else{
            return false;
        }
    }
    /*Mengambil password user*/
    function getPassword(){
        $email = $_POST['email'];
        $id_reg = $_POST['id_reg'];
        $result = $this->db->query("SELECT password from dosen WHERE `NIP` = '" .$id_reg."'");
        $row = $result->fetch(PDO::FETCH_ASSOC);
        
        return base64_decode($row['password']);
    }
    /*Mengirim password yang diminta melalui email*/
    function sent_password(){
        $to = $_POST['email'];
        $subject = 'Password';
        $body = "Ini password anda ".$this->getPassword();
        if(mail($to, $subject, $body)){
            return true;
        }
        else{
            return false;
        }
    }
    function buatMatkul(){
        if(!empty($_POST['mata_kuliah'])){
        $matkul = $_POST['mata_kuliah'];
        $id = $_SESSION['id_user'];
        if($this->db->query("INSERT INTO matakuliah(`nama_mk`,`id_dosen`) VALUES('$matkul','$id')"))
            return TRUE;
        else
            return FALSE;
        }    
    }
    function buatKategori(){
        if(!empty($_POST['mata_kuliah']) && !empty($_POST['nama_kategori'])){
        $matkul = $_POST['mata_kuliah'];
        $namakate = $_POST['nama_kategori'];
        $tgltes = date("Y-m-d",  strtotime($_POST['tgl_tes']));
        $wktmulai = $_POST['wkt_mulai'];
        $wkttes = $_POST['wkt_tes'];
        
        $this->db->query("INSERT INTO kategori_tes(`nama_matkul`, `nama_kategori`, `tanggal_tes`, `waktu_mulai`, `waktu_tes`) VALUES('$matkul','$namakate','$tgltes','$wktmulai','$wkttes')");
        }
        
    }
    function tambahSoal(){
        $kategori = $_SESSION['kategori'];
        $deskripsi = $_POST['deskripsi'];
        $soal = $_POST['soal'];
        $pilihan1 = $_POST['pilihan1'];
        $pilihan2 = $_POST['pilihan2'];
        $pilihan3 = $_POST['pilihan3'];
        $pilihan4 = $_POST['pilihan4'];
        $pilihan5 = $_POST['pilihan5'];
        $pilihan = $_POST['pilihan'];
        foreach($pilihan as $pilih){
        $jawaban .= $_POST[$pilih].' ';
        }
        
        
        //$jawaban = $_POST['pilihan1']; get value from checkbox
        $poin = $_POST['poin'];
        
        $jawaban = trim($jawaban);
        
        $this->db->query("INSERT INTO soal_tes(`nama_kategori`, `deskripsi`, `soal`, `pilihan1`,`pilihan2`,`pilihan3`,`pilihan4`,`pilihan5`,`kunci_jawaban`, `poin`) VALUES('$kategori','$deskripsi','$soal','$pilihan1','$pilihan2','$pilihan3','$pilihan4','$pilihan5', '$jawaban', '$poin')");
    }
    function lihatSoal($kategori=NULL){
       $sql = "SELECT * FROM soal_tes WHERE `nama_kategori`='$kategori'";
       $query = $this->db->prepare($sql);
       $query->execute();
       $result = $query->fetchAll();
       return $result;
    }
    function ambilSoal($id=NULL){
        $sql = "SELECT * FROM soal_tes WHERE `id_soal`='$id'";
       $query = $this->db->prepare($sql);
       $query->execute();
       $result = $query->fetchAll();
       return $result;
    }
    function update($id=NULL,$kategori=NULL,$deskripsi=NULL,$soal=NULL,$pilihan1=NULL,$pilihan2=NULL,$pilihan3=NULL,$pilihan4=NULL,$pilihan5=NULL,$kuncijawaban=NULL,$poin=NULL){
        $sql = "UPDATE soal_tes SET `nama_kategori`=?,`deskripsi`=?,`soal`=?,`pilihan1`=?,`pilihan2`=?,`pilihan3`=?,`pilihan4`=?, `pilihan5`=?, `kunci_jawaban`=?, `poin`=? WHERE`id_soal`='$id'";
        $query = $this->db->prepare($sql);
        $query->execute(array($kategori,$deskripsi,$soal,$pilihan1,$pilihan2,$pilihan3,$pilihan4,$pilihan5,$kuncijawaban,$poin));
    }
    function delete($id_soal){
        $this->db->query("DELETE FROM soal_tes WHERE `id_soal`='$id_soal'");
    }
    function getMatkul(){
        $id= $_SESSION['id_user'];
        $sql = "SELECT nama_matkul, nama_kategori FROM kategori_tes INNER JOIN matakuliah ON kategori_tes.nama_matkul = matakuliah.nama_mk WHERE matakuliah.id_dosen = '$id'";
       $query = $this->db->prepare($sql);
       $query->execute();
       $result = $query->fetchAll();
       return $result;
    }
    function getInfoTes($kategori=NULL){
        
        $sql = "SELECT `tanggal_tes`,`waktu_mulai`,`waktu_tes` FROM kategori_tes WHERE `nama_kategori` = '$kategori'";
        $result = $this->db->query($sql);
        $row = $result->fetch(PDO::FETCH_ASSOC);
        return $row;
    }
    function lihatHasilTes($kategori=NULL){
       $sql = "SELECT `nama_kategori`, `NIM`,`poin` from hasil_tes WHERE `nama_kategori`='$kategori'";
        $query = $this->db->prepare($sql);
       $query->execute();
       $result = $query->fetchAll();
       return $result;
    }
    function addSoal($kategori,$deskripsi,$soal,$pilihan1,$pilihan2,$pilihan3,$pilihan4,$pilihan5,$kunci,$poin){
        $this->db->query("INSERT INTO soal_tes(`nama_kategori`, `deskripsi`, `soal`, `pilihan1`,`pilihan2`,`pilihan3`,`pilihan4`,`pilihan5`,`kunci_jawaban`, `poin`) VALUES('$kategori','$deskripsi','$soal','$pilihan1','$pilihan2','$pilihan3','$pilihan4','$pilihan5', '$kunci', '$poin')");
    }
}

?>
