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
function info() {
	$("#container_login").fadeOut('slow', function() {
		$.post('php/info_page.php',
			function(data) {
				$("#container_overall").append(data);
				$("#go_back_button").fadeIn("slow");
				$("#info_page").fadeIn("slow");
				
				$("#go_back_button").click(function() {
					$("#go_back_button").fadeOut("slow");
					$("#info_page").fadeOut("slow", function() {
						$("#container_login").fadeIn("slow");
					});
				});
			});
	});
}