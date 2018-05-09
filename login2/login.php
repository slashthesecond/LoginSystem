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

    <div class="login_user">
        <div class="form-container">
            <div class="image-holder"></div>
            <form method="post">
                <h2 class="text-center"><strong>Login</strong></h2>
                
                
                 <a href="register.php" class="register"> New here? Create an account here! </a>
                
                <div class="form-group"><input class="form-control" type="email" name="email" placeholder="Email" required></div>
                
                
                
                <div class="form-group"><input class="form-control" type="password" name="password_1" placeholder="Password" required></div>
                
                <div class="form-group"><input class="form-control" type="password" name="password_2" placeholder="Password" required></div>
                
                
                <div class="form-group"><button name="login_user" class="btn btn-primary btn-block" href="login.php"type="submit">Login</button></div></form>
            
            
                <a href="passwordreset.php" class="forgotton">Forgotton your password? Reset it here. </a>
        </div>
    </div>
    </body>
</html>


