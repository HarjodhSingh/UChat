<?php error_reporting(E_ERROR|E_PARSE);

include 'functions.php';

$con = getDB();


// define variables and set to empty values$name = $email = $password = $password2 = $checkbox = "";
$nameErr = $emailErr = $passwordErr = $password2Err = $checkboxErr = "";
$passFlag = 0;
$allpass = 1;
if($_SERVER["REQUEST_METHOD"] == "POST") {

        if(empty($_POST["name"])){
            $nameErr = "Missing";
            $allpass = 0;
        }else{
            $name = $_POST["name"];
        
        }

        if(empty($_POST["email"])){
            $emailErr = "Missing";
            $allpass = 0;
        }else{
            $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
          
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $emailErr = "Invalid Email";
                $allpass = 0;
            }
        }

        if(empty($_POST["pass"])){
            $passwordErr = "Missing";
            $allpass = 0;
            
        }else{
            $password = $_POST["pass"];
            
            
            
        }

        if(empty($_POST["re_pass"])){
            $password2Err = "Missing";
            $allpass = 0;
            
        }else if($passFlag==1){
            
            
            if($password2 != $password){
                $password2Err = "Passwords do not Match";
                $allpass = 0;
            }
            else{
                $password2 = $_POST["re_pass"];
              
            }
        }

        if(!isset($_POST["agree-term"])){
            $checkboxErr = "Must Agree to Terms and Conditions";
            $allpass = 0;
        }
    
    if ($allpass == 1){
        
        $name = $_POST['name'];
        $email = $_POST['email'];
        $pass = $_POST['pass'];
        $id = md5($name);

        $passwordHashed = password_hash($pass, PASSWORD_DEFAULT);
    


        $sql = $con->prepare("INSERT INTO clientList (id,name,password,email) VALUES (?, ?, ?, ?)");

        $sql->bind_param("ssss",$id,$name,$passwordHashed,$email);

        $sql->execute();
         header("location:signup-success.php");
    }
    else{
        echo "Try Again!";
    }

    }
?>



<!-- Sign Up Page -->
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>UChat - Instant Messgenger Sign Up Page </title>


    <link rel="stylesheet" href="css/style.css">


</head>

<body>

    <div class="main">

        <!-- Sign up form -->
        <section class="signup">
            <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title">Sign up</h2>
                        <form method="POST" class="register-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                            <div class="form-group">
                                <label for="name"></label>
                                <input type="text" name="name" id="name" placeholder="Your Name" /><span style="color:red;">
                                    <?php echo $nameErr?></span>
                            </div>
                            <div class="form-group">
                                <label for="email"></label>
                                <input type="email" name="email" id="email" placeholder="Your Email" /><span style="color:red;">
                                    <?php echo $emailErr?></span>
                            </div>
                            <div class="form-group">
                                <label for="pass"></label>
                                <input type="password" name="pass" id="pass" placeholder="Password" /><span style="color:red;">
                                    <?php echo $passwordErr ?></span>
                            </div>
                            <div class="form-group">
                                <label for="re-pass"></label>
                                <input type="password" name="re_pass" id="re_pass" placeholder="Repeat your password" /><span style="color:red;">
                                    <?php echo $password2Err ?></span>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" />
                                <label for="agree-term" class="label-agree-term"><span><span></span></span>I agree all statements in <a href="#" class="term-service">Terms of service </a></label><br /><span style="color:red;">
                                    <?php echo $checkboxErr?></span>
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="signup" id="signup" class="form-submit" value="Register" />
                            </div>

                        </form>
                    </div>
                    <div class="signup-image">
                        <figure><img src="images/signup-image.png" alt="sing up image"></figure>
                        <a href="index2.php" class="signup-image-link">I am already member</a>
                    </div>
                </div>
            </div>
        </section>
    </div>
</body>

</html>
