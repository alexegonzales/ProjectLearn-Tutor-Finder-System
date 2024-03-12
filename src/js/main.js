
//email
$(document).ready(function(){


    $('#email').on('focusout', function(){

        if($('#email').val() != ""){

           if(validateEmail($('#email').val())){

            $('.error').fadeOut('slow');

           }else{
              $('.error').text('Invalid Email!');
              $('.error').fadeIn('slow');
           }

        }else{
            $('.error').text('Email Required!');
            $('.error').fadeIn("slow");
        }



    });

});


function validateEmail(eVal){
    var val = /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/;
    
    if( val.test(eVal)){
        return true;
    }else{
        return false;
    }
}

//first name
$(document).ready(function(){


    $('#firstname').on('focusout', function(){

        if($('#firstname').val() != ""){

           if(validateFname($('#firstname').val())){

            $('.error').fadeOut('slow');

           }else{
              $('.error').text('Invalid First name!');
              $('.error').fadeIn('slow');
           }

        }else{
            $('.error').text('First name Required!');
            $('.error').fadeIn("slow");
        }



    });

});


function validateFname(eVal){
    var val = /^\s+|[\d]$/;
    
    if(val.test(eVal) == 1){
        return false;
    }else{
        return true;
    }
}

//last name
$(document).ready(function(){


    $('#lastname').on('focusout', function(){

        if($('#lastname').val() != ""){

           if(validateLname($('#lastname').val())){

            $('.error').fadeOut('slow');

           }else{
              $('.error').text('Invalid Last name!');
              $('.error').fadeIn('slow');
           }

        }else{
            $('.error').text('Last name Required!');
            $('.error').fadeIn("slow");
        }



    });

});


function validateLname(eVal){
    var val = /^\s+|[\d]$/;
    
    if(val.test(eVal) == 1){
        return false;
    }else{
        return true;
    }
}

//username
$(document).ready(function(){


    $('#username').on('focusout', function(){

        if($('#username').val() != ""){

           if(validateUname($('#username').val())){

            $('.error').fadeOut('slow');

           }else{
              $('.error').text('Invalid Username!');
              $('.error').fadeIn('slow');
           }

        }else{
            $('.error').text('Username Required!');
            $('.error').fadeIn("slow");
        }



    });

});


function validateUname(eVal){
    var val = /^(?=[a-zA-Z])(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;
    
    if(val.test(eVal)){
        return true;
    }else{
        return false;
    }
}


