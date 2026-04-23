importScripts('https://www.gstatic.com/firebasejs/9.0.0/firebase-app-compat.js');
importScripts('https://www.gstatic.com/firebasejs/9.0.0/firebase-messaging-compat.js');

const firebaseConfig = {
    apiKey: "AIzaSyA5dDYGYewcisANHp3ZGZ7My27WCk-UCr4",
    authDomain: "vahanassist-56ed3.firebaseapp.com",
    projectId: "vahanassist-56ed3",
    storageBucket: "vahanassist-56ed3.firebasestorage.app",
    messagingSenderId: "968718523334",
    appId: "1:968718523334:web:724ec76e965c64a9bef0c7",
    measurementId: "G-5DKHDJ2VPM"
};

firebase.initializeApp(firebaseConfig);

const messaging = firebase.messaging();

messaging.onBackgroundMessage((payload) => {
  console.log('[firebase-messaging-sw.js] Received background message ', payload);
  // Customize notification here
  const notificationTitle = payload.notification.title;
  const notificationOptions = {
    body: payload.notification.body,
    icon: '/assets/icons/icon-192x192.png'
  };

  self.registration.showNotification(notificationTitle, notificationOptions);
});
