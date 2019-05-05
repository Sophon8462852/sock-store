
var x = document.getElementsByClassName("categoryImage");
var collapse = document.getElementById("collapseNavBar");
var nonCollapse = document.getElementById("nonCollapseNavBar");
var imageTimer;

imageTimer = setInterval(loadImages, 500);

function loadImages() {
    if(collapse.style.display != "none" || nonCollapse.style.display != "none") {
	for(i = 0; i < x.length; i++) {
	    x[i].src = x[i].getAttribute("imageSource");
	}
	clearInterval(imageTimer);
    } else {
	console.log(collapse.style.display);
    }
}
