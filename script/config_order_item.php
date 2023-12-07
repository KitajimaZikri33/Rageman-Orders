<script type="module">
// Import the functions you need from the SDKs you need
import {
    initializeApp
} from "https://www.gstatic.com/firebasejs/10.6.0/firebase-app.js";
import {
    getDatabase,
    get,
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

function handleSelectChange() {
    console.log('Select change event triggered');
    const selectedItemKey = this.value;
    console.log('Selected Item Key:', selectedItemKey);

    const selectedItemRef = ref(database, `coffee/${selectedItemKey}`);
    get(selectedItemRef).then(snapshot => {
        const selectedItemData = snapshot.val();
        console.log('Selected Item Data:', selectedItemData);

        if (selectedItemData) {
            // Tampilkan data di modal
            document.getElementById('itemName').textContent = selectedItemData.Name;
            document.getElementById('itemPrice').textContent = selectedItemData.Price;

            // Buka modal
            $('#exampleModalCoffee').modal('show');
        }
    });
}


document.getElementById('submitButton').addEventListener('click', function() {
    const itemName = document.getElementById('itemName').textContent;
    const itemPrice = document.getElementById('itemPrice').textContent;
    const jumlahPorsi = document.getElementById('porsi').value;
    const catatan = document.getElementById('catatan').value;

    const selectedItemKey = document.getElementById('menuCoffee').value;

    const orderRef = ref(database, 'order_item');
    const newOrderRef = push(orderRef);

    set(newOrderRef, {
        itemName: itemName,
        itemPrice: itemPrice,
        jumlahPorsi: jumlahPorsi,
        catatan: catatan,

        selectedItemKey: selectedItemKey
    }).then(() => {

        document.getElementById('porsi').value = '';
        document.getElementById('catatan').value = '';
        document.getElementById('menuCoffee').value = 'Menu Pesanan';


        $('#exampleModalCoffee').modal('hide');

    }).catch((error) => {
        console.error("Error saving order: ", error);
    });
});




const getData = () => {
    const dataTable = $('#ordersTableBody');

    dataTable.empty();
    const dbRef = ref(database, 'order_item/');

    onValue(dbRef, (snapshot) => {
        $('#ordersTableBody td').remove();
        let rowNum = 1;

        snapshot.forEach((childSnapshot) => {
            const childKey = childSnapshot.key;
            const childData = childSnapshot.val();

            // Update the row creation part in getData function
            var row = `<tr data-key="${childKey}" data-name="${childData.itemName}" data-nomor="${childData.itemPrice}" data-time="${childData.jumlahProsi}"data-time="${childData.catatan}">
                    <td>${rowNum}</td>
                    <td>${childData.itemName}</td>
                    <td>${childData.jumlahPorsi}</td>
                    <td>${childData.catatan}</td>
                    <td></td>
                    <td>${childData.itemPrice}</td>
                    <td class="d-flex">
                        <button class="btn btn-primary me-1" onclick="...">
                            <i class="bi bi-eye"></i>
                        </button>
                        <button class="btn btn-warning me-1" onclick="editData(this)">
                            <i class="bi bi-pencil-square"></i>
                        </button>
                        <button class="btn btn-danger me-1" onclick="deleteData(this)">
                            <i class="bi bi-trash3"></i>
                        </button>
                    </td>
                    </tr>`;

            $(row).appendTo('#ordersTableBody');

            rowNum++;
        });
    });
};


getData();


// Pastikan Anda memanggil fungsi ini setelah halaman sepenuhnya dimuat
document.addEventListener('DOMContentLoaded', fetchDataAndUpdateOptions);

document.getElementById('menuCoffee').addEventListener('change', handleSelectChange);
</script>