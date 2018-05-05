//html5andcss3.org
function showEdit(text){
  var edit = document.getElementById("edit");
  var submit = document.getElementById("submit");
  var cancel = document.getElementById("cancel");
  var name = document.getElementById("nameChat");

    edit.style.display = "none";
    cancel.style.display = "block";
    submit.style.display = "block";
    name.style.color = "#000000";
    name.style.backgroundColor = "#ffffff";
    name.contentEditable = "true";
    name.innerHTML = text;
}

function hideEdit(){
  var edit = document.getElementById("edit");
  var submit = document.getElementById("submit");
  var cancel = document.getElementById("cancel");
  var name = document.getElementById("nameChat");

    edit.style.display = "block";
    cancel.style.display = "none";
    submit.style.display = "none";
    name.style.color = "#ffffff";
    name.style.backgroundColor = "#4067FF";
    name.contentEditable = "false";
}
