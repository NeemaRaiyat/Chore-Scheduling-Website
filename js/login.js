// This file validates the login form
$(document).ready( function() {

    $('#form').submit( function() {

        // clears error messages on a new form submission
        $('#email_errors').empty();
        $('#pw_errors').empty();

        var email = $('#email').val();         
        var pw = $('#password').val();
    
        if (email == null || email == "" || !email.includes("@") || pw == null || pw == "") {
            
            $('#pw_errors').append("!! Email or Password is Incorrect !!");
            return false;
        }
        return true;
    });
});

