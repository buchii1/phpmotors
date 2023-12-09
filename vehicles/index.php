<?php
// This is the Vehicle controller

// Create or access a Session
session_start();

// Get the database connection file
require_once '../library/connections.php';
// Get the PHP Motors model
require_once '../model/main-model.php';
// Get the Vehicles model
require_once '../model/vehicles-model.php';
// Get the Uploads model
require_once '../model/uploads-model.php';
// Get the Reviews model
require_once '../model/reviews-model.php';
// Get the Function file
require_once '../library/functions.php';

// Get the array of classifications
$classifications = getClassifications();

// Pass the array of classification as a parameter 
// to the navList function
$navigation = navList($classifications);

// // Build a car classification list using the $classifications array
// $classificationList = '<select id="carClassification" name="carClassification">';
// $classificationList .= "<option value='' selected disabled>Choose Car Classification</option>";
// foreach ($classifications as $carClass) {
//     $classificationList .= "<option value='$carClass[classificationId]'>$carClass[classificationName]</option>";
// }
// $classificationList .= "</select>";

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}

switch ($action) {
    case 'class-page';
        include '../view/add-classification.php';
        exit;
        break;
    case 'vehicle-page';
        include '../view/add-vehicle.php';
        exit;
        break;
    case 'newClassification';
        // Filter and store the data
        $classificationName = trim(filter_input(INPUT_POST, 'classificationName', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        
        // Check for inaccurate data
        if (empty($classificationName)) {
            $message = '<p class="message">Classification Name field cannot be empty.</p>';
            include '../view/add-classification.php';
            exit;
        }
        if (strlen($classificationName > 30)) {
            $message = '<p class="message">Field cannot contain more than 30 characters.</p>';
            include '../view/add-classification.php';
            exit;
        }
        
        // Send data to the model
        $sendData = addClassification($classificationName);
        
        // Check and return the result
        if ($sendData) {
            header('Location: /phpmotors/vehicles/index.php');
            exit;
        } else {
            $message = "<p class='message'>Sorry, your request wasn't successful. Please try again.</p>";
            include '../view/add-classification.php';
            exit;
        }
        break;
    case 'newVehicle';
        // Filter and store the data
        $invMake = trim(filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invModel = trim(filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invDescription = trim(filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invImage = trim(filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invThumbnail = trim(filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invPrice = trim(filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
        $invStock = trim(filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT));
        $invColor = trim(filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $classificationId = trim(filter_input(INPUT_POST, 'carClassification', FILTER_SANITIZE_NUMBER_INT));
    
        // Check for inaccurate data
        if (empty($invMake) || empty($invModel) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invColor) || empty($classificationId)) {
            $message = '<p class="message">Please provide information for all empty form fields.</p>';
            include '../view/add-vehicle.php';
            exit; 
        }
        
        // Send data to the model
        $sendData = addVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId);
        
        // Check and return the result
        if ($sendData) {
            $message = "<p class='message success'>The $invMake $invModel was added successfully!</p>";
            include '../view/add-vehicle.php'; 
        } else {
            $message = "<p class='message'>Sorry, your request wasn't successful. Please try again.</p>";
            include '../view/add-vehicle.php';
            exit;
        }
        break;
    /* * *********************************
    * Get vehicles by classificationId
    * Used for starting Update & Delete process
    * ********************************** */
    case 'getInventoryItems'; 
        // Get the classificationId
        $classificationId = filter_input(INPUT_GET, 'classificationId', FILTER_SANITIZE_NUMBER_INT);
        // Fetch the vehicles by classificationId from the DB
        $inventoryArray = getInventoryByClassification($classificationId);
        // Convert the array to a JSON object and send it back
        echo json_encode($inventoryArray);
        break;
    case 'mod':
        $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
        $invInfo = getInvItemInfo($invId);
        if (count($invInfo) < 1) {
            $message = 'Sorry, no vehicle information could be found.';
        }
        include '../view/vehicle-update.php';
        exit;
        break;
    case 'updateVehicle';
        // Filter and store the data
        $invMake = trim(filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invModel = trim(filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invDescription = trim(filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invImage = trim(filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invThumbnail = trim(filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invPrice = trim(filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
        $invStock = trim(filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT));
        $invColor = trim(filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $classificationId = trim(filter_input(INPUT_POST, 'carClassification', FILTER_SANITIZE_NUMBER_INT));
        $invId = trim(filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT));

        // Check for inaccurate data
        if (empty($invMake) || empty($invModel) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invColor) || empty($classificationId)) {
            $message = '<p class="message">Please provide information for all empty form fields.</p>';
            include '../view/vehicle-update.php';
            exit;
        }

        // Send data to the model
        $updateResult = updateVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId, $invId);

        // Check and return the result
        if ($updateResult) {
            $message = "<p class='message success'>Congratulations, the $invMake $invModel was successfully updated.</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/vehicles/');
            exit;
        } else {
            $message = "<p class='message'>Error: The $invMake $invModel was not updated.</p>";
            include '../view/vehicle-update.php';
            exit;
        }
        break;
    case 'del';
        $invId = trim(filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT));
        $invInfo = getInvItemInfo($invId);
        if (count($invInfo) < 1) {
            $message = 'Sorry, no vehicle information could be found.';
        }
        include '../view/vehicle-delete.php';
        exit;
        break;
    case 'deleteVehicle';
        // Filter and store the data
        $invMake = trim(filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invModel = trim(filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invId = trim(filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT));


        // Send data to the model
        $deleteResult = deleteVehicle($invId);

        // Check and return the result
        if ($deleteResult) {
            $message = "<p class='message success'>Congratulations, the $invMake $invModel was successfully deleted.</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/vehicles/');
            exit;
        } else {
            $message = "<p class='message'>Error: $invMake $invModel was not deleted.</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/vehicles/');
            exit;
        }
        break;
    case 'classification';
        $classificationName = trim(filter_input(INPUT_GET, 'classificationName', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $vehicles = getVehiclesByClassification($classificationName);
        if (!count($vehicles)) {
            $message = "<p class='message'>Sorry, no $classificationName vehicles could be found.</p>";
        } else {
            $vehicleDisplay = buildVehiclesDisplay($vehicles);
        }
        include '../view/classification.php';
        break;
    case 'detail';
        $invId = trim(filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT));
        $inventory = getInvItemInfo($invId);
        $images = getImagesThumbnail($invId);
        $reviews = getInvReviews($invId);
        $count = count($reviews);
        
        if (!count($inventory)) {
            $message = '<p class="message">Sorry, no vehicle could be found.</p>';
        } else {
            $inventoryDisplay = buildInventoryDisplay($inventory);
            $imagesDisplay = buildImageThumbnailDisplay($images);
            $reviewsDisplay = buildReviewsDisplay($reviews);
        }

        include '../view/vehicle-detail.php';
        break;
    default:
        $classificationList = buildClassificationList($classifications);
        include '../view/vehicle-man.php';
        exit;
        break;
}
?>