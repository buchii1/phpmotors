<?php
function checkEmail($clientEmail)
{
    $valEmail = filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
    return $valEmail;
}

// Check the password for a minimum of 8 characters,
// at least one 1 capital letter, at least 1 number and
// at least 1 special character
function checkPassword($clientPassword)
{
    $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]\s])(?=.*[A-Z])(?=.*[a-z])(?:.{8,})$/';
    return preg_match($pattern, $clientPassword);
}

// Build a navigation bar using the $classifications array
function navList($classifications)
{
    $navList = '<ul>';
    $navList .= "<li><a href='/phpmotors/' title='View the PHP Motors home page'>Home</a></li>";
    foreach ($classifications as $classification) {
        $navList .= "<li><a href='/phpmotors/vehicles/?action=classification&classificationName=" . urlencode($classification['classificationName']) . "' title='View our $classification[classificationName] lineup of vehicles'>$classification[classificationName]</a></li>";
    }
    $navList .= '</ul>';
    return $navList;
}

// Build the classifications select list
function buildClassificationList($classifications)
{
    $classificationList = '<select name="classificationId" id="classificationList">';
    $classificationList .= "<option>Choose a Classification</option>";
    foreach ($classifications as $classification) {
        $classificationList .= "<option value='$classification[classificationId]'>$classification[classificationName]</option>";
    }
    $classificationList .= '</select>';
    return $classificationList;
}

// Build a display of vehicles within an unordered list
function buildVehiclesDisplay($vehicles)
{
    $dv = '<ul id="inv-display">';
    foreach ($vehicles as $vehicle) {
        $price = formatPrice($vehicle['invPrice']);
        $dv .= '<li>';
        $dv .= "<div>";
        $dv .= "<a href='/phpmotors/vehicles/?action=detail&invId=" . urlencode($vehicle['invId']) . "'><img src='$vehicle[imgPath]' alt='Image of $vehicle[invMake] $vehicle[invModel] on phpmotors.com'></a>";
        $dv .= '</div>';
        $dv .= '<hr>';
        $dv .= "<h2><a href='/phpmotors/vehicles/?action=detail&invId=" . urlencode($vehicle['invId']) . "'>$vehicle[invMake] $vehicle[invModel]</a></h2>";
        $dv .= "<span>$price</span>";
        $dv .= '</li>';
    }
    $dv .= '</ul>';
    return $dv;
}

// Format the price as a currency
function formatPrice($price)
{
    $formattedPrice = '$' . number_format($price, 2, '.', ',');
    return $formattedPrice;
}

// Build a display of vehicle details
function buildInventoryDisplay($inv)
{
    $price = formatPrice($inv['invPrice']);
    $st = '<div id="vehicle-detail">';
    $st .= '<div class="vehicle-detail-grid">';
    $st .= "<div class='grid1'><img src='$inv[imgPath]' alt='$inv[invMake] $inv[invModel]'></div>";
    $st .= "<div class='grid2'><ul><li class='shade price'>$price</li><li>$inv[invDescription]</li><li class='shade'>Color: $inv[invColor]</li><li># in Stock: $inv[invStock]</li></ul></div>";
    $st .= '</div>';
    $st .= '</div>';

    return $st;
}

/* * ********************************
*  Functions for working with images
* ********************************* */
// Adds "-tn" designation to file name
function makeThumbnailName($image)
{
    $i = strrpos($image, '.');
    $image_name = substr($image, 0, $i);
    $ext = substr($image, $i);
    $image = $image_name . '-tn' . $ext;
    return $image;
}

// Build images display for image management view
function buildImageDisplay($imageArray)
{
    // $id = '<div class="image-grid">';
    $id = '<ul id="image-display">';
    foreach ($imageArray as $image) {
        $id .= '<li>';
        $id .= "<img src='$image[imgPath]' title='$image[invMake] $image[invModel] image on PHP Motors.com' alt='$image[invMake] $image[invModel] image on PHP Motors.com'>";
        $id .= "<p><a href='/phpmotors/uploads?action=delete&imgId=$image[imgId]&filename=$image[imgName]' title='Delete the image'>Delete $image[imgName]</a></p>";
        $id .= '</li>';
    }
    $id .= '</ul>';
    // $id .= '</div>';
    return $id;
}

// Build the vehicles select list
function buildVehiclesSelect($vehicles)
{
    $prodList = '<select name="invId" id="invId">';
    $prodList .= "<option>Choose a Vehicle</option>";
    foreach ($vehicles as $vehicle) {
        $prodList .= "<option value='$vehicle[invId]'>$vehicle[invMake] $vehicle[invModel]</option>";
    }
    $prodList .= '</select>';
    return $prodList;
}

// Handles the file upload process and returns the path
// The file path is stored into the database
function uploadFile($name)
{
    // Gets the paths, full and local directory
    global $image_dir, $image_dir_path;
    if (isset($_FILES[$name])) {
        // Gets the actual file name
        $filename = $_FILES[$name]['name'];
        if (empty($filename)) {
            return;
        }
        // Get the file from the temp folder on the server
        $source = $_FILES[$name]['tmp_name'];
        // Sets the new path - images folder in this directory
        $target = $image_dir_path . '/' . $filename;
        // Moves the file to the target folder
        move_uploaded_file($source, $target);
        // Send file for further processing
        processImage($image_dir_path, $filename);
        // Sets the path for the image for Database storage
        $filepath = $image_dir . '/' . $filename;
        // Returns the path where the file is stored
        return $filepath;
    }
}

