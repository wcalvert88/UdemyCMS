$(document).ready(function() {
    // EDITOR CKEDITOR
    ClassicEditor
    .create( document.querySelector( '#body' ) )
    .catch( error => {
        console.error( error );
    } );

    $('#selectAllBoxes').click(function(event) {
        if(this.checked) {
            $('.checkBoxes').each(function(){
                this.checked = true;
            });
        } else {
            $('.checkBoxes').each(function() {
                this.checked = false;
            })
        }
    });

    // This adds a loading screen feature I don't like how it works so it's commented out for reference.
    // var divBox = "<div id='load-screen'><div id='loading'></div></div>";
    // $("body").prepend(divBox);
    // $('#load-screen').delay(700).fadeOut(600, function() {
    //     $(this).remove();
    // });
});

function loadUsersOnline() {
    $.get("includes/functions.php?onlineusers=result", function(data) {
        $(".usersOnline").text(data);
    });
}

setInterval(function() {
    loadUsersOnline();
}, 500);
