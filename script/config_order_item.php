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
            const menuValue = childSnapshot.val().Name;
            const option = document.createElement('option');
            option.value = menuKey; 
            option.text = menuValue;
            menuSelect.appendChild(option);
        });
    });

    const menuRef2 = ref(database, 'drink');
    onValue(menuRef2, (snapshot) => {
        snapshot.forEach((childSnapshot) => {
            const menuKey = childSnapshot.key;
            const menuValue = childSnapshot.val().Name;
            const option = document.createElement('option');
            option.value = menuKey; 
            option.text = menuValue;
            menuSelect2.appendChild(option);
        });
    });

    const menuRef3 = ref(database, 'food');
    onValue(menuRef3, (snapshot) => {
        snapshot.forEach((childSnapshot) => {
            const menuKey = childSnapshot.key;
            const menuValue = childSnapshot.val().Name;
            const option = document.createElement('option');
            option.value = menuKey;
            option.text = menuValue;
            menuSelect3.appendChild(option);
        });
    });
}

//input coffee//
function handleSelectChange() {
    console.log('Select change event triggered');
    const selectedItemKey = this.value;
    console.log('Selected Item Key:', selectedItemKey);

    const selectedItemRef = ref(database, `coffee/${selectedItemKey}`);
    get(selectedItemRef).then(snapshot => {
        const selectedItemData = snapshot.val();
        console.log('Selected Item Data:', selectedItemData);

        if (selectedItemData) {
            document.getElementById('itemName').textContent = selectedItemData.Name;
            document.getElementById('itemPrice').textContent = selectedItemData.Price;

            $('#exampleModalCoffee').modal('show');
        }
    });
}

//input drink//
function handleSelectChange2() {
    console.log('Select change event triggered');
    const selectedItemKey = this.value;
    console.log('Selected Item Key:', selectedItemKey);

    const selectedItemRef = ref(database, `drink/${selectedItemKey}`);
    get(selectedItemRef).then(snapshot => {
        const selectedItemData = snapshot.val();
        console.log('Selected Item Data:', selectedItemData);

        if (selectedItemData) {
            document.getElementById('itemName2').textContent = selectedItemData.Name;
            document.getElementById('itemPrice2').textContent = selectedItemData.Price;

            $('#exampleModalDrink').modal('show');
        }
    });
}

//input food//
function handleSelectChange3() {
    console.log('Select change event triggered');
    const selectedItemKey = this.value;
    console.log('Selected Item Key:', selectedItemKey);

    const selectedItemRef = ref(database, `food/${selectedItemKey}`);
    get(selectedItemRef).then(snapshot => {
        const selectedItemData = snapshot.val();
        console.log('Selected Item Data:', selectedItemData);

        if (selectedItemData) {
            document.getElementById('itemName3').textContent = selectedItemData.Name;
            document.getElementById('itemPrice3').textContent = selectedItemData.Price;

            $('#exampleModalFood').modal('show');
        }
    });
}

//submit coffee
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

//submit drink//
document.getElementById('submitButton2').addEventListener('click', function() {
    const itemName = document.getElementById('itemName2').textContent;
    const itemPrice = document.getElementById('itemPrice2').textContent;
    const jumlahPorsi = document.getElementById('porsi2').value;
    const catatan = document.getElementById('catatan2').value;

    const selectedItemKey = document.getElementById('menuDrink').value;

    const orderRef = ref(database, 'order_item');
    const newOrderRef = push(orderRef);

    set(newOrderRef, {
        itemName: itemName,
        itemPrice: itemPrice,
        jumlahPorsi: jumlahPorsi,
        catatan: catatan,

        selectedItemKey: selectedItemKey
    }).then(() => {

        document.getElementById('porsi2').value = '';
        document.getElementById('catatan2').value = '';
        document.getElementById('menuDrink').value = 'Menu Pesanan';


        $('#exampleModalDrink').modal('hide');

    }).catch((error) => {
        console.error("Error saving order: ", error);
    });
});

