<a href='index.php?page=lista.php'>Λίστα αναφορών</a><br><br>
<?php 

if (isset($_POST['lysib']))
{

	
	$sqlcmd="update anafores set solution='$_POST[lysi]' , email_admin='$_SESSION[email]' ,date2=now()
	where id=$_GET[id]";
	
	
	if (mysql_query($sqlcmd)) 
		echo "Η Λύση καταχωρήθηκε";
	else 
	echo "Λάθος στην καταχώρηση";

}
else
{



$s="select * from anafores where id=$_GET[id]";
$q=mysql_query($s);
$r=mysql_fetch_array($q);
?>

	 <script>
			var map2;
			var marker2;
			function initialize2() {
			<?php
			echo "var pos= new google.maps.LatLng($r[lat], $r[lng]);";
			?>
			
			
			  var mapOptions = {
				zoom: 15,
				center: pos
			  };
			  
			  
			    map2 = new google.maps.Map(document.getElementById('map-canvas2'),  mapOptions);
			
			 var marker2=new google.maps.Marker( {
			 position: pos,
			 map: map2
			 });
			  
			  
			}

			google.maps.event.addDomListener(window, 'load', initialize2);
	</script>	
		<?php
		echo "
		<div id='map-canvas2' style='width:300px; height:300px;'></div>
		<br><br>
		<form action='' method=post>
		Θέση μου<br>
		Latitude=<input type=text readonly  name=lat value='$r[lat]' ><br>
		Longitude=<input type=text readonly   name=lng value='$r[lng]'><br>
		
		Κατηγορία:<br>
		$r[katigoria]	
		<br><br>
		
		
		Περιγραφή:<br> <input type=text name=perigrafi size=50 value='$r[description]'><br>
		";
		
		$ss="select * from photos where id_anaforas=$r[id]";
		$qq=mysql_query($ss);
		while ($rr=mysql_fetch_array($qq))
		{
		  echo "<img src='img/$rr[filename]' width=200px><br>";
		
		}
		

		if ($r['email_admin']=="" && $_SESSION['user']==1 )
		{
		echo "<form action='' method=post>
		Λύση: <input type=text name=lysi size=40><br>
		<input type=submit name=lysib value='Αποστολή Λύσης'>
		
		</form>
		";
		
		}
		else
		{
	      echo "Διαχειριστής Λύσης: $r[email_admin]<br>
	       Λύση: $r[solution]<br>";
		
		}


}
?>