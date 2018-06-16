$(document).ready(function () {

    $('.show-password').click(function () {
        if ($(this).prev('input').prop('type') == 'password') {
            //Si c'est un input type password
            $(this).prev('input').prop('type', 'text');
            $(this).toggleClass('fal fa-eye');
            $(this).toggleClass('fal fa-eye-slash');


        }
    });

});

