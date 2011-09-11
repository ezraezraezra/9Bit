<?php
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
//require "login.php";

echo '<div id="container_main">
			<div id="container_left">
				<div id="container_left_top">
					<div id="title">9BIT</div>
					<div id="settings_button" class="login_button" style="margin-top: -20px;">settings</div>
					<div id="invite_button" class="login_button" style="margin-top: 5px;">invite X more</div>
				</div>
				<div id="container_left_bottom">
					<div id="color_board_name">Choose a color<br/> or camera!</div>
					
					<div id="color_board"><div id="cbc1" class="color_board_cell"></div><div id="cbc2" class="color_board_cell"></div><div id="cbc3" class="color_board_cell"></div>
							<div id="cbc4" class="color_board_cell"></div><div id="cbc5" class="color_board_cell"></div><div id="cbc6" class="color_board_cell"></div>
							<div id="cbc7" class="color_board_cell"></div><div id="cbc8" class="color_board_cell"></div><div id="cbc9" class="color_board_cell"></div>
					</div>
					<div id="container_cameras">
						<div class="color_board_cell_vid" style="margin-top:19px;margin-left:19px;">
							<div class="color_board_cell_vid" id="cbc_vid_1" style="position:absolute; margin-left:-2px; margin-top: -2px; background: black;"></div>
							<div class="color_board_cell" id="cbc10" style="position:absolute;margin-left:-2px;margin-top:-2px;background:transparent"></div>
						</div>
						<div class="color_board_cell_vid" style="margin-top:19px;">
							<div class="color_board_cell_vid" id="cbc_vid_2" style="position:absolute; margin-left:-2px; margin-top: -2px; background: blue;"></div>
							<div class="color_board_cell" id="cbc11" style="position:absolute;margin-left:-2px;margin-top:-2px;background:transparent"></div>
						</div>
						<div class="color_board_cell_vid" style="margin-top:19px;">
							<div class="color_board_cell_vid" id="cbc_vid_3" style="position:absolute; margin-left:-2px; margin-top: -2px; background: white;"></div>
							<div class="color_board_cell" id="cbc12" style="position:absolute;margin-left:-2px;margin-top:-2px;background:transparent"></div>
						</div>
					</div>
				</div>
			</div>
			<div id="container_right">
				<div id="container_right_board">
					<div class="holder_container_right_board_cell" style="margin-left:19px; margin-top:19px;">
						<div id="crb1_v_1" class="holder_container_right_board_cell" style="position:absolute; margin-top:-2px; margin-left:-2px;background:black;"></div>
						<div id="crb1_v_2" class="holder_container_right_board_cell" style="position:absolute; margin-top:-2px; margin-left:-2px;background:blue;"></div>
						<div id="crb1_v_3" class="holder_container_right_board_cell" style="position:absolute; margin-top:-2px; margin-left:-2px;background:white;"></div>
						<div id="crb1" class="container_right_board_cell" style="position:absolute; margin:0px; margin-top:-2px; margin-left:-2px; background-color:green;"></div>
					</div>
					
					<div class="holder_container_right_board_cell" style="margin-top:19px;">
						<div id="crb2_v_1" class="holder_container_right_board_cell" style="position:absolute; margin-top:-2px; margin-left:-2px;background:black;"></div>
						<div id="crb2_v_2" class="holder_container_right_board_cell" style="position:absolute; margin-top:-2px; margin-left:-2px;background:blue;"></div>
						<div id="crb2_v_3" class="holder_container_right_board_cell" style="position:absolute; margin-top:-2px; margin-left:-2px;background:white;"></div>
						<div id="crb2" class="container_right_board_cell" style="position:absolute; margin:0px; margin-top:-2px; margin-left:-2px; background-color:green;"></div>
					</div>
					
					<div class="holder_container_right_board_cell" style="margin-top:19px;">
						<div id="crb3_v_1" class="holder_container_right_board_cell" style="position:absolute; margin-top:-2px; margin-left:-2px;background:black;"></div>
						<div id="crb3_v_2" class="holder_container_right_board_cell" style="position:absolute; margin-top:-2px; margin-left:-2px;background:blue;"></div>
						<div id="crb3_v_3" class="holder_container_right_board_cell" style="position:absolute; margin-top:-2px; margin-left:-2px;background:white;"></div>
						<div id="crb3" class="container_right_board_cell" style="position:absolute; margin:0px; margin-top:-2px; margin-left:-2px; background-color:green;"></div>
					</div>
					
					<div class="holder_container_right_board_cell" style="margin-left:19px;">
						<div id="crb4_v_1" class="holder_container_right_board_cell" style="position:absolute; margin-top:-2px; margin-left:-2px;background:black;"></div>
						<div id="crb4_v_2" class="holder_container_right_board_cell" style="position:absolute; margin-top:-2px; margin-left:-2px;background:blue;"></div>
						<div id="crb4_v_3" class="holder_container_right_board_cell" style="position:absolute; margin-top:-2px; margin-left:-2px;background:white;"></div>
						<div id="crb4" class="container_right_board_cell" style="position:absolute; margin:0px; margin-top:-2px; margin-left:-2px; background-color:green;"></div>
					</div>
					
					<div class="holder_container_right_board_cell">
						<div id="crb5_v_1" class="holder_container_right_board_cell" style="position:absolute; margin-top:-2px; margin-left:-2px;background:black;"></div>
						<div id="crb5_v_2" class="holder_container_right_board_cell" style="position:absolute; margin-top:-2px; margin-left:-2px;background:blue;"></div>
						<div id="crb5_v_3" class="holder_container_right_board_cell" style="position:absolute; margin-top:-2px; margin-left:-2px;background:white;"></div>
						<div id="crb5" class="container_right_board_cell" style="position:absolute; margin:0px; margin-top:-2px; margin-left:-2px; background-color:green;"></div>
					</div>
					
					<div class="holder_container_right_board_cell">
						<div id="crb6_v_1" class="holder_container_right_board_cell" style="position:absolute; margin-top:-2px; margin-left:-2px;background:black;"></div>
						<div id="crb6_v_2" class="holder_container_right_board_cell" style="position:absolute; margin-top:-2px; margin-left:-2px;background:blue;"></div>
						<div id="crb6_v_3" class="holder_container_right_board_cell" style="position:absolute; margin-top:-2px; margin-left:-2px;background:white;"></div>
						<div id="crb6" class="container_right_board_cell" style="position:absolute; margin:0px; margin-top:-2px; margin-left:-2px; background-color:green;"></div>
					</div>
					
					<div class="holder_container_right_board_cell" style="margin-left:19px;">
						<div id="crb7_v_1" class="holder_container_right_board_cell" style="position:absolute; margin-top:-2px; margin-left:-2px;background:black;"></div>
						<div id="crb7_v_2" class="holder_container_right_board_cell" style="position:absolute; margin-top:-2px; margin-left:-2px;background:blue;"></div>
						<div id="crb7_v_3" class="holder_container_right_board_cell" style="position:absolute; margin-top:-2px; margin-left:-2px;background:white;"></div>
						<div id="crb7" class="container_right_board_cell" style="position:absolute; margin:0px; margin-top:-2px; margin-left:-2px; background-color:green;"></div>
					</div>
					
					<div class="holder_container_right_board_cell">
						<div id="crb8_v_1" class="holder_container_right_board_cell" style="position:absolute; margin-top:-2px; margin-left:-2px;background:black;"></div>
						<div id="crb8_v_2" class="holder_container_right_board_cell" style="position:absolute; margin-top:-2px; margin-left:-2px;background:blue;"></div>
						<div id="crb8_v_3" class="holder_container_right_board_cell" style="position:absolute; margin-top:-2px; margin-left:-2px;background:white;"></div>
						<div id="crb8" class="container_right_board_cell" style="position:absolute; margin:0px; margin-top:-2px; margin-left:-2px; background-color:green;"></div>
					</div>
					
					<div class="holder_container_right_board_cell" >
						<div id="crb9_v_1" class="holder_container_right_board_cell" style="position:absolute; margin-top:-2px; margin-left:-2px;background:black;"></div>
						<div id="crb9_v_2" class="holder_container_right_board_cell" style="position:absolute; margin-top:-2px; margin-left:-2px;background:blue;"></div>
						<div id="crb9_v_3" class="holder_container_right_board_cell" style="position:absolute; margin-top:-2px; margin-left:-2px;background:white;"></div>
						<div id="crb9" class="container_right_board_cell" style="position:absolute; margin:0px; margin-top:-2px; margin-left:-2px; background-color:green;"></div>
					</div>
				</div>
			</div>
			<div id="container_settings">
				Camera Settings & Such
				<div id="container_settings_cameras">
					<div class="settings_cameras" id="settings_vid_1"></div>
					<div class="settings_cameras" id="settings_vid_2"></div>
					<div class="settings_cameras" id="settings_vid_3"></div>
				</div>
				<div id="settings_name_container">
					<div class="settings_vid_name" id="s_v_n_1">User 1</div>
					<div class="settings_vid_name" id="s_v_n_2">User 2</div>
					<div class="settings_vid_name" id="s_v_n_3">User 3</div>
				</div>
				<div id="container_settings_confirm">
					Lets Go!
				</div>
			</div>
			<div id="invite_panel">
				INVITE MORE FOLKS!<br />
				that\'s right, invite X more folks to this session<br/>
				just give them this session id:<br />
				<input type="text" id="invite_session_id" class="text_field" style="margin-top:15px;" readonly="readonly" /><br /> 
				<div id="invite_ok">
					lets go back
				</div>
			</div>
			<div id="devicePanelContainer"></div>
			<div id="temp_vid_holder"></div>
		</div>
		<a href="http://ezraezraezra.com" target="_blank"><img border="0" alt="Ezra Velazquez logo" src="img/ezra_logo_9bit.png" id="developer"/></a>';

