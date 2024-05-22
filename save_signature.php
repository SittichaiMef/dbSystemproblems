<?php
if(isset($_POST['signature'])) {
    // Get the signature data
    $signatureData = $_POST['signature'];

    // Decode the base64-encoded image data
    $decodedImage = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $signatureData));

    // Save the image to a file (you may want to generate a unique filename)
    $filename = 'uploads/signature_' . uniqid() . '.png';
    file_put_contents($filename, $decodedImage);

    // Return the filename or any other response
    echo $filename;
} else {
    // Handle the case when no signature data is received
    echo 'No signature data received.';
}
?>
