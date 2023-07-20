<style>
	.card-chat{
	width: 300px;
	border: none;
	border-radius: 15px;
	background-color: #EFEFEF;
	}
	.card-body {
		margin-bottom: 25px;
	}
	.adiv{
		background: red;
		border-radius: 15px;
		border-bottom-right-radius: 0;
		border-bottom-left-radius: 0;
		font-size: 12px;
		height: 46px;
	}
	.chat{
		border: none;
		background: #fff;
		font-size: 12px;
		margin-left: 25px;
		border-radius: 10px;
	}
	.chat-right{
		border: none;
		background: #fff;
		font-size: 12px;
		margin-left: auto;
		border-radius: 15px;
		padding: 12px;
		display: table;
	}
	.chat-left{
		border: none;
		background: #D9D9D9;
		font-size: 12px;
		margin-right: auto;
		border-radius: 15px;
		padding: 12px;
		display: table;
	}

	.chat-date{
		font-size: 12px;
		border-radius: 20px;
	}
	.bg-white-chat{
		border: 1px solid #E7E7E9;
		font-size: 12px;
		border-radius: 20px;
	}
	.myvideo img{
		border-radius: 20px
	}
	.chat-name{
		font-size: 14px;
	}
	.chat-body-db{
		background-color: #d9d9d9;
	}
	.form-control-chat{
	border-radius: 6px;
	font-size: 12px;
	height: 40px;
	border: none;
    overflow: auto;
    outline: none;
    -webkit-box-shadow: none;
    -moz-box-shadow: none;
    box-shadow: none;
    resize: none; /*remove the resize handle on the bottom right*/
	}
	.form-control-chat:focus{
		box-shadow: none;
		}
	.form-control-chat::placeholder{
		font-size: 12px;
		color: #C4C4C4;
	}
</style>

<?php $this->load->view($template['partials_sidebar_dashboard']); ?>
<input type="hidden" class="txt_csrfname" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>

<!-- Page Content  -->
<div class="container-fluid">
<div class="row">
	<div class="col-11 col-md-7 mx-auto px-0">
		<div class="col pt-4 mr-0 bg-indoconnex" >
			<div class="row">
				<div class="col-4">
					<div class="card">
						<div class="card-body">
								<div class="row">
									<div class="input-group">
										<span class="input-group-text bg-white border-end-0 rounded-pill-left" id="search-navbar" style="background: #F2F4F8 !important;">
											<span class="material-icons text-muted ">search</span>
										</span>
										<input style="background: #F2F4F8;" onkeyup="searchUser()" name="q" class="form-control me-2 border-start-0 rounded-pill-right" id="myInput" name="q" type="search" placeholder="Search" aria-label="Search" autocomplete="off">
									</div>
								</div>
								<div class="user_head" id="user_head" style="height:400px; overflow-y: scroll;"></div>
						</div>
					</div>
				</div>
				<div class="col-8">
					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col">
									<div class="d-flex align-items-center">
										<div class="flex-shrink-0">
											<img id="user_receiver_photo_profile" class='rounded-circle border feed-user-img' alt='img'>
										</div>
										<div class="flex-grow-1 ms-2 flex-column d-flex">
											<a href="<?php echo site_url('post/'.$this->session->userdata('username')) ?>" class="text-prussianblue fw-bold"><span id="user_receiver_live"></span></a>
										</div>
									</div>
								</div>
							</div>
							<div class="row mt-3">
								<div class="col">
									<input type="hidden" id="receiver_id_user">
									<div id="chat_body" style="height:318px; overflow-y: scroll;background: #EFEFEF;"></div>
								</div>
							</div>
							<div class="row mt-1">
								<div class="col">
									<div class="input-group" style="margin-bottom: 25px; background: #F2F4F8;">
										<textarea style="background: #F2F4F8; width: 90%;" class="form-control-chat emoji" placeholder="Type your message" id="box-message"></textarea>										
										<button style="background: #F2F4F8 !important; height: 40px;display: flex;position: absolute;left: 92%;" type="button" class="btn input-group-text" onclick="sendChat()"><i class="fas fa-paper-plane"></i></button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>


<?php
$this->load->view($template['partials_footer']);
$this->load->view($template['partials_sidebar_ads']);
?>

