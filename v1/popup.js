/*window.onload = function(e){
	document.getElementById("btn").addEventListener("click", myFunction);	
}*/
/*
function getElementByXpath(path) {
	  return document.evaluate(path, document, null, XPathResult.FIRST_ORDERED_NODE_TYPE, null).singleNodeValue;
	}

function myFunction() {
	  document.getElementById("btn").innerHTML = "Copy the link below";
	  var tests = document.querySelector("img[class='boxart-image boxart-image-in-padded-container']");
	  console.log(tests);
	  console.log(getElementByXpath("//*[@id=\"title-card-0-0\"]/div[1]/a/div[1]/img"));
	  document.getElementById("url").value = getElementByXpath("//*[@id=\"title-card-0-0\"]/div[1]/a/div[1]/img");
}*/
/*
function myFunction() {
	chrome.runtime.onMessage.addListener(function(request, sender, sendResponse) {
	  if (request.from == 'content_script') {
		console.log('The request has been received from the content script.');
	  }
	});
}*/

chrome.runtime.onMessage.addListener(function(request, sender, sendResponse) {
  if (request.from == 'content_script') {
	console.log('The request has been received from the content script.');
  }
});