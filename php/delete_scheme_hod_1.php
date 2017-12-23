
<!doctype html>
 <html lang='en'>
 <head>
	<meta charset='utf-8' />
	<title>Update Marks</title>
	<link rel='stylesheet' href='../css/finallook.css' >
	
	 
 </head> 
 <?php
include('common.php');
echo "</br></br></br></br></br></br>";
include('connect.php');
echo $fac_id=$_POST['faculty'];
echo $sub_id = $_POST['subjectid'];
echo $exam = $_POST['exam'];
echo $section = $_POST['section'];

$delete="DELETE  FROM questions WHERE fac_id='$fac_id' AND sub_id='$sub_id' AND section='$section' AND exam='$exam'";    

$delete1="DELETE  FROM nba_student WHERE fac_id='$fac_id' AND sub_id='$sub_id' AND section='$section' AND exam='$exam'";    

if (mysql_query($delete)) {
    if (mysql_query($delete1)) {
    echo "Marks deleted successfully";
} 
else {
    echo "Error deleting record: " . mysql_error();
}
} 
else {
    echo "Error deleting record: " . mysql_error();
}

?>
