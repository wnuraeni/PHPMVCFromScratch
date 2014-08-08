
    <div id="time"></div>
    <script type="text/javascript">
        HMStoSec(<?php echo '"'.$waktu.'"';?>,<?php echo '"'.$jangka.'"';?>,"time");
    </script>
    <body>
  
<div id="tes">
  <?php //echo 'pk:'.$waktu.'jangka'. $jangka; ?>
<form method="post" action="<?php echo BASE_URL;?>mahasiswa/proses_nilai/<?php echo $kategori;?>">
    <?php
       while(true){
           $i = rand(0,$max-1);
           if($_SESSION['soal'][$i] ==  0){
              $_SESSION['soal'][$i] += 1;
            $n = $i;
            break;
        }
       }
       ?>
    
    <?php
       echo '<fieldset><table><tr><td><span style="font-weight:bold">Deskripsi</span> </td></tr><tr><td>'.$soal[$n]['deskripsi'].'</td></tr></table></fieldset>';
       echo '<fieldset><table><tr><td><span style="font-weight:bold">Pertanyaan</span></td></tr><tr><td>'.$soal[$n]['soal'].'</td></tr>';
       ?>
</table>
    </fieldset>
    <fieldset>
        <table>
        <?php
       echo '<tr><td><span style="font-weight:bold">Pilihan</span></td></tr>';
    
            for($i=1;$i<=5;$i++){
                //echo $s['pilihan'.$i].'<br>';
                if($soal[$n]['pilihan'.$i]!=null){
                    
                echo '<tr><td><input type="checkbox" name="plhn_jwbn[]" value="'.$soal[$n]['pilihan'.$i].'"></td><td>'.$soal[$n]['pilihan'.$i].'</td>';
                echo '<td><input type="hidden" name ="kunci_jawaban" value="'.$soal[$n]['kunci_jawaban'].'"> <input type="hidden" name="poin" value="'.$soal[$n]['poin'].'"></td></tr>';
            }
            }
             
        
        if($_SESSION['counter']<$max){
           
?>
        <tr><td><input type="submit" name="soalSelanjutnya" value="Next"></td></tr>
        <?php }else{
     date("Y-m-d", time());
            ?>
        
        <tr><td><input type="submit" name="selesai" value="Selesai"></td></tr>
        <?php }?>
        </table>
    </fieldset>
    </form>
</div>
    </body>