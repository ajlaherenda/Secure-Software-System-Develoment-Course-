<?php
require 'vendor/autoload.php';

Flight::route('/', function () {
    echo 'hello world!';
});

Flight::route('/ibu', function () {
    echo 'hello world IBU';
});

// REGISTER
Flight::route('POST /register', function(){

    $username = Flight::request()->data->username;
    $password = Flight::request()->data->password;
    $email = Flight::request()->data->email;
    $phone = Flight::request()->data->phone;
    
// username validation
    if(strlen($username) < 3) {

        echo "Username must be longer than 3 characters!";
        exit;
    }
    echo 'I received a POST request.'. ' from ' . $username . " and ". $password ;

// email validation..
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    Flight::json(array(
      'status' => 'error',
      'message' => "The email '" . $email . "' address is not valid."
    ));
    exit;
  }
// other validations for the project

/* logic to save this to the database is missing + check if certain data is 
   already present in the database => cannot be used!
*/
Flight::json(array(
      'status' => 'success',
      'message' => 'Registration successful.'
    ));
});

// LOGIN request
Flight::route('POST /login', function(){
    $username = Flight::request()->data->username;
    $password = Flight::request()->data->password;

/*  connect to the database using PDO and look for the $username and 
    check if $password matches the one in the database
*/ 

// if match occurs 
    Flight::json(['status'=>'success', 'message'=>'Login achieved!']); 
// else
    Flight::json(['status'=>'failure', 'message'=>'Login failed!']); 

});

Flight::start();
?>