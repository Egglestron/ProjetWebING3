var input = document.querySelector('input[type="file"]');
var preview = document.querySelector('.preview');

input.style.opacity = 0;
input.addEventListener('change', updateImageDisplay);

function updateImageDisplay() {
  while(preview.firstChild) {
    preview.removeChild(preview.firstChild);
  }

  var curFiles = input.files;
  if(curFiles.length === 0) {
    var para = document.createElement('p');
    para.textContent = 'No files currently selected for upload';
    preview.appendChild(para);
  } else {
    for(var i = 0; i < curFiles.length; i++) {

      var para = document.createElement('p');
      if(validFileType(curFiles[i])) {
        para.textContent = curFiles[i].name + ' (' + returnFileSize(curFiles[i].size) + ')';
        var image = document.createElement('img');
        image.src = window.URL.createObjectURL(curFiles[i]);

        para.appendChild(image);

      } else {
        para.textContent = 'File name ' + curFiles[i].name + ': Not a valid file type. Update your selection.';
        preview.appendChild(para);
      }
      preview.appendChild(para);
    }
  }
}var fileTypes = [
  'image/jpeg',
  'image/pjpeg',
  'image/png'
]

function validFileType(file) {
  for(var i = 0; i < fileTypes.length; i++) {
    if(file.type === fileTypes[i]) {
      return true;
    }
  }

  return false;
}function returnFileSize(number) {
  if(number < 1024) {
    return number + 'bytes';
  } else if(number >= 1024 && number < 1048576) {
    return (number/1024).toFixed(1) + 'KB';
  } else if(number >= 1048576) {
    return (number/1048576).toFixed(1) + 'MB';
  }
}