<!-- Emoji -->
<script src='<?php echo theme_user_locations(); ?>plugins/emoji-picker-input/inputEmoji.js'></script>


<!-- Pusher -->
<script src="https://js.pusher.com/7.2/pusher.min.js"></script>

<script>
$(function() {
	var receiver_id = $("#receiver_id_user").val();
	var rec_id = localStorage.getItem("receiver_id_user");
	var receiver_name_user = localStorage.getItem("receiver_name_user");
	$("#user_receiver_live").html(receiver_name_user);
	if (rec_id) {
		load_chat_data(rec_id, 'yes');
	}

	$.ajax({
		url: "<?php echo site_url('message/histories_dashboard_chat');?>",
		method:"GET",
		data:{},
		dataType:"html",
	}).done(
		function (data) {
			$('#user_head').html(data);
		}
	);
})
	// Enable pusher logging - don't include this in production
    // Pusher.logToConsole = true;

    var pusher = new Pusher("<?php echo PUSHER_KEY ?>", {
    	cluster: 'ap1'
    });

    var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function(data) {
        var receiver_id = $("#receiver_id_user").val();
        var rec_id = localStorage.getItem("receiver_id_user");
        var receiver_name_user = localStorage.getItem("receiver_name_user");
        $("#user_receiver_live").html(receiver_name_user);
        if (data.message === 'success') {
			$.ajax({
				url: "<?php echo site_url('message/histories_dashboard_chat');?>",
				method:"GET",
				data:{},
				dataType:"html",
			}).done(
				function (data) {
					$('#user_head').html(data);
				}
			);

            if (rec_id) {
                load_chat_data(rec_id, 'yes');
            }
        }
    });

	function searchUser(){
		var input, filter, user_child, a, i, txtValue;
		input = document.getElementById("myInput");
		filter = input.value.toUpperCase();
		user_head = document.getElementById("user_head");
		user_child = user_head.querySelectorAll('#user_child');
		for (i = 0; i < user_child.length; i++) {
			a = user_child[i].querySelectorAll("#user_get")[0];
			txtValue = a.textContent || a.innerText;
			if (txtValue.toUpperCase().indexOf(filter) > -1) {
            user_child[i].style.display = "";
			} else {
				user_child[i].style.display = "none";
			}
		}
	}

	function user_chat_db(id){
		$("#receiver_id_user").val(id);
		localStorage.setItem("receiver_id_user", id);
		var csrfName = $(".txt_csrfname").attr("name"); // Value specified in $config['csrf_token_name']
		var csrfHash = $(".txt_csrfname").val();
		var receiver_id = id;
		$.ajax({
			url: "<?php echo site_url('message/request_send');?>",
			method:"POST",
			data: { receiver_id: receiver_id, [csrfName]: csrfHash },
			beforeSend:function()
			{

			},
			success:function(data)
			{
				const res = JSON.parse(data);
				for (const key in res){
					$('#user_receiver_photo_profile').attr('src', res[key].user_receiver_photo_profile);
					$("#user_receiver_live").html(res[key].user_receiver_live);
					localStorage.setItem("receiver_name_user", res[key].user_receiver_live);
					load_chat_data(res[key].user_receiver_live_id, 'yes');
				}
			}
		})
		// document.getElementById("myForm").style.display = "block";
	}

	function sendChat() {
		var csrfName = $(".txt_csrfname").attr("name"); // Value specified in $config['csrf_token_name']
		var csrfHash = $(".txt_csrfname").val();
		var message   = $("#box-message").val();
		var receiver_id = $("#receiver_id_user").val();
		var rec_id = localStorage.getItem("receiver_id_user");
		var keycode = (event.keyCode ? event.keyCode : event.which);

		if (! message.trim()) {
			return;
		}
		
		$.ajax({
			url: "<?php echo site_url('message/message_send');?>",
			type: "POST",
			data: { message: message, receiver_id: rec_id, [csrfName]: csrfHash },
			timeout: 5000,
			dataType: "JSON",
			beforeSend: function (params) {
				
			},
		}).done(
			function (data) {
				// var html = '';
				// for(var count = 0; count < data.length; count++)
				// {
				// html += '<div class="row" style="margin-left:0; margin-right:0">';
				// if(data[count].message_direction == 'right')
				// {
				// html += `<div class="p-3">
				// <div class="d-flex flex-row justify-content-end">
				// 			<img src="`+data[count].user_photo_profile+`" class="rounded-circle border feed-user-img mb-1">
				// 			<div class="chat-date text-sm ml-2 p-2">`+data[count].user_sender+`</div>
				// 			<div class="chat-date text-sm ml-2 p-2">`+data[count].chat_messages_datetime+`</div>
						
				// 		</div>
				// 		<div class="chat-right ml-2 p-3">`+data[count].chat_messages_text+`</div>
				// 		</div>`;
				// }
				// else
				// {
				// html += `<div class="p-3">
				// <div class="d-flex flex-row justify-content-start">
				// 			<img src="`+data[count].user_photo_profile+`" class="rounded-circle border feed-user-img mb-1">
				// 			<div class="chat-date text-sm ml-2 p-2">`+data[count].user_sender+`</div>
				// 			<div class="chat-date text-sm ml-2 p-2">`+data[count].chat_messages_datetime+`</div>
						
				// 		</div>
				// 		<div class="chat-left ml-2 p-3">`+data[count].chat_messages_text+`</div>
				// 		</div>`;
				// }
				// html += '</div>';
				// }
				// $('#chat_body').html(html);
				$('#chat_body').scrollTop($('#chat_body')[0].scrollHeight);
				$("#box-message").val('');
			}
		);
	}

	$('#box-message').keypress(function(event){
		var csrfName = $(".txt_csrfname").attr("name"); // Value specified in $config['csrf_token_name']
		var csrfHash = $(".txt_csrfname").val();
		var message   = $("#box-message").val();
		var receiver_id = $("#receiver_id_user").val();
		var rec_id = localStorage.getItem("receiver_id_user");
		var keycode = (event.keyCode ? event.keyCode : event.which);
		if (! message.trim()) {
			return;
		}
		if(keycode == '13'){
		$.ajax({
			url: "<?php echo site_url('message/message_send');?>",
			type: "POST",
			data: { message: message, receiver_id: rec_id, [csrfName]: csrfHash },
			timeout: 5000,
			dataType: "JSON",
			beforeSend: function (params) {
				
			},
		}).done(
			function (data) {
				// var html = '';
				// for(var count = 0; count < data.length; count++)
				// {
				// html += '<div class="row" style="margin-left:0; margin-right:0">';
				// if(data[count].message_direction == 'right')
				// {
				// html += `<div class="p-3">
				// <div class="d-flex flex-row justify-content-end">
				// 			<img src="`+data[count].user_photo_profile+`" class="rounded-circle border feed-user-img mb-1">
				// 			<div class="chat-date text-sm ml-2 p-2">`+data[count].user_sender+`</div>
				// 			<div class="chat-date text-sm ml-2 p-2">`+data[count].chat_messages_datetime+`</div>
						
				// 		</div>
				// 		<div class="chat-right ml-2 p-3">`+data[count].chat_messages_text+`</div>
				// 		</div>`;
				// }
				// else
				// {
				// html += `<div class="p-3">
				// <div class="d-flex flex-row justify-content-start">
				// 			<img src="`+data[count].user_photo_profile+`" class="rounded-circle border feed-user-img mb-1">
				// 			<div class="chat-date text-sm ml-2 p-2">`+data[count].user_sender+`</div>
				// 			<div class="chat-date text-sm ml-2 p-2">`+data[count].chat_messages_datetime+`</div>
						
				// 		</div>
				// 		<div class="chat-left ml-2 p-3">`+data[count].chat_messages_text+`</div>
				// 		</div>`;
				// }
				// html += '</div>';
				// }
				// $('#chat_body').html(html);
				$('#chat_body').scrollTop($('#chat_body')[0].scrollHeight);
				$("#box-message").val('');
			}
		);
		}
	});

	// setInterval(function(){
	// var receiver_id = $("#receiver_id_user").val();
	// var rec_id = localStorage.getItem("receiver_id_user");
	// var receiver_name_user = localStorage.getItem("receiver_name_user");
	// $("#user_receiver_live").html(receiver_name_user);
	// if(rec_id)
	// {
	// 	load_chat_data(rec_id, 'yes');
	// }
	// 	// check_chat_notification();
	// }, 5000);

	function load_chat_data(receiver_id, update_data){
		var csrfName = $(".txt_csrfname").attr("name"); // Value specified in $config['csrf_token_name']
		var csrfHash = $(".txt_csrfname").val();

		$.ajax({
			url: "<?php echo site_url('message/load_chat_data');?>",
			method:"POST",
			data:{receiver_id:receiver_id, update_data:update_data, [csrfName]: csrfHash},
			dataType:"html",
			beforeSend: function (params) {
			},
		}).done(
			function (data) {
				// var html = '';
				// for(var count = 0; count < data.length; count++)
				// {
				// html += '<div class="row" style="margin-left:0; margin-right:0">';
				// if(data[count].message_direction == 'right')
				// {
				// html += `
				// <div class="p-3">
				// <div class="d-flex flex-row justify-content-end">
				// 			<img src="`+data[count].user_photo_profile+`" class="rounded-circle border feed-user-img mb-1">
				// 			<div class="chat-date text-sm ml-2 p-2">`+data[count].user_sender+`</div>
				// 			<div class="chat-date text-sm ml-2 p-2">`+data[count].chat_messages_datetime+`</div>
						
				// 		</div>
				// 		<div class="chat-right ml-2 p-3">`+data[count].chat_messages_text+`</div>
				// 		</div>
				// 		`;
				// }
				// else
				// {
				// $('#user_receiver_photo_profile').attr('src', data[count].user_photo_profile);
				// html += `<div class="p-3">
				// <div class="d-flex flex-row justify-content-start">
				// 			<img src="`+data[count].user_photo_profile+`" class="rounded-circle border feed-user-img mb-1">
				// 			<div class="chat-date text-sm ml-2 p-2">`+data[count].user_sender+`</div>
				// 			<div class="chat-date text-sm ml-2 p-2">`+data[count].chat_messages_datetime+`</div>
						
				// 		</div>
				// 		<div class="chat-left ml-2 p-3">`+data[count].chat_messages_text+`</div>
				// 		</div>`;
				// }
				// html += '</div>';
				// }
				$('#chat_body').html(data);
				$('#chat_body').scrollTop($('#chat_body')[0].scrollHeight);
			}
		);
	}


