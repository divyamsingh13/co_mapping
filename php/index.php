<?php
include 'common.php';
include 'connect.php';
for($i=0;$i<10;$i++)
{
	echo "<br>";
}

echo "<h1 align='center' font='arial'>WELCOME TO MARKS SECTION</br></br></h1>";
if($username=='arun' || $username=='111'){
echo "<div align='center' ><table><form method='POST' action='index.php'>
			<tr align='center'><td><b style=font-size:20px;text-align:center;> MARKS UPDATE ALLOWED? </b></td></tr>
			<tr align='center'><td style=text-align:center;><input type='submit' value='ALLOWED' name='allow' class='button'></td></tr>
			<tr align='center'><td style=text-align:center;><input type='submit' value='NOT ALLOWED' name='not_allow' class='button'></td></tr>";

if(isset($_POST['allow']))
{
//$updatestatus="UPDATE allow_update SET allow='YES'";
$updatestatus="UPDATE allow SET value='Y' where setting='allow_update'";


$update = mysql_query( $updatestatus);
}
if(isset($_POST['not_allow']))
{
//$updatestatus="UPDATE allow_update SET allow='NO'";
$updatestatus="UPDATE allow SET value='N' where setting='allow_update'";

$update = mysql_query( $updatestatus);
}			
			
$checkupdate="SELECT value FROM allow where setting='allow_update'";

$checky = mysql_query( $checkupdate );
while($row = mysql_fetch_array($checky, MYSQL_ASSOC))
{$status=$row['value'];}
if($status=='N'){
echo "<tr align='center'><td><b style=font-size:20px> STATUS: NOT ALLOWED </b></td></tr>";
}
else
{
echo "<tr align='center'><td style=text-align:center;><b style=font-size:20px> STATUS: ALLOWED </b></td></tr>";
}
			
		echo "</form></table></div>";

}
?>
