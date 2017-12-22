<?php
include "function_uuid.php";

function idunik(){
$v4= UUID::v4();
$stamp = date("YmdHis");
$ip = $_SERVER['REMOTE_ADDR'];
$orderid = "$stamp-$ip";
$orderid = str_replace(".", "", "$orderid");
$SomeRandomString='gamainformatika'.$orderid;
$v5uuid = UUID::v5( $v4, $SomeRandomString);
$uuid=str_replace("-", "", "$v5uuid");
return $uuid;
}

?>