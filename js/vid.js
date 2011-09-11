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

function video(session_num, token_num) {
	//$.getScript("http://staging.tokbox.com/v0.91/js/TB.min.js", function(){
	  $.getScript("http://static.opentok.com/v0.91/js/TB.min.js", function(){
		//var session = TB.initSession("29eaabf3888d2283f805c9c867189749c72737da"); // Previously generated 
		var session = TB.initSession(session_num);
			
			session.addEventListener("sessionConnected", sessionConnectedHandler);
			session.addEventListener("streamCreated", streamCreatedHandler);
			//session.connect(330921, "T1==cGFydG5lcl9pZD0zMzA5MjEmc2RrX3ZlcnNpb249dGJwaHAtdjAuOTEuMjAxMS0wMi0xNCZzaWc9ZTFjOGUzMWQ2NjUyNzM2NWJjMDBkOTc2MWQxZDY4ZTliNmMxNWM1YTpzZXNzaW9uX2lkPSZjcmVhdGVfdGltZT0xMjk5NTQ4MDM2JnJvbGU9cHVibGlzaGVyJm5vbmNlPTEyOTk1NDgwMzYuNDcxMDMyNTMyMTk5"); // API Key & token 
			session.connect(330921, ""+token_num); // API Key & token 
			
			function sessionConnectedHandler(event) {
				 subscribeToStreams(event.streams);
				 //session.publish();
				 var parentDiv = document.getElementById("temp_vid_holder");
				 var stubDiv = document.createElement("div");
				 stubDiv.id = "vid_1_inner";
				 parentDiv.appendChild(stubDiv);

				// Need to publish in order to set up camera
				//
				// Should I have a float div to handle this, then hide it with user action?
				// OR
				// Keep camera on the side? <-- Pref
				 var publisherProps = {width: 200/*140*/, height: 150/*155*/, microphoneEnabled: false};
				 publisher = session.publish(stubDiv.id, publisherProps);
				 
				 var temp_str_id = new String(publisher.id);
				// Remove temp subscribe
				$("#temp_vid_holder").html("");
				var temp_id_array = temp_str_id.split("_");
				var parentDiv = document.getElementById("settings_vid_" + temp_id_array[2]);
							var stubDiv = document.createElement("div");
							stubDiv.id = "vid_3_inner";
							parentDiv.appendChild(stubDiv);
							var publisherProps = {width: 215/*200/*140/*120*/, height: 150/*155/*120*/, microphoneEnabled: false};
				 			publisher = session.publish(stubDiv.id, publisherProps);
							
							publisher.addEventListener('settingsButtonClick', settingsButtonClickHandler);
							//publisher.addEventListener('closeButtonClick', closeButtonClickHandler);
							
							console.log("PUBLISHER NAME IS:"+temp_id_array[2]);
			}
			
			function settingsButtonClickHandler(event) {
    			event.preventDefault();
    
    			var newDiv = document.createElement('div');
    			newDiv.id = 'devicePanel';
    			document.getElementById('devicePanelContainer').appendChild(newDiv);

    			deviceManager = TB.initDeviceManager(330921);
    			devicePanel = deviceManager.displayPanel('devicePanel', publisher);
				devicePanel.addEventListener('closeButtonClick', closeButtonClickHandler);
				$("#devicePanelContainer").css("display", "block");
			}

			function closeButtonClickHandler(event) {
				event.preventDefault();
				$("#devicePanelContainer").css("display", "none");
			}
			
			function streamCreatedHandler(event) {
				//subscribeToStreams(event.streams);
				subscribeToStreams(event.streams)							
			}
			
			// After generating their params, store them and use them when needed?
			function subscribeToStreams(streams) {
					// PUT in code that was removed
					
					for (var i = 0; i < streams.length; i++) {
						var stream = streams[i];
						// Me
						//if (stream.connection.connectionId == session.connection.connectionId) {
							
							var parentDiv = document.getElementById("temp_vid_holder");
							//var parentDiv = document.getElementById("cbc_vid_1");
							var stubDiv = document.createElement("div");
							stubDiv.id = "vid_3_inner";
							parentDiv.appendChild(stubDiv);
							
							var subscriberProps = {
								width: 44,
								height: 44,
								audioEnabled: false
							};
							me = session.subscribe(stream, stubDiv.id, subscriberProps);
							
							var temp_str_id = new String(me.id);
							// Remove temp subscribe
							$("#temp_vid_holder").html("");
							//if (stream.connection.connectionId == session.connection.connectionId) {
								var temp_id_array = temp_str_id.split("_");
								if(!temp_id_array) {
									var temp_id_array = temp_str_id.split(",");
								}
							//}
							//else {
							//	var temp_id_array = temp_str_id.split(",");
							//}
							console.log ("This is the split: "+ temp_id_array);
							
							// This will have to be changed to 13 or 14
							if(temp_id_array[2] == 12 || temp_id_array[2] == 13/**4**/) {
								temp_id_array[2] = 2;
							}
							
							if(temp_id_array[2] == 24 || temp_id_array[2] == 25/**4**/) {
								temp_id_array[2] = 3;
							}
							
							var parentDiv = document.getElementById("cbc_vid_" + temp_id_array[2]);
							var stubDiv = document.createElement("div");
							stubDiv.id = "vid_3_inner";
							parentDiv.appendChild(stubDiv);
							me = session.subscribe(stream, stubDiv.id, subscriberProps);
							
							
							
							//crb1_v_XXX
							var subscriberProps = {
								width: 140,
								height: 155,
								audioEnabled: false
							};
							
							for(index = 1; index <=9; index++) {
								var parentDiv = document.getElementById("crb" + index +"_v_" + temp_id_array[2]);
								//console.log(crb1_v_1);
								var stubDiv = document.createElement("div");
								stubDiv.id = "vid_3_inner";
								parentDiv.appendChild(stubDiv);
								subscriber = session.subscribe(stream, stubDiv.id, subscriberProps);
							}
							
						//$("#vid_4").append($("#vid_3").html());
						//$("#vid_5").html('<object type="application/x-shockwave-flash" id="'+me.id+'" data="http://staging.tokbox.com/v0.91.7.201103041054/flash/f_subscribewidget.swf?partnerId=330921" width="300" height="300">' + $("#"+ me.id).html() + '</object>');
						//}
						
						if (stream.connection.connectionId != session.connection.connectionId) {
							var parentDiv = document.getElementById("settings_vid_" + temp_id_array[2]);
							console.log("NAME IS:"+temp_id_array[2]);
							var stubDiv = document.createElement("div");
							stubDiv.id = "vid_3_inner";
							parentDiv.appendChild(stubDiv);
							var subscriberProps = {
								width: 215,
								height: 150,
								audioEnabled: false
							};
							session.subscribe(stream, stubDiv.id, subscriberProps);
						}
						
						//Add names associated to user video-feed
						$.post('php/magic1.php',
							{comm : 'names'},
							function(data){
								//Put them on the screen
						});
					}
			}
	});
}
