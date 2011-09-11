<?php
require "info.php";
require_once '../SDK/API_Config.php';
require_once '../SDK/OpenTokSDK.php';
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

if($_POST['comm'] == 'create') {
	login_display('Join Session', 'Your New');
}
else if($_POST['comm'] == 'check_input') {
	if($_POST['name'] == "") {
		$err = 'name';
		$arr = array("err"=>$err);
		$output = json_encode($arr);
		echo $output;
	}
	else if($_POST['session'] == "") {
		$err = 'session';
		$arr = array("err"=>$err);
		$output = json_encode($arr);
		echo $output;
	}
	else {
		$arr = array("err"=>'none');
		$output = json_encode($arr);
		echo $output;
	}	
}
else if($_POST['comm'] == 'create_session') {
	$name = $_POST['name'];
	$session = $_POST['session'];
/*else if($_GET['comm'] == 'create_session') {
	$name = $_GET['name'];
	$session = $_GET['session'];	*/
	/**
	 * Connecting to database
	 */
	$connection = mysql_connect($hostname, $user, $pwd);
	if(!$connection) {
		die("Error ".mysql_errno()." : ".mysql_error());
	}
	$db_selected = mysql_select_db($database, $connection);
	if(!$db_selected) {
		die("Error ".mysql_errno()." : ".mysql_error());
	}
	
	//echo "connected to database<br/>";
	
	/**
	 * Create the TokBox variables
	 */
	$tok_apiObj = new OpenTokSDK(API_Config::API_KEY, API_Config::API_SECRET);
	//echo"opentokSDK problem?<br />";
	//echo $_SERVER["REMOTE_ADDR"];
	$tok_session = $tok_apiObj->create_session($_SERVER["REMOTE_ADDR"]);
	//echo"session has been created<br />";
	$tokBox_id = (string) $tok_session->getSessionId();
	$tok_box_token = $tok_apiObj->generate_token();
	//echo"other things<br/>";

	/**
	 * PHP talks to MySQL
	 * 1) add user to database
	 * 2) add session to database
	 * 3) add appropriate ids to relationship table
	 */
	$new_user = "INSERT INTO mock_user (user_id, user_name) VALUES ('NULL','$name')";
	$new_session = "INSERT INTO mock_session (session_id, session_name, tok_id, tok_token) VALUES ('NULL','$session','$tokBox_id','$tok_box_token')";
	submit_info($new_user, $connection, false); // #1
	$user_id = mysql_insert_id($connection);
	submit_info($new_session, $connection, false); // #2
	$session_id = mysql_insert_id($connection);
	
	$relationship = "INSERT INTO mock_session_X_mock_user (session_id, user_id) VALUES ('$session_id','$user_id')";
	submit_info($relationship, $connection, false); // #3
	
	//#4 Create "table" (9 cells) and assign those cells to the session
	$new_cells = "INSERT INTO mock_cell (cell_num, color_id, camera_num) VALUES (1,1,1),(2,1,1),(3,1,1),(4,1,1),(5,1,1),(6,1,1),(7,1,1),(8,1,1),(9,1,1)";
	submit_info($new_cells, $connection, false);
	$top_cell_id = mysql_insert_id($connection);
	
	$session_X_cell = "INSERT INTO mock_session_X_mock_cell (session_id, cell_id) VALUES($session_id, $top_cell_id)";
	for($index = $top_cell_id + 1; $index <= $top_cell_id + 8; $index++) {
		$session_X_cell = $session_X_cell.",($session_id, $index)";
	}
	submit_info($session_X_cell, $connection, false); // #4
	
	
	/**
 	* Close connection
 	*/
	mysql_close($connection);
	
	$arr = array("err"=>'none', "session_id"=>$session_id, "session_name"=>$session, "user_id"=>$user_id, "tokBox_id"=>$tokBox_id, "tokBox_token"=>$tok_box_token);
	$output = json_encode($arr);
	echo $output;
}
else if($_POST['comm'] == 'join') {
	login_display('Join Session', 'The');
}

// Join Session
else if($_POST['comm'] == 'join_session') {
	$name = $_POST['name'];
	$session = $_POST['session'];
	
	/**
	 * Connecting to database
	 */
	$connection = mysql_connect($hostname, $user, $pwd);
	if(!$connection) {
		die("Error ".mysql_errno()." : ".mysql_error());
	}
	$db_selected = mysql_select_db($database, $connection);
	if(!$db_selected) {
		die("Error ".mysql_errno()." : ".mysql_error());
	}
	
	
	/**
	 * PHP talks to MySQL
	 * 2) find session id
	 * If session exists, then
	 * 1) add user to database
	 * 3) add appripriate IDs to relationship table
	 */
	if(!strstr($session, "-")) {
		$arr = array("err"=>'no_session');
		$output = json_encode($arr);
		echo $output;
	}
	else if(strstr($session_array, "-")) {
		$session_array = explode('-', $session);
		if(sizeof($session_array) != 2)  {
			$arr = array("err"=>'no_session');
			$output = json_encode($arr);
			echo $output;
		}
	}
	else {
	$session_array = explode('-', $session);
	$session_id_request = "SELECT session_id, session_name, tok_id, tok_token FROM mock_session WHERE session_name = '$session_array[0]' AND session_id = $session_array[1]"; // #2
	$session_id_request = submit_info($session_id_request, $connection, true);
	while(($rows[] = mysql_fetch_assoc($session_id_request)) || array_pop($rows));
	//$valid = 0;
	foreach ($rows as $row):
		$answer =  "{$row['session_id']} + {$row['session_name']}<br />";
		$tokBox_id = "{$row['tok_id']}";
		$tokBox_token = "{$row['tok_token']}";
	endforeach;
	// Session exists, add user
	if ($answer != "") {
		$new_user = "INSERT INTO mock_user (user_name) VALUES ('$name')";
		submit_info($new_user, $connection, false); // #1
		$user_id = mysql_insert_id($connection);
	
		$relationship = "INSERT INTO mock_session_X_mock_user (session_id, user_id) VALUES ('$session_array[1]','$user_id')"; // #3
		submit_info($relationship, $connection, false);
		
		$arr = array("err"=>'none', "session_id"=>$session_array[1], "session_name"=>$session_array[0], "user_id"=>$user_id, "tokBox_id"=>$tokBox_id, "tokBox_token"=>$tokBox_token);
		$output = json_encode($arr);
		echo $output;
	}
	else {
		$arr = array("err"=>'no_session');
		$output = json_encode($arr);
		echo $output;
	}
	}
	
	

	
}






function login_display($title,$text) {
	echo '<div id="login_create">'.
			$title . '
			<div class="login_form" id="form_create">
				<label id="user_name_label" for="user_name">Your Name</label><br />
				<input type="text" maxlength="25" class="text_field" id="user_name"><br /><br />
				<label id="session_name_label" for="session_name">'.$text.'<br />Session\'s Name</label><br />
				<input type="text" maxlength="100" class="text_field" id="session_name">
			</div>
			<div class="login_button" id="login_button_create_session">let\'s start</div>
			<div class="progress_bar" id="progress_bar_2">
				<div id="progress_ball_1" class="progress_ball"></div>
				<div id="progress_ball_2" class="progress_ball"></div>
				<div id="progress_ball_3" class="progress_ball"></div>
			</div>
		</div>';
}

function submit_info($data, $conn, $return) {
	$result = mysql_query($data,$conn);
	if(!$result) {
		die("Error ".mysql_errno()." : ".mysql_error());
	}
	else if($return == true) {
		return $result;
	}
}
?>