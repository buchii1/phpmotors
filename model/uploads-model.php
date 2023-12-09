<?php 
// A model for the vehicle inventory image uploads

// Add image information to the database table
function storeImages($imgPath, $invId, $imgName, $imgPrimary) {
    $db = phpmotorsconnect();
    $sql = 'INSERT INTO images (invId, imgPath, imgName, imgPrimary)
            VALUES (:invId, :imgPath, :imgName, :imgPrimary)';
    $st = $db->prepare($sql);
    // Store the full size image information
    $st->bindValue(':invId', $invId, PDO::PARAM_INT);
    $st->bindValue(':imgPath', $imgPath, PDO::PARAM_STR);
    $st->bindValue(':imgName', $imgName, PDO::PARAM_STR);
    $st->bindValue(':imgPrimary', $imgPrimary, PDO::PARAM_INT);
    $st->execute();

    // Make and store the thumbnail image information
    // Change name in path
    $imgPath = makeThumbnailName($imgPath);
    // Change name in file name
    $imgName = makeThumbnailName($imgName);
    $st->bindValue(':invId', $invId, PDO::PARAM_INT);
    $st->bindValue(':imgPath', $imgPath, PDO::PARAM_STR);
    $st->bindValue(':imgName', $imgName, PDO::PARAM_STR);
    $st->bindValue(':imgPrimary', $imgPrimary, PDO::PARAM_INT);
    $st->execute();

    $rowsChanged = $st->rowCount();
    $st->closeCursor();
    return $rowsChanged;
}

// Get Image Information from images table
function getImages() {
    $db = phpmotorsconnect();
    $sql = 'SELECT imgId, imgPath, imgName, imgDate, inventory.invId, invMake, invModel FROM images JOIN inventory ON images.invId = inventory.invId';
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $imageArray = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $imageArray;
}

// Delete image information from the images table
function deleteImage($imgId) {
    $db = phpmotorsconnect();
    $sql = 'DELETE FROM images WHERE imgId = :imgId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':imgId', $imgId, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->rowCount();
    $stmt->closeCursor();
    return $result;
}

// Check for an existing image
function checkExistingImage($imgName) {
    $db = phpmotorsConnect();
    $sql = "SELECT imgName FROM images WHERE imgName = :name";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':name', $imgName, PDO::PARAM_STR);
    $stmt->execute();
    $imageMatch = $stmt->fetch();
    $stmt->closeCursor();
    return $imageMatch;
}

// Get all thumbnails for an image
function getImagesThumbnail($invId) {
    $db = phpmotorsconnect();
    $sql = 'SELECT inventory.invMake, inventory.invModel, images.imgPath
            FROM inventory INNER JOIN images
            ON inventory.invId = images.invId
            WHERE inventory.invId = :invId
            AND images.imgPath LIKE "%-tn.%"';
    $st = $db->prepare($sql);
    $st->bindValue(':invId', $invId, PDO::PARAM_INT);
    $st->execute();
    $imageArray = $st->fetchAll(PDO::FETCH_ASSOC);
    $st->closeCursor();
    return $imageArray;
    
}
?>