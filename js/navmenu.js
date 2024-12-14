/* window.addEventListener('beforeunload', function (event) {
    // Your function to run before unloading the page
    console.log('Page is about to be unloaded.');
    rewind();

    // You can display a custom message to the user
    event.preventDefault(); // Some browsers require this for custom messages
    event.returnValue = ''; // Display a prompt to the user in some browsers
}); */

popup;

function unwind() {
    document.getElementById('nav').classList.add('unwind'),
        document.getElementById('button').classList.add('unwind'),
        document.getElementById('hide').classList.add('unwind'),
        document.getElementById('hide1').classList.add('unwind'),
        document.getElementsByClassName('strong').classList.toggle('unwind'),
    document.getElementById('body').classList.add('unwind');

}

function rewind() {
    document.getElementById('nav').classList.toggle('unwind'),
    document.getElementById('content').classList.toggle('unwind'),
        document.getElementById('button').classList.toggle('unwind'),
        document.getElementById('hide').classList.toggle('unwind'),
        document.getElementById('hide1').classList.toggle('unwind'),
        document.getElementsByClassName('strong').classList.toggle('unwind'),
        document.getElementById('body').classList.toggle('unwind');

}

function check(){
    
    let save = sessionStorage.getItem('last-selected');
    if(save) {
        select_renew(save);
    }
    else {
        deflt = 'strg';
        select_renew(deflt);
    } 
}

function select_renew(element) {
    document.getElementById('a_' + element).style.transition = 'none';
    document.getElementById('i_' + element).style.transition = 'none';
    document.getElementById('bar_' + element).style.transition = 'none';

    document.getElementById('content').style.opacity = '0%';
    document.getElementById('innerbody').style.opacity = '100%';
    if(popup === false) {
        setTimeout(() => {
            document.getElementById('innerbody').style.opacity = '0%';
            document.getElementById('content').style.opacity = '100%';
        }, 5000);
        let curr_elem = document.querySelector('li.select');
        let curr_sel = document.querySelector('a.select');
        let curr_bar = document.querySelector('.bar.select');
        if (curr_sel) {
            curr_elem.classList.remove('select');
            curr_sel.classList.remove('select');
            curr_bar.classList.remove('select');
        }
        document.getElementById(element).classList.toggle('select');
        document.getElementById('a_' + element).classList.toggle('select');
        document.getElementById('i_' + element).classList.toggle('select');
        document.getElementById('bar_' + element).classList.toggle('select');
        sessionStorage.setItem("last-selected", element);
        display_content(element);
    }
    else {
        return;
    }
}

function select(element) {
    document.getElementById('content').style.opacity = '0%';
    document.getElementById('innerbody').style.opacity = '100%';
    setTimeout(() => {
        document.getElementById('innerbody').style.opacity = '0%';
        document.getElementById('content').style.opacity = '100%';
    }, 5000);
    let curr_elem = document.querySelector('li.select');
    let curr_sel = document.querySelector('a.select');
    let curr_bar = document.querySelector('.bar.select');
    if (curr_sel) {
        curr_bar.style.transition = '';
        curr_sel.style.transition = '';
        curr_elem.style.transition = '';
        curr_elem.classList.remove('select');
        curr_sel.classList.remove('select');
        curr_bar.classList.remove('select');
    }
    document.getElementById(element).classList.toggle('select');
    document.getElementById('a_' + element).classList.toggle('select');
    document.getElementById('i_' + element).classList.toggle('select');
    document.getElementById('bar_' + element).classList.toggle('select');
    sessionStorage.setItem("last-selected", element);
    display_content(element);

}

function display_content(element) {
    setTimeout(() => {

        if(element == 'dshbrd') {
            console.log('dashboard');
            document.getElementById("content").innerHTML = '<iframe src="dashboard.php" frameborder="0" allowfullscreen></iframe>';
    
        }else if(element == 'usr') {
            console.log('user');
            document.getElementById("content").innerHTML = '<iframe src="palette.html" frameborder="0" allowfullscreen></iframe>';
    
        }else if(element == 'bckups') {
            console.log('backups');
            document.getElementById("content").innerHTML = '<iframe src="palette.html" frameborder="0" allowfullscreen></iframe>';
    
        }else if(element == 'strg') {
            console.log('storage');
            document.getElementById("content").innerHTML = '<iframe src="storage.php" frameborder="0" allowfullscreen></iframe>';
    
        }else if(element == 'mail') {
            console.log('mail');
            document.getElementById("content").innerHTML = '<iframe src="palette.html" frameborder="0" allowfullscreen></iframe>';
    
        }else if(element == 'log') {
            console.log('log');
            document.getElementById("content").innerHTML = '<iframe src="palette.html" frameborder="0" allowfullscreen></iframe>';

        }  
 }, 4900);

}
