<style>
    form{
        width: 100px;
        height: 200px;
        position: relative;
        margin: auto;
        margin-top: 100px;
    }    
    form label{
        width: 100px;
    }
</style>
    
<?php echo empty($success)?'':$success;?>
<form action="<?php echo BASE_URL?>mahasiswa/process_reset_password" method="POST">
    <input type="hidden" name="email" value="<?php echo $email;?>">
    <label>Password : </label><input type="text" name="password">
    <label>Confirm Password: </label><input type="password" name="conf_password">
    <?php echo empty($error_msg)? '' : $error_msg; ?>
    <input type="submit" name="reset_password" value="Reset">
</form>