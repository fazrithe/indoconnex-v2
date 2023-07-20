<style>
/* Button used to open the chat form - fixed at the bottom of the page */
.open-button {
	background: red;
	border-radius: 15px;
	border-bottom-right-radius: 0;
	border-bottom-left-radius: 0;
	font-size: 12px;
	height: 46px;
  	padding: 16px 20px;
  	border: none;
	cursor: pointer;
	position: fixed;
	bottom: 0px;
	right: 28px;
	width: 280px;
}

/* The popup chat - hidden by default */
.chat-popup {
  display: none;
  position: fixed;
  bottom: 0;
  right: 15px;
  z-index: 9;
}

/* Add styles to the form container */
.form-container {
  max-width: 300px;
  padding: 10px;
  background-color: white;
}

/* Full-width textarea */
.form-container textarea {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  border: none;
  background: #f1f1f1;
  resize: none;
  min-height: 200px;
}

/* When the textarea gets focus, do something */
.form-container textarea:focus {
  background-color: #ddd;
}

/* Set a style for the submit/send button */
.form-container .btn {
  background-color: #04AA6D;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  width: 100%;
  margin-bottom:10px;
  opacity: 0.8;
}

/* Add a red background color to the cancel button */
.form-container .cancel {
  background-color: red;
}

/* Add some hover effects to buttons */
.form-container .btn:hover, .open-button:hover {
  opacity: 1;
}
.card-chat{
	width: 300px;
	border: none;
	border-radius: 15px;
	background-color: #EFEFEF;
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
	margin-left: 15px;
	border-radius: 5px;
	padding: 12px;
}
.chat-left{
	border: none;
	background: #D9D9D9;
	font-size: 12px;
	margin-right: 15px;
	border-radius: 5px;
	padding: 12px;
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
.dot{
	font-weight: bold;
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

<div class="open-button" id="fix-chat" style="z-index:1000000000">
<div class="d-flex flex-row justify-content-between text-white">
      <i class="fas fa-chevron-up" onclick="openForm()"></i>
      <span class="pb-3" id="user_receiver_live_down"></span>
      <i class="fas fa-times" onclick="closeForm()"></i>
    </div>
</div>
<div class="chat-popup" id="myForm" style="z-index:1000000000">
<div class="container d-flex justify-content-center">
  <div class="card card-chat mt-5">
    <div class="d-flex flex-row justify-content-between p-3 adiv text-white">
      <i class="fas fa-chevron-down" onclick="minimizeForm()"></i>
      <span class="pb-3" id="user_receiver_live_up"></span>
      <i class="fas fa-times" onclick="closeForm()"></i>
    </div>
		<input type="hidden" id="receiver_id_user">
	  <div id="chat_body" style="height:350px; overflow-y: scroll;"></div>
	  <div class="input-group">
		  <textarea autofocus class="form-control form-control-chat" aria-label="Box message" id="box-message" placeholder="Type your message"></textarea>
		  <button style="background: white !important;" type="button" class="btn input-group-text" onclick="sendChat()"><i class="fas fa-paper-plane"></i></button>
		</div>
  </div>
</div>
</div>
<script>
	function openForm() {
		document.getElementById("myForm").style.display = "block";
	}

	function closeForm() {
		document.getElementById("myForm").style.display = "none";
		document.getElementById("fix-chat").style.display = "none";
	}

	function minimizeForm(){
		document.getElementById("myForm").style.display = "none";
		document.getElementById("fix-chat").style.display = "block";
	}
	function user_chat(id){
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
					$("#user_receiver_live_up").html(res[key].user_receiver_live);
					$("#user_receiver_live_down").html(res[key].user_receiver_live);
					localStorage.setItem("receiver_name_user", res[key].user_receiver_live);
				}
			}
		})
		document.getElementById("myForm").style.display = "block";
	}

	function sendChat() {
		var csrfName = $(".txt_csrfname").attr("name"); // Value specified in $config['csrf_token_name']
		var csrfHash = $(".txt_csrfname").val();
		var message   = $("#box-message").val();
		var receiver_id = $("#receiver_id_user").val();
		var rec_id = localStorage.getItem("receiver_id_user");
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
				var html = '';
				for(var count = 0; count < data.length; count++)
				{
				html += '<div class="row" style="margin-left:0; margin-right:0">';
				if(data[count].message_direction == 'right')
				{
				html += `<div class="p-3">
				<div class="d-flex flex-row justify-content-end">
						<img src="`+data[count].user_photo_profile+`" class="rounded-circle border feed-user-img mb-1">
							<div class="chat-date text-sm ml-2 p-2">`+data[count].user_sender+`</div>
							<div class="chat-date text-sm ml-2 p-2">`+data[count].chat_messages_datetime+`</div>
						
						</div>
						<div class="chat-right ml-2 p-3">`+data[count].chat_messages_text+`</div>
						</div>`;
				}
				else
				{
				html += `<div class="p-3">
				<div class="d-flex flex-row justify-content-start">
							<img src="`+data[count].user_photo_profile+`" class="rounded-circle border feed-user-img mb-1">
							<div class="chat-date text-sm ml-2 p-2">`+data[count].user_sender+`</div>
							<div class="chat-date text-sm ml-2 p-2">`+data[count].chat_messages_datetime+`</div>
						
						</div>
						<div class="chat-left ml-2 p-3">`+data[count].chat_messages_text+`</div>
						</div>`;
				}
				html += '</div>';
				}
				$('#chat_body').html(html);
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
				var html = '';
				for(var count = 0; count < data.length; count++)
				{
				html += '<div class="row" style="margin-left:0; margin-right:0">';
				if(data[count].message_direction == 'right')
				{
				html += `<div class="p-3">
				<div class="d-flex flex-row justify-content-end">
							<img src="`+data[count].user_photo_profile+`" class="rounded-circle border feed-user-img mb-1">
							<div class="chat-date text-sm ml-2 p-2">`+data[count].user_sender+`</div>
							<div class="chat-date text-sm ml-2 p-2">`+data[count].chat_messages_datetime+`</div>
						
						</div>
						<div class="chat-right ml-2 p-3">`+data[count].chat_messages_text+`</div>
						</div>`;
				}
				else
				{
				html += `<div class="p-3">
				<div class="d-flex flex-row justify-content-start">
							<img src="`+data[count].user_photo_profile+`" class="rounded-circle border feed-user-img mb-1">
							<div class="chat-date text-sm ml-2 p-2">`+data[count].user_sender+`</div>
							<div class="chat-date text-sm ml-2 p-2">`+data[count].chat_messages_datetime+`</div>
						
						</div>
						<div class="chat-left ml-2 p-3">`+data[count].chat_messages_text+`</div>
						</div>`;
				}
				html += '</div>';
				}
				$('#chat_body').html(html);
				$('#chat_body').scrollTop($('#chat_body')[0].scrollHeight);
				$("#box-message").val('');
			}
		);
		}
	});

	setInterval(function(){
	var receiver_id = $("#receiver_id_user").val();
	var rec_id = localStorage.getItem("receiver_id_user");
	var receiver_name_user = localStorage.getItem("receiver_name_user");
	$("#user_receiver_live_up").html(receiver_name_user);
	$("#user_receiver_live_down").html(receiver_name_user);
	if(rec_id)
	{
		load_chat_data(rec_id, 'yes');
	}
		// check_chat_notification();
	}, 5000);

	function load_chat_data(receiver_id, update_data){
		var csrfName = $(".txt_csrfname").attr("name"); // Value specified in $config['csrf_token_name']
		var csrfHash = $(".txt_csrfname").val();

		$.ajax({
			url: "<?php echo site_url('message/load_chat_data');?>",
			method:"POST",
			data:{receiver_id:receiver_id, update_data:update_data, [csrfName]: csrfHash},
			dataType:"json",
			beforeSend: function (params) {
			},
		}).done(
			function (data) {
				var html = '';
				for(var count = 0; count < data.length; count++)
				{
				html += '<div class="row" style="margin-left:0; margin-right:0">';
				if(data[count].message_direction == 'right')
				{
				html += `
				<div class="p-3">
				<div class="d-flex flex-row justify-content-end">
							<img src="`+data[count].user_photo_profile+`" class="rounded-circle border feed-user-img mb-1">
							<div class="chat-date text-sm ml-2 p-2">`+data[count].user_sender+`</div>
							<div class="chat-date text-sm ml-2 p-2">`+data[count].chat_messages_datetime+`</div>
						
						</div>
						<div class="chat-right ml-2 p-3">`+data[count].chat_messages_text+`</div>
						</div>
						`;
				}
				else
				{
				html += `<div class="p-3">
				<div class="d-flex flex-row justify-content-start">
							<img src="`+data[count].user_photo_profile+`" class="rounded-circle border feed-user-img mb-1">
							<div class="chat-date text-sm ml-2 p-2">`+data[count].user_sender+`</div>
							<div class="chat-date text-sm ml-2 p-2">`+data[count].chat_messages_datetime+`</div>
						
						</div>
						<div class="chat-left ml-2 p-3">`+data[count].chat_messages_text+`</div>
						</div>`;
				}
				html += '</div>';
				}
				$('#chat_body').html(html);
				$('#chat_body').scrollTop($('#chat_body')[0].scrollHeight);
			}
		);
	}

</script>