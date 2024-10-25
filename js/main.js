var popupbool = false;
var x = 0;
function toggleMainPopup(content) {
   popupbool = true;
   popup = document.getElementById("full-popup");
   dim = document.getElementById("popup-dim");
   popup.classList.toggle("visible");
   dim.classList.toggle("visible");
   if(x==0) {
      popup.innerHTML = '<object type="text/html" data="' + content + '" ></object>';
      x++;
   }
   else {
      popup.innerHTML = '';
   }
}

/* function sessionTimeout() {
   var timeout = $.ajax({
   url: "php/session_timeout.php",
   type: "GET",
   async: false,
   data: {},
   success: function(response) {
   },
   error: function(xhr, status, error) {
       console.error("Perkele:", error);
   }
});
} */
/* 
window.addEventListener('beforeunload', function (e) {
   sessionTimeout();
});

window.addEventListener('load', function(e) {
   sessionTimeout();
}); */


