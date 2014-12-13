<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" 
"http://www.w3.org/TR/html4/frameset.dtd">
<?php
session_start();
?>
<html>
<head>
 <title>Title of the document</title>
 <meta name="description" content="Type a Short Description Here" />
 <meta name="keywords" content="type, keywords, here" />
 <meta name="author" content="Your Name" />
 <meta http-equiv="content-type" content="text/html;charset=UTF-8" /> 
 <link rel="stylesheet" type="text/css" href="CataloguePHPstyle.css" /> 
 </head>

<body>
<font face="Comic Sans MS" color="blue">
<?php
//---- Define variables ----------------------
$action="";
$c=0;
$file = fopen("C:\\Users\\1ceballom\\Desktop\\Web_Design\\PHP\\catalogue.txt","r")or die("Unable to open file!");

#--------Get the values passed through the REQUEST
if (isset($_REQUEST["submit"])) {
	$action = $_REQUEST["submit"];
	$qToChange = $_REQUEST["q"];
}

while(!feof($file)){ 
	$line = fgets($file);

	if (!isset($_SESSION["q" .$c])) {
		$_SESSION["q" .$c]=0;
	}
	// ---- explode each string of data
	$ExplodedLine = explode("\t",$line);
$c=$c+1;
echo "<form action = \"catalogue.php\" method=\"get\">\n";
	echo "<input type=\"hidden\" name=\"q\" value=\"". $_SESSION["q" .$c] ."\">\n";
echo "</form>\n";

echo "". $ExplodedLine[0] ."s :";
echo "$". $_SESSION["q" .$c] ."" * "". $ExplodedLine[1] ."";

}
?> 
</body>
</html>