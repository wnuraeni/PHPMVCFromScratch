<div id="reg_container">
<fieldset id="registerbox">
     <?php echo $reg_msg; ?>
<form id="register_form" method="post" action="<?php echo BASE_URL.$_SESSION['user'];?>/process_register"><!-- index coba ganti sesuai dengan user -->
    <fieldset id="body">
        <fieldset><label><?php echo ucfirst($label_id).' :';?> </label><input type="text" name="id_reg">
    <span style="color: red"><?php echo (empty($err_id_reg))? '': $err_id_reg; ?></span></fieldset>
        <fieldset><label>Nama Lengkap : </label><input type="text" name="nama_lngkp">
    <span style="color: red"><?php echo (empty($err_nama_lngkp))? '': $err_nama_lngkp; ?></span></fieldset>
    <fieldset><label>Email : </label><input type="text" name="email">
    <span style="color: red"><?php echo (empty($err_email))? '': $err_email; ?></span></fieldset>
    <fieldset><label>Password : </label><input type="password" name="password">
    <span style="color: red"><?php echo (empty($err_pass_reg))? '': $err_pass_reg; ?></span></fieldset>
    <input type="submit" name="submit" id="register" value="Daftar">
    </fieldset>
</form>
 
</fieldset>
</div>