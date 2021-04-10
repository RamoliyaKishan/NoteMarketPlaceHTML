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
|	|	|	toggle password for login, signup, forgot password
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


/*==============================
|	|	|	userprofile
================================*/

$(function () {
    var year = new Date().getFullYear;
	$('#birth_date,#open_datepicker').datepicker({
		numberOfMonths: 1,
		changeYear: true,
		changeMonth: true,
		showOtherMonths: true,
        dateFormat: 'dd-mm-yy',
		maxDate: new Date(),
        yearRange: "1947:c-0"
        
	});
});

/*==============================
|	|	|	Add Notes
================================*/


/*==============================
|	|	|	dashbord
================================*/

// In progress notes table
  dashboard_progress = $('#in-progress-table').DataTable({
    "bLengthChange": false, // this gives option for changing the number of records shown in the UI table
    "lengthMenu": [5], 
    "dom": "lrtp" 
  });
	
	$("#progress-search").on('keyup',function(){
		dashboard_progress.search(this.value).draw();	 // this  is for customized searchbox with datatable search feature.
	});

dashboard_published = $('#published-table').DataTable({
    "bLengthChange": false, // this gives option for changing the number of records shown in the UI table
    "lengthMenu": [5], 
    "dom": "lrtp" 
  });
	
	$("#published-search").on('keyup',function(){
		dashboard_published.search(this.value).draw();	 // this  is for customized searchbox with datatable search feature.
	});


/*==============================
|	|	|	My Downloads
================================*/

// In progress notes table
  downloads = $('#my-downloads-table').DataTable({
    "bLengthChange": false, // this gives option for changing the number of records shown in the UI table
    "lengthMenu": [10], 
    "dom": "lrtp" 
  });

$("#downloads-search").on('keyup',function(){
		downloads.search(this.value).draw();	 // this  is for customized searchbox with datatable search feature.
	});

/*==============================
|	|	|	My Sold Notes
================================*/

// In progress notes table
  my_sold_notes = $('#my-sold-notes-table').DataTable({
    "bLengthChange": false, // this gives option for changing the number of records shown in the UI table
    "lengthMenu": [10], 
    "dom": "lrtp" 
  });

$("#sold-notes-search").on('keyup',function(){
		my_sold_notes.search(this.value).draw();	 // this  is for customized searchbox with datatable search feature.
	});

/*==============================
|	|	|	My rejected Notes
================================*/

// In progress notes table
  my_rejected_notes = $('#my-rejected-notes-table').DataTable({
    "bLengthChange": false, // this gives option for changing the number of records shown in the UI table
    "lengthMenu": [10], 
    "dom": "lrtp" 
  });

$("#rejected-notes-search").on('keyup',function(){
		my_rejected_notes.search(this.value).draw();	 // this  is for customized searchbox with datatable search feature.
	});


/*==============================
|	|	|	buyer-request
================================*/

// In progress notes table
  buyer_request = $('#buyer-request-table').DataTable({
    "bLengthChange": false, // this gives option for changing the number of records shown in the UI table
    "lengthMenu": [10], 
    "dom": "lrtp" 
  });

$("#buyer-request-search").on('keyup',function(){
		buyer_request.search(this.value).draw();	 // this  is for customized searchbox with datatable search feature.
	});

/*==============================
|	|	|	FAQ
================================*/


