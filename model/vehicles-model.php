<?php
// This is the Vehicles model

function addClassification($classificationName)
{
    // Create a connection object from the phpmotors connection object
    $db = phpmotorsConnect();
    // SQL statement
    $sql = 'INSERT INTO carclassification (classificationName)
            VALUES (:classificationName)';
    // Create the prepared statement
    $st = $db->prepare($sql);
    // Replace the placeholders in the SQL statement with the actual
    // values and tells the database the type of data it is
    $st->bindValue(':classificationName', $classificationName, PDO::PARAM_STR);
    // Insert the data
    $st->execute();
    // Ask how many rows changed as a result of our insert
    $rowsChanged = $st->rowCount();
    // Close the database interaction
    $st->closeCursor();
    // Return the indication of success (rows changed)
    return $rowsChanged;
}


function addVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId)
{
    // Create a connection object from the phpmotors connection object
    $db = phpmotorsConnect();
    // SQL statement
    $sql = 'INSERT INTO inventory (invMake, invModel, invDescription, invImage, invThumbnail, invPrice, invStock, invColor, classificationId)
            VALUES (:invMake, :invModel, :invDescription, :invImage, :invThumbnail, :invPrice, :invStock, :invColor, :classificationId)';
    // Create the prepared statement
    $st = $db->prepare($sql);
    // Replace the placeholders in the SQL statement with the actual
    // values and tells the database the type of data it is
    $st->bindValue(':invMake', $invMake, PDO::PARAM_STR);
    $st->bindValue(':invModel', $invModel, PDO::PARAM_STR);
    $st->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
    $st->bindValue(':invImage', $invImage, PDO::PARAM_STR);
    $st->bindValue(':invThumbnail', $invThumbnail, PDO::PARAM_STR);
    $st->bindValue(':invPrice', $invPrice, PDO::PARAM_STR);
    $st->bindValue(':invStock', $invStock, PDO::PARAM_INT);
    $st->bindValue(':invColor', $invColor, PDO::PARAM_STR);
    $st->bindValue(':classificationId', $classificationId, PDO::PARAM_INT);
    // Insert the data
    $st->execute();
    // Ask how many rows changed as a result of our insert
    $rowsChanged = $st->rowCount();
    // Close the database interaction
    $st->closeCursor();
    // Return the indication of success  (rows changed)
    return $rowsChanged;
}

// Get vehicles by classificationId
function getInventoryByClassification($classificationId)
{
    $db = phpmotorsConnect();
    $sql = 'SELECT * FROM inventory WHERE classificationId = :classificationId';
    $st = $db->prepare($sql);
    $st->bindValue(':classificationId', $classificationId, PDO::PARAM_INT);
    $st->execute();
    $inventory = $st->fetchAll(PDO::FETCH_ASSOC);
    $st->closeCursor();
    return $inventory;
}

// Get vehicle information by invId
function getInvItemInfo($invId)
{
    $db = phpmotorsConnect();
    $sql = 'SELECT inventory.*, images.imgPath 
            FROM inventory INNER JOIN images 
            ON inventory.invId = images.invId 
            WHERE inventory.invId = :invId
            AND images.imgPrimary = 1';
    $st = $db->prepare($sql);
    $st->bindValue(':invId', $invId, PDO::PARAM_INT);
    $st->execute();
    $invInfo = $st->fetch(PDO::FETCH_ASSOC);
    $st->closeCursor();
    return $invInfo;
}

// Update a vehicle
function updateVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId, $invId)
{
    // Create a connection object from the phpmotors connection object
    $db = phpmotorsConnect();
    // SQL statement
    $sql = 'UPDATE inventory SET invMake = :invMake, invModel = :invModel, invDescription = :invDescription, invImage = :invImage, invThumbnail = :invThumbnail, 
            invPrice = :invPrice, invStock = :invStock, invColor = :invColor, classificationId = :classificationId
            WHERE invId = :invId';
    // Create the prepared statement
    $st = $db->prepare($sql);
    // Replace the placeholders in the SQL statement with the actual
    // values and tells the database the type of data it is
    $st->bindValue(':invMake', $invMake, PDO::PARAM_STR);
    $st->bindValue(':invModel', $invModel, PDO::PARAM_STR);
    $st->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
    $st->bindValue(':invImage', $invImage, PDO::PARAM_STR);
    $st->bindValue(':invThumbnail', $invThumbnail, PDO::PARAM_STR);
    $st->bindValue(':invPrice', $invPrice, PDO::PARAM_STR);
    $st->bindValue(':invStock', $invStock, PDO::PARAM_INT);
    $st->bindValue(':invColor', $invColor, PDO::PARAM_STR);
    $st->bindValue(':classificationId', $classificationId, PDO::PARAM_INT);
    $st->bindValue(':invId', $invId, PDO::PARAM_INT);
    // Insert the data
    $st->execute();
    // Ask how many rows changed as a result of our insert
    $rowsChanged = $st->rowCount();
    // Close the database interaction
    $st->closeCursor();
    // Return the indication of success  (rows changed)
    return $rowsChanged;
}

// Update a vehicle
function deleteVehicle($invId)
{
    // Create a connection object from the phpmotors connection object
    $db = phpmotorsConnect();
    // SQL statement
    $sql = 'DELETE FROM inventory WHERE invId = :invId';
    // Create the prepared statement
    $st = $db->prepare($sql);
    // Replace the placeholders in the SQL statement with the actual
    // values and tells the database the type of data it is
    $st->bindValue(':invId', $invId, PDO::PARAM_INT);
    // Insert the data
    $st->execute();
    // Ask how many rows changed as a result of our insert
    $rowsChanged = $st->rowCount();
    // Close the database interaction
    $st->closeCursor();
    // Return the indication of success  (rows changed)
    return $rowsChanged;
}

// Get a list of vehicles based on the classification
function getVehiclesByClassification($classificationName)
{
    $db = phpmotorsConnect();
    $sql = 'SELECT inventory.*, images.imgPath 
            FROM inventory INNER JOIN images ON inventory.invId = images.invId  
            WHERE classificationId IN
            (SELECT classificationId FROM carclassification
            WHERE classificationName = :classificationName)
            AND images.imgPath LIKE "%-tn.%"
            AND images.imgPrimary = 1';
    $st = $db->prepare($sql);
    $st->bindValue(':classificationName', $classificationName, PDO::PARAM_STR);
    $st->execute();
    $vehicles = $st->fetchAll(PDO::FETCH_ASSOC);
    $st->closeCursor();
    return $vehicles;
}

// Get information for all vehicles
function getVehicles()
{
    $db = phpmotorsConnect();
    $sql = 'SELECT invId, invMake, invModel FROM inventory';
    $st = $db->prepare($sql);
    $st->execute();
    $invInfo = $st->fetchAll(PDO::FETCH_ASSOC);
    $st->closeCursor();
    return $invInfo;
}