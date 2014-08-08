<div id="pass_container">
<fieldset id="passwordbox">
    <?php echo (empty($msg)) ? '' : $msg; ?>
<form id="password_form" method="post" action="<?php echo BASE_URL.$_SESSION['user'];?>/process_password"><!-- index coba ganti sesuai dengan user -->
    <fieldset id="body">
    Email : <input type="text" name="email"> 
    <p id="err_msg"><?php echo (empty($err_email_pass))? '': $err_email_pass; //error form validasi?></p>
    
    <?php echo ucfirst($label_id).' :';?> <input type="text" name="id_reg">
    <p id="err_msg"><?php echo (empty($err_id_pass))? '': $err_id_pass; //error form validasi?></p>
    <input id="submit_pass"type="submit" name="submit" value="Kirim">
    
    </fieldset>
</form>
</fieldset>
</div>