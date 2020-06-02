<?php
 
$s="select * from anafores ";
$t=mysql_query($s);

while ($r=mysql_fetch_array($t))
{
echo "<a href='index.php?page=editanaf.php&id=$r[id]'>$r[id]<a> <b>$r[description]</b> ";
if ($r['email_admin']=='') echo " -- Ανοικτή Αναφορά";
else echo " -- Διαχειριστής που έδωσε λύση: $r[email_admin] -- Λύση: $r[solution]<br><br> ";
echo "<br>";
}