function disableImgDragging() {
    var images = document.getElementsByTagName("img")
    for(var i = 0 ; i < images; i++) {
        images[i].classList.add('no-drag');
        images[i].setAttribute('no-drag', 'on');
        images[i].setAttribute('draggable', 'false');
        images[i].addEventListener('dragstart', function(event) {
            event.preventDefault();
        }, false);
    }
}
disableImgDragging();