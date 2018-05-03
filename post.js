$(function() {
    $(".button").click(function() {
      // validate and process form here
      var desc = $("input#description").val();
      var idpost = $("input#idpost").val();
      var datastring = 'description=' + desc + '&idpost=' + idpost;

      //alert (dataString);return false;

      $.ajax({
        type: "POST",
        url: "comment.php",
        data: dataString,
        success: function() {
        $('#contact_form').html("<div id='message'></div>");
        $('#message').html("<h2>Contact Form Submitted!</h2>")
        .append("<p>We will be in touch soon.</p>")
        .hide()
        .fadeIn(1500, function() {
        $('#message').append("<img id='checkmark' src='images/check.png' />");
      });
      })
    });
  });
