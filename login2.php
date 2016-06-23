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
?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['textfield'])) {
  $loginUsername=$_POST['textfield'];
  $password=$_POST['textfield2'];
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "/web/index.html";
  $MM_redirectLoginFailed = "gagal.php";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_kucobalah, $kucobalah);
  
  $LoginRS__query=sprintf("SELECT Username, Password FROM loginnya WHERE Username=%s AND Password=%s",
    GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $kucobalah) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
     $loginStrGroup = "";
    
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>EtenbahH !!!</title>
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
<form id="form1" name="form1" method="POST" action="<?php echo $loginFormAction; ?>">
<div style="margin:0 10%; pading:0 5%; border-bottom:6px solid black; font-size="20px" Text-shadow="3px"">
  <p align="center" "><img src="fix etenbahh.png" width="155" height="160" />
  </p>
  <h1 align="center">Selamat Datang di EtenbahH !!!  </h1>
  </div>
  <div style="border:1 solid Black; margin:5% 10%; width:80%; padding:3% 0; background-color:#d8d8d8; border:2px solid black; border-radius:8px">
    <p align="center">
    <label for="textfield">Username</label>
    <input type="text" name="textfield" id="textfield" />
  </p>
  <p align="center">
    <label for="textfield2">Password </label>
    <input type="text" name="textfield2" id="textfield2" />
  </p>
  <p align="center">
    <input type="submit" name="button" id="button" value="LOGIN" />
  Belum punya akun ? Klik <a href="daftar.php" style="text-decoration:none">disini</a>  </p>
</div>
  <div style="; width:80%; margin:5% 10%; ">
    <div>
      <h2 align="left">Warning !!!</h2>
      <p align="left"> Dihimbau kepada setiap pengguna layanan Etenbahh untuk menjaga akun masing-masing, di karenakan banyaknya kejahatan dalam internet untuk itu kami menghimbau agar user menjaga data sensitif seperti Kartu Kredit dan Password.</p>
      <p align="left">Dilarang keras mengnyalahgunakan akun anda untuk hal negatif dan penjualan ILEGAL.Hanya Untuk 13+ (13 tahun ke atas)..... Waspadalah....!!! Waspadalah.....!!!</p>
</div>
  </div>
  <p align="center">&nbsp;</p>
  <p align="center">&nbsp;</p>
  <div style="border-top:5px solid Black; padding:0 2%; margin: 0 10%">
  <p align="center" > Company Name © All rights Reseverd | Design by <a href="file:///C:/xampp/htdocs/kucobalah/web/index.html#">Kapuyuak Mikro</a></p>
  </div>
</form>
</body>
</html>