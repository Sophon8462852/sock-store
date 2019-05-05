var dropDownPanel = document.getElementById('dropDownPanel');
var materialIcon = document.getElementById('materialIcon');
var container = document.getElementById('container');
var topBL = document.getElementById("topBL");
var lowBL = document.getElementById("lowBL");
var panelIsExtended = false;

window.onresize = function() {
$("#main").height(window.innerHeight);
  if(window.innerWidth > 550) {
    $(dropDownPanel).show();
    if(panelIsExtended){
      rotateMenuButton();
    }
    } else {
    $(dropDownPanel).hide();
    if(panelIsExtended){
      rotateMenuButton();
    }
    }
}

$("#main").height(window.innerHeight);

window.onscroll = function(e) {
            
    if(window.scrollY > window.innerHeight) {
        console.log("hello");
        document.getElementById('contactButton').style.color = "black";
    } else {
        document.getElementById('contactButton').style.color = "white";
    }
}



  
function rotateMenuButton() {
  if (!panelIsExtended) {
    $(topBL).animate({ top: '3.5px' });
    $(lowBL).animate({ top: '4px' });
    topBL.style.transform = "rotate(45deg)";
    lowBL.style.transform = "rotate(-45deg)";
    topBL.style.width = "40px";
    lowBL.style.width = "40px";
    topBL.style.background = "black";
    lowBL.style.background = "black";
    panelIsExtended = true;
  } else {
    $(topBL).animate({ top: '1px' });
    $(lowBL).animate({ top: '7px' });
    topBL.style.transform = "rotate(0deg)";
    lowBL.style.transform = "rotate(0deg)";
    topBL.style.width = "30px";
    lowBL.style.width = "30px";
    topBL.style.background = "white";
    lowBL.style.background = "white";
    panelIsExtended = false;
  }
}

/*
$("#title").on('click', function () {
  switchPages('papersPage');
});

  $("#menuButton").on('click', function () {
    $(dropDownPanel).slideToggle("slow");
    rotateMenuButton();
  });


  $("#contactPageLink").on('click', function () {
    switchPages('contactPage');
  });
*/

$("#downArrow").on('click', function() {
    scrollToIntro();

});


$("#contactButton").on('click', function() {
    scrollToContact();

});


$("#upArrow").on('click', function() {
    scrollToTop();

});



/*
function switchPages(pageId) {
  document.getElementById('contactPage').style.display = "none";
  document.getElementById('papersPage').style.display = "none";
  document.getElementById('aboutPage').style.display = "none";
  document.getElementById(pageId).style.display = "block";
  if (panelIsExtended) {
    $(dropDownPanel).slideToggle("slow");
    rotateMenuButton();
  }
}*/


function scrollToContact() {
$('html, body').animate({
      scrollTop: $(contactDiv).offset().top
}, 800);
}

function scrollToTop() {
$('html, body').animate({
      scrollTop: $(main).offset().top
}, 800);
}


function scrollToIntro() {
$('html, body').animate({
      scrollTop: $(introDiv).offset().top
}, 1000);
}

