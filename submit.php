<?php
if($_POST)
{
    //check if its an ajax request, exit if not
    if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
        
        $output = json_encode(array( //create JSON data
            'type'=>'error', 
            'text' => 'Invalid request, must be AJAX POST'
        ));
        die($output); //exit script outputting json data
    } 
    
    $ecks = json_encode(array('type'=>'done'));
    die($ecks);
    
    $user_email = $_POST["user_email"];
    $user_comments = $_POST["user_comments"];
    
    $dbConnection = new PDO('mysql:dbname=dgm;host=localhost;charset=utf8', 'dgm', 'dgm');

    $dbConnection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $dbConnection->prepare('INSERT INTO data (email, comments) VALUES (:email, :comments)');

    $stmt->execute(array('email' => $user_email, 'comments' => $user_comments));
    
    die($json_encode(array('type'=>'done')));
}
?>
