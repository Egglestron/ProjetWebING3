
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
