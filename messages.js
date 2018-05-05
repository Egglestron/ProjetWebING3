//html5andcss3.org
function showhideEdit(){
  var edit = document.getElementById("edit");
  var submit = document.getElementById("submit");
  var name = document.getElementById("nameChat");

  if(edit.style.display !== "none") {
    edit.style.display = "none";
    submit.style.display = "block";
  }
  // else {
  //   edit.style.display = "block";
  //   cancel.style.display = "none";
  //   submit.style.display = "none";
  // }
}


//
// function showhideComment(id){
//   //var id = 35;
//   var div = document.getElementById("otherComments".concat(id));
//   var but = document.getElementById("hidebutton".concat(id));
//   if (div.style.display !== "none") {
//     div.style.display = "none";
//     but.textContent = "Show More";
//   }
//   else {
//     div.style.display = "block";
//     but.textContent = "Show Less";
//   }
// }
