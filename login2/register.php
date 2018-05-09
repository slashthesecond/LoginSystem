<?php include('connect.php') ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
        <script src="jquery-3.1.1.min.js" type="text/javascript"></script>
     


        <script>
            $(document).ready(function(){

                $("#email").keyup(function(){

                    var email = $("#email").val().trim();
                    
                    if(email != ''){

                        $("#email_response").show();

                        $.ajax({
                            url: 'connect.php',
                            type: 'post',
                            data: {ajax_:'ajax_', email:email},
                            success: function(response){                                
                                // Show status
                                if(response > 0){
                                    $("#email_response").html("<span class='not-exists'>* email Already in use.</span>");

                                }else{
                                    $("#email_response").html("<span class='exists'>Available.</span>");

                                }

                            }
                        });
                    }else{
                        $("email_response").hide();
                    }

                });

            });
        </script>
  
    
</head>

<body>
    
 
      
 <div class="register-photo">
        <div class="form-container">
            <div class="image-holder"></div>
            <form method="post">
                <h2 class="text-center"><strong>Create an account</strong></h2>
                
                
                <div class="form-group"><input class="form-control" type="forename" name="forename" placeholder="Forename" required></div>
                
                <div class="form-group"><input class="form-control" type="surname" name="surname" placeholder="Surname" requied></div>
                
                 <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>

                <div class="form-group"><span id="email_response"></span><input class="form-control" type="email" name="email" placeholder="Email" id="email" >
                
                    
                
                 <span id="usercheck" class="help-block" required></span>
                </div>
                
                <div class="form-group"><input class="form-control" type="password" name="password_1" id="psw" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" placeholder="Password" required></div>
                
                 <div class="form-group"><input class="form-control" type="password" name="password_2" id="psw-2" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" placeholder="Password" required></div>
                
                
                <div class="form-group">
                    <div class="form-check"><label class="form-check-label"><input class="form-check-input" type="checkbox" required>I agree to the license terms.</label></div>
                </div>
                <div class="form-group"><button name="reg_user" class="btn btn-primary btn-block" type="submit">Sign Up</button></div><a href="login.php" class="already">Already a member? Login here.</a></form>
            
            
            
            <script>
            var myInput = document.getElementById("password_1");
            var myInput = document.getElementById("password_2");
            var letter = document.getElementById("letter");
            var capital = document.getElementById("capital");
            var number = document.getElementById("number");
            var length = document.getElementById("length");
            
            // When the user clicks on the password field, show the message box
            myInput.onfocus = function() {
              document.getElementById("message").style.display = "block";
            }
            
            // When the user clicks outside of the password field, hide the message box
            myInput.onblur = function() {
              document.getElementById("message").style.display = "none";
            }
            
            // When the user starts to type something inside the password field
            myInput.onkeyup = function() {
              // Validate lowercase letters
              var lowerCaseLetters = /[a-z]/g;
              if(myInput.value.match(lowerCaseLetters)) { 
                letter.classList.remove("invalid");
                letter.classList.add("valid");
              } else {
                letter.classList.remove("valid");
                letter.classList.add("invalid");
            }
            
              // Validate capital letters
              var upperCaseLetters = /[A-Z]/g;
              if(myInput.value.match(upperCaseLetters)) { 
                capital.classList.remove("invalid");
                capital.classList.add("valid");
              } else {
                capital.classList.remove("valid");
                capital.classList.add("invalid");
              }
            
              // Validate numbers
              var numbers = /[0-9]/g;
              if(myInput.value.match(numbers)) { 
                number.classList.remove("invalid");
                number.classList.add("valid");
              } else {
                number.classList.remove("valid");
                number.classList.add("invalid");
              }
                
              // Validate length
              if(myInput.value.length >= 8) {
                length.classList.remove("invalid");
                length.classList.add("valid");
              } else {
                length.classList.remove("valid");
                length.classList.add("invalid");
              }
            }
</script>
        </div>
    </div>

</body>

</html>