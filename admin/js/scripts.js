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
    var divBox = "<div id='load-screen'><div id='loading'></div></div>";
    $("body").prepend(divBox);
    $('#load-screen').delay(700).fadeOut(600, function() {
        $(this).remove();
    });
});
