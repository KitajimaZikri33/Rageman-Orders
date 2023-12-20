<script type="module">


<?php include('../firebase.js') ?>


const updateStatus = (orderId, itemKey) => {
  const orderItemRef = ref(getDatabase(app), `orders/${orderId}/order_item/${itemKey}`);

  update(orderItemRef, {
    status2: 'Masuk Dapur'
  });
};

const updateStatusSiap = (orderId, itemKey) => {
  const orderItemRef = ref(getDatabase(app), `orders/${orderId}/order_item/${itemKey}`);

  update(orderItemRef, {
    status2: 'Siap Disajikan'
  });
};

const hideAllReadyItems = () => {
  const allItemsReady = $('#drinkTable tr').toArray().every((element) => {
    const statusCell = $(element).find('td').eq(4);
    return statusCell.text().trim() === 'Siap Disajikan';
  });

  if (allItemsReady) {
    $('#drinkTable tr').hide();
  }
};

const getData = () => {
  const dataTable = $('#drinkTable');
  dataTable.empty();
  const dbRef = ref(getDatabase(app), 'orders/');

  onValue(dbRef, (snapshot) => {
    $('#drinkTable td').remove();


    // Menyimpan status siap disajikan
    let allItemsReady = true;

    snapshot.forEach((orderSnapshot) => {
      const orderId = orderSnapshot.key;
      const orderData = orderSnapshot.val();

      if (orderData.order_item) {
        Object.entries(orderData.order_item).forEach(([orderItemId, orderItemData]) => {
          if (
            orderItemData.hasOwnProperty('itemName2') &&
            orderItemData.hasOwnProperty('jumlahPorsi2') &&
            orderItemData.hasOwnProperty('catatan2') &&
            orderItemData.hasOwnProperty('status2')
          ) {
            var badgeClass = orderItemData.status2 === 'Masuk Dapur' ?
            'bg-warning' : orderItemData.status2 === 'Siap Disajikan' ?
            'bg-primary' : '';

            var row = `<tr data-key="${orderItemId}" data-name="${orderItemData.itemName2}" data-porsi="${orderItemData.jumlahPorsi2}" data-catatan="${orderItemData.catatan2}">
            <td>${orderItemData.itemName2}</td>
            <td>${orderItemData.jumlahPorsi2}</td>
            <td>${orderItemData.catatan2}</td>
            <td>
            <span class="badge ${badgeClass}">${orderItemData.status2}</span>
            </td>
            <td class="d-flex">
            <button class="btn btn-warning me-1 update-btn" data-orderid="${orderId}" data-itemid="${orderItemId}" ${orderItemData.status2 === 'Masuk Dapur' ? 'disabled' : ''}>
            Proses
            </button>
            <button class="btn btn-success me-1 updateSiap-btn" data-orderid="${orderId}" data-itemid="${orderItemId}" ${orderItemData.status2 === 'Siap Disajikan' ? 'disabled' : ''}>
            Siap Saji
            </button>
            </td>
            </tr>`;


            $(row).appendTo('#drinkTable');


            // Periksa status dan sembunyikan item jika siap disajikan
            if (orderItemData.status2 === 'Siap Disajikan') {
              $(`tr[data-key="${orderItemId}"][data-name="${orderItemData.itemName2}"]`)
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
      $('#drinkTable tr').hide();
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
</script>
