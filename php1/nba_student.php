<!doctype html>
 <html lang="en">
 <head>
 <script type="text/javascript">
 	function save()
 	{
 		if(confirm('Do you want to save'))
 			return true;
 		else
 			return false;
 	}
//  	function minmax(value, min, max) 
// {
//     if(value > min && value<max) 
//         return value; 
    
//     else
//     	alert("Invalid entry"); 
//     //    return 100; 
//     //else return value;
// }

function savegen(id,count,st_id)
	{
		
		var xmlhttp;
		var sub_id= document.getElementById("sub_id"+id).value;
		//var section= document.getElementById("section").value;
		var exam= document.getElementById("exam"+id).value;

		var question="";
		var marks;
		question = document.getElementById('new'+id+'-'+1).value;
		for(var i=2;i<=count;i++) {
			marks= document.getElementById('new'+id+'-'+i).value;
			question = question+","+marks;
		}

		if(window.XMLHttpRequest)
		{
			//code for IE7,firefox,chrome,opera,safari	
			
			xmlhttp=new XMLHttpRequest();
		}
		else
		{
			
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.open('GET', 'save_ajax_tr2.php?question='+question+'&count='+count+'&st_id='+st_id+'&sub_id='+sub_id+'&exam='+exam+'&id='+id,true);
		xmlhttp.send();
			
		xmlhttp.onreadystatechange=function()
		{
			if(xmlhttp.readyState==4&&xmlhttp.status==200)
			{
			
				//document.getElementById("objx").innerHTML=xmlhttp.responseText;
				
				document.getElementById(id).innerHTML=xmlhttp.responseText;
			}
		}
	}


	function edit_tr(id,st_id,count)
	{
		
		var xmlhttp;

		var sub_id= document.getElementById("sub_id").value;
		//var section= document.getElementById("section").value;
		var exam= document.getElementById("exam").value;

		if(window.XMLHttpRequest)
		{
			//code for IE7,firefox,chrome,opera,safari	
			
			xmlhttp=new XMLHttpRequest();
		}
		else
		{
			
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.open('GET', 'ajax_edit_tr2.php?id='+id+'&st_id='+st_id+'&exam='+exam+'&sub_id='+sub_id+'&count='+count,true);
		xmlhttp.send();
			
		xmlhttp.onreadystatechange=function()
		{
			if(xmlhttp.readyState==4&&xmlhttp.status==200)
			{
			
				//document.getElementById("objx").innerHTML=xmlhttp.responseText;

				
				document.getElementById(id).innerHTML=xmlhttp.responseText;
			}
		}

	}

	function init()
	{
		
		var xmlhttp;

		var sub_id= document.getElementById("sub_id").value;
		var section= document.getElementById("section").value;
		var exam= document.getElementById("exam").value;
		var session= document.getElementById("session").value;

		if(window.XMLHttpRequest)
		{
			//code for IE7,firefox,chrome,opera,safari	
			
			xmlhttp=new XMLHttpRequest();
		}
		else
		{
			
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.open('GET', 'show_table.php?sub_id='+sub_id+'&section='+section+'&exam='+exam+'&session='+session,true);
		xmlhttp.send();
			
		xmlhttp.onreadystatechange=function()
		{
			if(xmlhttp.readyState==4&&xmlhttp.status==200)
			{
			
				//document.getElementById("objx").innerHTML=xmlhttp.responseText;

				
				document.getElementById("table").innerHTML=xmlhttp.responseText;
			}
		}

	}
	function save(count,jval)
	{
		
		var xmlhttp;
		var sub_id= document.getElementById("sub_id").value;
		var section= document.getElementById("section").value;
		var exam= document.getElementById("exam").value;
		var session= document.getElementById("session").value;

		

		if(window.XMLHttpRequest)
		{
			//code for IE7,firefox,chrome,opera,safari	
			
			xmlhttp=new XMLHttpRequest();
		}
		else
		{
			
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.open('GET', 'save.php?session='+session+'&count='+count+'&sub_id='+sub_id+'&exam='+exam+'&section='+section+'&jval='+jval,true);
		xmlhttp.send();
			
		xmlhttp.onreadystatechange=function()
		{
			if(xmlhttp.readyState==4&&xmlhttp.status==200)
			{
			
				//document.getElementById("objx").innerHTML=xmlhttp.responseText;
				
				document.getElementById('table').innerHTML=xmlhttp.responseText;
			}
		}
	}

 </script>
 	<style type="text/css">
    #addbutton{
    	align : center;
    	margin:auto;
    	vertical-align: center;
    	align-items: center;
    	padding-left: 600px;
    }
    </style>

	<meta charset="utf-8" />
	<title>Update Marks</title>
	<link rel="stylesheet" href="../css/finallook.css" >
	</head>
	<body onload="init();">
		
	

<?php
include 'common.php';
include('connect.php');
//include('nba_common.php');

$count=0;
if(isset($_POST['submit_entry'])){
	$sub_id = $_POST['subjectid'];
	$section = $_POST['section'];
	$exam = $_POST['exam'];
	$session = $_POST['session'];
	$_SESSION['sub_id'] = $sub_id;
	$_SESSION['section'] = $section;
 	$_SESSION['exam'] = $exam;
 	$_SESSION['session'] = $session;

}
else{ 
$sub_id = $_SESSION['sub_id'];
$section = $_SESSION['section'];
$exam = $_SESSION['exam'];
$session = $_SESSION['session'];
}
$update = "UPDATE questions set confirm='1' where sub_id='$sub_id' AND section='$section' AND exam='$exam'";
$run_Update = mysql_query($update);
$check_confirm="SELECT * from questions where sub_id='$sub_id' AND section='$section' AND exam='$exam' AND confirm='1'";
$run_check=mysql_query($check_confirm);
if(mysql_num_rows($run_check)>0)
	echo "<br><br><br><br>";
	echo "<h3>Scheme Has Been Added</h3>";
//echo	"
//	<input type='hidden' name='st_id".$j."' value=".$st_id.">
//		<input type='hidden' name='st_name".$j."' value=".$name.">
 echo"	
 ";
 echo "</br></br></br></br></br></br>";

		echo "<form method='POST' action='save_nba.php' >
	<table  class='table' id='table' style='margin-left:260px; max-width:100%; ' >
	<input type='hidden' name='sub_id' id='sub_id' value=".$sub_id.">
 	<input type='hidden' name='exam' 	id='exam' value=".$exam.">
 	<input type='hidden' name='section' id='section' value=".$section.">
 	<input type='hidden' name='branch' value=".$branch.">
 	<input type='hidden' name='semester' id='semester' value=".$sem.">
 	<input type='hidden' name='session'  id='session'	value=".$session.">
        
		</table>   ";

echo "</form>";
	
/*$sub_id = $_POST['subjectid'];
$section = $_POST['section'];
$exam = $_POST['exam'];
?>
<!doctype html>
 <html lang="en">
 <head>
	<meta charset="utf-8" />
	<title>Update Marks</title>
	<link rel="stylesheet" href="../css/finallook.css" >
	
	 
 </head> 

<script type="text/javascript">



</script>*/
?>

	<?php
	
		if(isset($_POST['ADD'])) {
			 $j=$_POST['jval'];
			 $count = $_POST['countval'];
			for ($i=1; $i <=$j-1 ; $i++) { 
				
			$name_ind='st_name'.$i;
			$stid_index='st_id'.$i;
			$subid_index='sub_id'.$i;
			$exam_index='exam'.$i;
			$section_index='section'.$i;
			$branch_index='branch'.$i;
			$semester_index='semester'.$i;
			//$session_index='session'.$i;


			 $name=$_POST[$name_ind];
			 $st_id=$_POST[$stid_index];
			 $sub_id1=$_POST[$subid_index];
 			 $exam=$_POST[$exam_index];
 			 $section=$_POST[$section_index];
 			 $branch=$_POST[$branch_index];
 			 $semester=$_POST[$semester_index];
 			 $session=$_SESSION['session'];

 			$find2 = "SELECT * FROM nba_student where st_id='$st_id' AND exam='$exam' AND sub_id='$sub_id' AND session='$session'";
 			$run10 = mysql_query($find2);
 			if(mysql_num_rows($run10)==0) {

 			$enter = "INSERT INTO nba_student(fac_id,st_id,name,exam,sub_id,question_no,section,session,branch,semester) VALUES('$username','$st_id','$name','$exam','$sub_id1','$count','$section','$session','$branch','$semester')";
 			$run1 = mysql_query($enter);
}
 			$find = "SELECT * FROM nba_student where st_id='$st_id' AND exam='$exam' AND sub_id='$sub_id'";
 			$runfind = mysql_query($find);
 			$rowfind = mysql_fetch_array($runfind);
 			if($rowfind['entered']==1)
 				continue;

 		$entry=0;
		for($x=1;$x<=$count;$x++)
		{
			$marks_index="t".$x."-".$i ;
			$marks=$_POST[$marks_index];
			if($marks != "")
				$entry++;
			$m="mark".$x;
			if($marks!= "") {
			$e="UPDATE nba_student SET $m='$marks' WHERE st_id='$st_id' AND exam='$exam' AND sub_id='$sub_id'";
			$r=mysql_query($e);
			}

} 
if($entry !=0)
	$ef="UPDATE nba_student SET entered='1' WHERE st_id='$st_id' AND exam='$exam' AND sub_id='$sub_id'";
			$rf=mysql_query($ef);

			}
			echo "<script>alert('MARKS ADDED SUCCESSFULLY');</script>";
			header('Location:entry2.php');
		}
	 ?>
</body>
</html>