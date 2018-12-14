$(document).ready(function(){

    $('.chosen-select').chosen();


    if( $('#signup-timezone-select') ){

        // Guess timezone
        var tz = moment.tz.guess();
        $('#signup-timezone-select option').each(function(){

            if( $(this).val() == tz ){
                $(this).prop('selected', true);
            }
        });
        $('#signup-timezone-select').chosen();

    }


    $('.delete-btn').click(function(){
        if( !confirm('Are you sure you want to delete this?') ){
            return false;
        }
    });


}); // END DOCUMENT READY

function previewFile() {

    var preview = document.getElementById('img-preview');
    var file = document.getElementById('file-with-preview').files[0];

    var reader = new FileReader();

    reader.onloadend = function(){
        preview.src = reader.result;
    }

    if(file) {
        reader.readAsDataURL(file);
    }else{
        preview.src = "";
    }

}
