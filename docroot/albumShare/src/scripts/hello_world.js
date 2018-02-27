$(document).ready(() => {

console.log("hello");


let arry = ['hello', 'world'];

arry.forEach((elem, i) => {
    console.log(elem);
});

let myPath = '/Users/jslavin/Projects/localhost/docroot/albumShare/pages/endpoints/helloWorldAPI.php';

$.ajax({
    type: 'GET',
    url: './endpoints/helloWorldAPI.php',
    dataType: 'json',
    data: {'action' : 'getList'},
    success: function(data) {
        console.log(data);
        console.log(typeof data);
        // console.log(data.array.hello);
        // console.log(data.array.world);
    },
});


});

