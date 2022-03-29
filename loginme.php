<?php session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: index.html");
    //echo "session";
    exit();
}


// Include config file
require_once "config1.php";

// Define variables and initialize with empty values


$username_err='';
$password_err='';


// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$username = trim($_POST["username"]);
    $password =trim($_POST["password"]);
	//$email = trim($_POST["email"]);
	//$phone_number = trim($_POST["pnumber"]);
 
    if(empty($username)){
        $username_err = "Please enter username.";
    } 
    
    // Check if password is empty
    if(empty($password)){
        $password_err = "Please enter your password.";
    } 
      //echo $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
      
        // Prepare a select statement
        $sql = "SELECT `id`, `username`, `password` FROM `users` WHERE `username` = ? and `password` = ? ";
        
            $stmt = $link->prepare( $sql);
            
            // Bind variables to the prepared statement as parameters
            $stmt -> bind_param( "ss", $username,md5($password));                
            $stmt->execute();
            $result = $stmt->get_result(); 
            // Set parameters
            $user = $result->fetch_assoc();
         // print_r(count($user));
          //exit();
          if(count($user)>0) {
            $_SESSION["loggedin"] = true;
            $_SESSION["id"] = $id;
            $_SESSION["uname"] = $username;                             
           //echo "success";
            // Redirect user to welcome page
           header("location: index.html");
          } else {
              // Username doesn't exist, display a generic error message
            echo   $login_err = "Invalid username or password.";

          }
            // Attempt to execute the prepared statement
            $stmt -> close();
    } 
    

$link -> close();
}  ?>
