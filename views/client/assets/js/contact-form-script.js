(function ($) {
  "use strict";
  $("#contactForm")
    .validator()
    .on("submit", function (event) {
      if (event.isDefaultPrevented()) {
        formError();
        submitMSG(false, "Did you fill up the form properly?");
      } else {
        event.preventDefault();
        submitForm();
      }
    });
  function submitForm() {
    var name = $("#name").val();
    var email = $("#email").val();
    var password = $("#password").val();
    var ConfirmPassword = $("#ConfirmPassword").val();
    $.ajax({
      type: "POST",
      url: "index.php?controller=client&action=register",
      data:
        "name=" +
        name +
        "&email=" +
        email +
        "&password=" +
        password +
        "&ConfirmPassword=" +
        ConfirmPassword,
      success: function (text) {
        if (text == "success") {
          formSuccess();
        } else {
          formError();
          submitMSG(false, text);
        }
      },
    });
  }
  function formSuccess() {
    $("#contactForm")[0].reset();
    submitMSG(true, "Message Submitted!");
  }
  function formError() {
    $("#contactForm")
      .removeClass()
      .addClass("shake animated")
      .one(
        "webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend",
        function () {
          $(this).removeClass();
        }
      );
  }
  function submitMSG(valid, msg) {
    if (valid) {
      var msgClasses = "h4 tada animated text-success";
    } else {
      var msgClasses = "h4 text-danger";
    }
    $("#msgSubmit").removeClass().addClass(msgClasses).text(msg);
  }
})(jQuery);
