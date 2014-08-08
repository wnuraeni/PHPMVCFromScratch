<link rel="stylesheet" href="<?php echo BASE_URL;?>css/style.css"/> 
<link rel="stylesheet" href="<?php echo BASE_URL;?>css/reset.css"/> 
    <script type="text/javascript" src="<?php echo BASE_URL;?>js/jquery-1.4.js"></script>  
               
        <script type="text/javascript">

$(document).ready(function(){
  var reglink = $('#reg_link');
  var regbox = $('#registerbox');
  var regform = $('#register_form');  
  var passlink = $('#pass_link');
  var passbox = $('#passwordbox');
  var passform = $('#password_form');
  reglink.removeAttr('link');
  passlink.removeAttr('link');
  regbox.hide();
  passbox.hide();
  reglink.mouseup(function(e){
     regbox.toggle();
     passbox.hide();
     reglink.toggleClass('active');
  });
  passlink.mouseup(function(e){
     passbox.toggle();
     regbox.hide();
     passlink.toggleClass('active');
  });
  form.mouseup(function(){
      return false;
  });
 $(this).mouseup(function(e){
      if(!($(e.target).parent('#reg_link').length > 0)){
          reglink.removeClass('active');
          regbox.hide();
         
      }
       if(!($(e.target).parent('#pass_link').length > 0)){
          passlink.removeClass('active');
          passbox.hide();
      }
  });
});
    </script>
    
  <body id="<?php echo isset($body_title)?$body_title:'';?>">
     
<div id="loginbox">
<!--<div id="menutab">-->
<ul id="menu_tab">
    <li id="mahasiswa_tab"><a href="<?php echo BASE_URL;?>mahasiswa">Mahasiswa</a></li>
    <li id="dosen_tab"><a href="<?php echo BASE_URL;?>dosen">Dosen</a></li>
    <li id="admin_tab"><a href="<?php echo BASE_URL;?>admin">Admin</a></li>
</ul>
<!--</div>-->
<div id="loginformfield">
    
    <div id="message"><script type="text/javascript"><?php echo $msg;?></script></div>  
<form id="login_form" method="post" action="<?php echo BASE_URL.$_SESSION['user'];?>/process_login"><!-- index coba ganti sesuai dengan user -->
   
    <p><label for="id"><?php echo ucfirst($label_id);?></label><input type="text" name="id" value="<?php echo $_POST['id']; ?>"></p>
        <p id="err_msg"><?php echo (empty($err_id))? '': $err_id; //error form validasi ?></p>
    <!-- input id end-->
    <p><label for="password">Password</label><input type="password" name="password"></p>
    <p id="err_msg"><?php echo (empty($err_pass))? '': $err_pass; //error form validasi?></p>
    <!-- input password end -->
    <p><input id="login" type="submit" name="submit" value="Masuk"></p>
</form>
<!--</div> input form end -->
<?php if($_SESSION['user']!= 'admin'){?>
<div id="regpass">
    
    <a href="#" id="reg_link">Registrasi</a>
    <a href="#" id="pass_link">Lupa Password</a>
    
<!-- selain admin tampilkan form registrasi dan form password-->
<?php require(SITE_PATH.'views/register.php');?> <!-- buat file register.php -->

<?php require(SITE_PATH.'views/password.php');?> 
</div>
</div>
<?php } ?>
</div>
       </body>