//submit food//
document.getElementById('submitButton3').addEventListener('click', function() {
    const itemName = document.getElementById('itemName3').textContent;
    const itemPrice = document.getElementById('itemPrice3').textContent;
    const jumlahPorsi = document.getElementById('porsi3').value;
    const catatan = document.getElementById('catatan3').value;

    const selectedItemKey = document.getElementById('menuFood').value;

    const orderRef = ref(database, 'order_item');
    const newOrderRef = push(orderRef);

    set(newOrderRef, {
        itemName: itemName,
        itemPrice: itemPrice,
        jumlahPorsi: jumlahPorsi,
        catatan: catatan,

        selectedItemKey: selectedItemKey
    }).then(() => {

        document.getElementById('porsi3').value = '';
        document.getElementById('catatan3').value = '';
        document.getElementById('menuFood').value = 'Menu Pesanan';


        $('#exampleModalFood').modal('hide');

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
            const totalHarga = childData.itemPrice * childData.jumlahPorsi;

            const formattedPrice = parseFloat(childData.itemPrice).toLocaleString('id-ID', {
                style: 'currency',
                currency: 'IDR',
            });
            const formattedPrice2 = parseFloat(totalHarga).toLocaleString('id-ID', {
                style: 'currency',
                currency: 'IDR',
            });

            // Update the row creation part in getData function
            var row = `<tr data-key="${childKey}" data-name="${childData.itemName}" data-nomor="${childData.itemPrice}" data-time="${childData.jumlahProsi}"data-time="${childData.catatan}">
                    <td>${rowNum}</td>
                    <td>${childData.itemName}</td>
                    <td>${childData.jumlahPorsi}</td>
                    <td>${childData.catatan}</td>
                    <td></td>
                    <td hidden>${formattedPrice}</td>
                    <td>${formattedPrice2}</td>
                    <td class="d-flex">
                        <!-- ... -->
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


const deleteData = (button) => {

    console.log('Delete button clicked');
    if (confirm('Apakah kamu yakin ingin menghapus data ini?')) {
        const row = button.closest('tr');
        const key = row.dataset.key;

        const dbRef = ref(database, 'order_item/' + key);
        remove(dbRef).then(() => {
            getData();
        }).catch((error) => {
            console.error("Error deleting data: ", error);
        });
    }
};


const updateTotalHarga = () => {
    console.log('Updating total harga...');
    const dataTable = $('#ordersTableBody');
    let jmlHarga = 0;

    dataTable.find('tr').each((index, row) => {
        const itemPriceText = $(row).find('td:nth-child(6)').text().trim();
        const jumlahPorsiText = $(row).find('td:nth-child(3)').text().trim();

        // Menghapus karakter 'Rp', mengganti '.' dengan '', dan mengganti ',' dengan '.'
        const cleanedItemPriceText = itemPriceText.replace('Rp', '').replace('.', '').replace(',', '.');

        // Mengubah teks menjadi angka
        const itemPrice = parseFloat(cleanedItemPriceText);
        const jumlahPorsi = parseInt(jumlahPorsiText);

        // Memeriksa apakah nilai valid atau tidak
        if (!isNaN(itemPrice) && !isNaN(jumlahPorsi)) {
            jmlHarga += itemPrice * jumlahPorsi;
        } else {
            console.error(`Invalid values: itemPrice=${itemPrice}, jumlahPorsi=${jumlahPorsi}`);
        }
    });

    // Update total harga di footer
    $('#totalHargaFooter').text(jmlHarga.toLocaleString('id-ID', {
        style: 'currency',
        currency: 'IDR',
    }));
};

// Panggil fungsi saat data berubah atau diupdate
onValue(ref(database, 'order_item/'), () => {
    getData();
    updateTotalHarga();
});





getData();


$(document).ready(function() {
    // Tambahkan event listener untuk tombol Edit dan Delete
    $('#ordersTableBody').on('click', '.btn-warning', function() {
        editData(this);
    });

    $('#ordersTableBody').on('click', '.btn-danger', function() {
        deleteData(this);
    });

    $('#saveChangesButton').on('click', function() {
        saveEdit();
    });

});

// Pastikan Anda memanggil fungsi ini setelah halaman sepenuhnya dimuat
document.addEventListener('DOMContentLoaded', fetchDataAndUpdateOptions);

document.getElementById('menuCoffee').addEventListener('change', handleSelectChange);
document.getElementById('menuDrink').addEventListener('change', handleSelectChange2);
document.getElementById('menuFood').addEventListener('change', handleSelectChange3);
</script>