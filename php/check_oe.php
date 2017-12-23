<?php

function check_oe($s4)
{
//Subject Code for userid
$S5="ROE-033";
$S6="ROE-034";
$S7="NOE-043";
$S16="NOE-071";
$S20="NOE-072";
$S12="NOE-073";
$S13="RCA-A01";
$S14="NOE-034";
$S15="NOE-036";

//Subject Code for userid;

$S8="NME-031";
$S9="NME-032";
$S17="NME-063";
$S18="NME-065";
$S23="NMCA-E15";
$S24="NMCA-E12";

//Subject Code for userid2
$S10="NMBA-HR-03";
$S11="EME-043";
$S21="ECE-043";
$S22="ECE-044";

$s4=trim((string)$s4);

if($s4==$S5 || $s4==$S6 || $s4==$S7 || $s4==$S12 || $s4==$S13 || $s4==$S14 || $s4==$S15 || $s4==$S16 || $s4==$S20)
	return 1;
else if($s4==$S8 || $s4==$S9 || $s4==$S17 || $s4==$S18 || $s4==$S23 || $s4==$S24)
	return 2;
else if($s4==$S10 || $s4==$S11 || $s4==$S21 || $s4==$S22)
	return 3;
else
	return 0;
}

?>
