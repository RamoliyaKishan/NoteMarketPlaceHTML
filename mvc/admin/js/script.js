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

/*==============================
|	|	|	dashboard-published Notes
================================*/

// In progress notes table
  dashboard_published_notes = $('#dashboard-published-notes-table').DataTable({
    "bLengthChange": false, // this gives option for changing the number of records shown in the UI table
    "lengthMenu": [5], 
    "dom": "lrtp" 
  });
	
	$("#dashboard-published-notes-search").on('keyup',function(){
		dashboard_published_notes.search(this.value).draw();
	});

	$("#dashboard-published-notes-month").on('keyup',function(){
		dashboard_published_notes.columns(7).search( this.value ).draw();
	});

/*==============================
|	|	|	manage-administrator
================================*/

// In progress notes table
  manage_administrator = $('#manage-administrator-table').DataTable({
    "bLengthChange": false, // this gives option for changing the number of records shown in the UI table
    "lengthMenu": [5], 
    "dom": "lrtp" 
  });

$("#manage-administrator-search").on('keyup',function(a){
		manage_administrator.search(a.target.value);
		manage_administrator.draw();
	});

/*==============================
|	|	|	manage-category
================================*/

// In progress notes table
  manage_category = $('#manage-category-table').DataTable({
    "bLengthChange": false, // this gives option for changing the number of records shown in the UI table
    "lengthMenu": [5], 
    "dom": "lrtp" 
  });

	$("#manage-category-search").on('keyup',function(a){
		manage_category.search(a.target.value);
		manage_category.draw();
	});


/*==============================
|	|	|	manage-Type
================================*/

// In progress notes table
  manage_type = $('#manage-type-table').DataTable({
    "bLengthChange": false, // this gives option for changing the number of records shown in the UI table
    "lengthMenu": [5], 
    "dom": "lrtp" 
  });
	
	$("#manage-type-search").on('keyup',function(a){
		manage_type.search(a.target.value);
		manage_type.draw();
	});

/*==============================
|	|	|	members
================================*/
// In progress notes table
   members  = $('#members-table').DataTable({
    "bLengthChange": false, // this gives option for changing the number of records shown in the UI table
    "lengthMenu": [5], 
    "dom": "lrtp" 
  });

	$("#members-search").on('keyup',function(a){
		members.search(a.target.value);
		members.draw();
	});

/*==============================
|	|	|	members Details
================================*/

// In progress notes table
  members_etails = $('#notes-table').DataTable({
    "bLengthChange": false, // this gives option for changing the number of records shown in the UI table
    "lengthMenu": [5], 
    "dom": "lrtp" 
  });

/*==============================
|	|	|	spam-reports
================================*/

// In progress notes table
   spanTable = $('#spam-reports-table').DataTable({
    "bLengthChange": false, // this gives option for changing the number of records shown in the UI table
    "lengthMenu": [5], 
    "dom": "lrtp" 
  });

	$("#spam-reports-search").on('keyup',function(a){
		spanTable.search(a.target.value);
		spanTable.draw();
	});


/*==============================
|	|	|	manage-country
================================*/

// In progress notes table
   manage_country  = $('#manage-country-table').DataTable({
    "bLengthChange": false, // this gives option for changing the number of records shown in the UI table
    "lengthMenu": [5], 
    "dom": "lrtp" 
  });

	$("#manage-country-search").on('keyup',function(){
		manage_country.search(this.value).draw();
	});

 /*==============================
|	|	|	published Notes
================================*/

// In progress notes table
  published_notes = $('#published-notes-table').DataTable({
    "bLengthChange": false, // this gives option for changing the number of records shown in the UI table
    "lengthMenu": [5], 
    "dom": "lrtp" 
  });

$("#published-notes-search").on('keyup',function(){
		published_notes.search(this.value).draw();
	});

	$("#published-notes-month").on('keyup',function(){
		published_notes.columns(5).search(this.value).draw();
	});

 /*==============================
|	|	|	downloads
================================*/

// In progress notes table
  downloads = $('#downloads-table').DataTable({
    "bLengthChange": false, // this gives option for changing the number of records shown in the UI table
    "lengthMenu": [5], 
    "dom": "lrtp" 
  });

$("#downloads-search").on('keyup',function(){
		downloads.search(this.value).draw();
	});

	$("#downloads-note").on('keyup',function(){
		downloads.columns(1).search(this.value).draw();
	});
	$("#downloads-seller").on('keyup',function(){
		downloads.columns(4).search(this.value).draw();
	});
	$("#downloads-buyer").on('keyup',function(){
		downloads.columns(3).search(this.value).draw();
	});

 /*==============================
|	|	|	rejected Notes
================================*/

// In progress notes table
  rejected_notes = $('#rejected-notes-table').DataTable({
    "bLengthChange": false, // this gives option for changing the number of records shown in the UI table
    "lengthMenu": [5], 
    "dom": "lrtp" 
  });

$("#rejected-notes-search").on('keyup',function(){
		rejected_notes.search(this.value).draw();
	});

	$("#rejected-notes-month").on('keyup',function(){
		rejected_notes.columns(5).search(this.value).draw();
	});


 /*==============================
|	|	|	notes-under-review
================================*/

// In progress notes table
  notes_under_review = $('#notes-under-review-table').DataTable({
    "bLengthChange": false, // this gives option for changing the number of records shown in the UI table
    "lengthMenu": [5], 
    "dom": "lrtp" 
  });

$("#notes-under-review-search").on('keyup',function(){
		notes_under_review.search(this.value).draw();
	});

	$("#notes-under-review-month").on('keyup',function(){
		notes_under_review.columns(3).search(this.value).draw();
	});