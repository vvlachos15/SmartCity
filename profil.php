<?php
 
if (isset($_POST['koumpiallagis']))
{
   $s="update users set password='$_POST[password]',onoma='$_POST[onoma]',tilefono='$_POST[tilefono]' where email='$_SESSION[email]'";
   if (mysql_query($s)) echo "Τα στοιχεία άλλαξαν<br><br><br><br> ";
   else  echo "Λάθος στα στοιχεια<br><br><br><br> ";
}

$s="select * from users where email='$_SESSION[email]'";
$t=mysql_query($s);
$r=mysql_fetch_array($t);

 echo "

<h2> Προφίλ Χρήστη </h2>
<form action='' method=post>
<table>
<tr><td>email    </td><td><input type=email required readonly name=email value='$r[email]'></td></tr>
<tr><td>Password </td><td><input type=password required name=password value='$r[password]'></td></tr>
<tr><td>Όνομα    </td><td><input type=text name=onoma value='$r[onoma]'></td></tr>
<tr><td>Τηλέφωνο</td><td><input type=text name=tilefono value='$r[tilefono]'></td></tr>
<tr><td>        </td><td><input type=submit name=koumpiallagis  value='Αποθήκευση'></td></tr>
</table>
</form>";



?>