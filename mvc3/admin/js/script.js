/*==============================
|	|	|	Mobile Menu
================================*/

$(function () {

	// Show mobile nav
	$("#mobile-nav-open-btn").click(function () {
		$("#mobile-nav").css("height", "100vh");
		$("#mobile-nav-close-btn").css("display", "block")
		$("#mobile-nav-open-btn").css("display", "none")
	});
	// Hide mobile nav
	$("#mobile-nav-close-btn, #mobile-nav a.item").click(function () {
		$("#mobile-nav").css("height", "0");
		$("#mobile-nav-close-btn").css("display", "none")
		$("#mobile-nav-open-btn").css("display", "block")
	});

});
/*==============================
|	|	|	login
================================*/

$(function () {
	$(".toggle-password").click(function() {

  $(this).toggleClass("fa-eye fa-eye-slash");
  var input = $($(this).attr("toggle"));
  if (input.attr("type") == "password") {
    input.attr("type", "text");
  } else {
    input.attr("type", "password");
  }
});
});
