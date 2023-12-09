<?php
// This is the Accounts Model


// A model that handles registration of user in the site
function regClient($clientFirstname, $clientLastname, $clientEmail, $clientPassword) {
    // Create a connection object using the phpmotors connection function
    $db = phpmotorsconnect();
    // SQL statement
    $sql = 'INSERT INTO clients (clientFirstname, clientLastname, clientEmail, clientPassword)
            VALUES (:clientFirstname, :clientLastname, :clientEmail, :clientPassword)';
    // Create the prepaid statement using the phpmotors connection
    $stmt = $db->prepare($sql);
    // Replace the placeholders in the SQL statement with the actual
    // values and tells the database the type of data it is
    $stmt->bindValue(':clientFirstname', $clientFirstname, PDO::PARAM_STR);
    $stmt->bindValue(':clientLastname', $clientLastname, PDO::PARAM_STR);
    $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
    $stmt->bindValue(':clientPassword', $clientPassword, PDO::PARAM_STR);
    // Insert the data
    $stmt->execute();
    // Ask how many roles changed as a result of our insert
    $rowsChanged = $stmt->rowCount();
    // Close the database interaction
    $stmt->closeCursor();
    // Return the indication of success (rows changed)
    return $rowsChanged;
}

// Check for an existing email address
function checkExistingEmail($clientEmail) {
    $db = phpmotorsconnect();
    $sql = 'SELECT clientEmail FROM clients WHERE clientEmail = :email';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':email', $clientEmail, PDO::PARAM_STR);
    $stmt->execute();
    $matchEmail = $stmt->fetch(PDO::FETCH_NUM);
    $stmt->closeCursor();
    if (empty($matchEmail)) {
        return 0;
    } else {
        return 1;
    }
}

// Get client data based on an email address
function getClient($clientEmail) {
    $db = phpmotorsconnect();
    $sql = 'SELECT clientId, clientFirstname, clientLastname, clientEmail, clientLevel, clientPassword FROM clients WHERE clientEmail = :clientEmail';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
    $stmt->execute();
    $clientData = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $clientData;
}

// Update client information
function updateInfo($clientFirstname, $clientLastname, $clientEmail, $clientId)
{
    // Create a connection object using the phpmotors connection function
    $db = phpmotorsconnect();
    // SQL statement
    $sql = 'UPDATE clients SET clientFirstname = :clientFirstname, clientLastname = :clientLastname, clientEmail = :clientEmail
            WHERE clientId = :clientId';
    // Create the prepaid statement using the phpmotors connection
    $stmt = $db->prepare($sql);
    // Replace the placeholders in the SQL statement with the actual
    // values and tells the database the type of data it is
    $stmt->bindValue(':clientFirstname', $clientFirstname, PDO::PARAM_STR);
    $stmt->bindValue(':clientLastname', $clientLastname, PDO::PARAM_STR);
    $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
    // Insert the data
    $stmt->execute();
    // Ask how many roles changed as a result of our insert
    $rowsChanged = $stmt->rowCount();
    // Close the database interaction
    $stmt->closeCursor();
    // Return the indication of success (rows changed)
    return $rowsChanged;
}

// Get client data based on an clientId
function getClientDetails($clientId)
{
    $db = phpmotorsconnect();
    $sql = 'SELECT clientId, clientFirstname, clientLastname, clientEmail, clientLevel 
            FROM clients
            WHERE clientId = :clientId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
    $stmt->execute();
    $clientData = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $clientData;
}

// Update client information
function updatePassword($clientPassword, $clientId)
{
    // Create a connection object using the phpmotors connection function
    $db = phpmotorsconnect();
    // SQL statement
    $sql = 'UPDATE clients SET clientPassword = :clientPassword
            WHERE clientId = :clientId';
    // Create the prepaid statement using the phpmotors connection
    $stmt = $db->prepare($sql);
    // Replace the placeholders in the SQL statement with the actual
    // values and tells the database the type of data it is
    $stmt->bindValue(':clientPassword', $clientPassword, PDO::PARAM_STR);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
    // Insert the data
    $stmt->execute();
    // Ask how many roles changed as a result of our insert
    $rowsChanged = $stmt->rowCount();
    // Close the database interaction
    $stmt->closeCursor();
    // Return the indication of success (rows changed)
    return $rowsChanged;
}
?>