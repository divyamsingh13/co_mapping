<?php
include 'common.php';
echo "</br></br></br></br></br></br>";
include 'connect.php';

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

function showsection(str)
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
		xmlhttp.open("GET","showsubjectsec.php?q="+str,true)
		xmlhttp.send();
			
		xmlhttp.onreadystatechange=function()
		{
			if(xmlhttp.readyState==4&&xmlhttp.status==200)
			{
			
				document.getElementById("section").innerHTML=xmlhttp.responseText;
			}
		}
	}
	
 
 </script>
 <body id="main">
 
   <form method="POST" action="nba_student.php" id="form">
	
	<h3 align="center"><b>ADD MARKS<b></h3>
		
	<table id="table" width="40%">
		
		<tr>
			<td>Subject ID:</td>
			<td>
				<select size="1" name="subjectid" id="subjectid" required="required" onchange="showsection(this.value)">
					<option value=''>SELECT</option>
					<?php 
						//$getid="SELECT distinct(sub_id),type FROM assignrole WHERE fac_id='$username'";  //see...........
						
					    $getid="SELECT distinct(assignrole.sub_id),subject.category FROM assignrole,subject WHERE assignrole.sub_id=subject.sub_id AND assignrole.fac_id='$username' ";
						
						$retval = mysql_query( $getid );
					while($row = mysql_fetch_array($retval, MYSQL_ASSOC))
					{ if($row['category']=='T' || $row['category']=='O' || $row['category']=='t' || $row['category']=='o')       //associative array.....
					{echo "<option value='$row[sub_id]'>$row[sub_id]</option>";
					}
					}
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
			<td>
			Section</td>
			<td >
			<select size="1" name="section" id="section" required></select></td>
		</tr>
		<tr>
			<td>select exam:</td>
			<td>
				<select size="1" name="exam" required="required" >
				<?php
					$selectexam="SELECT * FROM allow where type='T'";                          
					

					$get = mysql_query( $selectexam, $conn );
					while($row = mysql_fetch_array($get, MYSQL_ASSOC))
					{
						if($row['value']=='Y' && $row['type']=='T'){
						echo "<option value='$row[setting]'>$row[setting]</option>";           
						}
					}
				?>
					
					
				</select>
			</td>
		</tr>
		
		
		<tr>
			<td>&nbsp</td>
			<td>
				<input type="submit" value="Submit" name="submit_entry" class="mybutton"  >
			</td>
		</tr>
		
	</table>
		
	
</form>


</body>

</html>
