'use strict';

var _typeof = typeof Symbol === "function" && typeof Symbol.iterator === "symbol" ? function (obj) { return typeof obj; } : function (obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; };

$(document).ready(function () {

    var currentUser = $('.share-track').attr('data-current-user');
    var selectedUser = void 0;

    console.log(currentUser, selectedUser, 'current and selected users');

    function setGetData() {
        selectedUser = $('select[name="share-track"] :selected').attr('value');

        return {
            action: 'seeRecommendations',
            current: currentUser,
            selected: selectedUser
        };
    }

    function placeData(element, data) {
        console.log(element);
        var ourElement = $('<h3></h3>', {
            text: 'Artist: ' + data.artist + '; Album: ' + data.album
        }).appendTo(element);
    }

    function getRecommendedList() {
        $.ajax({
            type: 'GET',
            url: './endpoints/homePage.php',
            dataType: 'json',
            data: setGetData(),
            success: function success(data) {
                console.log(data, 'data');
                console.log(typeof data === 'undefined' ? 'undefined' : _typeof(data));
                data.forEach(function (elem) {
                    placeData('.results', elem);
                });
            }
        }).fail(function () {
            console.log('Something went wrong');
        });
    }

    $('input[name="shares"]').on('click', function () {
        console.log('change');
        getRecommendedList();
    });
});