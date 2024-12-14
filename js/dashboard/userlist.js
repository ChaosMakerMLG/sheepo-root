/* function mySearch() {
    var input, filter, ulz, li, a, i;
    input = document.getElementById("searchbar");
    filter = input.value.toUpperCase();
    ul = document.getElementById("myMenu");
    li = ul.getElementsByTagName("li");
    for (i = 0; i < li.length; i++) {
      a = li[i].getElementsByTagName("a")[0];
      if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
        li[i].style.display = "";
      } else {
        li[i].style.display = "none";
      }
    }
  } */

function toggle(element) {
  document.getElementById(element).classList.toggle('on');
}

function disable(element) {
  let element_id = '#' + element;
  document.querySelector(element_id + '.open').classList.add('toggle');
  document.querySelector(element_id + '.shutdown').classList.add('toggle');
  document.querySelector(element_id + '_text' + '.suspend_text').classList.add('toggle');
  $.ajax({
    url: "php/userlist.php",
    type: "POST",
    dataType: "json",
    data: { suspend_name: element },
    success: function(result) {
      console.log(result);
    },
    error: function(xhr, status, error) {
      console.error("Error deleting user:", error);
  } 
});
 
}

function enable(element) {
  let element_id = '#' + element;
  document.querySelector(element_id + '.open').classList.remove('toggle');
  document.querySelector(element_id + '.shutdown').classList.remove('toggle');
  document.querySelector(element_id + '_text' + '.suspend_text').classList.remove('toggle');
  $.ajax({
    url: "php/userlist.php",
    type: "POST",
    dataType: "json",
    data: { unsuspend_name: element },
    success: function(result) {
      console.log(result);
    },
    error: function(xhr, status, error) {
      console.error("Error deleting user:", error);
  } 
});
  

}

function myDelete(deluname) {
  let root_id = deluname + '_cell';
  let scroll = document.getElementById('content');
  document.getElementById(root_id).style.display = 'none';
  $.ajax({
    url: "php/userlist.php",
    type: "POST",
    dataType: "json",
    data: { delname: deluname },
    success: function(result) {
      console.log(result);
    },
    error: function(xhr, status, error) {
      console.error("Error deleting user:", error);
  } 
});
  
  if (scroll.scrollHeight > scroll.clientHeight) {
    document.getElementById('tbody').style.marginRight = "0px";
  }
  else {
    document.getElementById('tbody').style.marginRight = "6px";
  }
  
}



