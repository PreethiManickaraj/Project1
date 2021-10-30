function staffFileUploads() {
    var form = document.getElementById('image_upload');
    var fileSelect = document.getElementById('myfile');
    var uploadButton = document.getElementById('upload');
    var statusDiv = document.getElementById('status');
    statusDiv.innerHTML = 'Uploading . . . ';
    var files = fileSelect.files;
    var formData = new FormData();
    var file = files[0]; 
    if (file.length == 0) {
        statusDiv.innerHTML = 'Please select a file..';
        return;
    }
    if (!file.type.match('image.*')) {
        statusDiv.innerHTML = 'You cannot upload this file because it’s not an image.';
        return;
    }
    if (file.size >= 2000000 ) {
        statusDiv.innerHTML = 'You cannot upload this file because its size exceeds the maximum limit of 2 MB.';
        return;
    }
    formData.append('myfile', file, file.name);
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'StaffProfilePost', true);
    xhr.onload = function () {
        if (xhr.status === 200) {
        statusDiv.innerHTML = 'Your upload is successful..';
        } else {
        statusDiv.innerHTML = 'An error occurred during the upload. Try again.';
        }
    };
    xhr.send(formData);
}