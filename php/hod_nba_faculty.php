<?php
include 'common.php';
echo "</br></br></br></br></br></br>";
include 'connect.php';
$getid="SELECT * FROM login WHERE userid='$username'";

$retval = mysql_query( $getid, $conn );
while($row = mysql_fetch_array($retval, MYSQL_ASSOC)){
 	$dept=$row['branch'];
 	$category=$row['category'];
}
if($category!="HOD" && $category!="ADMIN"){
	header('Location: index.php');
}

$count=0;



?>
<!doctype html>
 <html lang="en" >
 <head>
	<meta charset="utf-8" />
	<title>Student Entry</title>
	<link rel="stylesheet" href="../css/finallook.css" >
	<link rel="stylesheet" type="text/css" href="../polyfill/number-polyfill.css" />
 </head> 
 <script>
	function disable()
{
		document.getElementById("to").style.visibility="hidden";
			document.getElementById("todate").style.visibility="hidden";
    
}
function enable()
{
//alert("cdsvcd");
	document.getElementById("to").style.visibility="visible";
		document.getElementById("todate").style.visibility="visible";
    
}
function inform()
{
	alert("PLEASE CHECK ALL MARKS BEFORE SUBMIT..!!");
}
 function find_section(){
value_select = document.getElementById("section").value;
}

function showfaculty(sem,dept)
	{
		
		var xmlhttp;
			
		if(window.XMLHttpRequest)
		{
			//code for IE7,firefox,chrome,opera,safari	
			
			xmlhttp=new XMLHttpRequest();
		}
		else
		{
			
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.open("GET","shownbafac.php?sem="+sem+"&dept="+dept,true)
		xmlhttp.send();
			
		xmlhttp.onreadystatechange=function()
		{
			if(xmlhttp.readyState==4&&xmlhttp.status==200)
			{
			
				document.getElementById("faculty").innerHTML=xmlhttp.responseText;
			}
		}
	}

	function showsub(fac_id,dept)
	{
		
		var xmlhttp;
			
		if(window.XMLHttpRequest)
		{
			//code for IE7,firefox,chrome,opera,safari	
			
			xmlhttp=new XMLHttpRequest();
		}
		else
		{
			
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.open("GET","shownbafac.php?fac_id="+fac_id+"&dept="+dept,true)
		xmlhttp.send();
			
		xmlhttp.onreadystatechange=function()
		{
			if(xmlhttp.readyState==4&&xmlhttp.status==200)
			{
			
				document.getElementById("subjectid").innerHTML=xmlhttp.responseText;
			}
		}
	}
	
 
 </script>
 <body id="main">
 
   <form method="POST" action="facultywise_show_nba.php" id="form">
	
	<h3 align="center"><b>CO PERCENTAGE<b></h3>
		
	<table id="table" width="40%">

		<tr>
			<td>
			faculty:</td>
			<td >
			<select size="1" name="faculty" id="faculty" required onchange="showsub(this.value,'<?php echo $dept; ?>')">
			<option value=''>SELECT</option>
			<?php $checksub="SELECT * FROM login where branch = '$dept'";
		
	    		$retval = mysql_query( $checksub, $conn );
	    	while($row = mysql_fetch_array($retval, MYSQL_ASSOC))
	    {
		    echo "<option value=$row[userid]>$row[name]($row[userid])</option>";
	    }?></select></td>
		</tr>

		<tr>
			<td>Subject ID:</td>
			<td>
				<select size="1" name="subjectid" id="subjectid" required="required" >
					<option value=''>SELECT</option>
					
				?>
				</select>
			</td>
		</tr>
		
		
		<tr>
			<td>Session:</td>
			<td>
			<select size="1" name="session" id="session" required="required">
				<option value="2014-15">2014-15</option>
				<option value="2015-16">2015-16</option>
				<option value="2016-17">2016-17</option>
				<option value="2017-18">2017-18</option>
			</select>
		</tr></td>

		
		
		
		
		<tr>
			<td>&nbsp</td>
			<td>
				<input type="submit" value="Submit" name="submit_entry" class="myButton"  >
			</td>
		</tr>
		
	</table>
		
	
</form>


</body>

</html>
