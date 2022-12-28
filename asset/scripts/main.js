import { Form } from './Form.js'

(function () {

    let elForms = document.querySelectorAll('[data-js-form]');
    let sidenav = document.getElementById("mySidenav");
    let openBtn = document.getElementById("openBtn");
    let closeBtn = document.getElementById("closeBtn");

    for (let i = 0, l = elForms.length; i < l; i++) {
        new Form(elForms[i]);
    }

    /**
     * function manu burger
     */
    openBtn.onclick = openNav;
    closeBtn.onclick = closeNav;

    function openNav() {
        sidenav.classList.add("active");

    }

    function closeNav() {
        sidenav.classList.remove("active");
    }



       /**
         * function zoom sur image
         */
    let zoomer = function () {

        document.querySelector('#img-zoomer-box').addEventListener('mousemove', function (e) {

            let original = document.querySelector('#img-1'),
                magnified = document.querySelector('#img-2'),
                style = magnified.style,
                x = e.pageX - this.offsetLeft,
                y = e.pageY - this.offsetTop,
                imgWidth = original.offsetWidth,
                imgHeight = original.offsetHeight,
                xperc = ((x / imgWidth) * 100),
                yperc = ((y / imgHeight) * 100);

            if (x > (.01 * imgWidth)) {
                xperc += (.15 * xperc);
            };

            if (y >= (.01 * imgHeight)) {
                yperc += (.15 * yperc);
            };

            style.backgroundPositionX = (xperc - 9) + '%';
            style.backgroundPositionY = (yperc - 9) + '%';

            style.left = (x - 180) + 'px';
            style.top = (y - 180) + 'px';

        }, false);
    }();
    zoomer();
})(); 