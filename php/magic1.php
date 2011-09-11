<?php
	require "info.php";
	
	/**
	 * Connect to Server
	 */
	$connection = mysql_connect($hostname, $user, $pwd);
	if(!connection) {
		die("Error ".mysql_errno()." : ".mysql_error());
	}
	$db_selected = mysql_select_db($database, $connection);
	if(!$db_selected) {
		die("Error ".mysql_errno()." : ".mysql_error());
	}

	if($_POST['comm'] == 'su') {
		$cell_num = "". $_POST['cell'];
		$cell_color = "". $_POST['value'];
		$camera_number = "". $_POST['camera'];
		$session_id = "". $_POST['sess_id'];
		//$cell_num = (int) $cell_num_string;
		// Yeah subqueries!
		$SqlStatement = "UPDATE mock_cell, mock_session_X_mock_cell, mock_color 
						SET mock_cell.color_id = (SELECT color_id 
												FROM mock_color 
												WHERE color_name = \"$cell_color\") 
						WHERE cell_num = $cell_num 
						AND mock_session_X_mock_cell.session_id = $session_id 
						AND mock_session_X_mock_cell.cell_id = mock_cell.cell_id;";
		
		
		
		
//		"UPDATE mock_cell 
//						SET color_id = 
//							(SELECT color_id 
//							FROM mock_color 
//							WHERE color_name = \"$cell_color\")
//						WHERE cell_num = $cell_num";
		$result = mysql_query($SqlStatement,$connection);
		if (!$result) {
			die("Error " . mysql_errno() . " : " . mysql_error());
		}
		
		$SqlStatement = "UPDATE mock_cell, mock_session_X_mock_cell, mock_color 
						SET mock_cell.camera_num = $camera_number 
						WHERE cell_num = $cell_num 
						AND mock_session_X_mock_cell.session_id = $session_id 
						AND mock_session_X_mock_cell.cell_id = mock_cell.cell_id;";
		$result = mysql_query($SqlStatement,$connection);
		if (!$result) {
			die("Error " . mysql_errno() . " : " . mysql_error());
		}
		
		
		
		
		$arr = array("v1"=>$cell_color, "camera"=>$camera_number);
		echo json_encode($arr);	
	}
	else if($_POST['comm'] == 'cu') {
		$session_id = "". $_POST['sess_id'];
		$SqlStatement = "SELECT cell_num, color_name, camera_num 
						FROM mock_color, mock_cell, mock_session_X_mock_cell 
						WHERE mock_session_X_mock_cell.session_id = $session_id 
						AND mock_cell.cell_id = mock_session_X_mock_cell.cell_id 
						AND mock_cell.color_id = mock_color.color_id";
		$result = mysql_query($SqlStatement,$connection);
		if (!$result) {
			die("Error " . mysql_errno() . " : ". mysql_error());
		}
		while(($rows[] = mysql_fetch_assoc($result)) || array_pop($rows));
		$arr = array();
		foreach($rows as $row) {
			//$arr["c{$row['cell_num']}"] = "{$row['color_name']}";
			//$arr = array("c{$row['cell_num']}"=>"{$row['color_name']}", "cCam{$row['cell_num']}"=>"{$row['camera_num']}");
			$arr["c{$row['cell_num']}"] = "{$row['color_name']}";
			$arr["cCam{$row['cell_num']}"] = "{$row['camera_num']}";
		} 
		echo json_encode($arr);
	}
	
	else if($_POST['comm'] == 'names') {
		$SqlStatement = "SELECT";
	}
	
	
	/**
	 * Disconnect from Server
	 */
	mysql_close($connection);
	
	
	
	
	
	
	

?>