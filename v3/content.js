/*function getElementByXpath(path) {
  return document.evaluate(path, document, null, XPathResult.FIRST_ORDERED_NODE_TYPE, null).singleNodeValue;
}

var test = getElementByXpath("//*[@id=\"title-card-0-0\"]/div[1]/a/div[1]/img").src;
chrome.runtime.sendMessage({ from: 'content_script', message: 'Information from webpage.' });*/
/*
function getElementByXpath(path) {
  return document.evaluate(path, document, null, XPathResult.FIRST_ORDERED_NODE_TYPE, null).singleNodeValue;
}*/

var $input = $('<button class="button-three" id="soso">Share My List</button>').click(goFrame);
var $url = $('<input type="hidden" name="url" id="url" disabled>');
var $hiddenAccountName = $(`
<form target="_blank" name="fooForm" id="fooForm" method="POST" action="/addList.php">
<input type="hidden" name="accountName" id="an">
<input type="hidden" name="listid" id="listid">
<input type="hidden" name="itemnames" id="hnames">
<input type="hidden" name="itemimages" id="himages">
</form>
`);

jQuery("#appMountPoint > div > div > div:nth-child(1) > div.bd.dark-background > div.pinning-header > div > div.sub-header > div > div > div > div.title ").after($input);
jQuery("#soso").after($url);
jQuery("#url").after($hiddenAccountName);
$('#soso').attr('style', `
border: none;
color: white;
padding: 7px 20px;
text-align: center;
text-decoration: none;
display: inline-block;
font-size: 12px;
margin: 2px 2px;
transition-duration: 0.4s;
cursor: pointer;
background-color: #e50914; 
color: #fff; 
border: 2px solid red;
`);
$('#url').attr('style', `
width: 50%;
margin-left: 40px;
`);

function makeid(length) {
   var result           = '';
   var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz01234567890123456789';
   var charactersLength = characters.length;
   for ( var i = 0; i < length; i++ ) {
      result += characters.charAt(Math.floor(Math.random() * charactersLength));
   }
   return result;
}

function goFrame() {
	var listIDGen = makeid(16);
	
	var imgs = document.getElementsByTagName("img");
    var imgSrcs = [];
	
	var name = document.getElementsByTagName("p");
    var nameInner = [];

	var accountName = document.getElementsByTagName("a")[8].ariaLabel.replace(" – Account & Settings", "");
    for (var i = 0; i < imgs.length; i++) {
		var cImage = (imgs[i].src).replace("https://occ-0-806-300.1.nflxso.net/dnm/api/v6/X194eJsgWBDE2aQbaNdmCXGUP-Y", "");
        imgSrcs.push(cImage);
		
    }
    for (var i = 0; i < name.length; i++) {
        nameInner.push(name[i].innerHTML);
    }
	
	/*$.get("http://localhost/cList.php?id="+listIDGen+"&numberOf="+name.length, function(data, status){
	});*/
		
	/*for (var x = 0; x < name.length; x++) {
		$.get("http://localhost/addList.php?listid="+listIDGen+"&itemnames="+nameInner[x]+"&itemimages="+imgSrcs[x], function(data, status){
		});
	}*/
	/*$.get("http://localhost/addList.php?listid="+makeid(16)+"&num="+name.length+"&itemnames="+nameInner+"&itemimages="+imgSrcs, function(data, status){
      alert("Data: " + data + "\nStatus: " + status);
    });*/
	//window.open("http://localhost/addList.php?accountName="+accountName+"&listid="+makeid(16)+"&itemnames="+nameInner+"&itemimages="+imgSrcs);
	document.getElementById("an").value = accountName;
	document.getElementById("listid").value = listIDGen;
	document.getElementById("hnames").value = nameInner;
	document.getElementById("himages").value = imgSrcs;
	document.getElementById('fooForm').submit();
}