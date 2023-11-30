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

// write data
const submitButton = document.getElementById('submitButton');
submitButton.addEventListener('click', (e) => {
    var Name = document.getElementById('Name').value;
    var Price = document.getElementById('Price').value;

    const dbRef = ref(database, 'drink');
    const drinkRef = push(dbRef);

    alert('Add Drink Success');
    set(drinkRef, {
        Name: Name,
        Price: Price
    }).then(() => {
        document.getElementById('Name').value = '';
        document.getElementById('Price').value = '';
        
        getData();
    }).catch((error) => {
        console.error("Error setting new data: ", error);
    });
});



const getData = () => {
    const dataTable = $('#dataTblBody');

    dataTable.empty();
    const dbRef = ref(database, 'drink/');

    onValue(dbRef, (snapshot) => {
        $('#dataTblBody td').remove();
        let rowNum = 1;

        snapshot.forEach((childSnapshot) => {
            const childKey = childSnapshot.key;
            const childData = childSnapshot.val();

            // Format harga menjadi pecahan uang
            const formattedPrice = parseFloat(childData.Price).toLocaleString('id-ID', {
                style: 'currency',
                currency: 'IDR',
            });
            // Update the row creation part in getData function
            var row = `<tr data-key="${childKey}" data-name="${childData.Name}" data-price="${childData.Price}">
                    <td>${rowNum}</td>
                    <td>${childData.Name}</td>
                    <td>${formattedPrice}</td>
                    <td class="d-flex">
                         <button class="btn btn-warning me-1" onclick="editData(this)">
                            <i class="bi bi-pencil-square"></i>
                        </button>
                        <button class="btn btn-danger me-1" onclick="deleteData(this)">
                            <i class="bi bi-trash3"></i>
                        </button>
                    </td>
                    </tr>`;

            $(row).appendTo('#dataTblBody');

            rowNum++;
        });
    });
};

// Function to open edit modal
const editData = (button) => {
    console.log('Edit button clicked');
    const row = button.closest('tr');
    const key = row.dataset.key;
    const name = row.dataset.name;
    const price = row.dataset.price;

    // Set modal input values
    $('#editKey').val(key);
    $('#editName').val(name);
    $('#editPrice').val(price);

    // Open the modal
    $('#editModal').modal('show');
};


// Function to save edited data
const saveEdit = () => {
    console.log('Save Changes clicked');
    const key = $('#editKey').val();
    const updatedName = $('#editName').val();
    const updatedPrice = $('#editPrice').val();

    // Perbarui data di Firebase
    const dbRef = ref(database, 'drink/' + key);

    alert('Edit Success');
    set(dbRef, {
        Name: updatedName,
        Price: updatedPrice
    }).then(() => {
        // Sembunyikan modal setelah berhasil disimpan
        $('#editModal').modal('hide');
        // Perbarui tampilan data
        getData();
    }).catch((error) => {
        console.error("Error updating data: ", error);
    });
};

// Fungsi untuk menghapus data
const deleteData = (button) => {

    console.log('Delete button clicked');
    if (confirm('Apakah kamu yakin ingin menghapus data ini?')) {
        const row = button.closest('tr');
        const key = row.dataset.key;

        const dbRef = ref(database, 'drink/' + key);
        remove(dbRef).then(() => {
            getData();
        }).catch((error) => {
            console.error("Error deleting data: ", error);
        });
    }
};

$(document).ready(function() {
    // Tambahkan event listener untuk tombol Edit dan Delete
    $('#dataTblBody').on('click', '.btn-warning', function() {
        editData(this);
    });

    $('#dataTblBody').on('click', '.btn-danger', function() {
        deleteData(this);
    });

    $('#saveChangesButton').on('click', function() {
        saveEdit();
    });

});

document.addEventListener('DOMContentLoaded', function() {
    getData();
});
</script>