// JavaScript source code
$(document).ready(function () {

    // show html form when 'update product' button was clicked
    $(document).on('click', '.update-event-button', function () {
        var name = $(this).attr('data-Name');
        var date = $(this).attr('data-Date');

        console.log(date);
        console.log(name);

        // read one record based on given product id
        $.getJSON("http://localhost/api/event/read_one.php?Name=\"" + name + "\"&Date=\"" + date + "\"", function (data) {

            // values will be used to fill out our form
            var name = data.Name;
            var date = data.Date;
            var location = data.Location;
            var fundname = data.FundraiserName;

            // load list of categories will be here
            // Don't need this since we don't have something like this

            //// load list of categories
            //$.getJSON("http://localhost/api/category/read.php", function (data) {

            //    // build 'categories option' html
            //    // loop through returned list of data
            //    var categories_options_html = `<select name='category_id' class='form-control'>`;

            //    $.each(data.records, function (key, val) {
            //        // pre-select option is category id is the same
            //        if (val.id == category_id) { categories_options_html += `<option value='` + val.id + `' selected>` + val.name + `</option>`; }

            //        else { categories_options_html += `<option value='` + val.id + `'>` + val.name + `</option>`; }
            //    });
            //    categories_options_html += `</select>`;

            //    // update product html will be here
            //});

            // store 'update product' html to this variable

            var update_event_html = `
            <div id='read-events' class='btn btn-primary read-events-button'>
                <span class='glyphicon glyphicon-list'></span> Read Events
            </div>

            <!-- build 'update event' html form -->
            <!-- we used the 'required' html5 property to prevent empty fields -->
            <form id='update-event-form' action='#' method='post' border='0'>
                <table class='table'>

                    <!-- name field -->
                    <tr>
                        <td>Name</td>
                        <td><input value=\"`+ name + `\" type='text' name='Name' class='form-control'/></td>
                    </tr>

                    <!-- date field -->
                    <tr>
                        <td>Date</td>
                        <td><input value=\"`+ date + `\" type='date' name='Date' class='form-control'/></td>
                    </tr>

                    <!-- location field -->
                    <tr>
                        <td>Location</td>
                        <td><input value=\"`+ location + `\" type='text' name='Location' class='form-control'/></td>
                    </tr>

                    <!-- fundraiser field -->
                    <tr>
                        <td>Corresponding Fundraiser</td>
                        <td><input value=\"`+ fundname + `\" type='text' name='FundraiserName' class='form-control'/></td>
                    </tr>
 

                    <tr>
                        <!-- button to submit form -->
                        <td></td>
                        <td>
                            <button type='submit' class='btn btn-info'>
                                <span class='glyphicon glyphicon-edit'></span> Update Event
                            </button>
                        </td>
 
                    </tr>
 
                </table>
            </form>`;

            // inject to 'page-content' of our app
            $("#page-content").html(update_event_html);

            // chage page title
            changePageTitle("Update Event");
           
        });


    });

    // will run if 'create product' form was submitted
    $(document).on('submit', '#update-event-form', function() {

        // get form data
        var form_data = JSON.stringify($(this).serializeObject());

        // submit form data to api
        $.ajax({
            url: "http://localhost/api/event/update.php",
            type: "POST",
            contentType: 'application/json',
            data: form_data,
            success: function (result) {
                // product was created, go back to products list
                showEvents();
            },
            error: function (xhr, resp, text) {
                // show error to console
                console.log(xhr, resp, text);
            }
        });

        return false;
    });


});