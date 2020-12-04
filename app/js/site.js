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

function move_to_home() {
    window.location = "index.html";
}

function move_to_member() {
    window.location = "members.html";
}

function move_to_meetings() {
    window.location = "meetings.html";
}

function move_to_events() {
    window.location = "events.html";
}

function move_to_financials() {
    window.location = "financials.html";
}

// function to make form values to json format
$.fn.serializeObject = function () {
    var o = {};
    var a = this.serializeArray();
    $.each(a, function () {
        if (o[this.name] !== undefined) {
            if (!o[this.name].push) {
                o[this.name] = [o[this.name]];
            }
            o[this.name].push(this.value || '');
        } else {
            o[this.name] = this.value || '';
        }
    });
    return o;
};