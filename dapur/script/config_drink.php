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
    const dataTable = $('#drinkTable');
    dataTable.empty();
    const dbRef = ref(database, 'orders/');

    onValue(dbRef, (snapshot) => {
        $('#drinkTable td').remove();
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
                        orderItemData.hasOwnProperty('itemName2') &&
                        orderItemData.hasOwnProperty('jumlahPorsi2') &&
                        orderItemData.hasOwnProperty('catatan2')
                    ) {
                        var row = `<tr data-key="${orderItemId}" data-name="${orderItemData.itemName2}" data-porsi="${orderItemData.jumlahPorsi2}" data-catatan="${orderItemData.catatan2}">
                                <td>${rowNum}</td>
                                <td>${orderItemData.itemName2}</td>
                                <td>${orderItemData.jumlahPorsi2}</td>
                                <td>${orderItemData.catatan2}</td>
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

                        $(row).appendTo('#drinkTable');

                        rowNum++;
                    }
                });
            }
        });
    });
};


getData();
</script>
