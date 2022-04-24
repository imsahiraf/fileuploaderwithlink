<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instagram File Uploader</title>
    <link rel="icon" href="images/logo.jpg" type="image/jpg" sizes="16x16">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
<div class="container">
    <div class="text">Upload a file and get a link to share! <br> No Authentication required.</div>
    <div class="page">
      <div class="title">instagram</div>
      <form id="uploadForm" enctype="multipart/form-data">
        <input type="file" name="file" id="fileInput">
        <input type="submit" name="submit" value="UPLOAD"/>
        <div class="progress">
            <div class="progress-bar"></div>
        </div>
        <div id="uploadStatus" stye="margin-bottom:5px"></div>
        <input type="text" value="Hello World" id="copytext">
        <div class="tooltip">
            <button type="button" onclick="myFunction()">
            <!--<span class="tooltiptext" id="myTooltip">Copy to clipboard</span>-->
            Copy text
            </button>
        </div>
      </form>
    </div>
  </div>
  <script>
$(document).ready(function(){
    // File upload via Ajax
    $("#uploadForm").on('submit', function(e){
        e.preventDefault();
        $.ajax({
            xhr: function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = ((evt.loaded / evt.total) * 100).toFixed(1);
                        $(".progress-bar").width(percentComplete + '%');
                        $(".progress-bar").html(percentComplete+'%');
                    }
                }, false);
                return xhr;
            },
            type: 'POST',
            url: 'upload.php',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            beforeSend: function(){
                $(".progress-bar").width('0%');
                $('#uploadStatus').html('<img src="images/loading.gif"/>');
            },
            error:function(){
                $('#uploadStatus').html('<p style="color:#EA4335;">File upload failed, please try again.</p>');
            },
            success: function(resp){
                $('#uploadForm')[0].reset();
                $('#uploadStatus').html('<p style="color:#28A74B;">File has uploaded successfully!</p>');
                $('#copytext').val('http://iguploader.dgr-65.online/uploads/'+resp);
            }
        });
    });
});
</script>
<script>
function myFunction() {
  var copyText = document.getElementById("copytext");
  copyText.select();
  copyText.setSelectionRange(0, 99999);
  document.execCommand("copy");
  navigator.clipboard.writeText(copyText.value);
  
  var tooltip = document.getElementById("myTooltip");
  tooltip.innerHTML = "Copied";
}

function outFunc() {
  var tooltip = document.getElementById("myTooltip");
  tooltip.innerHTML = "Copy to clipboard";
}
</script>    
</body>
</html>