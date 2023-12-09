<?php
// This is the reviews controller

session_start();

require_once '../library/connections.php';
require_once '../model/main-model.php';
require_once '../model/vehicles-model.php';
require_once '../model/reviews-model.php';
require_once '../library/functions.php';

// Get the array of classifications
$classifications = getClassifications();
// Build a navigation bar using the $classifications array
$navigation = navList($classifications);

$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
}

switch ($action) {
    case 'add-review';
        $reviewText = trim(filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invId = trim(filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT));
        $clientId = trim(filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT));
        
        if (empty($reviewText)) {
            $_SESSION['messages'] = '<p class="message">Please provide information for all empty form fields.</p>';
            header('Location: /phpmotors/vehicles?action=detail&invId=' . urlencode($invId));
            exit;
        }

        $sendData = addReview($reviewText, $invId, $clientId);

        // Check and return the result
        if ($sendData) {
            $_SESSION['messages'] = "<p class='message success'>Congratulations, your review was successfully added.</p>";
        } else {
            $_SESSION['messages'] = "<p class='message'>Error: Your review was not added.</p>";
        }
        header('Location: /phpmotors/vehicles?action=detail&invId=' . urlencode($invId));
        exit;
        break;
    case 'mod':
        $reviewId = trim(filter_input(INPUT_GET, 'reviewId', FILTER_VALIDATE_INT));
        $reviewInfo = getReviewInfo($reviewId);
        // Get the  human readable date format
        $date = dateTime($reviewInfo['reviewDate']);

        if (count($reviewInfo) < 1) {
            $message = 'Sorry, no review information could be found.';
        }
        include '../view/review-update.php';
        exit;
        break;
    case 'del':
        $reviewId = trim(filter_input(INPUT_GET, 'reviewId', FILTER_VALIDATE_INT));
        $reviewInfo = getReviewInfo($reviewId);
        // Get the  human readable date format
        $date = dateTime($reviewInfo['reviewDate']);
        
        if (count($reviewInfo) < 1) {
            $message = 'Sorry, no review information could be found.';
        }
        include '../view/review-delete.php';
        exit;
        break;
    case 'updateReview':
        $reviewText = trim(filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $reviewId = trim(filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_NUMBER_INT));
        $clientId = trim(filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT));

        if (empty($reviewText)) {
            $_SESSION['message'] = '<p class="message">Please provide information for all empty form fields.</p>';
            header('Location: /phpmotors/reviews/?action=mod&reviewId=' . urlencode($reviewId));
            exit;
        }

        $updateResult = updateReview($reviewId, $reviewText, $clientId);
        
        // Check and return the result
        if ($updateResult) {
            $_SESSION['message'] = "<p class='message success'>Congratulations, your review was successfully updated.</p>";
            header('Location: /phpmotors/accounts/');
            exit;
        } else {
            $_SESSION['message'] = "<p class='message'>Error: Your review was not updated.</p>";
            header('Location: /phpmotors/reviews/?action=mod&reviewId=' . urlencode($reviewId));
            exit;
        }
        break;
    case 'deleteReview':
        $reviewText = trim(filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $reviewId = trim(filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_NUMBER_INT));
        $clientId = trim(filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT));

        $deleteResult = deleteReview($reviewId, $clientId);
        
        // Check and return the result
        if ($deleteResult) {
            $_SESSION['message'] = "<p class='message success'>Congratulations, your review was successfully deleted.</p>";
            header('Location: /phpmotors/accounts/');
            exit;
        } else {
            $_SESSION['message'] = "<p class='message'>Error: Your review was not deleted.</p>";
            header('Location: /phpmotors/reviews/?action=mod&reviewId=' . urlencode($reviewId));
            exit;
        }
        break;
    default:

        break;
}
?>