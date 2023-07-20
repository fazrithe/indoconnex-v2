<script src="https://www.gstatic.com/firebasejs/8.2.6/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.2.6/firebase-analytics.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.2.6/firebase-messaging.js"></script>
<script>
    var csrfName = $(".txt_csrfname").attr("name"); // Value specified in $config['csrf_token_name']
    var csrfHash = $(".txt_csrfname").val(); // CSRF hash
    // Initialize Firebase
    var config = {
        apiKey: "AIzaSyCXAHVHYg9mULOFZefmbob_KkWm_d0ZDpw",
        authDomain: "indoconnex-3689a.firebaseapp.com",
        databaseURL: "https://indoconnex-3689a-default-rtdb.asia-southeast1.firebasedatabase.app",
        projectId: "indoconnex-3689a",
        storageBucket: "indoconnex-3689a.appspot.com",
        messagingSenderId: "477335172746",
        appId: "1:477335172746:web:063f089f92ca4fdeee9f73"
    };
    firebase.initializeApp(config);

    const messaging = firebase.messaging();
    let token = '';
    messaging.requestPermission()
    .then(function() {
        console.log('Notification permission granted.');
        token = '';
        $.ajax({
            url: "<?php echo site_url('user/get_token');?>",
            type: "POST",
            data: { [csrfName]: csrfHash },
            timeout: 5000,
            async: false,
            dataType: "JSON",
        }).done(
            function (response) {
                $(".txt_csrfname").val(response.token);
                if(response.notify) {
                    token = response.notify;
                }
            }
        );
        return token;
    })
    .then(function(newToken) {
        if(!newToken) {
            // make new token if empty
            newToken = messaging.getToken();
            $.ajax({
                url: "<?php echo site_url('user/update_token');?>",
                type: "POST",
                data: {token:newToken, [csrfName]: csrfHash },
                timeout: 5000,
                dataType: "JSON",
            }).done(
                function (response) {
                    // Update CSRF hash
                    $(".txt_csrfname").val(response.token);
                }
            );
        }
    })
    .catch(function(err) { // Happen if user deney permission
        console.log('Unable to get permission to notify.', err);
    });

messaging.onMessage(function(payload){
    const title = payload.notification;
    const options = {
        body: payload.notification,
        icon: 'https://dev.indoconnex.com/public/globals/logo-symbol.png',
    };
    new Notification(title, options);

    $clickUrl = '#';
    $userImage = '';
    $userName = '';
    $detail = '';
    $prep = "<li class='mb-3'>"+
            "<a href='"+$clickUrl+"' class='hstack d-flex'>"+
                "<div class='flex-shrink-0 placeholder-glow'>"+
                    "<img src='"+$userImage+"' alt='' srcset='' class='rounded-circle feed-user-img'>"+
                "</div>"+
                "<div class='flex-grow-1 ms-2 d-flex flex-column'>"+
                    "<span class='fw-semi fs-14 text-black text-truncate'>"+$userName+"</span>"+
                    "<span class='fs-10 text-black text-truncate'>"+$detail+"</span>"+
                "</div>"+
            "</a>"+
        "</li>";
    $('#thenotify').prepend($prep);
})
</script>
