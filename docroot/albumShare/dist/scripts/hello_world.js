'use strict';

var _typeof = typeof Symbol === "function" && typeof Symbol.iterator === "symbol" ? function (obj) { return typeof obj; } : function (obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; };

$(document).ready(function () {

    console.log("hello");

    var arry = ['hello', 'world'];

    arry.forEach(function (elem, i) {
        console.log(elem);
    });

    var myPath = '/Users/jslavin/Projects/localhost/docroot/albumShare/pages/endpoints/helloWorldAPI.php';

    $.ajax({
        type: 'GET',
        url: './endpoints/helloWorldAPI.php',
        dataType: 'json',
        data: { 'action': 'getList' },
        success: function success(data) {
            console.log(data);
            console.log(typeof data === 'undefined' ? 'undefined' : _typeof(data));
            // console.log(data.array.hello);
            // console.log(data.array.world);
        }
    });
});