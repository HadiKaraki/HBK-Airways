$("#username").on('focus', function() {
    $(".required_username").slideDown();
})


$("#username").on('blur', function() {
    $(".required_username").slideUp();
})


$("#username").on('keyup', function() {
    useval = $(this).val();


    if (useval.match(/[a-z]/g)) {
        $('.loweruser').addClass('active');
    } else {
        $('.loweruser').removeClass('active');
    }


    if (useval.match(/[A-Z]/g)) {
        $('.upperuser').addClass('active');
    } else {
        $('.upperuser').removeClass('active');
    }

    if (useval.match(/[0-9]/g)) {
        $('.numuser').addClass('active');
    } else {
        $('.numuser').removeClass('active');
    }

    if (useval.length >= 8 && useval.length <= 20) {
        $('.minpass').addClass('active');
    } else {
        $('.minpass').removeClass('active');
    }


})