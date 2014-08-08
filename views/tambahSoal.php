<div id="tabelmatkul">
<table id="matkulkategori" border="1">
    <tr><th>Nama Mata Kuliah</th><th>Nama Kategori</th></tr>
<?php 
    foreach ($matkul as $row) {
             echo '<tr><td>'.$row['nama_matkul'].'</td><td><a href="'.BASE_URL.'dosen/lihatSoal/'.$row['nama_kategori'].'">'.$row['nama_kategori'].'</td></tr>';
        }
?>
</table>
</div>
<div id="infotes">
<?php echo '<p><label>Tanggal tes : </label>'.$infotes['tanggal_tes'].'  <label>Jam : </label>'.$infotes['waktu_mulai'].'  <label>Jangka waktu : </label>'.$infotes['waktu_tes'].'</p><br/>';  
      echo '<p><label> Kategori : </label>'.$_SESSION['kategori'].'</p>';?>
</div>

<div id="tabelsoal">
<form method="POST" action="<?php echo BASE_URL;?>dosen/addSoal">
    <input type="hidden" name="kategori" value="<?php echo $_SESSION['kategori'];?>">
<table id="soal" border="1">
    <tr><th>Deskripsi</th><th>Soal</th><th>Pilihan1</th><th>Pilihan2</th><th>Pilihan3</th><th>Pilihan4</th><th>Pilihan5</th><th>Jawaban</th><th>Poin</th><th>Action</th></tr>
<?php 
                echo    '<tr><td><input type="text" name="deskripsi"></td>'.
                     '<td><input type="text" name="soal"></td>'.
                     '<td><input type="text" name="pilihan1"></td>'.
                     '<td><input type="text" name="pilihan2"></td>'.
                     '<td><input type="text" name="pilihan3"></td>'.
                     '<td><input type="text" name="pilihan4"></td>'.
                     '<td><input type="text" name="pilihan5"></td>'.
                     '<td><input type="text" name="kunci_jawaban"></td>'.
                     '<td><input type="text" name="poin"></td>'.
                     '<td><input type="submit" name="addsoal" value="Save"></td></tr>';
 
?>
</table>
</form>
</div>