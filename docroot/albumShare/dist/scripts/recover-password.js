'use strict';

$(document).ready(function () {

    console.log('im here');

    var $initialLogin = $('.initial-login');
    var $lostPWForm = $('.lost-pw-form');

    var formHeight = $lostPWForm.height();
    var loginHeight = $initialLogin.height();

    $initialLogin.height(loginHeight - formHeight);

    function setPostData() {
        var email = $('input[name="recovery-email"]').val();

        return {
            'action': 'recoverPassword',
            'email': email
        };
    }

    function ajaxRecoverPassword() {
        $.ajax({
            type: 'POST',
            url: '../endpoints/passwordRecovery.php',
            dataType: 'json',
            data: setPostData(),
            success: function success(data) {
                console.log(data, 'data');
            }
        }).fail(function () {
            console.log('Something went wrong');
        });
    }

    function removeFormandReplace() {
        var inputVal = $lostPWForm.find('input').val();

        $lostPWForm.css('height', formHeight);
        $lostPWForm.empty();
        $('<h3></h3>', {
            text: 'An email has been sent to ' + inputVal + '. Thank you.'
        }).appendTo($lostPWForm);
    }

    $('.lost-pw').on('click', function () {
        $initialLogin.css({
            'height': loginHeight,
            'transition': '1s'
        });
        window.setTimeout(function () {
            $('.lost-pw-form').addClass('toggle').css('visibility', 'visible');
        }, 500);
    });

    $('.recover-submit').on('click', function () {
        console.log('click');
        ajaxRecoverPassword();
        removeFormandReplace();
    });
});