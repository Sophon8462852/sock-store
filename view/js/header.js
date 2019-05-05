var scroll = $(window).scrollTop();
var navBar = document.getElementById("navBar");
var dropDownPanel = document.getElementById("dropDownPanel");
var panelIsExtended = false;
var topBL = document.getElementById("topBL");
var lowBL = document.getElementById("lowBL");


$(dropDownPanel).hide();

$(".subContainer").hide();


$("#outletLink").on("mouseenter", function() {
	$(".subContainer").hide();
	$("#outletContainer").show();
	
	
	$("#outletContainer").animate({ left: $("#outletLink").position().left +'px' }, 0);
	
});

$("#womanLink").on("mouseenter", function() {
	$(".subContainer").hide();
	$("#womanContainer").show();
	
	$("#womanContainer").animate({ left: $("#womanLink").position().left +'px' }, 0);
});

$("#manLink").on("mouseenter", function() {
	$(".subContainer").hide();
	$("#manContainer").show();
	
	$("#manContainer").animate({ left: $("#manLink").position().left +'px' }, 0);
});

$("#childLink").on("mouseenter", function() {
	$(".subContainer").hide();
	$("#childContainer").show();
	
	$("#childContainer").animate({ left: $("#childLink").position().left +'px' }, 0);
});


$("#container").on("mouseenter", function() {
	$(".subContainer").hide();
});

$("#bigImage").on("mouseenter", function() {
	$(".subContainer").hide();
});



window.onload = function () {
	checkSize();
};

$("#navBar").on("mouseout", function() {
	
	$("#navBar").css("background-color", "white");
});

$("#navBar").on("mouseenter", function() {
	$("#navBar").css("background-color", "white");
});

$("#menuButton").on("click", function() {
	$(dropDownPanel).slideToggle("slow");
	rotateMenuButton();
});

window.onresize = function() {
	checkSize();
  };


function rotateMenuButton() {
  if (!panelIsExtended) {
//	$(dropDownPanel).animate({ top: scroll + 100 + "px;" });
    $(topBL).animate({ top: '3.5px' });
    $(lowBL).animate({ top: '4px' });
    topBL.style.transform = "rotate(45deg)";
    lowBL.style.transform = "rotate(-45deg)";
    topBL.style.width = "40px";
    lowBL.style.width = "40px";
	  $("#midBL").hide();
    panelIsExtended = true;
  } else {
    $(topBL).animate({ top: '1px' });
    $(lowBL).animate({ top: '15px' });
    topBL.style.transform = "rotate(0deg)";
    lowBL.style.transform = "rotate(0deg)";
    topBL.style.width = "30px";
    lowBL.style.width = "30px";
	 $("#midBL").show();
    panelIsExtended = false;
  }
}







function checkSize() {
	  if(window.innerWidth > 1100) {
	  
	   	$("#nonCollapseNavBar").show();
		$("#collapseNavBar").hide();
		  if(panelIsExtended) {
			  $(dropDownPanel).hide();
			  rotateMenuButton();
		  }
		  
//    $(dropDownPanel).show();
//    if(panelIsExtended){
//      rotateMenuButton();
//    }
    } else {
//    $(dropDownPanel).hide();
//    if(panelIsExtended){
//      rotateMenuButton();
//    }
        
        $("#nonCollapseNavBar").hide();
		$("#collapseNavBar").show();
    }
}