<?php require_once('Connections/kucobalah.php'); ?>
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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form")) {
  $insertSQL = sprintf("INSERT INTO loginnya (Username, Password) VALUES (%s, %s)",
                       GetSQLValueString($_POST['username'], "text"),
                       GetSQLValueString($_POST['password'], "text"));

  mysql_select_db($database_kucobalah, $kucobalah);
  $Result1 = mysql_query($insertSQL, $kucobalah) or die(mysql_error());

  $insertGoTo = "login.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}


session_start();

if(isset($_SESSION['username'])) {

header('location:index.php'); }

?>

<html>

<head>

<title>Form Pendaftaran</title>
<style type="text/css">
body {
	background-color: #FFF;
}
body,td,th {
	font-family: "Comic Sans MS", cursive;
}
a {
	text-decoration:none;
	color:#003;
}
a:hover {
	color:#00F;
}
</style>
</head>

<body>

<center>

<form name="form" action="<?php echo $editFormAction; ?>" method="POST">
<div style="margin:0 20%; pading:0 5%; border-bottom:6px solid black; font-size="20px" Text-shadow="3px"">
  <p align="center" "><img src="fix etenbahh.png" width="155" height="160" />
  </p>
  <h1 align="center">Selamat Datang di EtenbahH !!!  </h1>
  </div>
<p>&nbsp;</p>
<div style="border:1 solid Black; margin:5% 26%; width:50%; padding:1.5% 0; background-color:#d8d8d8; border:2px solid black; border-radius:8px">
<table>

<tr><td colspan="2" align="center"><h1>Daftar Baru</h1></td></tr>

<tr><td>Username</td><td> : <input type="text" name="username"></td></tr>

<tr><td>Password</td><td> : <input type="password" name="password"></td></tr>

<tr><td colspan="2" align="right"><input type="submit" value="Daftar"></td></tr>

<tr><td colspan="2" align="center">Sudah Punya akun ? <a href="login2.php"><b>Login</b></a></td></tr>

</table>
</div>
<p>
  <input type="hidden" name="MM_insert" value="form">
</p>
<p>&nbsp;</p>
<div style="border-top:5px solid Black; padding:0 2%; margin: 0 20%">
  <p align="center" > Company Name © All rights Reseverd | Design by <a href="file:///C:/xampp/htdocs/kucobalah/web/index.html#">Kapuyuak Mikro</a></p>
</div>
</form>

</center>

</body>

</html>