<script type="module">
// Import the functions you need from the SDKs you need
import {
    initializeApp
} from "https://www.gstatic.com/firebasejs/10.6.0/firebase-app.js";
import {
    getDatabase,
    set,
    ref,
    push,
    child,
    onValue,
    remove
} from "https://www.gstatic.com/firebasejs/10.6.0/firebase-database.js";


// Your web app's Firebase configuration
const firebaseConfig = {
    apiKey: "AIzaSyCl187TfdE2U96gwo_Wg7HToa0YmRV5wWk",
    authDomain: "rageman-orders.firebaseapp.com",
    databaseURL: "https://rageman-orders-default-rtdb.firebaseio.com",
    projectId: "rageman-orders",
    storageBucket: "rageman-orders.appspot.com",
    messagingSenderId: "998695493444",
    appId: "1:998695493444:web:a10201af4430f73e414111"
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);
console.log('Firebase initialized successfully!', app);
// Get a reference to the database service
const database = getDatabase(app);

function fetchDataAndUpdateOptions() {

    const menuSelect = document.getElementById('menuCoffee');
    const menuSelect2 = document.getElementById('menuDrink');
    const menuSelect3 = document.getElementById('menuFood');

    menuSelect.innerHTML = '<option selected disabled>Menu Pesanan</option>';
    menuSelect2.innerHTML = '<option selected disabled>Menu Pesanan</option>';
    menuSelect3.innerHTML = '<option selected disabled>Menu Pesanan</option>';



    // Fetch data from Firebase for 'menu'
    const menuRef = ref(database, 'coffee');
    onValue(menuRef, (snapshot) => {
        snapshot.forEach((childSnapshot) => {
            const menuKey = childSnapshot.key;
            const menuValue = childSnapshot.val().Name; // Sesuaikan dengan struktur data Anda
            const option = document.createElement('option');
            option.value = menuKey; // Gunakan kunci sebagai nilai
            option.text = menuValue;
            menuSelect.appendChild(option);
        });
    });

    const menuRef2 = ref(database, 'drink');
    onValue(menuRef2, (snapshot) => {
        snapshot.forEach((childSnapshot) => {
            const menuKey = childSnapshot.key;
            const menuValue = childSnapshot.val().Name; // Sesuaikan dengan struktur data Anda
            const option = document.createElement('option');
            option.value = menuKey; // Gunakan kunci sebagai nilai
            option.text = menuValue;
            menuSelect2.appendChild(option);
        });
    });

    const menuRef3 = ref(database, 'food');
    onValue(menuRef3, (snapshot) => {
        snapshot.forEach((childSnapshot) => {
            const menuKey = childSnapshot.key;
            const menuValue = childSnapshot.val().Name; // Sesuaikan dengan struktur data Anda
            const option = document.createElement('option');
            option.value = menuKey; // Gunakan kunci sebagai nilai
            option.text = menuValue;
            menuSelect3.appendChild(option);
        });
    });
}

// Pastikan Anda memanggil fungsi ini setelah halaman sepenuhnya dimuat
document.addEventListener('DOMContentLoaded', fetchDataAndUpdateOptions);






</script>