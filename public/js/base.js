$(document).ready(function(){
    new WOW().init();
    // $('#flash-load').css({
    //     'display':'none'
    // })

    let headCarousel = $("#header .owl-carousel").owlCarousel({
        items: 1,
        autoplay: true,
        loop: true,
        // autoplayHoverPause: false,
        // autoplayTimeout: 5000,
        // animateOut: 'fadeOut',
        // animateIn: 'fadeIn',
        // dots: true,
        mouseDrag: false,
        touchDrag: false,
        nav: false,
        dots: false,
    });
    
    // let structure = $("#structure .owl-carousel").owlCarousel({
    //     items: 1,
    //     autoplay: true,
    //     loop: true,
    //     nav: false,
    //     dots: false,
    // });
    // $("#structure .prev").click(() => {
    //     structure.trigger('prev.owl.carousel');
    // })
    // $("#structure .next").click(() => {
    //     structure.trigger('next.owl.carousel');
    // })
    $('#nav-carousel .prev').click(() => {
        headCarousel.trigger('prev.owl.carousel');
    })
    
    $('#nav-carousel .next').click(() => {
        headCarousel.trigger('next.owl.carousel');
    })
    
    
    setTimeout(() => {
        $('#header .shapes').css({
            'right':'60%',
        })
        $('#header .shapes .shape-2').css({
            'right':'40%'
        })
        
        $('#header .shapes *').css({
            'opacity':'.8'
        })
        
        setTimeout(() => {
            $('#header .shapes').css({
                "animation": "3s shapes infinite"
            })
        }, 1000)
    }, 1000)

    $('#topArrow').click(() => {
        window.scrollTo({top:0})
    })
    
    window.onscroll = (e) => {
        let nav = document.querySelector('#navbar');
        if (window.scrollY > 0 ) {
            nav.classList.add('scroll');
        }else {
            nav.classList.remove('scroll');
        }
        // window.onscroll = (e) => {
        //     concole.log('a')
        // }
        let arrowTop = document.querySelector('#topArrow');
        if (window.scrollY > 64 ) {
            arrowTop.classList.add('show');
        }else {
            arrowTop.classList.remove('show');
        }
    }
});
