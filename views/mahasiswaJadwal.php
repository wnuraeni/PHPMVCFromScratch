<style>
    h3{
        font-family: verdana;
        font-size: 16px;
        font-weight: bold;
        padding: 10px;
    }
    hr{       
        margin-bottom: 20px;
    }
    
    fieldset{
        background-color: #535353;
        float: left;
        padding: 10px;
    }
    table{
        background-color: white;
        
    }
    
</style>
    
<?php date_default_timezone_set('Asia/Jakarta');    
         $date = strtotime(date("Y-m-d")); //current date, diubah ke milidetik
         $time = strtotime(date("H:i:s")); //current time, diubah ke milidetik
     ?>
<?php echo empty($alert)?'':$alert;?>
<h3>Tabel Jadwal Tes</h3>
<hr>
<fieldset>
<table id="tabelJdwlTesMhs" border="1" >
<form id="tabelTes" method="POST" action="<?php echo BASE_URL;?>mahasiswa/mulaiTes">

    <tr><th>Mata Kuliah</th><th>Kategori</th><th>Tanggal Tes</th><th>Jam</th><th>Jangka Waktu</th><th>Status</th></tr>
<?php
//echo $jadwal;
foreach($jadwal as $data){
    echo '<tr><td>'.$data['nama_matkul'].'</td><td>'.$data['nama_kategori'].'</td><td>'.$data['tanggal_tes'].'</td><td>'.$data['waktu_mulai'].'</td><td>'.$data['waktu_tes'].'</td>';
    echo '<td>';
    //cek tanggal bila belum mulai
    if((($date - strtotime($data['tanggal_tes']))/86400)<0){
        echo 'Belum mulai';
    }
    else if((($date - strtotime($data['tanggal_tes']))/86400)==0){
        if(((($time - strtotime($data['waktu_mulai']))/60)>=0) && ((($time - strtotime($data['waktu_mulai']))/60)<=$data['waktu_tes'])){
           echo '<a href="'. BASE_URL.'mahasiswa/mulaiTes/'.$data['nama_kategori']. '">Mulai</a></td>';
           
        }else if(($time - strtotime($data['waktu_mulai'])<0)){
            echo 'Mulai dalam '.(abs(($time - strtotime($data['waktu_mulai']))/60)).' menit';
        }
       
        else{
            echo 'Sudah selesai';
        }
    }
    else{
        echo 'Sudah selesai';
    }
    echo '</td></tr>';
}
?>
</table>
</form>
</fieldset>