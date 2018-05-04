
//html5andcss3.org
function showhide(){

var div = document.getElementById("otherDiscussions");
var but = document.getElementById("hidebutton");
if (div.style.display !== "none") {
  div.style.display = "none";
  but.textContent = "Show More";
}
else {
  div.style.display = "block";
  but.textContent = "Show Less";
}
}

function showhideComment(id){
//var id = 35;
var div = document.getElementById("otherComments".concat(id));
var but = document.getElementById("hidebutton".concat(id));
if (div.style.display !== "none") {
  div.style.display = "none";
  but.textContent = "Show More";
}
else {
  div.style.display = "block";
  but.textContent = "Show Less";
}
}
