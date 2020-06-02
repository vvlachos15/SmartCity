<?php
 
$s="select * from users";
$t=mysql_query($s);

while ($r=mysql_fetch_array($t))
{
echo "<a href='index.php?page=edituser.php&e=$r[email]'><b>$r[email]</b></a> ";
if ($r['user']==0) echo " -- Χρήστης";
else echo " -- Διαχειριστής";
echo "<br>";
}