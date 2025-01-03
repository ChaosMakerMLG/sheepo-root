/* window.addEventListener('beforeunload', function (event) {
    // Your function to run before unloading the page
    console.log('Page is about to be unloaded.');
    rewind();

    // You can display a custom message to the user
    event.preventDefault(); // Some browsers require this for custom messages
    event.returnValue = ''; // Display a prompt to the user in some browsers
}); */

const popup = Boolean(false);

function unwind() {
    document.getElementById('nav').classList.add('unwind'),
        document.getElementById('button').classList.add('unwind'),
/*         document.getElementById('hide').classList.add('unwind'),
        document.getElementById('hide1').classList.add('unwind'), */
        document.getElementsByClassName('strong').classList.toggle('unwind'),
    document.getElementById('body').classList.add('unwind');

}

function rewind() {
    document.getElementById('nav').classList.toggle('unwind'),
    document.getElementById('content').classList.toggle('unwind'),
        document.getElementById('button').classList.toggle('unwind'),
/*         document.getElementById('hide').classList.toggle('unwind'),
        document.getElementById('hide1').classList.toggle('unwind'), */
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

let dynamicDelay = 100; // Default delay

function measureLoadTime(src, callback) {
    const startTime = performance.now();
    const iframe = document.createElement('iframe');
    iframe.src = src;
    iframe.style.display = 'none'; // Hide during measurement
    iframe.onload = () => {
        const endTime = performance.now();
        document.body.removeChild(iframe);
        callback(endTime - startTime);
    };
    document.body.appendChild(iframe);
}

function updateDynamicDelay(loadTime) {
    // Smooth adjustment of dynamic delay
    dynamicDelay = Math.max(500, loadTime + 500); // Add 500ms buffer, min delay of 500ms
    console.log(`Page loaded in ${dynamicDelay}ms`);
}

function select_renew(element) {
    document.getElementById('a_' + element).style.transition = 'none';
    document.getElementById('i_' + element).style.transition = 'none';
    document.getElementById('bar_' + element).style.transition = 'none';

    document.getElementById('content').style.opacity = '0%';
    document.getElementById('innerbody').style.opacity = '100%';

    if (!popup) {
        measureLoadTime(`/${element}.php`, loadTime => {
            updateDynamicDelay(loadTime);

            setTimeout(() => {
                document.getElementById('innerbody').style.opacity = '0%';
                document.getElementById('content').style.opacity = '100%';
            }, dynamicDelay);
        });

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
    } else {
        return;
    }
}

function select(element) {
    document.getElementById('content').style.opacity = '0%';
    document.getElementById('innerbody').style.opacity = '100%';

    measureLoadTime(`/${element}.php`, loadTime => {
        updateDynamicDelay(loadTime);

        setTimeout(() => {
            document.getElementById('innerbody').style.opacity = '0%';
            document.getElementById('content').style.opacity = '100%';
        }, dynamicDelay);
    });

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
    const iframeSources = {
        dshbrd: 'dashboard.php',
        usr: 'palette.html',
        bckups: 'palette.html',
        strg: 'storage.php',
        mail: 'palette.html',
        log: 'palette.html',
    };

    const iframeSrc = iframeSources[element];
    if (!iframeSrc) {
        console.error('No such element.');
        return;
    }

    // Dynamically load content using modern fetch API
    const contentDiv = document.getElementById("content");
    contentDiv.innerHTML = ''; // Clear existing content

    // Create and append the iframe dynamically
    const iframe = document.createElement('iframe');
    iframe.src = iframeSrc;
    iframe.frameBorder = "0";
    iframe.allowFullscreen = true;

    // Append the iframe to the content div
    contentDiv.appendChild(iframe);

}
