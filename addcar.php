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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "Insertcar")) {
  $insertSQL = sprintf("INSERT INTO stocklist (stocknom, make, model, yearmodel, km, extras, fueltype, color, gearbox, wheelbase) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['stocknom'], "int"),
                       GetSQLValueString($_POST['make'], "text"),
                       GetSQLValueString($_POST['model'], "text"),
                       GetSQLValueString($_POST['yearmodel'], "text"),
                       GetSQLValueString($_POST['km'], "int"),
                       GetSQLValueString($_POST['extras'], "text"),
                       GetSQLValueString($_POST['fueltype'], "text"),
                       GetSQLValueString($_POST['color'], "text"),
                       GetSQLValueString($_POST['gearbox'], "text"),
                       GetSQLValueString($_POST['wheelbase'], "text"));

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
<title>Add New Car</title>
</head>
<body>
<form action="<?php echo $editFormAction; ?>" method="POST" name="Insertcar">
<input name="stocknom" type="text" placeholder="stock #"/>
<input name="yearmodel" type="text" placeholder="Yearmodel"/>
<input name="make" type="text" placeholder="Make"/>
<input name="model" type="text" placeholder="Model"/>
<input name="color" type="text" placeholder="Color"/>
<input name="km" type="text" placeholder="KM"/>
<select name="gearbox">
<option value="Manual">Manual</option>
<option value="Automatic">Automatic</option>
</select>
<select name="fueltype">
<option value="Diesel">Diesel</option>
<option value="Petrol">Petrol</option>
</select>
<select name="wheelbase">
<option value="4x4">4x4</option>
<option value="4x2">4x2</option>
</select>
<textarea name="extras" cols="50" rows="5" placeholder="Extras"></textarea>
<input type="hidden" name="MM_insert" value="Insertcar" />
<input name="Submit" type="submit" value="Submit" />
</form>
</body>
</html>
<?php
mysql_free_result($Recordset1);
mysql_free_result($Recordset2);
?>
