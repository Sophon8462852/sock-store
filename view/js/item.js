

var originalLink = " ";
var linkSet = false; 

function sizeSelected() {
	
	if(!linkSet) {
		originalLink = document.getElementById("cartLink").href;
		linkSet = true;
	}
	
	size = document.getElementById("product_size");
	link = document.getElementById("cartLink");
	
	link.href = originalLink + size.value;
	
	console.log(document.getElementById("cartLink").href);
}

$(".smallItemImage img").on("click", function() {
	
	console.log($('#mainImage').attr('src'));
	$('#mainImage').attr('src', $(this).attr('src'));
	
});
