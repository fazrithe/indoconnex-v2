<style>
	.chat-container {
		width: 245px;
		background-color: #eee;
		right: 0;
		bottom: 0;
		position: fixed;
		z-index: 100000;
		padding: 10px;
	}

	.button-chat-details-open .button-chat-details-close {
		height: 37px;
	}

	.chat-body-container {
		height: 502px;
	}

	@supports (-moz-appearance:none) {
		.chat-body-container {
			height: 490px;
		}
	}

	.singleChat {
		cursor: pointer;
		padding: 10px 0px 10px 0px;
		cursor: pointer;
		border-style: solid;
		border-width: 0px 0px 1px 0px;
		border-color: #c6c6c6;
	}
</style>

<div class="chat-container d-none d-md-block">
	<div class="button-chat-details-open" onclick="openChatBody()">
		<div class="d-flex justify-content-between align-items-center" style="cursor: pointer;">
		<div class="d-flex justify-content-center h-100">
			<div class="image_outer_container">
				<div class="green_icon" style="<?php echo user_online($this->session->user_id) ?>"></div>
					<div class="image_inner_container">
						<img src="<?php echo meta_profile_user_image($this->session->user_id) ?>" class="rounded-circle border feed-user-img">
					</div>
				</div>
			</div>
			<span><?php echo $this->session->username ?></span>
			<i class="fas fa-chevron-up open-chat"></i>
		</div>
	</div>
	<div class="button-chat-details-close d-none" onclick="closeChatBody()">
		<div class="d-flex justify-content-between align-items-center" style="cursor: pointer;">
			<img src="<?php echo meta_profile_user_image($this->session->user_id) ?>" class="rounded-circle border feed-user-img">
			<span><?php echo $this->session->username ?></span>
			<i class="fas fa-chevron-down close-chat"></i>
		</div>
	</div>
	<div class="chat-body-container d-none">
		<div class="d-flex flex-column">
			<div class="row my-2">
				<div class="input-group">
					<span class="input-group-text bg-white border-end-0 rounded-pill-left" id="search-navbar" style="background: #F2F4F8 !important;">
						<span class="material-icons text-muted ">search</span>
					</span>
					<input style="background: #F2F4F8;" class="form-control border-start-0 rounded-pill-right search-username" type="search" placeholder="Search" aria-label="Search">
				</div>
			</div>
			<div class="chats" id="chatBody">

			</div>
			<a href="<?php echo site_url('message/dashboard_chat'); ?>" class="btn btn-sm btn-default d-none mt-0" id="btnViewAllChat">View All</a>
		</div>
	</div>
</div>

