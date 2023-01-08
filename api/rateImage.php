<?php 

    try {
        include_once "../models/Image.php";
        include_once "../db/db.php";
        
        $db = new Database();
        $conn = $db->connect();
        $image = new Image($conn);
        $data = json_decode(file_get_contents("php://input"));
        //Clear a possible opposite rating
        $image->unrateImage($data->image_id);
        //Rate
        $image->rateImage($data->image_id, $data->rating);
    } catch (Exception $e) {
        echo "ERROR: " . $e->getMessage();
    }
?>