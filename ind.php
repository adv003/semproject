<?php 
   session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css\csssss.css">
    <title>Login</title>
</head>
<body>
      <div class="container">
        <div class="box form-box">
            <?php 
             
              include("config.php");
              if(isset($_POST['submit'])){
                $email = mysqli_real_escape_string($con,$_POST['email']);
                $password = mysqli_real_escape_string($con,$_POST['password']);

                $result = mysqli_query($con,"SELECT * FROM dta_db WHERE Email='$email' AND Password='$password' ") or die("Select Error");
                $row = mysqli_fetch_assoc($result);

                if(is_array($row) && !empty($row)){
                    $_SESSION['valid'] = $row['Email'];
                    $_SESSION['username'] = $row['Username'];
                    $_SESSION['age'] = $row['Age'];
                    $_SESSION['id'] = $row['Id'];
                }else{
                    echo "<div class='message'>
                      <p>Wrong Username or Password</p>
                       </div> <br>";
                   echo "<a href='ind.php'><button class='btn'>Go Back</button>";
         
                }
                if(isset($_SESSION['valid'])){
                    header("Location: home.php");
                }
              }else{
            ?>
            <header>Login</header>
            <form action="" method="post">
                <div class="field input">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" autocomplete="off" required>
                </div>

                <div class="field">
                    
                    <input type="submit" class="btn" name="submit" value="Login" required>
                </div>
                <div class="links">
                    Don't have account? <a href="register.php">Sign Up Now</a>
                </div>
            </form>
        </div>
        </div>
        <div id="cookies">
        <div class="box">
            <div class="subcontainer"> 
                <div class="cookies">
                    <div class="policies-consent" id="">
                        <div class="policy-container" id="">
                            <div class="banner">
                                <div class="description">
                                We use cookies to enhance
  the user experience and deliver content that is relevant.
  Depending on the purpose, cookies are set to fit the particular needs. By clicking on "Agree all", you declare your consent to the use of the aforementioned cookies. 
                                </div>
                                <div class="policy_buttons buttons">
                                    <button class="btn-secondary" data-action="reject-nonessential" id="rejectBtn">
                                        Reject All
                                    </button>
                                    <button class="btn-secondary" data-action="accept-all" id="acceptBtn">
                                        Accept All
                                    </button>
                                </div>
                                <div class="policies-settings-container collapse show" id="">
                                    <div class="policies-categories">
                                        <h5 class="text-left">Optional</h5>
                                        <ul class="list-unstyled text-left m-3">
                                            <li class="custom-control custom-switch">
                                                <input type="checkbox" class="policy-checkbox" name="privacy-policy">
                                                <label class="custom-control-label">
                                                    <a class="text-dark" href="" >
                                                    Strictly necessary (ie. account login related cookies)
                                                    </a>
                                                </label>
                                            </li>
                                            <li class="custom-control custom-switch">
                                                <input type="checkbox" class="policy-checkbox" name="information-policy">
                                                <label class="custom-control-label">
                                                    <a class="text-dark" href="">
                                                    Functionality (ie. remembering users choices)
                                                    </a>
                                                </label>
                                            </li>
                                            <li class="custom-control custom-switch">
                                                <input type="checkbox" class="policy-checkbox" name="advertisment-targeting">
                                                <label class="custom-control-label">
                                                    <a class="text-dark" href="">
                                                    Targeting and advertising.
                                                    </a>
                                                </label>
                                            </li>
                                            
                                        </ul>
                                        <button class="btn-secondary" data-action="accept-selected">
                                            Save my choices
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>   
 </div>
<?php
}

?>

?>

?>
        </div>    
    </div>
</div>

<script src="java.js"></script>
</body>
</html>
