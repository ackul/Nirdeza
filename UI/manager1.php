 <?php 
require '../libs/Smarty.class.php';
require("dbinfo.php");
include('Smarty.class.php');
echo "Hi ";
$smarty = new Smarty;
$smarty->compile_check = true;
$smarty->debugging = true;




// add the advice in database 
$Advice_name = $_POST["Advice_name"];
$Advice_category = $_POST["Advice_category"];
$Number_subways = $_POST["Number_subways"];
$Number_satairs= $_POST["Number_satairs"];

//connect to the database 
if(array_key_exists('Advice_name',$_POST))
{
	$Advice_name = false;
	$C_AN= $_REQUEST["Advice_name"];
	$C_AC= $_REQUEST["Advice_category"];
        $C_NS= $_REQUEST["Number_Subways"];
        $c_NS= $_REQUEST["Number_Satairs"];
	echo $C_AN;
        echo $C_AC;
        echo $C_NS;
        echo $C_NS;
	$connection=mysql_connect (localhost, $Advice_name, $Advice_Category,$Number_Subways,$Number_Satairs);
	if (!$connection) {  die('Not connected : ' . mysql_error());}
	$db_selected = mysql_select_db($database, $connection);
	if (!$db_selected) {
		die ('Can\'t use db : ' . mysql_error());
}


?>


<html> 
<head> 
<title>Advice INFO</title> 
</head> 
<body> 
<form method="post" action="<?php echo $PHP_SELF;?>"> 
Advice Name:<input type="text" size="12" maxlength="12" name="Advice_name"><br /> 
Advice Category:<input type="text" size="12" maxlength="36" name="Advice_category"><br /> 
Gender:<br />


Please choose type of advice:<br />
Subways:<input type="checkbox" value="Subways" name="no[]"><br />
Satairs:<input type="checkbox" value="Satairs" name="no[]"><br />
<textarea rows="5" cols="20" name="quote" wrap="physical">Enter your favorite quote!</textarea><br />
<input type="submit" value="submit" name="submit">
</form> 
