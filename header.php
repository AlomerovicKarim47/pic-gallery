<?php
    //if (session_status() == PHP_SESSION_NONE){
        if (!isset($_SESSION)){
            session_start();
            $_SESSION["user_id"] = 1;
        }
    //}
?>

<div>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    </head>
    <div class = "container">
        <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
        <a href="/" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
            <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"></use></svg>
        </a>

        <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
            <li><a href="upload.php" class="nav-link px-2 link-secondary">Upload</a></li>
            <li><a href="browse.php" class="nav-link px-2 link-dark">Browse</a></li>
            <li><a href="liked.php" class="nav-link px-2 link-dark">Liked</a></li>
            <li><a href="mypics.php" class="nav-link px-2 link-dark">My pics</a></li>
        </ul>

        <div class="col-md-3 text-end">
            <button type="button" class="btn btn-outline-primary me-2">Login</button>
            <button type="button" class="btn btn-primary">Sign-up</button>
        </div>
        </header>
    </div>
</div>