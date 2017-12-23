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

function submitForm()
{

		var xmlhttp;

		var sid = document.getElementById("subjectid").value;
		var sec = document.getElementById("section").value;
		var exam = document.getElementById("exam").value;
		var mm = document.getElementById("max_marks").value;

			
		if(window.XMLHttpRequest)
		{
			//code for IE7,firefox,chrome,opera,safari	
			
			xmlhttp=new XMLHttpRequest();
		}
		else
		{
			
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.open("GET","getstud_entry.php?sid="+sid+"&sec="+sec+"&exam="+exam+"&max_marks="+mm,true)
		xmlhttp.send();
			
		xmlhttp.onreadystatechange=function()
		{
			if(xmlhttp.readyState==4&&xmlhttp.status==200)
			{
			
				document.getElementById("slist").innerHTML=xmlhttp.responseText;
			}
		}
}
function mm(val)
{
	if(val=='CT1' || val=='CT2')
		document.getElementById('max_marks').innerHTML="<option value='10'>10</option>";
	else if(val=='ST1' || val=='ST2')
		document.getElementById('max_marks').innerHTML="<option value='30'>30</option>";
	else
		document.getElementById('max_marks').innerHTML="<option value='50'>50</option><option value='100'>100</option>";	
}
 </script>
 <body id="main">
 
   <form method="POST" action="entry.php" id="form">
	
	<h3 align="center"><b>ADD MARKS<b></h3>
		
	<table id="table" width="40%">
		
		<tr>
			<td>Subject ID:</td>
			<td>
				<select size="1" name="subjectid" id="subjectid" required="required" onchange="showsection(this.value)">
					<option value=''>SELECT</option>
					<?php 
						//$getid="SELECT distinct(sub_id),type FROM assignrole WHERE fac_id='$username'";
						$getid="SELECT distinct(assignrole.sub_id),subject.category FROM assignrole,subject WHERE assignrole.sub_id=subject.sub_id AND assignrole.fac_id='$username'";
						
						$retval = mysql_query( $getid, $conn );
					while($row = mysql_fetch_array($retval, MYSQL_ASSOC))
					{ if($row['category']=='T' || $row['category']=='O' )
					{echo "<option value='$row[sub_id]'>$row[sub_id]</option>";
					}
					}
				?>
				</select>
			</td>
		</tr>
		<tr>
			<td>
			Section</td>
			<td >
			<select size="1" name="section" id="section" required></select></td>
		</tr>
		<tr>
			<td>select exam:</td>
			<td>
				<select size="1" id="exam" name="exam" required="required" onchange="mm(this.value)">
				<option>SELECT</option>
				<?php
					$selectexam="SELECT * FROM allow";
					
					$get = mysql_query( $selectexam, $conn );
					while($row = mysql_fetch_array($get, MYSQL_ASSOC))
					{
						if($row['value']=='Y' && $row['type']=='T'){                   
						echo "<option value='$row[exam]'>$row[exam]</option>";
						}
					}
				?>
					
					
				</select>
			</td>
		</tr>
		
		<tr>
			<td>Maximum marks:</td>
			<td>
				<select name="max_marks" id="max_marks" required="required">
				</select>
			</td>
		</tr>
		<tr>
			<td>&nbsp</td>
			<td>
			<input type="button" value="Submit" name="submit" class="myButton" onclick=submitForm()  >
			</td>
		</tr>
		
	</table>
		
<div id='slist'>
</div>	
</form>

<?php
	
	if(isset($_POST['save']))
	{
		$subjectid = $_POST['subjectid'];
		$section = $_POST['section'];
		$exam = $_POST['exam'];
		$max_marks = $_POST['max_marks'];
		$count = $_POST['count'];
		$semester = $_POST['semester'];

		for ($i=1; $i <= $count; $i++) { 
			if($_POST['m_'.$i]==-1)
				$_POST['m_'.$i]='A';

			if($exam=='CT1')
				$e='exam1';
			elseif($exam=='CT2')
				$e='exam2';
			elseif($exam=='ST1')
				$e='exam3';
			elseif($exam=='ST2')
				$e='exam4';
			else
				$e='exam5';

		$sql1="UPDATE marks SET $e='".$_POST['m_'.$i]."' WHERE (st_id='".$_POST['roll_'.$i]."' AND sub_id='$subjectid')";
		$result = mysql_query( $sql1, $conn);
		if(!$result)
			{
			 die('Could not enter data: ' . mysql_error());
			}

		}
						

		$disallow="UPDATE assignrole SET $e='N' WHERE (fac_id='$username' AND sub_id='$subjectid' AND section='$section')";
		$dis = mysql_query( $disallow, $conn);
		
		/*$maxentry="INSERT INTO calculation".                                                       
				"(semester, section, sub_id, exam, outof)".
				"VALUES ('$semester','$section','$subjectid','$exam','$max_marks')";*/
		if($semester=='' || $section=='' || $subjectid=='' || $exam=='' || $max_marks=='' || $semester==NULL || $section==NULL || $subjectid==NULL || $exam==NULL || $max_marks==NULL)
			{
				for ($i=1; $i <= $count; $i++) { 
					if($_POST['m_'.$i]==-1)
						$_POST['m_'.$i]='A';

						
				if($_POST['m_'.$i]!='PC' || $_POST['m_'.$i]!='DB')
				{
						$sql1="UPDATE marks SET $e=NULL WHERE (st_id='".$_POST['roll_'.$i]."' AND sub_id='$subjectid')";
				$result = mysql_query( $sql1, $conn);
				}
				//$sql1="DELETE FROM calculation WHERE (semester='".$semester."' AND sub_id='$subjectid' AND exam='$exam' AND outof='$max_marks' AND section='$section')";
				//$result = mysql_query( $sql1, $conn);
				$disallow="UPDATE assignrole SET $e='Y' WHERE (fac_id='$username' AND sub_id='$subjectid' AND section='$section')";
				$dis = mysql_query( $disallow, $conn);

				}
				die("Error in inserting marks!");
			}
		
		if(!($enter = mysql_query( $maxentry, $conn )))
			{
				for ($i=1; $i <= $count; $i++) { 
					if($_POST['m_'.$i]==-1)
						$_POST['m_'.$i]='A';

				if($_POST['m_'.$i]!='PC' || $_POST['m_'.$i]!='DB')
					{$sql1="UPDATE marks SET $e=NULL WHERE (st_id='".$_POST['roll_'.$i]."' AND sub_id='$subjectid')";
				$result = mysql_query( $sql1, $conn);
				}//$sql1="DELETE FROM calculation WHERE (semester='".$semester."' AND sub_id='$subjectid' AND exam='$exam' AND outof='$max_marks' AND section='$section')";
				//$result = mysql_query( $sql1, $conn);
				$disallow="UPDATE assignrole SET $e='Y' WHERE (fac_id='$username' AND sub_id='$subjectid' AND section='$section')";
				$dis = mysql_query( $disallow, $conn);

				}
				die("Error in inserting marks1!");
			}
		/*$maxupdate="UPDATE calculation SET outof='$max_marks' WHERE semester='$semester' AND section='$section' AND sub_id='$subjectid' AND exam='$exam'";
		if(!($enter = mysql_query( $maxupdate, $conn )))                                            //calculation............
			{
				for ($i=1; $i <= $count; $i++) { 
					if($_POST['m_'.$i]==-1)
						$_POST['m_'.$i]='A';

				if($_POST['m_'.$i]!='PC' || $_POST['m_'.$i]!='DB')
					{$sql1="UPDATE marks SET $exam=NULL WHERE (st_id='".$_POST['roll_'.$i]."' AND sub_id='$subjectid')";
				$result = mysql_query( $sql1, $conn);
				}//$sql1="DELETE FROM calculation WHERE (semester='".$semester."' AND sub_id='$subjectid' AND exam='$exam' AND outof='$max_marks' AND section='$section')";
				//$result = mysql_query( $sql1, $conn);
				$disallow="UPDATE assignrole SET $exam='Y' WHERE (fac_id='$username' AND sub_id='$subjectid' AND section='$section')";
				$dis = mysql_query( $disallow, $conn);

				}
				die("Error in inserting marks2!");
			}*/

		echo 'SUCCESSFULLY ENTERED MARKS!!';
	}
?>


</body>

</html>
