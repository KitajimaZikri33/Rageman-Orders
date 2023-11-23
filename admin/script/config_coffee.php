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

    const dbRef = ref(database, 'coffee');
    const coffeeRef = push(dbRef);

    set(coffeeRef, {
        Name: Name,
        Price: Price
    }).then(() => {
        document.getElementById('Name').value = '';
        document.getElementById('Price').value = '';
        alert('Add Coffee Success');
        getData();
    }).catch((error) => {
        console.error("Error setting new data: ", error);
    });
});



const getData = () => {
    const dataTable = $('#dataTblBody');

    dataTable.empty();
    const dbRef = ref(database, 'coffee/');

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
                        <button class="btn btn-warning me-1" onclick="editData(this)"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                            </svg></button>
                        <button class="btn btn-danger me-1" onclick="deleteData(this)"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>
                            <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>
                            </svg></button>
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
    const dbRef = ref(database, 'coffee/' + key);
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

        const dbRef = ref(database, 'coffee/' + key);
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