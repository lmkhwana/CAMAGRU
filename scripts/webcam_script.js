// (function(){
//     var video = document.getElementById('vidDisplay'),
//         canvas = document.getElementById('boxi'),
//         context = canvas.getContext('2d'),
//         vendoUrl = window.URL || window.webkitURL;
        
//     navigator.getMedia = navigator.getUserMedia ||
//                         navigator.webkitGetUserMedia ||
//                         navigator.mozGetUserMedia ||
//                         navigator.msGetUserMedia;

//     navigator.getMedia({
//         video: true,
//         Audio: false
//     }, function(stream){
//         //success
//         try
//         {
//             video.srcObject = stream;
//             video.play();
//         }
//         catch
//         {
//             video.src = vendoUrl.createObjectURL(stream);
//         }
        
//     }, function(error){
//         //an error has appeard
//     });

//    var btn =document.getElementById('registerbtn');
//    if (btn)
//    {
//        btn.addEventListener('click', function(){
//         context.drawImage(video, 0 ,0 , 100, 100);
//     });
//    }
// })();


  const player = document.getElementById('vidDisplay');
  const canvas = document.getElementById('boxi');
  const context = canvas.getContext('2d');
  const captureButton = document.getElementById('registerbtn');

  const constraints = {
    video: true,
  };

   // Attach the video stream to the video element and autoplay.
   navigator.mediaDevices.getUserMedia(constraints)
   .then((stream) => {
     player.srcObject = stream;
   });

  captureButton.addEventListener('click', () => {
    // Draw the video frame to the canvas.
    context.drawImage(player, 0, 0, canvas.width, canvas.height);
  });

    //function to check for a blank canvas

    function isCanvasBlank(canvas) {
        var blank = document.createElement('canvas');
        blank.width = canvas.width;
        blank.height = canvas.height;
    
        return canvas.toDataURL() == blank.toDataURL();
    }

    function like()
    {
      document.getElementById("like").innerHTML = "Liked";
      document.getElementById("like").disabled = true;
    }

    function save()
    {
       var dataURL = canvas.toDataURL(); // convert to base64
       document.getElementById("data").value = dataURL;
    }
    //    const xhr = new XMLHttpRequest();

    //    xhr.onload = function()
    //    {
    //       const res = document.getElementById('server');
    //       res.innerHTML = this.responseText;
    //    };
    //    xhr.open("POST", "../photobooth.php");
    //    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    //    xhr.send("data="+dataURL);
    // }
