<a href='index.php?page=lista.php'>Λίστα αναφορών</a><br><br>
<?php
if (isset($_POST['eisagwgianaforas']))
{

	
	$s="INSERT INTO anafores (
	description ,lng ,lat ,date1,email_user,katigoria 
	)
	VALUES (
	 '$_POST[perigrafi]', '$_POST[lng]', '$_POST[lat]',   NOW(),
	 '$_SESSION[email]', '$_POST[katigoria]'
	)";
	
	
	if (mysql_query($s)) {
		echo "Η αναφορά καταχωρήθηκε";
		$id_last_anaf=mysql_insert_id();
		
		for ($i=1;$i<=4;$i++)
		{
		
			if ($_FILES["foto$i"]['name']!="")
			{
			$fn=$id_last_anaf.$_FILES["foto$i"]['name'];
			
			move_uploaded_file($_FILES["foto$i"]["tmp_name"],"img/".$fn);
			
			mysql_query("insert into photos(filename,id_anaforas) values('$fn',$id_last_anaf)");
			}
		
		
		
		}
	}
	else echo "Λάθος στην καταχώρηση";

}
else
{
?>




	 <script>
			var map2;
			var marker2;
			function initialize2() {
			var pos= new google.maps.LatLng(38.288717, 21.786181);
			
			  var mapOptions = {
				zoom: 15,
				center: pos
			  };
			  
			  
			    map2 = new google.maps.Map(document.getElementById('map-canvas2'),  mapOptions);
			
			 
			 		  
			  if(navigator.geolocation) {
				navigator.geolocation.getCurrentPosition(function(position) {
				
						pos = new google.maps.LatLng(position.coords.latitude,   position.coords.longitude);
									   
 						map2.setCenter(pos); 
						
						 marker2=new google.maps.Marker({
								position: pos, 
								map: map2
						});
		
					});
				}
				
				marker2=new google.maps.Marker({
				      position: pos, 
					  map: map2
				});
						document.getElementById("lat").value=pos.lat();
					document.getElementById("lng").value=pos.lng();
	
					 google.maps.event.addListener(map2, 'click', function(event) {
					 marker2.setMap(null);
					 pos=event.latLng;
					marker2=new google.maps.Marker( {
						position: pos,	
						map: map2
					});
						document.getElementById("lat").value=pos.lat();
					document.getElementById("lng").value=pos.lng();
				
				
				});
   
	
			 
			  
			  
			}

			google.maps.event.addDomListener(window, 'load', initialize2);
	</script>	
		
		<div id='map-canvas2' style='width:300px; height:300px;'></div>
		<br><br>
		<form action='' method=post  enctype='multipart/form-data'>
		Θέση μου<br>
		Latitude=<input type=text readonly id=lat name=lat ><br>
		Longitude=<input type=text readonly  id=lng name=lng ><br>
		
		Κατηγορία:<br>
		<select name=katigoria>
		<?php
		
		 $sqlcmd="select * from katigories";
   $res=mysql_query( $sqlcmd);
   while($row=mysql_fetch_array($res))
   {
   echo "<option>$row[katigoria]</option>";
   }
   
		
		?>
		</select><br><br>
		
		
		Περιγραφή:<br> <input type=text name=perigrafi size=50><br>
		
		Φωτογραφίες:<br>
		<input type=file name=foto1 accept='image/*' capture='camera'><br>
		<input type=file name=foto2 accept='image/*' capture='camera'><br>
		<input type=file name=foto3 accept='image/*' capture='camera'><br>
		<input type=file name=foto4 accept='image/*' capture='camera'><br>
		<input type=submit class=btn value='Εισαγωγή' name=eisagwgianaforas>
		</form>
		
<?php


}
?>