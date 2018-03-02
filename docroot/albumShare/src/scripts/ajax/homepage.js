// noinspection JSAnnotator
export default function () {

    const currentUser = $('.share-track').attr('data-curreunt-user');
    const selectedUser = $('select[name="share-track"] :selected').attr('value');

    console.log(currentUser, selectedUser, 'current and selected users');



    function setGetData () {
        return true;
    }


    function getRecommendedList () {
            $.ajax({
                type: 'GET',
                url: './endpoints/helloWorldAPI.php',
                dataType: 'json',
                data: {'action' : 'getList'},
                success: function(data) {
                    console.log(data);
                    console.log(typeof data);
                },
            });
        }

};