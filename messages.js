//html5andcss3.org
function showEdit(){
  var edit = document.getElementById("edit");
  var submit = document.getElementById("submit");
  var cancel = document.getElementById("cancel");
  var name = document.getElementById("nameChat");
  var input = document.getElementById("name2");

    edit.style.display = "none";
    cancel.style.display = "block";
    submit.style.display = "block";
    name.style.display = "none";
    name2.style.display = "block";
}

function hideEdit(text){
  var edit = document.getElementById("edit");
  var submit = document.getElementById("submit");
  var cancel = document.getElementById("cancel");
  var name = document.getElementById("nameChat");

    edit.style.display = "block";
    cancel.style.display = "none";
    submit.style.display = "none";
    name.style.color = "#ffffff";
    name.style.display = "block";
    name2.style.display = "none";
    name.innerHTML = text;
}
