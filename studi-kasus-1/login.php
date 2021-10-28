<?php

$user =$_POST["email"];
$pw   =$_POST["password"];

if($user =="ihsan@gmail.com" && $pw == "ihsan"){
  echo "1";
}
else{
  echo "0";
}
?>