// This file validates the addChore.php form
$(document).ready( function() {

    $('#form').submit( function() {

        // clears error messages on a new form submission
        $('#title_errors').empty();
        $('#desc_errors').empty();
        $('#frequency_errors').empty();

        var key = 1;
        var title = $('#title').val();
        var freq = $('#frequency').val();
    
        if (title == null || title == "") {
            
            $('#title_errors').append("!! Title must be filled in !!");
            key = 0;
        }
        if (freq == null || freq == "") {
            $('#frequency_errors').append("!! Frequency must be filled in !!");
            key = 0;
        }
        if (key == 0) {
            return false;
        }
        return true;
    });
});

