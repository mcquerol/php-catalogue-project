<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd">
<html>
<head>
 <title>Title of the document</title>
 <meta name="description" content="Type a Short Description Here" />
 <meta name="keywords" content="type, keywords, here" />
 <meta name="author" content="Your Name" />
 <meta http-equiv="content-type" content="text/html;charset=UTF-8" /> 
 <link rel="stylesheet" type="text/css" href="mystyle.css" />
 
 <style>
	table {
	border-collapse: collapse
	}
	td {border:1pt solid blue;width:50pt;}
	
 </style>
 
</head>
<body>

<?php
echo "<font face=\"Comic Sans MS\" color=\"blue\">";
// ---- define variables
$FileName = "C:\\Users\\1ceballom\\Desktop\\Web_Design\\PHP\\catalogue.txt";
$qToChange="";
$action="";
$c=0;


// ---- Get the values passed through the REQUEST
if (isset($_REQUEST["submit"])) {
	$action = $_REQUEST["submit"];
	$qToChange = $_REQUEST["iq"];
}

$myFile = fopen($FileName, "r") or die("Unable to open file!");

echo "<table >\n";

while (!feof($myFile)) {
	//---- Read the item data from the text file
	$line=fgets($myFile);
	$item = explode("\t" ,$line);
	
	//---- The very first time the page is called, create a new SESSION variable
	//     for the item (Q1, Q2 Q3, Q4...)
	$c=$c+1;
	if (!isset($_SESSION["q".$c])){
		$_SESSION["q".$c]=0;
	}
	
	//---- write the HTML
	echo "<tr><td>"
		.$item[0] 
		."</td><td style=\"width:50pt;\">"
		.$item[1] 
		."</td><td>"		
		.$_SESSION["q" .$c]
		."</td><td>";

		fTotal();
		
		echo "</td></tr>\n";
}	
fclose($myFile);

echo "</table>\n";


function fTotal() {
	global $c;
	global $line;
	global $myFile;
	global $item; 

	echo "<form action = \"catalogue.php\" method=\"get\">\n";
		echo "<input type=\"hidden\" name=\"iq\" value=\"". $_SESSION["q" .$c] ."\">\n";
	echo "</form>\n";
	echo "$". $item[0] *  $_SESSION["q" .$c] ."\n";

}
?> 
</body>
</html>