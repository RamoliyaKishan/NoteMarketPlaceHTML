/*==============================
|	|	|	home
================================*/


//Navigation


//Show and Hide white navigation
$(function () {

	// shoe/hide nav on window Load
	showHideNav();

	$(window).scroll(function () {

		// shoe/hide nav on window scroll
		showHideNav();

	});

	function showHideNav() {

		if ($(window).scrollTop() > 50) {

			//Show White Nav	
			$("nav").addClass("white-nav-top");

			//Show Dark Logo
			$(".navbar-brand img").attr("src", "../images/Front_images/logo.png");

			//Show Back to Top Button
			$("#back-to-top").fadeIn();

		} else {

			//Hide White Nav
			$("nav").removeClass("white-nav-top");

			//Show Normal Logo
			$(".navbar-brand img").attr("src", "../images/Front_images/top-logo.png");

			//Hide Back to Top Button
			$("#back-to-top").fadeOut();

		}

	}

});

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
	$("#mobile-nav-close-btn, #mobile-nav a").click(function () {
		$("#mobile-nav").css("height", "0");
		$("#mobile-nav-close-btn").css("display", "none")
		$("#mobile-nav-open-btn").css("display", "block")
	});

});

