$(document).ready(() => {

    let currentUser = $('.share-track').attr('data-current-user');
    let selectedUser;

    console.log(currentUser, selectedUser, 'current and selected users');



    function setGetData () {
        selectedUser = $('select[name="share-track"] :selected').attr('value');

        return {
            action: 'seeRecommendations',
            current: currentUser,
            selected: selectedUser,
        };

    }

    function placeData (element, data) {
        console.log(element);
        let ourElement = $('<h3></h3>', {
            text: 'Artist: ' + data.artist + '; Album: ' + data.album,
        }).appendTo(element);
    }


    function getRecommendedList () {
        $.ajax({
            type: 'GET',
            url: './endpoints/homePage.php',
            dataType: 'json',
            data: setGetData(),
            success: function(data) {
                console.log(data, 'data');
                console.log(typeof data);
                data.forEach((elem) => {
                    placeData('.results', elem);
                });
            },
        })
        .fail(() => {
            console.log('Something went wrong');
        });
    }

    $('input[name="shares"]').on('click', () => {
        console.log('change');
        getRecommendedList();

    });

});