<?php error_reporting(E_ERROR|E_PARSE);

include 'functions.php';

$con = getDB();

session_start();


if($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $pass = $_POST['pass'];

    


   $sql = $con->prepare("SELECT id, name, email, password FROM clientList WHERE name = ?");

    $sql->bind_param("s",$name);

    $sql->execute();

    $sql->bind_result($user_id,$user_name,$user_email,$hashed_password);

    $result = $sql->fetch();

    
    
    if (!empty($user_name)){
        if (password_verify($pass, $hashed_password)){
        
            $_SESSION['login_user'] = $user_name;
            
            $link = "<script>window.open('http://localhost:3000/')</script>";

            echo $link;
            //header ('location: chat-page.html');
        }
        
        
        else{
        $error = "Your password did not match";
        
        }
        
        
    }
    else{
        $error = "Your Login Name or Password is invalid";
    }
    }
    
    
    




?>





<!DOCTYPE html>
<!-- Sign In Page -->
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>UChat - Instant Messgenger Sign In Page </title>


    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>

    <section class="sign-in">
        <div class="container">
            <div class="signin-content">
                <div class="signin-image">
                    <figure><img src="../UChat/images/signup-image.png" alt="sign up image"></figure>
                    <a href="../UChat/index1.php" class="signup-image-link">Create an account</a>
                </div>

                <div class="signin-form">
                    <h2 class="form-title">Sign In</h2>
                    <form method="POST" class="register-form" id="login-form" action="<?php echo htmlspecialchars($_SERVER[" PHP_SELF"]);?>">
                        <div class="form-group">
                            <label for="your_name"></label>
                            <input type="text" name="name" id="your_name" placeholder="Your Name" />
                        </div>
                        <div class="form-group">
                            <label for="your_pass"></label>
                            <input type="password" name="pass" id="your_pass" placeholder="Password" />
                        </div>

                        <div class="form-group">
                            <input type="checkbox" name="remember-me" id="remember-me" class="agree-term" />
                            <label for="remember-me" class="label-agree-term"><span><span></span></span>Remember me</label>
                        </div>
                        <div class="form-group form-button">
                            <input type="submit" name="signin" id="signin" class="form-submit" value="Log in" />
                        </div>
                        <?php
                            
                            echo $error;  
                            echo $passwordHashed;
                            echo "acutal username " . $user_name;
                            ?>
                    </form>

                </div>
            </div>
        </div>
    </section>
</body>

</html>
