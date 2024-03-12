
    $("#check").click( function() {
    
    $.post( $("#form").attr("action"),
            $("#form :input").serializeArray(),
        function(info) {
    
            $("#response").empty();
            $("#response").html(info);
        
        });
    
    $("#form").submit( function() {
        return false;  
    });
    });
 
