function unratePic(e){
    const xhttp = new XMLHttpRequest();
    xhttp.open("POST", "http://localhost/image-share/api/unrateImage.php");
      xhttp.setRequestHeader("Content-Type", "application/json");
      xhttp.send(JSON.stringify({
        image_id: e.id
      }));
      xhttp.onload = function(){
        e.style = "background:white; color:#6c757d;";
        var r = /\d+/;
        e.innerHTML = (e.dataset.liked?"Like (":"Dislike(") + (parseInt(e.innerHTML.match(r)[0]) - 1)  + ")";
        e.dataset.liked?e.dataset.liked = 0:e.dataset.disliked = 0;
      }
      return;
  }

function checkOpposite(e){
  var buttons = document.getElementsByName(e.id);
  if (e.dataset.liked){
    var button = buttons[1];
    if (button.dataset.disliked == 1){
      button.style = "background:white; color:#6c757d;";
      var r = /\d+/;
      button.innerHTML = "Dislike(" + (parseInt(button.innerHTML.match(r)[0]) - 1)  + ")";
      button.dataset.disliked = 0;
    }
  }
  else if (e.dataset.disliked){
    var button = buttons[0];
    if (button.dataset.liked == 1){
      button.style = "background:white; color:#6c757d;";
      var r = /\d+/;
      button.innerHTML = "Like(" + (parseInt(button.innerHTML.match(r)[0]) - 1)  + ")";
      button.dataset.liked = 0;
    }
  }
}

function ratePic(e){
    const xhttp = new XMLHttpRequest();
    
    if ((e.dataset.liked && e.dataset.liked == 0) || (e.dataset.disliked && e.dataset.disliked == 0)){
      xhttp.open("POST", "http://localhost/image-share/api/rateImage.php");
      xhttp.setRequestHeader("Content-Type", "application/json");
      xhttp.send(JSON.stringify({
        image_id: e.id,
        rating: e.dataset.liked?1:0
      }));
      xhttp.onload = function(){
        var r = /\d+/;

        if (e.dataset.liked){
          e.style = "background:#0d6efd; color:white;";
          e.innerHTML = "Like (" + (parseInt(e.innerHTML.match(r)[0]) + 1)  + ")";
          e.dataset.liked = 1;
        }
        else if (e.dataset.disliked){
          e.style = "background:#dc3545; color:white;";
          e.innerHTML = "Dislike (" + (parseInt(e.innerHTML.match(r)[0]) + 1)  + ")";
          e.dataset.disliked = 1;
        }
        //Used only to adjust the display, opposite rating data is deleted on the server already
        checkOpposite(e)
      }
    }
    else{
      unratePic(e);
    }
  }