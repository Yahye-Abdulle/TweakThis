<?php
require 'assets/db/setup.php';
$listid = $_GET['listid'];
$getList = "SELECT * FROM `listitems` WHERE id = '$listid'";
$sockets = db::getInstance()->get_result2($getList);
$listArray = array();
if ($sockets->num_rows<1) {
	die('The user has empty list or invalid share code!');
}
while($row = $sockets->fetch_assoc())
{
	$userName = $row['user'];
	$name = $row['name'];
	$uImage = $row['uimage'];
	$image = $row['image'];

	$listArray[] = array('user'=>$userName, 'uImage'=> $uImage, 'name'=>$name, 'image'=>$image);
}
$profileName = $listArray[0]['user'];
echo '<style>

 @import url(\'https://fonts.googleapis.com/css2?family=Roboto:ital,wght@1,300&display=swap\');

 body {
	 background-color: #141414;
 }

 :focus {
   outline: none;
 }
 .gallery {
   /*max-width: 980px;*/
   margin: 0 auto;
   position: relative;
   display: flex;
   flex-direction: row;
   flex-wrap: wrap;
   justify-content: space-between;
   align-content: center; 
   
 }
 .gallery a {
   margin: 0;
   padding: 0px;
   display: inline-block;
   flex: 1 1 calc(13.33% - 30px);
   margin: 18px;
	

   height: 192px;
   position: relative;
   min-width: 341px;
 }
 .gallery a img {
   margin: 0;
   padding: 10px;
   cursor: pointer;
   display: block;
   left: 0px;
   width: 341px;
   height: 192px;
   position: absolute;
   top: 35px;
   z-index: 1;
   flex-grow: 1;
   
 }
 .gallery a:focus img {
   border: none;
   /*margin: 0;*/
   padding: 0;
   border-radius: 3px;
   cursor: default;
   position: absolute;
   z-index: -25; /*Change to 25 for over the text*/
   transition-duration: 0.7s;
 }/*
 .gallery a:focus:nth-child(3n+1) img {
   left: 0;
   top: -145px;
 }
 .gallery a:focus:nth-child(3n+2) img {
   left: -315px;
   top: -145px;
 }
 .gallery a:focus:nth-child(3n+3) img {
   left: -640px;
   top: -145px;
 }
 .gallery a:focus:nth-child(-n+3) img {
   top: 10px;
 }
 .gallery a:focus:nth-child(n+7) img {
   top: -300px;
 }
 .gallery a:focus:nth-child(n+10) img {
   top: -300px;
 }*/
 .closed {
   background-color: rgb(250, 75, 21);
   position: absolute;
   top: -5px;
   right: 20px;
   display: none;
   width: 30px;
   height: 30px;
   cursor: pointer;
   z-index: 30;
 }
 .closed p {
   margin: 10px 8px;
   font-size: 10px;
   color: rgb(255, 255, 255);
   position: absolute;
 }
 .closed-layer {
   display: none;
   position: absolute;
   top: 100px;
   left: 100px;
   width: 800px;
   height: 400px;
   background: transparent;
   z-index: 30;
 }
 a:focus~.closed,
 a:focus~.closed-layer {
   display: block;
   transition-duration: 4s;
 }
</style>';
$shareLinkID = $_GET['listid'];
$shareLink = $_SERVER['HTTP_HOST'] . '/share.php?sharecode='.$shareLinkID;
$redirect = '/share.php?sharecode='.$shareLinkID;
echo '
	<div id="bottom">
	<div class="container" id="container">
	<div class="header">
		<img src="'.$listArray[0]['image'].'" style="float:right;border-radius: 4px; width: 32px; height:32px;">
		<h1 style="color: #fff; text-align: center; text-transform: uppercase;font-family: \'Roboto\', sans-serif;font-size: 35px;"><span style="color: #e50914;">Showing account for </span>'.$profileName.'</h1>
		<h1 style="color: #fff; text-align: center; text-transform: uppercase;font-family: \'Roboto\', sans-serif;font-size: 20px;"><span style="color: #e50914;">Sharing link: </span><a href="'.$redirect.'" target="_blank" style="color: #fff;">'.$shareLink.'</a></h1>
	</div>
    <div class="gallery">';
	for ($x = 1; $x < $sockets->num_rows; $x++) {
		$imageUrl = 'https://occ-0-806-300.1.nflxso.net/dnm/api/v6/X194eJsgWBDE2aQbaNdmCXGUP-Y'.$listArray[$x]['image'];
		echo '
			<a tabindex="1">
			<img src="'.$imageUrl.'"/>
			<p style="text-align: center;float: left;padding-left: 10px; color: #fff;text-transform: uppercase;font-size:20px;font-family: \'Roboto\', sans-serif;">'.$listArray[$x-1]['name'].'</p>
			</a>
		';
	}
echo '
	</div>
	</div>
	</div>';
?>