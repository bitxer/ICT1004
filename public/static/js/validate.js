$(document).ready(function(){
  validatePassword();
});


function validatePassword(){
    var pass1 = $('#password');
    var pass2 = $('#confirm_password');
    //var submit_btn = document.getElementById("register-user");
    $('#password, #confirm_password').on('keyup', function () {
        if (pass2.val() == pass1.val()) {
          $('#message1').html('✔').css('color', 'green');
        } else if(pass2.val() !== pass1.val()){
          $('#message1').html('✖').css('color', 'red');
            $('#register-user').click,function(e){
              e.preventDefault();
              return false;
            };
        }
            
      }); 
}


                
        
