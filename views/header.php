<div id="logo">
    <img src="<?php echo BASE_URL;?>images/rfnetlogo.gif">
</div>
<div id="header_menu">
<ul>    
    <li><?php echo 'Welcome '.$_SESSION['user_name'];?></li>
    <li><a href="<?php echo BASE_URL.$_SESSION['user']; ?>/logout">Logout</a></li>
    <li><a href="<?php echo BASE_URL.$_SESSION['user']; ?>">Home</a></li>
    
</ul>
</div>