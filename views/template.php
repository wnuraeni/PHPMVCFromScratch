<script type="text/javascript">
          function HMStoSec(Time,jangka,elem){
        var el = Time.split(":");
        var htos = el[0]*3600;
        var mtos = el[1]*60;
        var stos = el[2]*1;
        var total_wkt_mulai = htos + mtos + stos;
        var element = document.getElementById(elem);
        var date = new Date();
        var currenth = date.getHours()*3600;
        var currentm = date.getMinutes()*60;
        var currents = date.getSeconds();
        var curr_total = currenth + currentm + currents;
        //var diff = Math.floor((currtot-total)/3600);
        var diff = (curr_total-total_wkt_mulai)/60;
        var left_time = jangka - diff;
        element.innerHTML = "Sisa waktu "+Math.floor(left_time)+" menit lagi";
        if(left_time == 0){
            element.innerHTML = "Waktu habis";
            alert("Waktu habis");
            document.location.href='http://localhost/testOnline/mahasiswa/akhiri_tes';
      }
      HMStoSec(Time,jangka,elem);
    }
</script>
<html>
    <head>
        <link rel="stylesheet" href="<?php echo BASE_URL;?>css/style.css"/> 
        <link rel="stylesheet" href="<?php echo BASE_URL;?>css/reset.css"/> 
        <link rel="stylesheet" href="<?php echo BASE_URL;?>css/rfnet.css"/>
        <script type="text/javascript" src="<?php echo BASE_URL;?>js/jquery-1.4.js"></script>  
        <script type="text/javascript" src="<?php echo BASE_URL;?>js/datetimepicker.js"></script>
    <style type="text/css">
        a{color : blue;
        text-decoration: none;}
        .black{color:black;}
    </style>
    <title>Test Online</title>
   
    </head>
    <body >
  
        <div id="container">
        <?php if(isset($_SESSION['logged_in'])){?>
        <div id="header">
          <?php 
        require(SITE_PATH.'views/header.php'); //pilihan menu di main page
        ?>  
        </div>
         <?php }?>
            
        <div id="sidecontent">
        <?php 
        (empty($sidecontent))? '':require(SITE_PATH.'views/'.$sidecontent); //pilihan menu di main page
        ?>
        </div>

            <div id="maincontent">
         <?php require(SITE_PATH.'views/'.$maincontent); //isi body main page ?>
        </div>
                
        <div id="footer">
          <?php 
        require(SITE_PATH.'views/footer.php'); //pilihan menu di main page
         
        ?>  
            
        </div>
            
      
        </div>
    </body>
</html>