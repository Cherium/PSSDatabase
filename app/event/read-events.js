// JavaScript source code
$(document).ready(function () {

    // show list of product on first load
    showEvents();

    $(document).on('click', '.read-events-button', function () {
        showEvents();
    });

});

function showEvents() {
    // get list of products from the API
    $.getJSON("http://localhost/api/event/read.php", function (data) {
        // html for listing products
        var read_events_html =`
        <!-- when clicked, it will load the create product form -->
        <div id='create-event' class='btn btn-primary create-event-button'>
            <span class='glyphicon glyphicon-plus'></span> Create Event
        </div>

        <!-- start table -->
        <table class='table'>

        <!-- creating our table heading -->
        <tr id="bold_items">
            <th>Name</th>
            <th>Date</th>
            <th>Location</th>
            <th>Corresponding Fundraiser</th>
            <th>Actions</th>
        </tr>`;

        // loop through returned list of data
        $.each(data.records, function (key, val) {

            // creating new table row per record
            read_events_html += `
        <tr>
 
            <td>` + val.Name + `</td>
            <td>` + val.Date + `</td>
            <td>` + val.Location + `</td>
            <td>` + val.FundraiserName + `</td>
 
            <!-- 'action' buttons -->
            <td>
                <!-- read event button -->
                <button class='btn btn-primary read-one-event-button' data-Name='` + val.Name + `' data-Date='`+ val.Date+`'>
                    <span class='glyphicon glyphicon-eye-open'></span> Read
                </button>
 
                <!-- edit button -->
                <button class='btn btn-info update-event-button'  data-Name='` + val.Name + `' data-Date='` + val.Date +`'>
                    <span class='glyphicon glyphicon-edit'></span> Edit
                </button>
 
                <!-- delete button -->
                <button class='btn btn-danger delete-product-button'  data-Name='` + val.Name + `' data-Date='` + val.Date +`'>
                    <span class='glyphicon glyphicon-remove'></span> Delete
                </button>
            </td>
 
        </tr>`;
        });

            // end table
        read_events_html += `</table>`;

        // inject to 'page-content' of our app
        $("#page-content").html(read_events_html);
    });
}
