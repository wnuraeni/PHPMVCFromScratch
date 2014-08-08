<table id="matkulkategori" border="1">
    <tr><th>Nama Mata Kuliah</th><th>Nama Kategori</th></tr>
<?php 
    foreach ($matkul as $row) {
             echo '<tr><td>'.$row['nama_matkul'].'</td><td><a href="'.BASE_URL.'dosen/lihatHasilTes/'.$row['nama_kategori'].'">'.$row['nama_kategori'].'</td></tr>';
        }
?>
</table>
<div id="infotes">
<?php echo '<p><label>Tanggal tes : </label>'.$infotes['tanggal_tes'].'</p><br/>';  
echo '<p><label>Kategori : </label>'.$_SESSION['kategori'].'</p><br/>';
 ?>
</div>

<table id="hasil" border="1">
    <tr><th>NIM</th><th>Nilai</th></tr>
<?php 
if(!empty($data)){
    foreach ($data as $row) {
             echo '<tr><td>'.$row['NIM'].'</td><td>'.$row['poin'].'</td></tr>';
        }
}
?>
</table>

