function showImage(image) {
    var img = new Image();
    document.write(img);
 // add src attribute                                   
    img.src = "views/AdminImageUploads" + image;

    // when image is loaded, add it to my div
    img.addEventListener("load", function(){
        document.getElementById("image").appendChild(img.src);
    });
}