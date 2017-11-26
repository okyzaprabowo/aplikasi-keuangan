$(document).ready(	
	function() {
		var $container = $(".container");
		$container.wtListRotator({
					screen_width:470,
					screen_height:300,
					item_width:250,
					item_height:75,
					item_display:4,
					list_align:"right",
					scroll_type:"mouse_move",
					auto_start:true,
					delay:7000,
					transition:"random",
					transition_speed:800,
					display_playbutton:true,
					display_number:true,
					display_timer:true,
					display_arrow:true,
					display_thumb:true,
					display_scrollbar:true,
					pause_mouseover:false,
					cpanel_mouseover:false,					
					text_mouseover:false,
					text_effect:"fade",
					text_sync:true,
					cpanel_align:"BR",
					timer_align:"bottom",
					move_one:false,
					auto_adjust:true,
					shuffle:true,
					block_size:75,
					vert_size:50,
					horz_size:50,
					block_delay:35,
					vstripe_delay:90,
					hstripe_delay:180		
				});

		var $transitions =	$("#transitions");
		var $textEffects =	$("#texteffects");
		var $scrollType =	$("#scrolltype");
		
		var $thumbCB = 		$("#thumb-cb");
		var $playBtnCB = 	$("#playbutton-cb");
		var $numCB 	= 		$("#num-cb");
		var $timerCB = 		$("#timer-cb");
		var $scrollbarCB = 	$("#scrollbar-cb");
		
		var $pauseCB = 	$("#pause-cb");
		var $cpanelCB = $("#cpanel-cb");
		var $textCB = 	$("#text-cb");
		
		$transitions.val("random").change(
			function() {
				$container.setTransition($(this).val());
			}
		);
		
		$textEffects.val("fade").change(
			function() {
				$container.setTextEffect($(this).val());
			}
		);
		
		$scrollType.val("mouse_move").change(
			function() {
				$container.setNav($(this).val());
			}
		);
		
		$("input#align-left").attr("checked", true);
		$("input[name='list-align']").change(
			function() {		
				var val = $(this).filter(":checked").val();
				$container.setListAlign(val);
			}
		);
		
		$thumbCB.attr("checked", "checked").change(
			function() {
				$container.setThumbs($(this).filter(":checked").val());
			}
		);		
		
		$scrollbarCB.attr("checked", "checked").change(
			function() {
				var val = $(this).filter(":checked").val();
				$container.setScrollbar(val);
			}
		);
		
		$playBtnCB.attr("checked", "checked").change(
			function() {
				var val = $(this).attr("checked");
				$container.setPlayButton(val);
				$cpanelCB.attr("disabled", !val && !$numCB.attr("checked"));
			}				
		);
		
		$numCB.attr("checked", "checked").change(
			function() {
				var val = $(this).attr("checked");
				$container.setNumber(val);
				$cpanelCB.attr("disabled", !val && !$playBtnCB.attr("checked"));
			}				
		);		
		
		$timerCB.attr("checked", "checked").change(
			function() {
				$container.setTimerBar($(this).attr("checked"));	
			}				
		);						
		
		$pauseCB.attr("checked", "").change(
			function() {
				$container.setMouseoverPause($(this).attr("checked"));
			}				
		);		
		
		$textCB.attr("checked", "").change(
			function() {
				$container.setMouseoverText($(this).attr("checked"));
			}				
		);
		
		$cpanelCB.attr("checked", "").change(
			function() {
				$container.setMouseoverCP($(this).attr("checked"));
			}				
		);				
	}
);