$(document).ready(function() {
       
    $.validator.addMethod('atLeastOneChecked', function(value, element) {
        return ($(".checkbox-group:checked").length > 0);
    }, 'Please select at least one option.');

    $("#graduate_assistant_application_form").validate({
        rules: {
            'first_name' : "required",
            'last_name': "required",
            'email_address' : {
                "required" : true,
                "email" : true
            },
            'position_id[]' : {
                'atLeastOneChecked' : true
            },
            'telephone_number' : "required",
            'undergraduate_institution' : "required",
            'graduate_institution' : "required",
            'graduate_program' : "required",
            'reference_one' : "required",
            'reference_two' : "required",
            'reference_three' : "required",
            'personal_qualities_question' : {
                required: true, 
                rangelength: [1, 5000]
            },
            'prior_experiences_question' : {
                required: true, 
                rangelength: [1, 5000]
            },
            'resume_cover_letter_attachment': {
                'required': true,
                'accept': "application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,binary/octet-stream,application/octet-stream"
            }
        },
        ignore: '',
        errorPlacement: function(error, element) {
            if (element.attr("type") === "checkbox") 
            {
                error.insertAfter("div[class='checkbox-group-container']");
            }
            else{
            
                if(element.attr("type") === "file")
                {
                    error.insertAfter("div[class='input-append']");
                }
                else{
                    if(element.hasClass('textarea-validation') == true){
                        error.insertAfter($(element).next());
                    }
                    else
                    {
                        error.insertAfter(element);
                    }
                }
                
            }
        },
        messages: {
            'resume_cover_letter_attachment': {
                'required': 'You must attach a cover letter with a resume.',
                'accept': "Your file type must be a .pdf, .docx, or .doc."
            },
            'position_id':{
                'atLeastOneChecked': 'Please select a position'
            },
            'personal_qualities_question':{
                rangelength: function(range, input) {
                                return [
                                    'You are only allowed between ',
                                    range[0],
                                    'and ',
                                    range[1],
                                    ' You have typed ',
                                    $(input).val().length,
                                    ' characters'                                
                                ].join('');
                            }
            },
            'prior_experiences_question':{
                rangelength: function(range, input) {
                                return [
                                    'You are only allowed between ',
                                    range[0],
                                    'and ',
                                    range[1],
                                    ' You have typed ',
                                    $(input).val().length,
                                    ' characters'                                
                                ].join('');
                            }
            }
        }
    });
    
     $('textarea').tinymce({
        // Location of TinyMCE script
        script_url : '/gar/assets/tiny_mce/tiny_mce.js',

        // General options
        theme : "advanced",
        skin : "bootstrap",
        plugins : "lists,style,paste,advlist",

        // Theme options
        theme_advanced_buttons1 : "bold,italic,underline,fontsizeselect,|,paste,pastetext,pasteword,|,bullist,numlist,|,outdent,indent,|,undo,redo",
        theme_advanced_buttons2 : "",
        theme_advanced_buttons3 : "",
        theme_advanced_buttons4 : "",
        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        theme_advanced_statusbar_location : false,
        theme_advanced_resizing : false,
        
        onchange_callback: function (editor)
        {
            tinyMCE.triggerSave();
            $("#" + editor.id).valid();
        }
    });
    
    
});