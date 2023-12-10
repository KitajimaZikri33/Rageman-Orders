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
submitButton.addEventListener('click', (e) => {
    var Name = document.getElementById('Name').value;
    var Nomor = document.getElementById('Nomor').value;
    
    // Tambahkan baris ini untuk mendapatkan nilai tanggal dan waktu dari input hidden
    var DateTime = document.getElementById('datetimeDisplay').value;

    const dbRef = ref(database, 'orders');
    const ordersRef = push(dbRef);

    alert('Orders Success');
    set(ordersRef, {
        Name: Name,
        Nomor: Nomor,
        DateTime: DateTime
    }).then(() => {
        document.getElementById('Name').value = '';
        document.getElementById('Nomor').value = '';

        const newOrderRef = ref(database, 'orders/' + newOrderId);
        
        getData();
    }).catch((error) => {
        console.error("Error setting new data: ", error);
    });
});


function viewOrderItems(key, Name, Nomor) {
    console.log('View button clicked for key:', key);
    console.log('Name:', Name);
    console.log('Nomor:', Nomor);

    let encodedName = encodeURIComponent(Name);
    let encodedNomor = encodeURIComponent(Nomor);

    const url = `order_item.php?orderId=${key}&Name=${encodedName}&Nomor=${encodedNomor}`;

    window.location.href = url;
}






function getData() {
    const dataTable = $('#dataTblBody');

    dataTable.empty();
    const dbRef = ref(database, 'orders/');

    onValue(dbRef, (snapshot) => {
        $('#dataTblBody td').remove();
        let rowNum = 1;

        snapshot.forEach((childSnapshot) => {
            const childKey = childSnapshot.key;
            const childData = childSnapshot.val();

            // Update the row creation part in getData function
            var row = `<tr data-key="${childKey}" data-name="${childData.Name}" data-nomor="${childData.Nomor}" data-time="${childData.DateTime}">
                    <td>${rowNum}</td>
                    <td>${childData.Name}</td>
                    <td>${childData.Nomor}</td>
                    <td>${childData.DateTime}</td>
                    <td class="d-flex">
                        <button class="btn btn-primary me-1" onclick="viewOrderItems('${childKey}', '${childData.Name}', '${childData.Nomor}')">
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

            $(row).appendTo('#dataTblBody');

            rowNum++;
        });
    });
}

// Function to open edit modal
const editData = (button) => {
    console.log('Edit button clicked');
    const row = button.closest('tr');
    const key = row.dataset.key;
    const name = row.dataset.name;
    const nomor = row.dataset.nomor;
    const time = row.dataset.time;

    // Set modal input values
    $('#editKey').val(key);
    $('#editName').val(name);
    $('#editNomor').val(nomor);
    $('#datetimeHidden').val(time);

    // Open the modal
    $('#editModal').modal('show');
};

// Function to save edited data
const saveEdit = () => {
    console.log('Save Changes clicked');
    const key = $('#editKey').val();
    const updatedName = $('#editName').val();
    const updatedNomor = $('#editNomor').val();
    const updateTime = $('#datetimeHidden').val();

    // Perbarui data di Firebase
    const dbRef = ref(database, 'orders/' + key);

    alert('Edit Success');
    set(dbRef, {
        Name: updatedName,
        Nomor: updatedNomor,
        DateTime: updateTime
    }).then(() => {
        // Sembunyikan modal setelah berhasil disimpan
        $('#editModal').modal('hide');
        // Perbarui tampilan data
        getData();
    }).catch((error) => {
        console.error("Error updating data: ", error);
    });
};

const deleteData = (button) => {

    console.log('Delete button clicked');
    if (confirm('Apakah kamu yakin ingin menghapus data ini?')) {
        const row = button.closest('tr');
        const key = row.dataset.key;

        const dbRef = ref(database, 'orders/' + key);
        remove(dbRef).then(() => {
            getData();
        }).catch((error) => {
            console.error("Error deleting data: ", error);
        });
    }
};

async function setCurrentDateTime() {
    const datetimeDisplay = document.getElementById('datetimeDisplay');

    try {
        // Fetch current time from WorldTimeAPI (Asia/Jakarta timezone)
        const response = await fetch(
            'http://worldtimeapi.org/api/timezone/Asia/Jakarta');
        const data = await response.json();

        // Extract the date and time
        const currentDateTime = new Date(data.datetime);

        // Format the date and time for Indonesia
        const options = {
            year: 'numeric',
            month: 'numeric',
            day: 'numeric',
            hour: 'numeric',
            minute: 'numeric',
            timeZoneName: 'short',
            weekday: 'long'
        };

        // Set the value of the display element
        datetimeDisplay.value = currentDateTime.toLocaleString('id-ID', options);
    } catch (error) {
        console.error('Error fetching time:', error);
    }
}


setInterval(setCurrentDateTime, 1000);

setCurrentDateTime();





$(document).ready(function() {
    
    $('#dataTblBody').on('click', '.btn-warning', function() {
        editData(this);
    });

    $('#dataTblBody').on('click', '.btn-danger', function() {
        deleteData(this);
    });

    $('#saveChangesButton').on('click', function() {
        saveEdit();
    });
    
    
    $(document).ready(function() {
        $('#dataTblBody').on('click', '.btn-primary', function() {
            const row = $(this).closest('tr');
            const orderId = row.data('key');
            const name = row.data('name');
            const nomor = row.data('nomor');
            viewOrderItems(orderId, name, nomor);
        });
    });
    

});

document.addEventListener('DOMContentLoaded', function() {
    getData();
});