</script>
<script>
	$(function () {
		$('.emoji').emoji({
			place: 'before',
			button:'&#x1F642;',
			listCSS: {
                position:'',
                border:'none',
                display:'none', 
                // width: '300px',
                height: '150px',
                overflowY: 'scroll'
			},
			rowSize: 10,
			emojis: ['&#x1F642;','&#x1F641;','&#x1f600;','&#x1f601;','&#x1f602;','&#x1f603;','&#x1f604;','&#x1f605;','&#x1f606;','&#x1f607;','&#x1f608;','&#x1f609;','&#x1f60a;','&#x1f60b;','&#x1f60c;','&#x1f60d;','&#x1f60e;','&#x1f60f;','&#x1f610;','&#x1f611;','&#x1f612;','&#x1f613;','&#x1f614;','&#x1f615;','&#x1f616;','&#x1f617;','&#x1f618;','&#x1f619;','&#x1f61a;','&#x1f61b;','&#x1f61c;','&#x1f61d;','&#x1f61e;','&#x1f61f;','&#x1f620;','&#x1f621;','&#x1f622;','&#x1f623;','&#x1f624;','&#x1f625;','&#x1f626;','&#x1f627;','&#x1f628;','&#x1f629;','&#x1f62a;','&#x1f62b;','&#x1f62c;','&#x1f62d;','&#x1f62e;','&#x1f62f;','&#x1f630;','&#x1f631;','&#x1f632;','&#x1f633;','&#x1f634;','&#x1f635;','&#x1f636;','&#x1f637;','&#x1f638;','&#x1f639;','&#x1f63a;','&#x1f63b;','&#x1f63c;','&#x1f63d;','&#x1f63e;','&#x1f63f;','&#x1f640;','&#x1f643;','&#x1f4a9;','&#x1f644;','&#x2620;','&#x1F44C;','&#x1F44D;','&#x1F44E;','&#x1F648;','&#x1F649;','&#x1F64A;']
		});
		// $('.emoji').emoji({});
	})
</script>
