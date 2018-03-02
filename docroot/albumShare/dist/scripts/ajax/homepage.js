'use strict';

Object.defineProperty(exports, "__esModule", {
    value: true
});

var _typeof = typeof Symbol === "function" && typeof Symbol.iterator === "symbol" ? function (obj) { return typeof obj; } : function (obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }; // noinspection JSAnnotator


exports.default = function () {

    var currentUser = $('.share-track').attr('data-curreunt-user');
    var selectedUser = $('select[name="share-track"] :selected').attr('value');

    console.log(currentUser, selectedUser, 'current and selected users');

    function setGetData() {
        return true;
    }

    function getRecommendedList() {
        $.ajax({
            type: 'GET',
            url: './endpoints/helloWorldAPI.php',
            dataType: 'json',
            data: { 'action': 'getList' },
            success: function success(data) {
                console.log(data);
                console.log(typeof data === 'undefined' ? 'undefined' : _typeof(data));
            }
        });
    }
};

;