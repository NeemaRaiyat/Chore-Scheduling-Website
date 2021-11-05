// This file validates the joinHouse form
$(document).ready( function() {

    $('#form').submit( function() {

        // clears error messages on a new form submission
        $('#pw_errors').empty();

        var name = $('#name').val();         
        var pw = $('#password').val();
    
        if (name == null || name == "" ||  pw == null || pw == "") {
            
            $('#pw_errors').append("!! Incorrect Group Name or Password !!");
            return false;
        }
        return true;
    });
});
