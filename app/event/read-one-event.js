// JavaScript source code
$(document).ready(function () {

    // handle 'read one' button click
    $(document).on('click', '.read-one-event-button', function () {
        // get primary key
        var name = $(this).attr('data-Name');
        var date = $(this).attr('data-Date');

        console.log(name);
        console.log(date);

        // read event record based on given ID
        $.getJSON("http://localhost/api/event/read_one.php?Name=\"" + name + "\"&Date=\"" + date + "\"", function (data) {
            // start html
            var read_one_event_html =`
 
            <!-- when clicked, it will show the event's list -->
            <div id='read-events' class='btn btn-primary read-events-button'>
                <span class='glyphicon glyphicon-list'></span> Read Events
            </div>

            <!-- event data will be shown in this table -->
            <table class='table'>

                <!-- event name -->
                <tr>
                    <td class='w-30-pct'>Name</td>
                    <td class='w-70-pct'>` + data.Name + `</td>
                </tr>
 
                <!-- event date -->
                <tr>
                    <td>Date</td>
                    <td>` + data.Date + `</td>
                </tr>
 
                <!-- event location -->
                <tr>
                    <td>Location</td>
                    <td>` + data.Location + `</td>
                </tr>
 
                <!-- event fundraiser name -->
                <tr>
                    <td>Corresponding Fundraiser</td>
                    <td>` + data.FundraiserName + `</td>
                </tr>
 
            </table>`;

            // inject html to 'page-content' of our app
            $("#page-content").html(read_one_event_html);

            // chage page title
            changePageTitle("Selected Event");
        });
    });

});