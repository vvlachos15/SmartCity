<?php

// syndeetai me tin vasi
include ("connect.php");

 
// an exei patithei to koumpi  koumpilogin tis formas me to login 
if (isset($_POST['koumpilogin']))
{

// elegxei an yparxei xristi me to email kai password pou dothike me vasi to erwtima pou akolouthei
    $s="select * from users where email='$_POST[email]' and password='$_POST[password]'";
	$t=mysql_query($s);
	
	// an yparxei
	if (mysql_num_rows($t)==1)
	{
	
	// vriskei ta stoixeia tou
	   $r=mysql_fetch_array($t);
	   
	   // orizei ta session pou kratame
	   $_SESSION['email']=$r['email'];
	   $_SESSION['user']=$r['user'];
	   
	
	}
	

}
// periptosi aposindesis
if (isset($_GET['page']))
{
  if ($_GET['page']=='logout.php')
  {
  
  // katastrefei to session kai to xekina pali
    session_destroy();
	session_start();
	
  
  }

}


?>

<html>

<title>Πανελλήνια Υπηρεσία Τεχνικής Υποστήριξης Τριτοβάθμιας Εκπαίδευσης</title>
<header>   
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="style.css">
</header>

<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>

    <script type="text/javascript">
      function initialize() {
        var mapOptions = {
          center: new google.maps.LatLng(38.288717, 21.786181),
          zoom: 15
        };
        var map = new google.maps.Map(document.getElementById("map-canvas"),  mapOptions);
			
			<?php
			$s="select * from anafores limit 0,20";
			$q=mysql_query($s);
			while ($r=mysql_fetch_array($q))
			{
			echo " 
			pos = new google.maps.LatLng($r[lat],$r[lng]);
			marker=new google.maps.Marker ({
			   position: pos,
			   map: map
			});
			map.setCenter(pos);
			";
			
			}
			?>
			
			
      }
      google.maps.event.addDomListener(window, 'load', initialize);
    </script>


<body>
<table id=maintable border=1 cellspacing=0>
<tr><td><img id=banner src="banner.jpg"></td></tr>
<tr><td id=menu>

<?php

//an exei oristei session diladi exei syndethei
if (isset($_SESSION['email']))
{

   // tote analoga an einai user i admin emfanizei to katallilo menu
   
   // xristis
   if ($_SESSION['user']==0)
   {
   echo "
  <ul >
<li><a href='index.php?page=welcome.php'>Αρχική</a></li>
<li><a href='index.php?page=anafores.php'>Αναφορές</a></li>
<li><a href='index.php?page=profil.php'>Στοιχεία Χρήστη</a></li>
<li><a href='index.php?page=logout.php'>Αποσύνδεση</a></li>
</ul>
 ";
   
   }
   
   // diaxeiristis
   if ($_SESSION['user']==1)
   {
echo "   <ul >
<li><a href='index.php?page=welcome.php'>Αρχική</a></li>
<li><a href='index.php?page=anafores.php'>Αναφορές</a></li>
<li><a href='index.php?page=katigories.php'>Κατηγορίες</a></li>
<li><a href='index.php?page=users.php'>Χρηστές</a></li>
<li><a href='index.php?page=profil.php'>Στοιχεία Χρήστη</a></li>
<li><a href='index.php?page=logout.php'>Αποσύνδεση</a></li>
</ul>";

   
   }
   



}
else
{

// an den exei syndethei emfanizei mono arxiki
echo "
<ul >
<li><a href='index.php'>Αρχική</a></li>
</ul>";


}

?>
</td></tr>
<tr>
<td id=main>

<?php

if (!isset($_GET['page']))
{
echo "
	<table width=100% cellspacing=5px>
	<tr><td width=40%>
	 <div id='map-canvas' />
	 </td>
	 <td width=60% valign=top>
	 <form action='index.php?page=welcome.php' method=post>
	 <table width=100% border=1 cellspacing=0>
	 Αν έχετε κωδικούς συμπληρώστε την παρακάτω φόρμα
	 <tr><td>email:</td><td><input type=text name=email></td></tr>
	 <tr><td>Password:</td><td><input type=password name=password><br></td></tr>
	 <tr><td colspan=2><input type=submit name=koumpilogin value='Σύνδεση'><br></td></tr>
	 </table>
	 </form>
	 <br>
	 <br>
	 Αλλιώς κάντε <a href='index.php?page=eggrafi.php'>νέα εγγραφή</a>.
	 <br><br>
	 Δείτε το <a href='rss.php' target=_blank>RSS</a>
	 
	 </td></tr>
	</table>";
}
else
{
   include ($_GET['page']);

}
	
	
	
?>	
	
</td></tr>
</table>
 



 </body>


</html>