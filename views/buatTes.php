<script type="text/javascript" src="<?php echo BASE_URL;?>js/datetimepicker.js"></script>

<fieldset id="buatMkKate">
    <table>
<form method="POST" action="<?echo BASE_URL?>dosen/setTes">
    <tr><td style="color:red"><?php echo empty($error)?'':$error;?></td></tr>
<tr><td><label>Nama mata kuliah</label></td><td><?php echo isset($_SESSION['matkul'])? $_SESSION['matkul'] : '<input type="text" name="mata_kuliah">';?></td></tr>
<tr><td><label>Nama kategori</label></td><td><?php echo isset($_SESSION['kategori'])? $_SESSION['kategori'] : '<input type="text" name="nama_kategori">'?></td></tr>
<tr><td><label>Tanggal tes</label></td><td><?php echo isset($_SESSION['tgl_tes'])? $_SESSION['tgl_tes']:'<input type="date" name="tgl_tes" id="tanggal_tes">'?><a href="javascript: NewCssCal('tanggal_tes','ddmmyyyy')"><img src="../images/cal.gif" width="16" height="16" alt="Pick a date"></a></td></tr>
<tr><td><label>Waktu mulai</label></td><td><?php echo isset($_SESSION['wkt_mulai'])? $_SESSION['wkt_mulai']:'<input type="time" name="wkt_mulai" id="waktu_mulai">'?></td></tr>
<tr><td><label>Waktu tes</label></td><td><?php echo isset($_SESSION['wkt_tes']) ? $_SESSION['wkt_tes']:'<input type="number" name="wkt_tes">'?>(minute)</td></tr>
<tr><td><input type="submit" name="setTes" value="SET"></td><td><button onclick="document.location.href='<?echo BASE_URL?>dosen/unsetTes'; return false;">UNSET</button></td></tr>
    </form>
    </table>
</fieldset>
<fieldset id="buatSoal">
    <table>
<form method="POST" action ="<?echo BASE_URL?>dosen/proses_buatSoal">
    <tr><td><label>Deskripsi</label></td><td><textarea cols="50" row="5" name="deskripsi"></textarea></td></tr>
    <tr><td><label>Soal</label></td><td><textarea cols="50" row="5"name="soal"></textarea></td></tr>
    <tr><td><label>Pilihan Jawaban</label></td><td>&nbsp;</td><td><label>Jawaban Benar</label></td></tr>
    <tr><td><label>a</label></td><td><input type="text" name="pilihan1"></td><td><input type="checkbox" value="pilihan1" name="pilihan[]"></td></tr>
    <tr><td><label>b</label></td><td><input type="text" name="pilihan2"></td><td><input type="checkbox" value="pilihan2" name="pilihan[]"></td></tr>
    <tr><td><label>c</label></td><td><input type="text" name="pilihan3"></td><td><input type="checkbox" value="pilihan3" name="pilihan[]"></td></tr>
    <tr><td><label>d</label></td><td><input type="text" name="pilihan4"></td><td><input type="checkbox" value="pilihan4" name="pilihan[]"></td></tr>
    <tr><td><label>e</label></td><td><input type="text" name="pilihan5"></td><td><input type="checkbox" value="pilihan5" name="pilihan[]"></td></tr>
    <tr><td><label>Poin</label></td><td><input type="number" name="poin"></td></tr>
    <tr><td cols="3"><input type="submit" name="buat_soal" value="Tambah Soal"></td></tr>
</form>
    </table>
</fieldset>