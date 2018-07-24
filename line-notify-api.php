<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<?php
define('LINE_API',"https://notify-api.line.me/api/notify");
$stickerPkg = 2; //stickerPackageId
$stickerId = 34; //stickerId


$name = $_REQUEST['name'];
$email = $_REQUEST['email'];
$phone = $_REQUEST['phone'];
$lineid = $_REQUEST['lineid'];
$mesg = $_REQUEST['mesg'];

$token = "fqKc6fDE3OiIPU5dQEg81i9ZPpiHPXCrvFOSZLb1deq";

$message = $mesg."\n".'ผู้แจ้ง : '.$name."\n";

if($name<>"" || $mesg <> "") {
 
 
 header('Content-Type: text/html; charset=utf-8');
// $res = notify_message($message);
$res = notify_message($message,$token);
 echo "<center>ส่งข้อความเรียบร้อยแล้ว</center>";
 ?>
<meta http-equiv="refresh" content="2;url=index.html">
<?php

} else {
 echo "<center>Error: กรุณากรอกข้อมูลให้ครบถ้วน</center>";
}

function notify_message($message,$token){
     $queryData = array(
      'message' => $message,
     );
     $queryData = http_build_query($queryData,'','&');
     $headerOptions = array(
         'http'=>array(
             'method'=>'POST',
             'header'=> "Content-Type: application/x-www-form-urlencoded\r\n"
                 ."Authorization: Bearer ".$token."\r\n"
                       ."Content-Length: ".strlen($queryData)."\r\n",
             'content' => $queryData
         ),
     );
     $context = stream_context_create($headerOptions);
     $result = file_get_contents(LINE_API,FALSE,$context);
     $res = json_decode($result);
  return $res;
 }

?>

<body>
</body>
</html>
