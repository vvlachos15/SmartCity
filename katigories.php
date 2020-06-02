
<?php

 
// an exoume patisei to koumpi prosthiki
if (isset($_POST['insertkatigoria']))
{

// ekteloume erotima prosthikis
	$sqltxt="insert into katigories(katigoria) values ('$_POST[katigoria]')";
	if(mysql_query($sqltxt)) echo "Η κατηγορία προστέθηκε !";
	else  echo "<font color=red> Η κατηγορία υπάρχει !</font>";
	
	
}


// diagrafi
if (isset($_POST['deletekatigoria']))
{
	$sqltxt="delete from katigories where katigoria='$_POST[katigoria]'";
		if(mysql_query($sqltxt)) echo "Η κατηγορία διαγράφηκε!";
	
}


?>

<table >
<tr><td><h2>Κατηγορία</h2></td><td> </td></tr>



<tr>
<form action='' method=post>
<td><input type=text name=katigoria></td>
<td><input type=submit value="Προσθήκη" name=insertkatigoria ></td>
</form>
</tr>
<?php


// epelexe oles tis katigories
$sqltext2="select * from katigories";
$restable=mysql_query($sqltext2);

// oso vrisko eggrafes dimiourgo grammes
while ($rowtable=mysql_fetch_array($restable))
{

	echo "
	<form action='' method='post'>
	<tr><td>
	
	<input type=text  readonly value='$rowtable[katigoria]' name=katigoria>
	</td><td>
	<input type=submit value='Διαγραφή' name=deletekatigoria class=btn>
	</td></tr></form>";	
}

?>
</table>