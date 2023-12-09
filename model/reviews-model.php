<?php
// Add a new review to the database
function addReview($reviewText, $invId, $clientId)
{
    $db = phpmotorsconnect();
    $sql = 'INSERT INTO reviews (reviewText, invId, clientId)
            VALUES (:reviewText, :invId, :clientId)';
    $st = $db->prepare($sql);
    $st->bindValue(':reviewText', $reviewText, PDO::PARAM_STR);
    $st->bindValue(':invId', $invId, PDO::PARAM_INT);
    $st->bindValue(':clientId', $clientId, PDO::PARAM_INT);
    $st->execute();
    $rowsChanged = $st->rowCount();
    $st->closeCursor();
    return $rowsChanged;
}

// Get the reviews based on the invId
function getInvReviews($invId)
{
    $db = phpmotorsconnect();
    $sql = 'SELECT reviews.reviewDate, reviews.reviewText, clients.clientFirstname, clients.clientLastname
            FROM reviews INNER JOIN clients
            ON reviews.clientId = clients.clientId
            WHERE reviews.invId = :invId
            ORDER BY reviews.reviewDate DESC';
    $st = $db->prepare($sql);
    $st->bindValue(':invId', $invId, PDO::PARAM_INT);
    $st->execute();
    $reviewsArray = $st->fetchAll(PDO::FETCH_ASSOC);
    $st->closeCursor();
    return $reviewsArray;
}

// Get the reviews based on the clientId
function getClientReviews($clientId)
{
    $db = phpmotorsconnect();
    $sql = 'SELECT reviews.reviewDate, reviews.reviewId, inventory.invMake, inventory.invModel
            FROM reviews INNER JOIN inventory
            ON reviews.invId = inventory.invId
            WHERE reviews.clientId = :clientId
            ORDER BY reviews.reviewDate DESC';
    $st = $db->prepare($sql);
    $st->bindValue(':clientId', $clientId, PDO::PARAM_INT);
    $st->execute();
    $reviewsArray = $st->fetchAll(PDO::FETCH_ASSOC);
    $st->closeCursor();
    return $reviewsArray;
}

// Get details of a review based on the reviewId
function getReviewInfo($reviewId)
{
    $db = phpmotorsconnect();
    $sql = 'SELECT reviews.*, inventory.invMake, inventory.invModel 
            FROM reviews INNER JOIN inventory
            ON reviews.invId = inventory.invId
            WHERE reviewId = :reviewId';
    $st = $db->prepare($sql);
    $st->bindValue('reviewId', $reviewId, PDO::PARAM_INT);
    $st->execute();
    $reviewInfo = $st->fetch(PDO::FETCH_ASSOC);
    $st->closeCursor();
    return $reviewInfo;
}

// Modify a review based on the reviewId and clientId
function updateReview($reviewId, $reviewText, $clientId)
{
    $db = phpmotorsconnect();
    $sql = 'UPDATE reviews SET reviewText = :reviewText
            WHERE reviewId = :reviewId
            AND clientId = :clientId';
    $st = $db->prepare($sql);
    $st->bindValue(':reviewText', $reviewText, PDO::PARAM_STR);
    $st->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
    $st->bindValue(':clientId', $clientId, PDO::PARAM_INT);
    $st->execute();
    $rowsChanged = $st->rowCount();
    $st->closeCursor();
    return $rowsChanged;
}

// Delete a review based on the reviewId and clientId
function deleteReview($reviewId, $clientId)
{
    $db = phpmotorsconnect();
    $sql = 'DELETE FROM reviews where reviewId = :reviewId
            AND clientId = :clientId';
    $st = $db->prepare($sql);
    $st->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
    $st->bindValue('clientId', $clientId, PDO::PARAM_INT);
    $st->execute();
    $rowsChanged = $st->rowCount();
    $st->closeCursor();
    return $rowsChanged;
}
?>