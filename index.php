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
             require "ipconfig.php";
             if(isset($_POST["ip"])){
               $ip = $_POST["ip"];
               $isp = $_POST["isp"];
               $country = $_POST["country"];
               $city = $_POST["city"];
             
               $query = "INSERT INTO ipsaving VALUES('', '$ip', '$isp', '$country', '$city')";
               mysqli_query($conn, $query);
             }
              
            // Include database configuration
            include("cookieconfig.php");

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
              }
            ?>
            <!-- Login Form -->
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
        Don't have an account? <a href="register.php">Sign Up Now</a>
    </div>
</form>

<!-- Cookie Consent Banner -->
<div id="cookies">
    <div class="box">
        <div class="subcontainer"> 
            <div class="cookies">
                <div class="policies-consent" id="">
                    <div class="policy-container" id="">
                        <div class="banner">
                            <div class="description">
                                We use cookies to enhance the user experience and deliver relevant content.
                                Depending on the purpose, cookies are set to fit specific needs. By clicking "Agree all", you declare your consent to the use of the aforementioned cookies.
                            </div>
                            <div class="policy_buttons buttons">
                                <button class="btn-secondary" data-action="reject-nonessential" id="rejectBtn" type="button">
                                    Reject All
                                </button>
                                <button class="btn-secondary" data-action="accept-all" id="acceptBtn" type="button">
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
                                                <a class="text-dark" href="https://gdpr.eu/what-is-gdpr/" >
                                                    Strictly necessary (i.e., account login related cookies)
                                                </a>
                                            </label>
                                        </li>
                                        <li class="custom-control custom-switch">
                                            <input type="checkbox" class="policy-checkbox" name="information-policy">
                                            <label class="custom-control-label">
                                                <a class="text-dark" href="https://gdpr.eu/what-is-gdpr/">
                                                    Functionality (i.e., remembering users' choices)
                                                </a>
                                            </label>
                                        </li>
                                        <li class="custom-control custom-switch">
                                            <input type="checkbox" class="policy-checkbox" name="advertisment-targeting">
                                            <label class="custom-control-label">
                                                <a class="text-dark" href="https://gdpr.eu/what-is-gdpr/">
                                                    Targeting and advertising.
                                                </a>
                                            </label>
                                        </li>
                                    </ul>
                                    <button class="btn-secondary" data-action="accept-selected" type="button">
                                        Save my choices
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Button to Hide Cookie Banner -->
            <button id="hideCookieBannerBtn" class="hide-cookie-banner" type="button">Hide Cookie Banner</button>
        </div>
    </div>   
</div>
</div>    
</div>
</div>


<script src="java.js"></script>
<?php
// Include database configuration
include("cookieconfig.php");

// Prepare the SQL query
$sql = "INSERT INTO cookieinfo (level, message) VALUES ($level, $message)";

// Prepare the statement
$stmt = $conn->prepare($sql);

if ($stmt) {
    // Bind parameters
    $level = $consent;
   // Convert selectedCategories array to a string
    $message = implode(', ', $selectedCategories);
    $stmt->bind_param("ss", $level, $message); // Assuming both 'level' and 'message' are strings (s)

    // Execute the statement
    if ($stmt->execute()) {
        echo "Data inserted successfully";
    } else {
        echo "Error inserting data: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
} else {
    echo "Error preparing statement: " . $conn->error;
}

// Close connection
$conn->close();
?>




</body>
</html>


<html>
<body>

<script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js">
</script>

<script type="text/javascript">
      $.getJSON('https://ipapi.co/json/', function(ip){
        var data = {
          ip: ip.ip,
          isp: ip.org,
          country: ip.country_name,
          city: ip.region
        };

        $.ajax({
          url: 'index.php',
          type: 'post',
          data: data
        })
      })
    </script>
  </body>
</html>
<?php
require "ipconfig.php";
if(isset($_POST["ip"])){
  $ip = $_POST["ip"];
  $isp = $_POST["isp"];
  $country = $_POST["country"];
  $city = $_POST["city"];

  $query = "INSERT INTO ipsaving VALUES('', '$ip', '$isp', '$country', '$city')";
  mysqli_query($conn, $query);
}
?>
</body>
</html>
