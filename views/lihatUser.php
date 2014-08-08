<table border="1">
    <tr>
        <td>NIM</td>
        <td>Nama Lengkap</td>
        <td>email</td>
    </tr>

           
<?php
foreach ($lihatUser as $user){
echo '<tr><td>'.$user['NIM'].'</td><td>'.$user['nama_lengkap'].'</td><td>'.$user['email'].'</td></tr>';
}
?>

</table>