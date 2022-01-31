<?php

// new filename
$filename = generateRandomString() . '.jpeg';

$url = '';
if (move_uploaded_file($_FILES['webcam']['tmp_name'], 'uploads/photos/' . $filename)) {
    $url = 'uploads/photos/' . $filename;
}

// Return image url
echo $url;


function generateRandomString($length = 30)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
