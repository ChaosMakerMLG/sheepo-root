
let bool;



let cookie = document.getElementById("cookie");
let popup = document.getElementById("cookiepopup");
let button = document.getElementById('confirm');

function onload() {
    let cookie = document.getElementById("cookie");
    let popup = document.getElementById("cookiepopup");
    
}

let yesno = false;
let timer;

function mouseEnter() {
    let popup = document.getElementById("cookiepopup");
    let cookie = document.getElementById("cookie");

    if (!yesno) {
        popup.classList.remove('mina');
        popup.classList.add('anim');
        yesno = true;
        
        popup.addEventListener("mouseenter", mouseHold);
        cookie.addEventListener("mouseenter", mouseHold);
    }

    function mouseHold() {
        clearTimeout(timer); // Clear any existing timer
        popup.addEventListener("mouseleave", mouseLeave);
        cookie.addEventListener("mouseleave", mouseLeave);
    }

    function mouseLeave() {
        timer = setTimeout(function () {
            popup.classList.remove('anim');
            popup.classList.add('mina');
            yesno = false;
        }, 2000);

        // Remove the mouseleave event listener after it has been set
        popup.removeEventListener("mouseleave", mouseLeave);
        cookie.removeEventListener("mouseleave", mouseLeave);
    }
}

document.getElementById("cookiepopup").addEventListener("mouseenter", mouseEnter);
document.getElementById("cookie").addEventListener("mouseenter", mouseEnter);


function policy() {
    let button = document.getElementById('confirm');

    button.classList.add('accepted');
    button.setAttribute("value", "Juz zaakceptowane");
}

function repolicy() {
    let button = document.getElementById('confirm');

    button.classList.remove('accepted');
    button.setAttribute("value", "Okej");
}

let myVar;

function noloading() {
    document.getElementById('main').classList.add('hid');
    document.getElementById('cookie').classList.add('hid');
    document.getElementById('dim').classList.add('visible');
    document.getElementById('loading').classList.remove('visible');
    document.getElementById('dim').style.transitionDuration = '0s';
    document.getElementById('main').style.transitionDuration = '0s';

}

function loading() {
    document.getElementById('main').classList.remove('hid');
    document.getElementById('cookie').classList.remove('hid');
    document.getElementById('dim').classList.remove('visible');
    document.getElementById('loading').classList.add('visible');
    myVar = setTimeout(function () {
        document.getElementById('main').classList.add('hid');
        document.getElementById('cookie').classList.add('hid');
        document.getElementById('dim').classList.add('visible');
        document.getElementById('loading').classList.remove('visible');
    }, 2000);
}

