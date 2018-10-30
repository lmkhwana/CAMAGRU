(function(){
    var video = document.getElementById('vidDisplay'),
        canvas = document.getElementById('boxi'),
        context = canvas.getContext('2d'),
        vendoUrl = window.URL || window.webkitURL;
        
    navigator.getMedia = navigator.getUserMedia ||
                        navigator.webkitGetUserMedia ||
                        navigator.mozGetUserMedia ||
                        navigator.msGetUserMedia;

    navigator.getMedia({
        video: true,
        Audio: false
    }, function(stream){
        //success
        try
        {
            video.srcObject = stream;
            video.play();
        }
        catch
        {
            video.src = vendoUrl.createObjectURL(stream);
        }
        
    }, function(error){
        //an error has appeard
    });

   var btn =document.getElementById('registerbtn');
   if (btn)
   {
       btn.addEventListener('click', function(){
        context.drawImage(video, 0 ,0 , 100, 100);
    });
   }
})();