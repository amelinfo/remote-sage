import $ from 'jquery';

    function initSlider(){
        $('.quotes').slick({
        dots: false,
        infinite: true,
        autoplay: true,
        autoplaySpeed: 2000,
        speed: 800,
        slidesToShow: 1,
        //adaptiveHeight: true,
      });
    }

    $(document).on('ready', function () {
        $('.no-fouc').removeClass('no-fouc');
        initSlider();
    });    
