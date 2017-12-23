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

function showsection(sem,dept)
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
		xmlhttp.open("GET","shownbasec.php?sem="+sem+"&dept="+dept,true)
		xmlhttp.send();
			
		xmlhttp.onreadystatechange=function()
		{
			if(xmlhttp.readyState==4&&xmlhttp.status==200)
			{
			
				document.getElementById("section").innerHTML=xmlhttp.responseText;
			}
		}
	}

	function showsubject(sem,dept)
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
		xmlhttp.open("GET","shownbasub.php?sem="+sem+"&dept="+dept,true)
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
 
   <form method="POST" action="students_attempted1.php" id="form">
	
	<h3 align="center"><b>CO PERCENTAGE<b></h3>
		
	<table id="table" width="40%">
		<tr>
		<td>Semester:</td>
		<td><select size="1" name="semester" id="semester" required="required" onchange="showsection(this.value,'<?php echo $dept; ?>');showsubject(this.value,'<?php echo $dept; ?>');">
		<option value="">SELECT</option>
		<?php
			$getsem = "SELECT DISTINCT(semester) from student WHERE branch='$dept'";
			$run_sem = mysql_query($getsem);
			while($row_sem= mysql_fetch_array($run_sem)) {
				echo "<option value='$row_sem[semester]'>$row_sem[semester]</option>";
			} 
		?></select></td>
		</tr>

		<tr>
			<td>
			Section</td>
			<td >
			<select size="1" name="section" id="section" required ></select></td>
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
				<input type="submit" value="Submit" name="submit_entry" class="myButton"  >
			</td>
		</tr>
		
	</table>
		
	
</form>


</body>

</html>
