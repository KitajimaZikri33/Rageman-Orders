import {
  initializeApp,
  getApps,
  getApp
} from "https://www.gstatic.com/firebasejs/10.6.0/firebase-app.js";
import {
  getDatabase,
  ref,
  onValue,
  update
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


const firebaseApps = getApps();
const app = firebaseApps.length === 0 ? initializeApp(firebaseConfig) : getApp();


const updateStatus = (orderId, itemKey) => {
  const orderItemRef = ref(getDatabase(app), `orders/${orderId}/order_item/${itemKey}`);

  update(orderItemRef, {
    status: 'Masuk Dapur'
  });
};

const updateStatusSiap = (orderId, itemKey) => {
  const orderItemRef = ref(getDatabase(app), `orders/${orderId}/order_item/${itemKey}`);

  update(orderItemRef, {
    status: 'Siap Disajikan'
  });
};

const hideAllReadyItems = () => {
  const allItemsReady = $('#coffeeTable tr').toArray().every((element) => {
    const statusCell = $(element).find('td').eq(4);
    return statusCell.text().trim() === 'Siap Disajikan';
  });

  if (allItemsReady) {
    $('#coffeeTable tr').hide();
  }
};

const getData = () => {
  const dataTable = $('#coffeeTable');
  dataTable.empty();
  const dbRef = ref(getDatabase(app), 'orders/');

  onValue(dbRef, (snapshot) => {
    $('#coffeeTable td').remove();


    // Menyimpan status siap disajikan
    let allItemsReady = true;

    snapshot.forEach((orderSnapshot) => {
      const orderId = orderSnapshot.key;
      const orderData = orderSnapshot.val();

      if (orderData.order_item) {
        Object.entries(orderData.order_item).forEach(([orderItemId, orderItemData]) => {
          if (
            orderItemData.hasOwnProperty('itemName') &&
            orderItemData.hasOwnProperty('jumlahPorsi') &&
            orderItemData.hasOwnProperty('catatan') &&
            orderItemData.hasOwnProperty('status')
          ) {
            var badgeClass = orderItemData.status === 'Masuk Dapur' ?
            'bg-warning' : orderItemData.status === 'Siap Disajikan' ?
            'bg-primary' : '';
            var row = `<tr data-key="${orderItemId}" data-name="${orderItemData.itemName}" data-porsi="${orderItemData.jumlahPorsi}" data-catatan="${orderItemData.catatan}">

            <td>${orderItemData.itemName}</td>
            <td>${orderItemData.jumlahPorsi}</td>
            <td>${orderItemData.catatan}</td>
            <td>
            <span class="badge ${badgeClass}">${orderItemData.status}</span>
            </td>
            <td class="d-flex">
            <button class="btn btn-warning me-1 update-btn" data-orderid="${orderId}" data-itemid="${orderItemId}" ${orderItemData.status === 'Masuk Dapur' ? 'disabled' : ''}>
            Proses
            </button>
            <button class="btn btn-success me-1 updateSiap-btn" data-orderid="${orderId}" data-itemid="${orderItemId}" ${orderItemData.status === 'Siap Disajikan' ? 'disabled' : ''}>
            Siap Saji
            </button>
            </td>
            </tr>`;

            $(row).appendTo('#coffeeTable');


            // Periksa status dan sembunyikan item jika siap disajikan
            if (orderItemData.status === 'Siap Disajikan') {
              $(`tr[data-key="${orderItemId}"][data-name="${orderItemData.itemName}"]`)
              .hide();
            } else {
              allItemsReady =
              false; // Setel ke false jika ada satu item yang belum siap
            }
          }
        });
      }
    });

    // Semua item siap disajikan, sembunyikan semua
    if (allItemsReady) {
      $('#coffeeTable tr').hide();
    }
  });
};

$(document).ready(() => {
  getData();

  // Tambahkan event listener untuk tombol update
  $(document).on('click', '.update-btn', function() {
    const orderId = $(this).data('orderid');
    const itemId = $(this).data('itemid');
    console.log('Button clicked with Order ID:', orderId, 'and Item ID:', itemId);
    updateStatus(orderId, itemId);
  });
  $(document).on('click', '.updateSiap-btn', function() {
    const orderId = $(this).data('orderid');
    const itemId = $(this).data('itemid');
    console.log('Button clicked with Order ID:', orderId, 'and Item ID:', itemId);
    updateStatusSiap(orderId, itemId);
  });
});
