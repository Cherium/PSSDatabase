$(document).ready(function () {

    // app html
    var app_html = `
        <div class='container'>

            <div class='page-header'>
                <h1 id='page-title'>Events</h1>
            </div>

            <!-- this is where the contents will be shown. -->
            <div id='page-content'></div>

        </div>`;

    // inject to 'app' in index.html
    $("#app").html(app_html);

});