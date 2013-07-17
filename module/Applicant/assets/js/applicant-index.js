$(document).ready(function(){
    
    $("#gar_registration_form").validate({
        rules: {
            'registration_email_address' : {
                "required" : true,
                "email" : true
            },
            'registration_password': {
                "required" : true,
                "equalTo": "#registration_verify_password"
            },
            'registration_verify_password' : "required"
        }
    });
    
});