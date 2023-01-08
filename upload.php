<?php
    include_once "db/db.php";
    include_once "models/Image.php";
    include_once "header.php";

    if (isset($_POST["submit"])){
        //Upload image
        $file = $_FILES["image"];
        $targetDir = "uploads/{$file["name"]}";
        $path = "http://localhost/image-share/uploads/{$file["name"]}";
        //Size and type checks here


        move_uploaded_file($file["tmp_name"], $targetDir);

        //Save path and rest to db
        try {
            $db = new Database();
            $conn = $db->connect();
            $image = new Image($conn);
    
            $image->title = $_POST["title"];
            $image->description = $_POST["description"];
            $image->path = $path;
            $image->author_id = $_SESSION["user_id"];
    
            $image->upload();
        } catch (Exception $e) {
            echo "ERROR: " . $e->getMessage();
        }
    }
?>


<!DOCTYPE html>
<html>
<div class = "container">
    <div class="card text-center mb-3 mx-auto" style="width: 28rem;">
    <div class="card-body">
        <h5 class="card-title">Upload image</h5>
        <br>

        <form class="row g-3" action=<?php echo $_SERVER["PHP_SELF"]?> method = "POST" enctype = "multipart/form-data">
            <div class="mb-3">
                <input  type="file" name = "image">
            </div>
            <div class="mb-3">
                <label class="form-label">Title</label>
                <input class="form-control" type="text" name = "title">
            </div>
            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea class="form-control" rows="3" name = "description"></textarea>
            </div>
            <div class="mb-3">
                <input class="form-control" type="submit" value = "Upload" name = "submit">
            </div>
        </form>

    </div>
</div>

</div>

</div>

</html>