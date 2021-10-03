<?php
require 'assets/db/setup.php';
$sharecode = $_GET['sharecode'];
$query="UPDATE listid SET shares = shares + 1 WHERE id = '$sharecode'";
$wisherID = db::getInstance()->dbquery($query);
header("Location: list.php?listid=".$sharecode);

?>