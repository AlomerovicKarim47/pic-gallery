<?php
    session_start();
    class Image{
        private $conn;
        public $title;
        public $description;
        public $author_id;
        public $path;
        public function __construct($c)
        {
            $this->conn = $c;
        }

        public function upload(){
            try {
                $query = "INSERT INTO images (title, description, author_id, path, created_at)
                    VALUES('{$this->title}',
                    '{$this->description}',
                    '{$this->author_id}',
                    '{$this->path}',
                    '". date("Y-m-d") ."')";
                $stmt = $this->conn->prepare($query);
                $stmt->execute();
            } catch (Exception $e) {
                throw $e;
            }
        }

        public function getAll($liked = false, $byUser = false){
            try {
                $query = "SELECT i.*, u.username AS author,
                (SELECT COUNT(*) FROM ratings WHERE image_id = i.id AND rating = 1) AS likes,
                (SELECT COUNT(*) FROM ratings WHERE image_id = i.id AND rating = 0) AS dislikes,
                (SELECT COUNT(*) > 0 FROM ratings WHERE user_id = {$_SESSION["user_id"]} AND image_id = i.id AND rating = 1) AS likedByUser,
                (SELECT COUNT(*) > 0 FROM ratings WHERE user_id = {$_SESSION["user_id"]} AND image_id = i.id AND rating = 0) AS dislikedByUser  
                FROM images i
                LEFT JOIN users u ON i.author_id = u.id"
                . ($liked? " HAVING likedByUser = 1":"") 
                . ($byUser? " WHERE u.id = {$_SESSION["user_id"]}":"") 
                . " ORDER BY i.created_at DESC";
                $stmt = $this->conn->prepare($query);
                $stmt->execute();
                $images = [];
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
                    array_push($images, [
                        "id" => $row["id"],
                        "title" => $row["title"],
                        "description" => $row["description"],
                        "author" => $row["author"],
                        "path" => $row["path"],
                        "likes" => $row["likes"],
                        "dislikes" => $row["dislikes"],
                        "likedByUser" => $row["likedByUser"],
                        "dislikedByUser" => $row["dislikedByUser"]
                    ]);
            } catch (Exception $e) {
                throw $e;
            }
            return $images;
        }

        public function rateImage($image, $rating){
            try {
                $sql = "INSERT INTO ratings (user_id, image_id, rating) VALUES ('{$_SESSION["user_id"]}', '$image', '$rating')";
                $stmt = $this->conn->prepare($sql);
                $stmt->execute();
            } catch (Exception $e) {
                throw $e;
            }
        }

        public function unrateImage($image){
            try {
                $sql = "DELETE from ratings WHERE image_id = $image";
                $stmt = $this->conn->prepare($sql);
                $stmt->execute();
            } catch (Exception $e) {
                throw $e;
            }
        }
    }
?>