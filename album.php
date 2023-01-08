<html>
<script src = "rate.js">
</script>

<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
  <?php foreach($images as $i):?>
  <div class="col">

    <div class="card shadow-sm">
          <img src= <?php echo $i["path"]?> class="img-fluid">
    <div class="card-body">
        <p class="card-text"><?php echo $i["title"] . " by " . $i["author"]?> </p>
        <p class="card-text"><?php echo $i["description"]?> </p>
        <div class="d-flex justify-content-between align-items-center">
          <div class="btn-group">
            
          <button type="button"
              data-liked = <?php echo $i["likedByUser"]?>
              class= <?php echo $i["likedByUser"]?'"btn btn-sm btn-primary"':'"btn btn-sm btn-outline-secondary"'?>
              onclick= "ratePic(this)"
              id = <?php echo $i["id"]?>
              name = <?php echo $i["id"]?>>
              Like (<?php echo $i["likes"]?>)
            </button>
            
            <button type="button"
              data-disliked = <?php echo $i["dislikedByUser"]?>
              class= <?php echo $i["dislikedByUser"]?'"btn btn-sm btn-danger"':'"btn btn-sm btn-outline-secondary"'?>
              onclick = "ratePic(this)"
              id = <?php echo $i["id"]?>
              name = <?php echo $i["id"]?>>
                Dislike (<?php echo $i["dislikes"]?>)
            </button>
          
            </div>
        </div>
      </div>
    </div>
  </div>

  <?php endforeach;?>
</div>
    
</html>