$(document).ready(function(){
    
   /* $('#myTab a').click(function (e) {
        e.preventDefault();
        $(this).tab('show');
    });*/
	    
    $('textarea').tinymce({
        // Location of TinyMCE script
        script_url : '/assets/tiny_mce/tiny_mce.js',

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
