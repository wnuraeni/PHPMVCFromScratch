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
   
<table id="soal" border="1">
    <tr><th>Deskripsi</th><th>Soal</th><th>Pilihan1</th><th>Pilihan2</th><th>Pilihan3</th><th>Pilihan4</th><th>Pilihan5</th><th>Jawaban</th><th>Poin</th><th>Action</th></tr>
<?php 
    foreach ($data as $row) {
             echo    '<td>'.$row['deskripsi'].'</td>'.
                     '<td>'.$row['soal'].'</td>'.
                     '<td> '.$row['pilihan1'].'</td>'.
                     '<td>'.$row['pilihan2'].'</td>'.
                     '<td>'.$row['pilihan3'].'</td>'.
                     '<td>'.$row['pilihan4'].'</td>'.
                     '<td>'.$row['pilihan5'].'</td>'.
                     '<td>'.$row['kunci_jawaban'].'</td>'.
                     '<td>'.$row['poin'].'</td>'.
                     '<td><a href="'.BASE_URL.'dosen/editSoal/'.$row['id_soal'].'">Edit</a> <a href="'.BASE_URL.'dosen/deleteSoal/'.$row['id_soal'].'">Delete</a></td></tr>';
        }
?>
</table>
</div>
<form method="POST" action="<?php echo BASE_URL?>dosen/view_addSoal">
    <input type="hidden" name="kategori" value="<?php echo $_SESSION['kategori'];?>">
<input type="submit" name="tambahsoal" value="Tambah Soal">
</form>