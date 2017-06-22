<?php require_once('Connections/rjsql.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "user")) {
  $insertSQL = sprintf("INSERT INTO users (Name, contact, email, model, km, prys) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString($_POST['contact'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
					   GetSQLValueString($_POST['model'], "text"),
                       GetSQLValueString($_POST['km'], "text"),
                       GetSQLValueString($_POST['prys'], "text"));

  mysql_select_db($database_rjsql, $rjsql);
  $Result1 = mysql_query($insertSQL, $rjsql) or die(mysql_error());

  $insertGoTo = "dashboard.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
mysql_select_db($database_rjsql, $rjsql);
$query_Recordset1 = "SELECT * FROM photos";
$Recordset1 = mysql_query($query_Recordset1, $rjsql) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

mysql_select_db($database_rjsql, $rjsql);
$query_Recordset2 = "SELECT * FROM stocklist";
$Recordset2 = mysql_query($query_Recordset2, $rjsql) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Dashboard</title>
<link href="css/nav.css" rel="stylesheet" type="text/css">
    
<script src="jquery.min.js"></script>
<script src="ajaxfile.js"></script>
</head>
<body>

 <div id="cssmenu" >
                <ul >
                    <li><a href="dashboard.php" >Home</a></li>
                    <li><a onclick="about()" style="cursor:pointer">About us</a></li>
                    <li><a onclick="jkl()" style="cursor:pointer">Sell your car</a></li>
                    <li><a style="cursor:pointer">Browse cars</a></li>
                </ul>
</div>
<div id="myModal" class="modal">
  <div class="model-content">
  <div id="toe" onclick="sp()">
  </div>
  <div id="inputform"><br /><br />
  Leave Your Info And We Will Call You Back<br /><br />
  <form action="<?php echo $editFormAction; ?>" method="POST" name="user">
	Name:<br />
  		<input name="name" type="text" /><br />
	Cell/Tell:<br />
        <input name="contact" type="text" /><br />
	E-mail:<br />
        <input name="email" type="text" /><br />
	Model:<br />
        <input name="model" type="text" /><br />
	Km:<br />
        <input name="km" type="text" /><br />
	Price:<br />
        <input name="prys" type="text" /><br />
        <input name="Submit" type="submit" value="Submit" />
        <input type="hidden" name="MM_insert" value="user" />
  </form>
  </div>
  </div>
</div>
<div id="main">
<?php
$kryphotossql="SELECT * FROM photos";
$kryphotos=mysql_query($kryphotossql, $rjsql) or die(mysql_error());
while($gebruik=mysql_fetch_array($kryphotos))
{
	$path=$gebruik["path"];
	$stock=$gebruik["stocknom"];
?>
    	<img class="mySlides" onclick="enkelrek(<?php echo $stock?>)"  src="<?php echo $path?>.jpg">
<?php
}
?>
<script>
carousel();
</script>
<div class="skip" id="regs" onclick="next()"><img src="regs.png"/></div>
<div class="skip" id="links" onclick="terug()"><img src="links.png" /></div>
</div>
<div id="search">
<h3 style="padding-top:0px;text-align:center">Search</h3>
	<form action="" method="post" name="search" style="padding-left:4%">
    Make:<br />
    <select name="make">
    <?php
	while($gebruikmake=mysql_fetch_array($krymake))
	{
	?>
    <option value="<?php echo $make?>"><?php echo $make?></option>
    <?php
	}
	?>
    </select><br />
    Model:<br />
    <input name="model" type="text" style="width:100px"/><hr />
	Minimum price: <br />R
    <input name="prysvan" type="text" style="width:100px"/><br />
	Maximum price: <br />R
    <input name="prystot" type="text" style="width:100px"/><hr />
	Minimum Km:<br />
    <input name="kmvan" type="text" style="width:100px"/>Km<br />
    Maximum Km:<br />
    <input name="kmtot" type="text" style="width:100px"/>Km<hr />
    <input name="Submit" type="submit" value="Search" />
    </form>
</div>
</body>
</html>
<?php
mysql_free_result($Recordset1);
mysql_free_result($Recordset2);
?>
