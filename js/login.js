/*
 * Project:     9Bit
 * Description: Web video conference art game
 * Website:     http://ezraezraezra.com/9bit
 * 
 * Author:      Ezra Velazquez
 * Website:     http://ezraezraezra.com
 * Date:        March 2011
 * 
 */
var $widget = null;
	var $check_input = null;
	var $final_action = null;

function login(user_action) {
	//var $widget = null;
	//var $check_input = null;
	//var $final_action = null;
	
	if(user_action == 'create') {
		// name vars here
		$widget = 'create';
		$final_action = 'create_session';
		
	}
	else if(user_action == 'join') {
		// name vars here
		$widget = 'join';
		$final_action = 'join_session';
	}
	
	$("#login_intro").fadeOut('slow', function(){
							$.post('php/login.php',
								{comm : $widget}, 
								function(data){
									//$("#progress_bar_1").fadeOut("fast", function() {
									$("#progress_bar_1").fadeOut("fast");
										$("#container_login").html(data);
									//});
									
							})
							
							// Once new code snippet is loaded, we can listen for it's events
							.success(function(){
								//$("#progress_bar_1").fadeOut("fast", function() {
									//console.log("HERE");
									//alert("H");
									$("#login_create").fadeIn('slow');
									$("#user_name").focus();
								//});
								//$("#login_create").fadeIn('slow');
								//$("#user_name").focus();
								// Create Session Button Pressed
								$("#session_name").keydown(check_for_enter);
								$("#login_button_create_session").click(function () {
									// Was here before
									check_entry();	
								});
							});
							//Load bar for between first options & second options
							$("#progress_bar_1").css("display", "block");
							
							
						});
						
	//$("#session_name").keydown(check_for_enter);
}

function check_for_enter(event) {
	if(event.keyCode == 13) {
		check_entry();
	}
}

function check_entry() {
	// First error check the form
									$.post('php/login.php',
										{comm : 'check_input', name : $("#user_name").val(), session : $("#session_name").val()},
										function(data){
											if(data.err == 'session') {
												$("#session_name_label").css("color", "red");
												$("#session_name").val();
												$("#session_name").focus();
												$("#user_name_label").css("color", "white");
											}
											else if (data.err == 'name') {
												$("#user_name_label").css("color", "red");
												$("#user_name").val();
												$("#user_name").focus();
												$("#session_name_label").css("color", "white");
											}
											else if (data.err = 'none') {
												$("#session_name_label").css("color", "white");
												$("#user_name_label").css("color", "white");
												// REMOVE BUTTON SO THEY CAN"T CONTINUE CLICKING
												$("#login_button_create_session").fadeOut("fast", function() {
													$("#progress_bar_2").fadeIn("fast");
												});
												// Create MYSQL entry
												var sess_id = null;
												var user_id = null;
												$.post('php/login.php',
														{comm: $final_action, name: $("#user_name").val(), session : $("#session_name").val()},
														// Remove login widget
														function(data) {
															if (data.err == 'none') {
																var sess_id = data.session_id;
																var sess_name = data.session_name;
																var user_id = data.user_id;
																var tok_id = data.tokBox_id;
																var tok_token = data.tokBox_token;
																$("#container_login").fadeOut("slow", function(){
																	//alert(data);
																	//GO TO APP
																	
																	start_app(sess_id, sess_name, user_id, tok_id, tok_token);
																	
																});
															}
															else if (data.err == 'no_session') {
																$("#session_name_label").css("color", "red");
																$("#session_name").val("");
																$("#session_name").focus();
																$("#progress_bar_2").fadeOut("fast", function() {
																	$("#login_button_create_session").fadeIn("fast");
																});
																
															}
														},
														"json");
												
											}
										}, "json");
}


//Load the actual app
				function start_app(session_id, session_name, user_id, tokBox_id, tokBox_token) {
					$.post('php/app.php',
							{session : session_id, user : user_id},
							function(data) {
								$("body").html(data);
								$.getScript("js/app.js", function() {
									appStart(session_id, session_name, user_id);
								});
								
							})
							.success(function() {
								$("#container_main").fadeIn("slow", function() {
									$.getScript("js/vid.js", function(){
										video(tokBox_id,tokBox_token);
									});
								});
								
							});
				};