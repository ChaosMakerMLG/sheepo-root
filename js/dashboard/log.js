function drop(element) {
  document.getElementById(element + '_info').style.display = 'block';
}

function undrop(element) {
  document.getElementById(element + '_info').style.display = 'none';
}

function infodropdown(element){
var button = document.getElementById(element);
button.classList.toggle('drop');
if(button.classList.contains('drop')) {
  drop(element);
}
else {
  undrop(element);
}
}

function filter_point() {

    document.getElementById('date-range').classList.toggle('active');
    document.getElementById('date-point').classList.toggle('active');
    document.getElementById('main-date').style.display = 'initial';
    document.getElementById('secondary-date').style.display = 'none';

}


function filter_range() {

    document.getElementById('date-range').classList.toggle('active');
    document.getElementById('date-point').classList.toggle('active');
    document.getElementById('secondary-date').style.display = 'initial';

}


function filter_date() {

    let range = document.getElementById('date-range');
    let point = document.getElementById('date-point');

    if (range.className == 'active') {

    }
    else if (point.className == 'active') {

    }
}

function filter_dropdown() {

    $('#filters').toggle();

}

function sorting(id) {
    var table, rows, switching, i, x, y, shouldSwitch;
  table = document.getElementById("content-log");
  switching = true;
  /*Make a loop that will continue until
  no switching has been done:*/
  while (switching) {
    //start by saying: no switching is done:
    switching = false;
    rows = table.rows;
    /*Loop through all table rows (except the
    first, which contains table headers):*/
    for (i = 0; i < (rows.length); i++) {
      //start by saying there should be no switching:
      shouldSwitch = false;
      /*Get the two elements you want to compare,
      one from current row and one from the next:*/
      x = rows[i].getElementsByTagName("TD")[0];
      y = rows[i + 1].getElementsByTagName("TD")[0];
      //check if the two rows should switch place:
      if(id == 'date-point') {
        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
            //if so, mark as a switch and break the loop:
            shouldSwitch = true;
            break;
      }
    }
        else if(id == 'date-range') {
            if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                //if so, mark as a switch and break the loop:
                shouldSwitch = true;
                break;
        }
      }
      if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
        //if so, mark as a switch and break the loop:
        shouldSwitch = true;
        break;
      }
    }
    if (shouldSwitch) {
      /*If a switch has been marked, make the switch
      and mark that a switch has been done:*/
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
    }
  }
}


