<?php
// This is the Accounts Controller

// Create or access a Session
session_start();

// Get the database connection file
require_once '../library/connections.php';
// Get the PHP Motors model for use as needed
require_once '../model/main-model.php';
// Get the Accounts model
require_once '../model/accounts-model.php';
// Get the Reviews model
require_once '../model/reviews-model.php';
// Get the Functions file
require_once '../library/functions.php';

// Pass the array of classification as a parameter 
// to the navList function
$navigation = navList(getClassifications());


$action = filter_input(INPUT_POST, 'action');
if ($action == NULL){
    $action = filter_input(INPUT_GET, 'action');
}

switch ($action){
    case 'login';
        include '../view/login.php';
        break;
    case 'registration';
        include '../view/registration.php';
        break;
    case 'register';
        // Filter and store the data
        $clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $clientLastname = trim(filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
        $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        // Validate email address
        $clientEmail = checkEmail($clientEmail);
        // Validate password
        $checkPassword = checkPassword($clientPassword);

        // Check for an existing email
        $existingEmail = checkExistingEmail($clientEmail);
        
        if ($existingEmail) {
            $message = '<p class="message">Email address already exists.</p>';
            include '../view/login.php';
            exit;
        }
        
        // Check for missing data (Extra Validation)
        if (empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($checkPassword)) {
            $message = '<p class="message">Please provide information for all empty form fields.</p>';
            include '../view/registration.php';
            exit;
        }

        // Hash the checked password
        $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);
        
        // Send the data to the model
        $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword);
        
        // Check and report the result
        if ($regOutcome) {
            // setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');
            $_SESSION['message'] = "<p class='message success'>Thanks for registering $clientFirstname.<br> Please use your email and password to login.</p>";
            header('Location: /phpmotors/accounts/?action=login');
            exit;
        } else {
            $message = "<p class='message'>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
            include '../view/registration.php';
            exit;
        }
        break;
    case 'Login';
        $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $clientEmail = checkEmail($clientEmail);
        $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $checkPassword = checkPassword($clientPassword);
        
        // Check for missing data
        if (empty($clientEmail) || empty($checkPassword)) {
            $_SESSION['message'] = '<p class="message">Both fields are required.</p>';
            include '../view/login.php';
            exit;
        }

        // A valid password exists, proceed with the login process
        // Query the client data based on the email address
        $clientData = getClient($clientEmail);
        if (!$clientData){
            $_SESSION['message'] = '<p class="message">Invalid email or password.</p>';
            include '../view/login.php';
            exit;
        }
        // Compare the password just submitted against 
        // the hashed password for the matching client
        $hashCheck = password_verify($clientPassword, $clientData['clientPassword']);
        // If the hashes don't match, create an error
        // and return to the login view
        if (!$hashCheck) {
            $_SESSION['message'] = "<p class='message'>Invalid email or password.</p>";
            include "../view/login.php";
            exit;
        }
        // A valid user exists, log them in
        $_SESSION['loggedin'] = TRUE;
        // Remove the password from the array
        // the array_pop function removes the last 
        // element from an array
        array_pop($clientData);
        // Store the array into the session
        $_SESSION['clientData'] = $clientData;
        // Send them to the admin view
        header('location: .');
        exit;
        break;
    case 'logout';
        // Unset session variables
        unset($_SESSION['loggedin']);
        unset($_SESSION['clientData']);
        // Destroy the current session
        session_destroy();
        // Redirect to homepage view
        header('Location: /phpmotors/');
        break;
    case 'update';
        include '../view/client-update.php';
        exit;
        break;
    case 'updateInfo';
        // Filter and store the data
        $clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $clientLastname = trim(filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
        $clientId = trim(filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT));
        // Validate email address
        $clientEmail = checkEmail($clientEmail);
        
        if ($clientEmail !== $_SESSION['clientData']['clientEmail']) {
            // Check for an existing email
            $existingEmail = checkExistingEmail($clientEmail);

            if ($existingEmail) {
                $_SESSION['message'] = '<p class="message">Email address already exists.</p>';
                include '../view/client-update.php';
                exit;
            }   
        }

        // Check for missing data (Extra Validation)
        if (empty($clientFirstname) || empty($clientLastname) || empty($clientEmail)) {
            $_SESSION['message'] = '<p class="message">Please provide information for all empty form fields.</p>';
            include '../view/client-update.php';
            exit;
        }

        // Send the data to the model
        $updateInfoResult = updateInfo($clientFirstname, $clientLastname, $clientEmail, $clientId);

        // Check and report the result
        if ($updateInfoResult) {
            $clientData = getClientDetails($clientId);
            $_SESSION['clientData'] = $clientData;
            $_SESSION['message'] = "<p class='message success'>$clientFirstname, your information has been updated.</p>";
            header('Location: /phpmotors/accounts/');
            exit;
        } else {
            $_SESSION['message'] = "<p class='message'>Error: your information was not updated.</p>";
            include '../view/client-update.php';
            exit;
        }
        break;
    case 'updatePassword';
        $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $clientId = trim(filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT));
        // Validate password
        $checkPassword = checkPassword($clientPassword);

        // Check for missing data (Extra Validation)
        if (empty($checkPassword)) {
            $_SESSION['message1'] = '<p class="message">Please make sure your password matches the desired pattern.</p>';
            include '../view/client-update.php';
            exit;
        }

        // Hash the checked password
        $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

        // Send the data to the model
        $updatePasswordResult = updatePassword($hashedPassword, $clientId);

        // Check and report the result
        if ($updatePasswordResult) {
            $_SESSION['message'] = "<p class='message success'>{$_SESSION['clientData']['clientFirstname']}, your password has been updated.</p>";
            header('Location: /phpmotors/accounts/');
            exit;
        } else {
            $_SESSION['message1'] = "<p class='message'>Error: your information was not updated.</p>";
            include '../view/client-update.php';
            exit;
        }
        break;
    default:
        $reviews = getClientReviews($_SESSION['clientData']['clientId']);

        if (!count($reviews)) {
            $_SESSION['message1'] = "<p class='message'>You haven't written any reviews yet.</p>";
        } else {
            $reviewsDisplay = buildClientReviews($reviews);
        }
        
        include '../view/admin.php';
        break;
}
?>