// Processes images by getting paths and 
// creating smaller versions of the image
function processImage($dir, $filename)
{
    // Set up the variables
    $dir = $dir . '/';

    // Set up the image path
    $image_path = $dir . $filename;

    // Set up the thumbnail image path
    $image_path_tn = $dir . makeThumbnailName($filename);

    // Create a thumbnail image that's a maximum of 200 pixels square
    resizeImage($image_path, $image_path_tn, 200, 200);

    // Resize original to a maximum of 500 pixels square
    resizeImage($image_path, $image_path, 500, 500);
}

// Checks and Resizes image
function resizeImage($old_image_path, $new_image_path, $max_width, $max_height)
{

    // Get image type
    $image_info = getimagesize($old_image_path);
    $image_type = $image_info[2];

    // Set up the function names
    switch ($image_type) {
        case IMAGETYPE_JPEG:
            $image_from_file = 'imagecreatefromjpeg';
            $image_to_file = 'imagejpeg';
            break;
        case IMAGETYPE_GIF:
            $image_from_file = 'imagecreatefromgif';
            $image_to_file = 'imagegif';
            break;
        case IMAGETYPE_PNG:
            $image_from_file = 'imagecreatefrompng';
            $image_to_file = 'imagepng';
            break;
        default:
            return;
    } // ends the switch

    // Get the old image and its height and width
    $old_image = $image_from_file($old_image_path);
    $old_width = imagesx($old_image);
    $old_height = imagesy($old_image);

    // Calculate height and width ratios
    $width_ratio = $old_width / $max_width;
    $height_ratio = $old_height / $max_height;

    // If image is larger than specified ratio, create the new image
    if ($width_ratio > 1 || $height_ratio > 1) {

        // Calculate height and width for the new image
        $ratio = max($width_ratio, $height_ratio);
        $new_height = round($old_height / $ratio);
        $new_width = round($old_width / $ratio);

        // Create the new image
        $new_image = imagecreatetruecolor($new_width, $new_height);

        // Set transparency according to image type
        if ($image_type == IMAGETYPE_GIF) {
            $alpha = imagecolorallocatealpha($new_image, 0, 0, 0, 127);
            imagecolortransparent($new_image, $alpha);
        }

        if ($image_type == IMAGETYPE_PNG || $image_type == IMAGETYPE_GIF) {
            imagealphablending($new_image, false);
            imagesavealpha($new_image, true);
        }

        // Copy old image to new image - this resizes the image
        $new_x = 0;
        $new_y = 0;
        $old_x = 0;
        $old_y = 0;
        imagecopyresampled($new_image, $old_image, $new_x, $new_y, $old_x, $old_y, $new_width, $new_height, $old_width, $old_height);

        // Write the new image to a new file
        $image_to_file($new_image, $new_image_path);
        // Free any memory associated with the new image
        imagedestroy($new_image);
    } else {
        // Write the old image to a new file
        $image_to_file($old_image, $new_image_path);
    }
    // Free any memory associated with the old image
    imagedestroy($old_image);
} // ends resizeImage function

// Build dynamic image thumbnail display
function buildImageThumbnailDisplay($image)
{
    $st = '<h2 class="small h2">Vehicle Thumbnails</h2>';
    $st .= '<ul id="vehicle-thumbnail">';
    foreach ($image as $img) {
        $st .= "<li><img src='$img[imgPath]' class='img-thumbnail' alt='$img[invMake] $img[invModel] image on PHPMotors.com'></li>";
    }
    $st .= '</ul>';
    return $st;
}

// Format the date in a human readable way
function dateTime($time)
{
    $timestamp = strtotime($time);
    $formattedDate = date("F j, Y", $timestamp);
    return $formattedDate;
}

// Build dynamic html structure of the reviews
function buildReviewsDisplay($reviews)
{
    $st = '<ul id="reviews">';
    foreach ($reviews as $review) {
        $initial = substr($review['clientFirstname'], 0, 1);
        $name = $initial . $review['clientLastname'];
        $dateTime = $review['reviewDate'];
        $reviewDate = dateTime($dateTime) . " at " . date("g:i a", strtotime($dateTime));

        $st .= '<li>';
        $st .= "<h5>$name</h5>";
        $st .= "<small>$reviewDate</small>";
        $st .= "<p>$review[reviewText]</p>";
        $st .= '</li>';
    }
    $st .= '</ul>';
    return $st;
}

// Build dynamic html structure of the client's reviews
function buildClientReviews($reviews)
{
    $st = '<table id="reviews-table">';
    $st .= '<thead><tr><th>Vehicle Name</th><th>Review Date</th><th colspan="2"></th></tr></thead>';
    foreach ($reviews as $review) {
        $st .= "<tr>";
        $st .= "<td>$review[invMake] $review[invModel]</td>";
        $reviewDate = dateTime($review['reviewDate']);
        $st .= "<td>$reviewDate</td>";
        $st .= "<td><a href='/phpmotors/reviews/?action=mod&reviewId=$review[reviewId]'>Modify</a></td>";
        $st .= "<td><a href='/phpmotors/reviews/?action=del&reviewId=$review[reviewId]'>Delete</a></td>";
        $st .= "</tr>";
    }
    $st .= '</table>';
    return $st;
}
?>