<script>
$(function() {
// Enable pusher logging - don't include this in production
// Pusher.logToConsole = true;

var csrfName = $(".txt_csrfname").attr("name"); // Value specified in $config['csrf_token_name']
var csrfHash = $(".txt_csrfname").val();

var pusher = new Pusher("<?php echo PUSHER_KEY ?>", {
  cluster: 'ap1'
});

var channel = pusher.subscribe('my-channel');
channel.bind('my-event', function(data) {
	if(data.message === 'success'){
		$.ajax({
			url: "<?php echo site_url('message/histories');?>",
			method:"GET",
			data:{[csrfName]: csrfHash},
			dataType:"html",
		}).done(
			function (data) {
				$('#chatBody').html(data);
				$('#btnViewAllChat').removeClass('d-none');

				// search.addEventListener('keyup', () => {
				// 	var term = search.value.trim().toLowerCase();
				// 	document.querySelectorAll('.singleChat').forEach(function(chat) {
				// 		var item = chat.childNodes[1].textContent;
				// 		if(item.toLowerCase().indexOf(term) != -1) {
				// 			chat.style.display = 'block';
				// 			chat.style.margin = '10px 0px 10px 0px';
				// 			chat.firstChild.style.display = 'block';
				// 			chat.childNodes[1].style.display = 'block';
				// 			chat.lastChild.style.display = 'block';
				// 		} else {
				// 			chat.style.display = 'none';
				// 			chat.style.margin = '0px 0px 0px 0px';
				// 			chat.firstChild.style.display = 'none';
				// 			chat.childNodes[1].style.display = 'none';
				// 			chat.lastChild.style.display = 'none';
				// 		}
				// 	});
				// });
			}
		);
	}
});
	var chatBody = document.getElementById("chatBody");
	var chats = document.querySelector(".chats");
	// var search = document.querySelector('.search-username');
	var singleChat = chatBody.querySelectorAll('.singleChat');

	var csrfName = $(".txt_csrfname").attr("name"); // Value specified in $config['csrf_token_name']
	var csrfHash = $(".txt_csrfname").val();

	$.ajax({
		url: "<?php echo site_url('message/histories');?>",
		method:"GET",
		data:{[csrfName]: csrfHash},
		dataType:"html",
	}).done(
		function (data) {
			$('#chatBody').html(data);
			$('#btnViewAllChat').removeClass('d-none');

			// search.addEventListener('keyup', () => {
			// 	var term = search.value.trim().toLowerCase();
			// 	document.querySelectorAll('.singleChat').forEach(function(chat) {
			// 		var item = chat.childNodes[1].textContent;
			// 		if(item.toLowerCase().indexOf(term) != -1) {
			// 			chat.style.display = 'block';
			// 			chat.style.margin = '10px 0px 10px 0px';
			// 			chat.firstChild.style.display = 'block';
			// 			chat.childNodes[1].style.display = 'block';
			// 			chat.lastChild.style.display = 'block';
			// 		} else {
			// 			chat.style.display = 'none';
			// 			chat.style.margin = '0px 0px 0px 0px';
			// 			chat.firstChild.style.display = 'none';
			// 			chat.childNodes[1].style.display = 'none';
			// 			chat.lastChild.style.display = 'none';
			// 		}
			// 	});
			// });
		}
	);

	$('.search-username').on('input', debounce(function() {
		$.ajax({
			url: "<?php echo site_url('message/histories');?>",
			method:"GET",
			data:{search: $(this).val(), [csrfName]: csrfHash},
			dataType:"html",
		}).done(
			function (data) {
				$('#chatBody').html(data);
				$('#btnViewAllChat').removeClass('d-none');
			}
		);		
	}, 750));

	// setInterval(function() {
	// 	var chatBody = document.getElementById("chatBody");
	// 	var chats = document.querySelector(".chats");
	// 	var search = document.querySelector('.search-username');
	// 	var singleChat = chatBody.querySelectorAll('.singleChat');

	// 	$.ajax({
	// 		url: "<?php echo site_url('message/histories');?>",
	// 		method:"GET",
	// 		data:{},
	// 		dataType:"html",
	// 	}).done(
	// 		function (data) {
	// 			$('#chatBody').html(data);
	// 			$('#btnViewAllChat').removeClass('d-none');

	// 			search.addEventListener('keyup', () => {
	// 				var term = search.value.trim().toLowerCase();
	// 				document.querySelectorAll('.singleChat').forEach(function(chat) {
	// 					var item = chat.childNodes[1].textContent;
	// 					if(item.toLowerCase().indexOf(term) != -1) {
	// 						chat.style.display = 'block';
	// 						chat.style.margin = '10px 0px 10px 0px';
	// 						chat.firstChild.style.display = 'block';
	// 						chat.childNodes[1].style.display = 'block';
	// 						chat.lastChild.style.display = 'block';
	// 					} else {
	// 						chat.style.display = 'none';
	// 						chat.style.margin = '0px 0px 0px 0px';
	// 						chat.firstChild.style.display = 'none';
	// 						chat.childNodes[1].style.display = 'none';
	// 						chat.lastChild.style.display = 'none';
	// 					}
	// 				});
	// 			});
	// 		}
	// 	);
	// }, 5000);
});

function openChatBody() {
	$('.chat-body-container').removeClass('d-none');
	$('.button-chat-details-open').addClass('d-none');
	$('.button-chat-details-close').removeClass('d-none');
}

function closeChatBody() {
	$('.chat-body-container').addClass('d-none');
	$('.button-chat-details-open').removeClass('d-none');
	$('.button-chat-details-close').addClass('d-none');
}
</script>
