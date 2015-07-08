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
    
    $user_email = $_POST["user_email"];
    $user_comments = $_POST["user_comments"];
    $volunteer = $_POST["volunteer"];
    $volunteer_name = $_POST["volunteer_name"];
    $btdt = ($_POST["btdt"] === "true");
    
    $dbConnection = new PDO('mysql:dbname=dgm;host=localhost;charset=utf8', 'dgm', 'dgm');

    $dbConnection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $dbConnection->prepare('INSERT INTO data (email, comments, volunteer, volunteer_name, btdt, timestamp) VALUES (:email, :comments, :volunteer, :volunteer_name, :btdt, NOW())');

    $stmt->execute(array('email' => $user_email, 'comments' => $user_comments, 'volunteer' => $volunteer, 'volunteer_name' => $volunteer_name, 'btdt' => $btdt));
    
    die(json_encode(array('type'=>'done')));
}
?>
