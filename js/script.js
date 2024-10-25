function unwind() {
    document.getElementById('nav').classList.add('unwind'),
        document.getElementById('button').classList.add('unwind'),
        document.getElementById('hide').classList.add('unwind'),
        document.getElementById('hide1').classList.add('unwind'),
        document.getElementById('strong1').classList.add('unwind'),
        document.getElementById('strong2').classList.add('unwind'),
        document.getElementById('strong3').classList.add('unwind'),
        document.getElementById('strong4').classList.add('unwind'),
        document.getElementById('strong5').classList.add('unwind'),
        document.getElementById('strong6').classList.add('unwind');
    document.getElementById('body').classList.add('unwind');

}

function rewind() {
    document.getElementById('nav').classList.toggle('unwind'),
        document.getElementById('button').classList.toggle('unwind'),
        document.getElementById('hide').classList.toggle('unwind'),
        document.getElementById('hide1').classList.toggle('unwind'),
        document.getElementById('strong1').classList.toggle('unwind'),
        document.getElementById('strong2').classList.toggle('unwind'),
        document.getElementById('strong3').classList.toggle('unwind'),
        document.getElementById('strong4').classList.toggle('unwind'),
        document.getElementById('strong5').classList.toggle('unwind'),
        document.getElementById('strong6').classList.toggle('unwind'),
        document.getElementById('body').classList.toggle('unwind');

}

function strg() {
    let curr_sel = document.querySelector('a.select');
    let curr_bar = document.querySelector('.bar.select');
    if (curr_sel) {
        curr_sel.classList.remove('select');
        curr_bar.classList.remove('select');
    }

    let load = document.querySelector('.dummy');
    if (load) {
        document.getElementById("innerbodychild").innerHTML = '';
        document.getElementById("innerbodychild").style.opacity = '0%'
        load.classList.add('visible');
    }
    setTimeout(() => {
        if (load) {
            load.classList.remove('visible');
            document.getElementById("innerbodychild").innerHTML = '<object type="text/html" data="palette.html" ></object>';
            document.getElementById("innerbodychild").style.opacity = '100%'
        }
    }, "2100")
        document.getElementById('storage').classList.toggle('select'),
        document.getElementById('bar').classList.toggle('select'),
        document.getElementById('a_strg').classList.toggle('select');
}
function mail() {
    let curr_sel = document.querySelector('a.select');
    let curr_bar = document.querySelector('.bar.select');
    if (curr_sel) {
        curr_sel.classList.remove('select');
        curr_bar.classList.remove('select');
    }
    
    var load = document.querySelector('.dummy');
    if (load) {
        document.getElementById("innerbodychild").innerHTML = '';
        document.getElementById("innerbodychild").style.opacity = '0%'
        load.classList.add('visible');
    }
    setTimeout(() => {
        if (load) {
            load.classList.remove('visible');
            document.getElementById("innerbodychild").innerHTML = '<object type="text/html" data="palette.html" ></object>';
            document.getElementById("innerbodychild").style.opacity = '100%'
        }
    }, "2100")

        document.getElementById('mail').classList.toggle('select'),
        document.getElementById('bar1').classList.toggle('select'),
        document.getElementById('a_mail').classList.toggle('select');
}
function accmngr() {
    var curr_sel = document.querySelector('a.select');
    var curr_bar = document.querySelector('.bar.select');
    if (curr_sel) {
        curr_sel.classList.remove('select');
        curr_bar.classList.remove('select');
    }
    
    var load = document.querySelector('.dummy');
    if (load) {
        document.getElementById("innerbodychild").innerHTML = '';
        document.getElementById("innerbodychild").style.opacity = '0%'
        load.classList.add('visible');
    }
    setTimeout(() => {
        if (load) {
            load.classList.remove('visible');
            document.getElementById("innerbodychild").innerHTML = '<object type="text/html" data="accountmanager.php" ></object>';
            document.getElementById("innerbodychild").style.opacity = '100%'
        }
    }, "2000")

        document.getElementById('accmanager').classList.toggle('select'),
        document.getElementById('bar2').classList.toggle('select'),
        document.getElementById('a_accmngr').classList.toggle('select');
}
function dshbrd() {
    var curr_sel = document.querySelector('a.select');
    var curr_bar = document.querySelector('.bar.select');
    if (curr_sel) {
        curr_sel.classList.remove('select');
        curr_bar.classList.remove('select');
    }
    
    var load = document.querySelector('.dummy');
    if (load) {
        document.getElementById("innerbodychild").innerHTML = '';
        document.getElementById("innerbodychild").style.opacity = '0%'
        load.classList.add('visible');
    }
    setTimeout(() => {
        if (load) {
            load.classList.remove('visible');
            document.getElementById("innerbodychild").innerHTML = '<object type="text/html" data="palette.html" ></object>';
            document.getElementById("innerbodychild").style.opacity = '100%'
        }
    }, "2000")

        document.getElementById('dashboard').classList.toggle('select'),
        document.getElementById('bar3').classList.toggle('select'),
        document.getElementById('a_dshbrd').classList.toggle('select');
}
function usr() {
    var curr_sel = document.querySelector('a.select');
    var curr_bar = document.querySelector('.bar.select');
    if (curr_sel) {
        curr_sel.classList.remove('select');
        curr_bar.classList.remove('select');
    }
    
    var load = document.querySelector('.dummy');
    if (load) {
        document.getElementById("innerbodychild").innerHTML = '';
        document.getElementById("innerbodychild").style.opacity = '0%'
        load.classList.add('visible');
    }
    setTimeout(() => {
        if (load) {
            load.classList.remove('visible');
            document.getElementById("innerbodychild").innerHTML = '<object type="text/html" data="palette.html" ></object>';
            document.getElementById("innerbodychild").style.opacity = '100%'
        }
    }, "2000")

        document.getElementById('user').classList.toggle('select'),
        document.getElementById('bar4').classList.toggle('select'),
        document.getElementById('a_usr').classList.toggle('select');
}


   
