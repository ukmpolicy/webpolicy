$(document).ready(function() {
    new WOW().init();
    $('.venobox').venobox({
        framewidth : '500px',
        titleattr: 'data-title',
        titlePosition: 'bottom',
        titleColor: '#fff'
    });

    $('#topArrow').click(() => {
        window.scrollTo({top:0})
    })
    
    window.onscroll = (e) => {
        let arrowTop = document.querySelector('#topArrow');
        if (window.scrollY > 64 ) {
            arrowTop.classList.add('show');
        }else {
            arrowTop.classList.remove('show');
        }
    }
})