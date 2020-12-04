// JavaScript source code
$(document).ready(function () {

    // show html form when 'create product' button was clicked
    $(document).on('click', '.create-event-button', function () {
        // categories api call will be here
        //$.getJSON("http://localhost/api/category/read.php", function (data) {
            //// build categories option html
            //// loop through returned list of data
            //var categories_options_html = `<select name='category_id' class='form-control'>`;
            //$.each(data.records, function (key, val) {
            //    categories_options_html += `<option value='` + val.id + `'>` + val.name + `</option>`;
            //});
            //categories_options_html += `</select>`;
        //});

        // we have our html form here where product information will be entered
        // we used the 'required' html5 property to prevent empty fields
        var create_product_html =`
 
        <!-- 'read products' button to show list of products -->
        <div id='read-products' class='btn btn-primary read-events-button'>
            <span class='glyphicon glyphicon-list'></span> Read Events
        </div>

        <!-- 'create product' html form -->
        <form id='create-event-form' action='#' method='post' border='0'>
            <table class='table'>

                <!-- name field -->
                <tr>
                    <td>Name</td>
                    <td><input type='text' name='Name' class='form-control' required /></td>
                </tr>

                <!-- Date field -->
                <tr>
                    <td>Date</td>
                    <td><input type='date' name='Date' class='form-control' required /></td>
                </tr>

                <!-- description field -->
                <tr>
                    <td>Location</td>
                    <td><input type='text' name='Location' class='form-control' value=null /></td>
                </tr>

                <!-- fundraiser field -->
                <tr>
                    <td>Corresponding Fundraiser</td>
                    <td><input type='text' name='FundraiserName' class='form-control' value=null /></td>
                </tr>
 
                <!-- button to submit form -->
                <tr>
                    <td></td>
                    <td>
                        <button type='submit' class='btn btn-primary'>
                            <span class='glyphicon glyphicon-plus'></span> Create Event
                        </button>
                    </td>
                </tr>
 
            </table>
        </form>`;

        // inject html to 'page-content' of our app
        $("#page-content").html(create_product_html);

        // chage page title
        changePageTitle("Create Event");
    });

    // will run if create product form was submitted
    $(document).on('submit', '#create-event-form', function () {
        // get form data
        var form_data = JSON.stringify($(this).serializeObject());

        console.log(form_data);

        // submit form data to api
        $.ajax({
            url: "http://localhost/api/event/create.php",
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