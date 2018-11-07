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
  var image = new Image();

  const constraints = {
    video: true,
  };

  captureButton.addEventListener('click', () => {
    // Draw the video frame to the canvas.
    context.drawImage(player, 0, 0, canvas.width, canvas.height);
  });

  // Attach the video stream to the video element and autoplay.
  navigator.mediaDevices.getUserMedia(constraints)
    .then((stream) => {
      player.srcObject = stream;
    });

    function save()
    {
        //Convert to an image
        image.src = canvas.toDataURL("image/png");

        var hr = new XMLHttpRequest();

        var url = "photobooth.php";
        var img = image.files[0];
        alert(img);
    }
