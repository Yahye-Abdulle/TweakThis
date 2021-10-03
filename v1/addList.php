<?php

require 'assets/db/setup.php';

function generateRandomString($length) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

$userName = $_POST['accountName'];
$listid = $_POST['listid'];
$itemNames = $_POST['itemnames'];
$itemImages = $_POST['itemimages'];

$array1 = explode(",", $itemNames);
$array2 = explode(",", $itemImages);

$numList = count($array1);
/*
$checkQuery = "SELECT * FROM listid WHERE id = '$listid'";
$sockets = db::getInstance()->get_result2($checkQuery);
if ($sockets->num_rows > 0) {
	$fullLink = str_replace($listid, generateRandomString(16), $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
	header("Location: addList.php?listid=".$full);
}
$checkQuery2 = "SELECT * FROM listid WHERE id = '$listid'";
$sockets2 = db::getInstance()->get_result2($checkQuery2);
if ($sockets2->num_rows > 0) {
	$fullLink = str_replace($listid, generateRandomString(16), $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
	header("Location: addList.php?listid=".$full);
}
*/
$createTable = "INSERT INTO `listid` (`id`, `num`, `shares`) VALUES ('$listid', '$numList', 1)";

$wisherID = db::getInstance()->dbquery($createTable);

for ($x = 0; $x < $numList; $x++) {
	$createTable = "INSERT INTO `listitems` (`id`, `user`,`name`, `image`) VALUES ('$listid', '$userName','$array1[$x]', '$array2[$x]')";

	$wisherID = db::getInstance()->dbquery($createTable);
}

header("Location: list.php?listid=".$listid);
?>

<style>
.loading-element {
  position: absolute;
  top: calc(50% - 32px);
  left: calc(50% - 32px);
  width: 64px;
  height: 64px;
  border-radius: 50%;
  perspective: 800px;
}
.loading-element .inner {
  position: absolute;
  box-sizing: border-box;
  width: 100%;
  height: 100%;
  border-radius: 50%;
}
.loading-element .inner.one {
  left: 0%;
  top: 0%;
  animation: rotate-one 1s linear infinite;
  border-bottom: 3px solid #666;
}
.loading-element .inner.two {
  right: 0%;
  top: 0%;
  animation: rotate-two 1s linear infinite;
  border-right: 3px solid #666;
}
.loading-element .inner.three {
  right: 0%;
  bottom: 0%;
  animation: rotate-three 1s linear infinite;
  border-top: 3px solid #666;
}
.loading-element.white .inner.one {
  border-bottom: 3px solid #efeffa;
}
.loading-element.white .inner.two {
  border-right: 3px solid #efeffa;
}
.loading-element.white .inner.three {
  border-top: 3px solid #efeffa;
}
@keyframes rotate-one {
  0% {
    transform: rotateX(35deg) rotateY(-45deg) rotateZ(0deg);
  }
  100% {
    transform: rotateX(35deg) rotateY(-45deg) rotateZ(360deg);
  }
}
@keyframes rotate-two {
  0% {
    transform: rotateX(50deg) rotateY(10deg) rotateZ(0deg);
  }
  100% {
    transform: rotateX(50deg) rotateY(10deg) rotateZ(360deg);
  }
}
@keyframes rotate-three {
  0% {
    transform: rotateX(35deg) rotateY(55deg) rotateZ(0deg);
  }
  100% {
    transform: rotateX(35deg) rotateY(55deg) rotateZ(360deg);
  }
}

</style>

<div class="loading-element">
  <div class="inner one"></div>
  <div class="inner two"></div>
  <div class="inner three"></div>
</div>