$(document).ready(function () {

    // will run if the delete button was clicked
    $(document).on('click', '.delete-product-button', function () {
        // get primary key
        var name = $(this).attr('data-Name');
        var date = $(this).attr('data-Date');

        // bootbox for good looking 'confirm pop up'
        bootbox.confirm({

            message: "<h4>Are you sure?</h4>",
            buttons: {
                confirm: {
                    label: '<span class="glyphicon glyphicon-ok"></span> Yes',
                    className: 'btn-danger'
                },
                cancel: {
                    label: '<span class="glyphicon glyphicon-remove"></span> No',
                    className: 'btn-primary'
                }
            },
            callback: function (result) {
                if (result == true) {

                    // send delete request to api / remote server
                    $.ajax({
                        url: "http://localhost/api/event/delete.php",
                        type: "POST",
                        dataType: 'json',
                        data: JSON.stringify({ Name: name, Date: date }),
                        success: function (result) {

                            // re-load list of products
                            showEvents();
                        },
                        error: function (xhr, resp, text) {
                            console.log(xhr, resp, text);
                            showEvents();
                        }
                    });

                }
            }
        });

        


    });


});