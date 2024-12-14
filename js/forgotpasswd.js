let myVar;

function noloading() {
    console.log('nigger')
    document.getElementById('main').classList.add('hid');
    document.getElementById('dim').classList.add('visible');
    document.getElementById('loading').classList.remove('visible');
    document.getElementById('dim').style.transitionDuration = '0s';
    document.getElementById('main').style.transitionDuration = '0s';
}

function loading() {
    document.getElementById('main').classList.remove('hid');
    document.getElementById('dim').classList.remove('visible');
    document.getElementById('loading').classList.add('visible');
    myVar = setTimeout(function () {
        document.getElementById('main').classList.add('hid');
        document.getElementById('dim').classList.add('visible');
        document.getElementById('loading').classList.remove('visible');
    }, 1000);
}
