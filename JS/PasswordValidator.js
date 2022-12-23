$("#pssword").on('focus', function() {
    $(".required_password").slideDown();
})


$("#pssword").on('blur', function() {
    $(".required_password").slideUp();
})


$("#pssword").on('keyup', function() {
    passval = $(this).val();


    if (passval.match(/[a-z]/g)) {
        $('.lowerpass').addClass('active');
    } else {
        $('.lowerpass').removeClass('active');
    }


    if (passval.match(/[A-Z]/g)) {
        $('.upperpass').addClass('active');
    } else {
        $('.upperpass').removeClass('active');
    }

    if (passval.match(/[0-9]/g)) {
        $('.numpass').addClass('active');
    } else {
        $('.numpass').removeClass('active');
    }

    if (passval.length >= 8 && passval.length <= 20) {
        $('.minpass').addClass('active');
    } else {
        $('.minpass').removeClass('active');
    }


})