<?php include('connect.php') ?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
    
</head>
    
<body>

    <div class="password_reset">
        <div class="form-container">
            <div class="image-holder"></div>
            <form method="post">
                <h2 class="text-center"><strong>Forgotton your password? </strong></h2>
                
                
                <div class="form-group"><input class="form-control" type="email" name="email" placeholder="Enter your email and submit to reset" required></div>
                
                
                            
                
                <div class="form-group"><button name="sendmail" class="btn btn-primary btn-block" action=""type="submit">Submit</button></div></form>
            
                 <a href="login.php" class="register"> Login to your account. </a>
            
            
        </div>
    </div>
    </body>

</html>

