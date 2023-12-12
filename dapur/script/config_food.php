<script type="module">
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


const getData = () => {
    const dataTable = $('#foodTable');
    dataTable.empty();
    const dbRef = ref(database, 'orders/');

    onValue(dbRef, (snapshot) => {
        $('#foodTable td').remove();
        let rowNum = 1;

        snapshot.forEach((orderSnapshot) => {
            const orderId = orderSnapshot.key;
            const orderData = orderSnapshot.val();

            // Jika order memiliki child 'order_item'
            if (orderData.order_item) {
                // Iterasi melalui order_items
                Object.entries(orderData.order_item).forEach(([orderItemId, orderItemData]) => {
                    // Periksa apakah orderItemData memiliki properti yang diperlukan
                    if (
                        orderItemData.hasOwnProperty('itemName3') &&
                        orderItemData.hasOwnProperty('jumlahPorsi3') &&
                        orderItemData.hasOwnProperty('catatan3')
                    ) {
                        var row = `<tr data-key="${orderItemId}" data-name="${orderItemData.itemName3}" data-porsi="${orderItemData.jumlahPorsi3}" data-catatan="${orderItemData.catatan3}">
                                <td>${rowNum}</td>
                                <td>${orderItemData.itemName3}</td>
                                <td>${orderItemData.jumlahPorsi3}</td>
                                <td>${orderItemData.catatan3}</td>
                                <td></td>
                                <td class="d-flex">
                                    <button class="btn btn-warning me-1" onclick="...">
                                        Proses</i>
                                    </button>
                                    <button class="btn btn-success me-1" onclick="...">
                                         Siap Saji</i>
                                    </button>
                                </td>
                                </tr>`;

                        $(row).appendTo('#foodTable');

                        rowNum++;
                    }
                });
            }
        });
    });
};


getData();
</script>
