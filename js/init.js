// https://images.unsplash.com/photo-1434064511983-18c6dae20ed5?q=80&fm=jpg&s=c45f3bff08de3f8509e90f66aab9393f

$('.home').parallax({imageSrc: 'img/head.jpg'});
document.createElement("section");

$(window).scroll(function() {
    if ($(".navbar").offset().top > 50) {
        $(".navbar-fixed-top").addClass("navbar-down");
    } else {
        $(".navbar-fixed-top").removeClass("navbar-down");
    }
});
$(window).scroll(function() {
    if ($(".navbar").offset().top > 50) {
        $(".navbar-fixed-top").addClass("top-nav-collapse");
    } else {
        $(".navbar-fixed-top").removeClass("top-nav-collapse");
    }
});

$(window).scroll(function() {
    if ($(".navbar").offset().top > 50) {
        $(".logo").addClass("logo-down");
    } else {
        $(".logo").removeClass("logo-down");
    }
});
$(window).scroll(function() {
    if ($(".navbar").offset().top > 50) {
        $(".navbar-nav").addClass("navbar-nav-down");
    } else {
        $(".navbar-nav").removeClass("navbar-nav-down");
    }
});


var $line = $('.service');
$line.waypoint(function (direction) {
    if (direction == 'down'){
        $line.addClass('service-down');
    } else {
        $line.removeClass('service-down');
    }
}, {offset: '55%'});