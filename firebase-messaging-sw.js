/*
Give the service worker access to Firebase Messaging.
Note that you can only use Firebase Messaging here, other Firebase libraries are not available in the service worker.
*/
importScripts('https://www.gstatic.com/firebasejs/8.2.6/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.2.6/firebase-messaging.js');
   
/*
Initialize the Firebase app in the service worker by passing in the messagingSenderId.
* New configuration for app@pulseservice.com
*/
firebase.initializeApp({
    apiKey: "AIzaSyCXAHVHYg9mULOFZefmbob_KkWm_d0ZDpw",
	authDomain: "indoconnex-3689a.firebaseapp.com",
	databaseURL: "https://indoconnex-3689a-default-rtdb.asia-southeast1.firebasedatabase.app",
	projectId: "indoconnex-3689a",
	storageBucket: "indoconnex-3689a.appspot.com",
	messagingSenderId: "477335172746",
	appId: "1:477335172746:web:063f089f92ca4fdeee9f73"
});
  
/*
Retrieve an instance of Firebase Messaging so that it can handle background messages.
*/
const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function(payload) {
    console.log(
        "[firebase-messaging-sw.js] Received background message ",
        payload,
    );
    /* Customize notification here */
    const notificationTitle = "Background Message Title";
    const notificationOptions = {
        body: "Background Message body.",
        icon: "/itwonders-web-logo.png",
    };
  
    return self.registration.showNotification(
        notificationTitle,
        notificationOptions,
    );
});