// This file validates the createHouse form
$(document).ready( function() {

    $('#form').submit( function() {

        // clears error messages on a new form submission
        $('#name_errors').empty();
        $('#pw_errors').empty();
        $('#pwc_errors').empty();

        var key = 1;
        var name = $('#name').val();         
        var pw = $('#password').val();
        var pwc = $('#passwordConf').val();

        if (name == null || name == "") {
            
            $('#name_errors').append("!! Name must be filled in !!");
            key = 0;
        }
        if (pw == null || pw == "") {
            
            $('#pw_errors').append("!! Password must be filled in !!");
            key = 0;
        }
        if (pw != pwc) {
            $('#pwc_errors').append("!! Passwords do not match !!");
            key = 0;
        }
        if (key == 0) {
            return false;
        }
        return true;
    });
});

