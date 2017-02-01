$(function() { 
    function newPage() {  //creates contact page when hash=#contact or link is clicked
          $('#1').hide();
		  $('#2').show().html('<div class="row"><div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">\
	<div id="message"><h2>Tell us about your organization and where you are located, and we will get back to you, soon.</h2></div>\
	<div class="return"><h3><a href="http://chrisganeymedia.com" class="btn btn-default">Main Page</a></h3>\
	</div></div></div><div class="row"><div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">\
	<form id="target1" class="fm" name="form1" method="post" action="contact"><div>\
	<h3>Name</h3><div id="error_name" class="errors"><h4></h4></div><input type="text" id="name1" class="input form-control" name="name" value="" /></div>\
	<div id="error_info" class="errors"><h4></h4></div><div><div class="row"><div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">\
	<h3 class="combine">Phone Number</h3><p class="combine">ie. ###-###-####</p></div></div><div id="error_phone" class="errors"><h4></h4></div>\
	<input type="text" id="phone1" class="input form-control" name="phone" value="" />\
	</div><div><h3>Email Address</h3><div id="error_email" class="errors"><h4></h4></div>\
	<input type="text" id="email1" class="input form-control" name="email" value="" />\
	</div><div class="radio"><h3>Preferred Method for Contacting You</h3><label class="radio-inline">\
	<input type="radio" id="methodphone" name="method" value="telephone" /><h4>Telephone</h4></label><label class="radio-inline">\
	<input type="radio" id="methodemail" name="method" value="email" /><h4>email</h4></label></div><div>\
	<h3>Your Comment or Question</h3><div id="error_text" class="errors"><h4></h4></div>\
	<textarea class="form-control" id="text1" name="text" rows="5"></textarea></div>\
	<div><div class="row hidden-xs"><div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">\
	<button type="submit" id="submit1" class="btn btn-primary" name="submit">Submit</button></div>\
	<div class="col-lg-10 col-md-10 col-sm-10 col-xs-10"><div id="incomplete" class="errors"><h4></h4></div></div></div>\
	<div class="row visible-xs"><div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><div id="incomplete" class="errors"><h4></h4></div>\
	<button type="submit" id="submit1" class="btn btn-primary" name="submit">Submit</button></div></div>\
	</div></form></div><div class="col-lg-6 col-md-6 col-sm-12 col-xs-12"><div class="more_contact text-center">\
	<h1>You can also contact us at:</h1><h2>(573) 880-3894</h2><h2>chrisganeymedia@gmail.com</h2>\
	</div><img class="monstrato img-responsive center-block" alt="Website Screenshot"\
	src="images/monstrato5.png" /></div></div><div class="row"><div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 visible"><div class="return">\
	<h3><a href="http://chrisganeymedia.com" class="btn btn-default">Main Page</a></h3></div>\
	<div class="copy"><h6>All Rights Reserved 2015 Christopher Ganey</h6></div></div></div>');
	$("html, body").animate({ scrollTop: 0 }, "fast");
}
// checks if hash=#contact when page loads
if(location.hash == '#contact') {
		newPage();
	}
// click handler for link to open contact page	
$( '#contact_pg1,#contact_pg2,#contact_pg3' ).click(function() {
	newPage();
	location.hash='#contact';
	return false; 
});
// validates form	
function validateForm(){
	var name = $('#name1').val();
    var phone = $('#phone1').val();
    var email = $('#email1').val();
    var ftext = $('#text1').val();
	var errors = false;
	
	$('h4','.errors').hide();
	
	if(name == ""){
		errors = true;
		$('#error_name h4').text("*Please enter your name.").show();
		}
	if(name != "" && /[^-.\w+( \w+)*$]/.test(name)){
		errors = true;
		$('#error_name h4').text("*Please enter a valid name.").show();
	}
	if(phone != ""){
		if(!/[0-9]{3}-[0-9]{3}-[0-9]{4}/.test(phone) || phone.length != 12){
		errors = true;	
		$('#error_phone h4').text("*Please enter a valid phone number.").show();
		}
	}
	if(email != ""){
		if(!((email.indexOf(".") > 0) && (email.indexOf("@") > 0)) || /[^a-zA-Z0-9.@_-]/.test(email)){
			errors = true;
			$('#error_email h4').text("*Please enter a valid email address.").show();
		}
	}
	if(phone == "" && email == ""){
		errors = true;
		$('#error_info h4').text("*Please enter a phone number or email address so that we may contact you.").show();
	}
	if(ftext == ""){
		errors = true;
		$('#error_text h4').text("*Please enter your message.").show();
	}
	if(errors == true){
		$('#incomplete h4').text("*Please supply the required values.").show();
	}
	else {
	// If form validates, we hide error messages, retrieve 
	// one more value from the form, and prepare an array for ajax.
	$('h4','.errors').hide();
	var method = $("input[name='method']:checked").val();
	
	var postArray = {};
	postArray["name"] = name;
	postArray["phone"] = phone;
	postArray["email"] = email;
	postArray["text"] = ftext;
	postArray["method"] = method;
	
	// do ajax and process return data
	$.ajax({
    url : "contactpost.php",
	cache: false,
    type: "POST",
    data : postArray,
	dataType: "json",
    success: function(data)
    {
		var i = 0;
		var j = 0;
		if(data[0] == "good"){ // message has been sent, show success message
			$('#message').css('border','').html('<h2>' + data[1] + '</h2>');
			$("html, body").animate({ scrollTop: 0 }, "fast");
		}
		else if(data[0] == "have_errors"){ // input data doesn't validate on server, show error message
			for(i=1,j=2; i < data.length; i++,j++){
				$(data[i] + ' h4').text(data[j]).show();
				i++;
				j++;
			}
			$('#incomplete h4').text("*Please supply the required values.").show();
		}
		else if(data[0] == "notgood"){ // php mail unable to send, show error message
			$('#message').css('border','3px solid #C93033').html('<h2>' + data[1] + '</h2>');
			$('#message h2').css('color','#42368F');
			$("html, body").animate({ scrollTop: 0 }, "fast");
		}
		
    }
	})};
}
// click handler for submit button
$('#2').on('submit','form.fm', function(e) { 
        e.preventDefault();  
		validateForm();
    });
// switches between contact page and homepage on hash change
window.onhashchange = function(event) {
	if(location.hash == ''){
		$('#2').hide();
		$('#1').show();
	}
	else if(location.hash == '#contact') {
		newPage();
	}
};	 
});
