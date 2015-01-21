

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
session_start();
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

if ($action=="Summary") {
fDisplaySummary();
} else {
		if($action=="+"){
			$_SESSION[$qToChange]=$_SESSION[$qToChange]+1;
		}elseif($action=="-"){
			$_SESSION[$qToChange]=$_SESSION[$qToChange]-1;
	}
}

// ---- Check if the variable is within the limits (0 to 12)

if($_SESSION[$qToChange] < 0){
   $_SESSION[$qToChange] = 0;
		
}elseif($_SESSION[$qToChange] > 12){
		$_SESSION[$qToChange] = 12;
}

// ---- Read lines from a text file
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
		."</td><td>"
		.$item[1] 
		."</td><td>"		
		.$_SESSION["q" .$c]
		."</td><td>";

		fDraw2Forms();
		
		echo "</td></tr>\n";
}                                                                                                                             
fclose($myFile);

echo "</table>\n";
fSummary();


// ---- Add a form to call the summarized  shopping cart ------------------
function fSummary(){
	global $c;
	
	echo "<form action = \"Summary.php\" method=\"post\">\n";
		echo "<input type=\"hidden\" name=\"iq\" value=\"". $_SESSION["q" .$c] ."\">\n";
		echo "<input type=\"submit\" name=\"Summary\" value=\"Summary\">\n";
	echo "</form>\n";
}

//---- Functions ------------------------------------------

//---- Display FORMS -------------------------------------------------------------------------
function fDraw2Forms(){
	global $c;
	
	echo "<td>\n<form action = \"catalogue.php\" method=\"post\">\n";
	echo "<input type=\"hidden\" name=\"iq\" value=\"q" .$c ."\">\n";
	echo "<input type=\"submit\" name=\"submit\" value=\"+\">\n";
	echo "</form>\n</td>\n";

	echo "<td>\n<form action = \"catalogue.php\" method=\"post\">\n";
	echo "<input type=\"hidden\" name=\"iq\" value=\"q" .$c ."\">\n";
	echo "<input type=\"submit\" name=\"submit\" value=\"-\">\n";
	echo "</form>\n</td>\n";
}
# -------------------------------------------------------- Summary Function --------------------------------
function fDisplaySummary() {
// ---- Read lines from a text file
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
		."</td>";
		
	echo "</tr>\n";
}	
fclose($myFile);

echo "</table>\n";
}
?> 
</body>
</html>