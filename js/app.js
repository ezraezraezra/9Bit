function appStart(session_id, session_name, user_id){
	var $colorHolderPreId = null;
	var $colorHolder = null;
	var $colorHolderId = null;
	var $colorToSend = null;
	var t = null;
	var $cameraIndex = 1;

	updateBoard(session_id, t);
	
	$(".color_board_cell").click(function(){
		$colorHolderPreId = $colorHolderId;
		$colorHolderId = $(this).attr("id");
		$colorHolder = $("#" + $colorHolderId).css("background-color");
		$("#" + $colorHolderPreId).css("border-color", 'transparent');
		$("#" + $colorHolderId).css("border-color", "black");
	});
	
	$(".container_right_board_cell").click(function(){
		clearTimeout(t);
		t = null;
		
		$tempId = $(this).attr("id");

		// CAMERA # 1 (CREATOR OF SESSION)
		
		if($colorHolderId == 'cbc10') {
			var tempString = $tempId.substring(3);
			$("#crb" + tempString + "_v_" + 1).css("z-index", 60);
			$("#crb" + tempString + "_v_2").css("z-index", 20);
			$("#crb" + tempString + "_v_3").css("z-index", 40);
			$cameraIndex = 1;	
		}
		else if($colorHolderId == 'cbc11') {
			var tempString = $tempId.substring(3);
			$("#crb" + tempString + "_v_" + 2).css("z-index", 60);
			$("#crb" + tempString + "_v_1").css("z-index", 20);
			$("#crb" + tempString + "_v_3").css("z-index", 40);
			$cameraIndex = 2;	
		}
		else if($colorHolderId == 'cbc12') {
			var tempString = $tempId.substring(3);
			$("#crb" + tempString + "_v_" + 3).css("z-index", 60);
			$("#crb" + tempString + "_v_2").css("z-index", 20);
			$("#crb" + tempString + "_v_1").css("z-index", 40);
			$cameraIndex = 3;	
		}
		
		$("#" + $tempId).css("background-color", $colorHolder);
		
		// Find cell's number to report to server
		$index = 0;
		while ($tempId.indexOf("" + $index) == -1) {
			$index++;
		}
		$colorToSend = $colorHolder;
		//Tell Server of update
		$.post("php/magic1.php", {
			comm: 'su',
			cell: $index,
			value: $colorToSend,
			camera: $cameraIndex,
			sess_id : session_id,
		}, function(data){
		}, "json").success(function(){
			updateBoard(session_id, t);
		});
	});
	
	// START OF NEW STUFF ADDED
	$("#container_settings_confirm").click(function() {
		$("#container_settings").css("top", -500);
	});
	$("#settings_button").click(function() {
		if ($("#invite_panel").css("top") != "100px") {
			$("#container_settings").css("top", 100);
		}
	});
	// END OF NEW STUFF ADDED
	$("#invite_ok").click(function() {
		$("#invite_panel").css("top", -500);
	});
	$("#invite_button").click(function() {
		if ($("#container_settings").css("top") != "100px") {
			$("#invite_panel").css("top", 100);
		}
	});
	
	$("#invite_session_id").val(session_name + "-" + session_id);
}

function updateBoard(session_id, t){
		$.post("php/magic1.php", {
			comm: 'cu', sess_id : session_id
		}, function(data){
		
			$("#crb1").css("background-color", data.c1);
			cameraChange(1, data.cCam1);
			$("#crb2").css("background-color", data.c2);
			cameraChange(2, data.cCam2);
			$("#crb3").css("background-color", data.c3);
			cameraChange(3, data.cCam3);
			$("#crb4").css("background-color", data.c4);
			cameraChange(4, data.cCam4);
			$("#crb5").css("background-color", data.c5);
			cameraChange(5, data.cCam5);
			$("#crb6").css("background-color", data.c6);
			cameraChange(6, data.cCam6);
			$("#crb7").css("background-color", data.c7);
			cameraChange(7, data.cCam7);
			$("#crb8").css("background-color", data.c8);
			cameraChange(8, data.cCam8);
			$("#crb9").css("background-color", data.c9);
			cameraChange(9, data.cCam9);
			
		}, "json").success(function(){
			if(!t) {
			t = setTimeout("updateBoard("+ session_id +");", 1500);
			}
		});
	}			
			
function cameraChange(index, data) {
	if(data ==1 ) {
			$("#crb" + index + "_v_" + 1).css("z-index", 60);
			$("#crb" + index + "_v_2").css("z-index", 20);
			$("#crb" + index + "_v_3").css("z-index", 40);
			$cameraIndex = 1;	
		}
		else if(data == 2) {
			$("#crb" + index + "_v_" + 2).css("z-index", 60);
			$("#crb" + index + "_v_1").css("z-index", 20);
			$("#crb" + index + "_v_3").css("z-index", 40);
			$cameraIndex = 2;	
		}
		else if(data == 3) {
			$("#crb" + index + "_v_" + 3).css("z-index", 60);
			$("#crb" + index + "_v_2").css("z-index", 20);
			$("#crb" + index + "_v_1").css("z-index", 40);
			$cameraIndex = 3;	
		}
}
