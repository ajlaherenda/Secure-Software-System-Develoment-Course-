<?php
require '../vendor/autoload.php';

// in this week we have moved our index.php in the api folder
// it contains work done in previous labs regarding the POST /register and /login requests + this week's workload
use OpenApi\Annotations as OA;

/**
 * @OA\Tag(
 *     name="user",
 *     description="User related operations"
 * )
 * @OA\Info(
 *     version="1.0",
 *     title="Example for response examples value",
 *     description="Example info",
 *     @OA\Contact(name="Swagger API Team")
 * )
 * @OA\Server(
 *     url="http://localhost:8888/lab-SSSD/",
 *     description="API server"
 * )
 * 
 */
class OpenApiSpec
{
}

/**
 * @OA\Post(
 *     path="/register",
 *     summary="Registers a new user - with oneOf examples",
 *     description="User registration",
 *     operationId="addUser",
 *     tags={"user"},
 *     @OA\RequestBody(
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                 @OA\Property(
 *                     property="username",
 *                     type="string"
 *                 ),
 *                 @OA\Property(
 *                     property="email",
 *                     type="string"
 *                 ),
 *                 @OA\Property(
 *                     property="password",
 *                     type="string"
 *                 ),
 *                 @OA\Property(
 *                     property="phone",
 *                     oneOf={
 *                     	   @OA\Schema(type="string"),
 *                     	   @OA\Schema(type="integer"),
 *                     }
 *                 ),
 *                 example={"username": "ajlaherenda", "email": "asvsbjfhc@gmail.com", "password": "152g7vd", "phone": 12345678}
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="OK",
 *         @OA\JsonContent(
 *             oneOf={
 *                 @OA\Schema(type="boolean")
 *             },
 *             @OA\Examples(example="result", value={"success": true}, summary="An result object."),
 *             @OA\Examples(example="bool", value=false, summary="A boolean value."),
 *         )
 *     )
 * )
 */

// now we repeat the same steps for the POST/login

/**
 * @OA\Post(
 *     path="/login",
 *     summary="Performs login - with oneOf examples",
 *     description="User login",
 *     operationId="loginUser",
 *     tags={"user"},
 *     @OA\RequestBody(
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                 @OA\Property(
 *                     property="email",
 *                     type="string"
 *                 ),
 *                 @OA\Property(
 *                     property="password",
 *                     type="string"
 *                 ),
 * 
 *                 example={"email": "asvsbjfhc@gmail.com", "password": "152g7vd"}
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="OK",
 *         @OA\JsonContent(
 *             oneOf={
 *                 @OA\Schema(type="boolean")
 *             },
 *             @OA\Examples(example="result", value={"success": true}, summary="An result object."),
 *             @OA\Examples(example="bool", value=false, summary="A boolean value."),
 *         )
 *     )
 * )
 */


/* LAB 3 + LAB 4
*/
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
