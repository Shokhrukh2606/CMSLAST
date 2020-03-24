
$('.products-slider').owlCarousel({
    loop: true,
    margin: 10,
    dots: true,
    responsive: {
        0: {
            items: 1
        },
        600: {
            items: 1
        },
        1000: {
            items: 1
        }
    }
})

$('.clients-slider').owlCarousel({
    loop: true,
    margin: 10,
    nav: true,
    dots: false,
    responsive: {
        0: {
            items: 1
        },
        600: {
            items: 3
        },
        768: {
            items: 4
        },
        992: {
            items: 5
        },
        1000: {
            items: 6
        }
    }
})
$('.inner-slider').owlCarousel({
    loop: true,
    margin: 10,
    dots: true,
    responsive: {
        0: {
            items: 1
        }
    }
})

// --- Video player---
const myVideo = document.getElementById("video");
const myVideoPlay = document.querySelector(".video-play");

myVideo ? myVideo.addEventListener("click", () => {
    if (myVideo.paused) {
        myVideo.setAttribute("controls", "controls");
        myVideoPlay.style.visibility = 'hidden';
        myVideoPlay.style.opacity = '0';
    }
    else {
        myVideo.setAttribute("controls", "controls");
    }
}) : null;

myVideoPlay ? myVideoPlay.addEventListener("click", () => {
    myVideo.setAttribute("controls", "controls");
    myVideo.play();
    myVideoPlay.style.visibility = 'hidden';
    myVideoPlay.style.opacity = '0';
}) : null
// --- end Video player---


// menu
$(".menuTrigger").click(function () {
    $("body").css("height", "100vh");
    $("body").css("overflow", "hidden");
    $(".mobMenu").removeClass("inactiveMob");
    $(".mobUnderlay").css("display", "block");
})
$(".mobUnderlay").click(function () {
    $("body").css("height", "unset");
    $("body").css("overflow", "unset");
    $(".mobMenu").addClass("inactiveMob");
    $(".mobUnderlay").css("display", "none");
})

$(".language").click(function () {
    $(".langList").fadeToggle();
})