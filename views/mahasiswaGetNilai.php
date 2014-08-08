<form action="<?php echo BASE_URL;?>mahasiswa/show_per_table">
<select name="row">
    <option value="10">10</option>
    <option value="20">20</option>
    <option value="30">30</option>
    <option value="40">40</option>
    <input type="submit" value="show" name="show"> 
<!--   ke fungsi baru untuk setting session limit -->
</select>
</form>
<form action="<?php echo BASE_URL;?>mahasiswa/lihatNilai">
<input type="submit" name ="next" value="next">
</form>
<!--ke fungsi lihatHasilTes -->
<table id="tabelNilaiMhs" border="1">
    <tr><th>Mata Kuliah</th><th>Kategori</th><th>Poin</th></tr>
<?php
foreach($nilai as $data){
    echo '<tr><td>'.$data['nama_matkul'].'</td><td>'.$data['nama_kategori'].'</td><td>'.$data['poin'].'</td></tr>';
}
?>
</table>