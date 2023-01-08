<?php
    try {
        include_once "../models/Image.php";
        include_once "../db/db.php";
        
        $db = new Database();
        $conn = $db->connect();
        $image = new Image($conn);

        $data = json_decode(file_get_contents("php://input"));

        $image->unrateImage($data->image_id);
    } catch (\Throwable $th) {
        throw $th;
    }
?>