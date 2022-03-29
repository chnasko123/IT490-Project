<?php
// apache and php configuration has some issue
// who install php /apache on this computer.
// 
// Include config file
require_once "config1.php";
 
// Define variables and initialize with empty values
$email = $username = $phone_number = $password = $repeat_password = "";
$email_err = $username_err = $phone_number_err = $password_err = $repeat_password_err = "";


// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $username = trim($_POST["uname"]);
    $email = trim($_POST["email"]);
    $phone_number = trim($_POST["pnumber"]);
    // Validate username
    if(empty($username)){
        $username_err = "Please enter a username.";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', $username)){
        $username_err = "Username can only contain letters, numbers, and underscores.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
	    // Set parameters
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $username);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
            

            // Close statement
            mysqli_stmt_close($stmt);
            
        }
    }
    
    // Validate password
    $password = trim($_POST["psw"]);
    if(empty($password)){
        $password_err = "Please enter a password.";     
    } elseif(strlen($password) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } 
    
        
    $repeat_password = trim($_POST["psw-repeat"]);
    
    // Validate confirm password
    if(empty($repeat_password)){
        $repeat_password_err = "Please confirm password.";     
    } else{
        if(empty($password_err) && ($password != $repeat_password)){
            $repeat_password_err = "Password did not match.";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($email_err) && empty($username_err) && empty($phone_number_err) && empty($password_err) && empty($repeat_password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO users (email, username, phone, password) VALUES (?, ?, ?, ?)";
        
        echo $sql;
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Set parameters
	    $param_email = $email;	
            $param_username = $username;
            $param_phone = $phone_number;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssss", $email, $username, $phone_number, $param_password);

	    

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
	            mysqli_stmt_close($stmt);
	            mysqli_close($link);
                // Redirect to login page
                header("location: login.html");
                
                return;
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
           
    }
    echo $email_err . $username_err . $phone_number_err . $password_err . $repeat_password_err;
    

    
    
    // Close connection
    mysqli_close($link);
    
    
}
 

?>
