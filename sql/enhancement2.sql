INSERT INTO clients (
        clientFirstname,
        clientLastname,
        clientEmail,
        clientPassword,
        comment
    )
VALUES (
        'Tony',
        'Stark',
        'tony@starkent.com',
        'Iam1ronM@n',
        'I am the real Ironman'
    );
--
--
UPDATE clients
SET clientLevel = 3
WHERE clientId = 1;
--
--
UPDATE inventory
SET invDescription = replace(
        invDescription,
        'small interior',
        'spacious interior'
    )
WHERE invMake = 'gm'
    and invModel = 'hummer';
--
--
SELECT inventory.invModel,
    carclassification.classificationName
FROM inventory
    INNER JOIN carclassification ON inventory.classificationId = carclassification.classificationId
WHERE carclassification.classificationName = 'SUV';
--
--
DELETE FROM inventory
WHERE invMake = 'jeep'
    and invModel = 'wrangler';
--
--  
UPDATE inventory
SET invImage = concat('/phpmotors', invImage),
    invThumbnail = concat('/phpmotors', invThumbnail);