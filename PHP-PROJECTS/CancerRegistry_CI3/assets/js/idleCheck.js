onInactive(1200000, function () {
    window.location.replace(site_url+'/logout');
});

function onInactive(ms, cb) {

    var wait = setTimeout(cb, ms);

    document.onmousemove = document.mousedown = document.mouseup = document.onkeydown = document.onkeyup = document.focus = function () {
        clearTimeout(wait);
        wait = setTimeout(cb, ms);

    };
}