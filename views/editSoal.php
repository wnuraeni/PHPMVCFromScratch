<style>
    label{
        font-weight: bold;
    }
</style>
<div id="tabelsoal">
<table id="soal" bgcolor="#eee" width="500">
    <form method="POST" action="<?php echo BASE_URL;?>dosen/updateSoal">
<?php 

    foreach ($data as $row) {
             echo    '<tr><td><input type="hidden" name="id_soal" value="'.$row['id_soal'].'"></td></tr>'.
                     '<tr><td><label>Kategori</label></td><td><input type="text" name="nama_kategori" value="'.$row['nama_kategori'].'"></td></tr>'.
                     '<tr><td><label>Deskripsi</label></td><td><input type="text" name="deskripsi" value="'.$row['deskripsi'].'"></td></tr>'.
                     '<tr><td><label>Soal</label></td><td><input type="text" name="soal" value="'.$row['soal'].'"></td></tr>'.
                     '<tr><td><label>Pilihan1</label></td><td><input type="text" name="pilihan1" value="'.$row['pilihan1'].'"></td></tr>'.
                     '<tr><td><label>Pilihan2</label></td><td><input type="text" name="pilihan2" value="'.$row['pilihan2'].'"></td></tr>'.
                     '<tr><td><label>Pilihan3</label></td><td><input type="text" name="pilihan3" value="'.$row['pilihan3'].'"></td></tr>'.
                     '<tr><td><label>Pilihan4</label></td><td><input type="text" name="pilihan4" value="'.$row['pilihan4'].'"></td></tr>'.
                     '<tr><td><label>Pilihan5</label></td><td><input type="text" name="pilihan5" value="'.$row['pilihan5'].'"></td></tr>'.
                     '<tr><td><label>Kunci Jawaban</label></td><td><input type="text" name="kunci_jawaban" value="'.$row['kunci_jawaban'].'"></td></tr>'.
                     '<tr><td><label>Poin</label></td><td><input type="text" name="poin" value="'.$row['poin'].'"></td></tr>'.
                     '<tr><td><input type="submit" name="save" value="Save"></td></tr>';
             }
?>
    </form>
</table>
</div>
<?php 

//foreach($data as $row);
 //$data = $row['pilihan_jawaban'];
 //$data = explode(' ', $data);
 //print_r($data);
?>