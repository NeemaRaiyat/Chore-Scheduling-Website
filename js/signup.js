// This file validates the singup form
$(document).ready( function() {

    $('#form').submit( function() {

        // clears error messages on a new form submission
        $('#email_errors').empty();
        $('#un_errors').empty();
        $('#pw_errors').empty();
        $('#pwc_errors').empty();

        var key = 1;
        var email = $('#email').val();         
        var username = $('#username').val();
        var pw = $('#password').val();
        var pwc = $('#passwordConf').val();
    
        if (email == null || email == "" || !email.includes("@")) {
            
            if (email == null || email == "") {
                $('#email_errors').append("!! Email must be filled in !!");
            }
            else {  // if doesnt have @
                $('#email_errors').append("!! Please input a valid email !!");
            }
            key = 0;
        }
        if (username == null || username == "") {
            $('#un_errors').append("!! Username must be filled in !!");
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

