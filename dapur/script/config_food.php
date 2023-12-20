<script type="module">


<?php include('../firebase.js') ?>


const updateStatus = (orderId, itemKey) => {
  const orderItemRef = ref(getDatabase(app), `orders/${orderId}/order_item/${itemKey}`);

  update(orderItemRef, {
    status3: 'Masuk Dapur'
  });
};

const updateStatusSiap = (orderId, itemKey) => {
  const orderItemRef = ref(getDatabase(app), `orders/${orderId}/order_item/${itemKey}`);

  update(orderItemRef, {
    status3: 'Siap Disajikan'
  });
};

const hideAllReadyItems = () => {
  const allItemsReady = $('#foodTable tr').toArray().every((element) => {
    const statusCell = $(element).find('td').eq(4);
    return statusCell.text().trim() === 'Siap Disajikan';
  });

  if (allItemsReady) {
    $('#foodTable tr').hide();
  }
};

const getData = () => {
  const dataTable = $('#foodTable');
  dataTable.empty();
  const dbRef = ref(getDatabase(app), 'orders/');

  onValue(dbRef, (snapshot) => {
    $('#foodTable td').remove();


    // Menyimpan status siap disajikan
    let allItemsReady = true;

    snapshot.forEach((orderSnapshot) => {
      const orderId = orderSnapshot.key;
      const orderData = orderSnapshot.val();

      if (orderData.order_item) {
        Object.entries(orderData.order_item).forEach(([orderItemId, orderItemData]) => {
          if (
            orderItemData.hasOwnProperty('itemName3') &&
            orderItemData.hasOwnProperty('jumlahPorsi3') &&
            orderItemData.hasOwnProperty('catatan3') &&
            orderItemData.hasOwnProperty('status3')
          ) {
            var badgeClass = orderItemData.status3 === 'Masuk Dapur' ?
            'bg-warning' : orderItemData.status3 === 'Siap Disajikan' ?
            'bg-primary' : '';
            var row = `<tr data-key="${orderItemId}" data-name="${orderItemData.itemName3}" data-porsi="${orderItemData.jumlahPorsi3}" data-catatan="${orderItemData.catatan3}">

            <td>${orderItemData.itemName3}</td>
            <td>${orderItemData.jumlahPorsi3}</td>
            <td>${orderItemData.catatan3}</td>
            <td>
            <span class="badge ${badgeClass}">${orderItemData.status3}</span>
            </td>
            <td class="d-flex">
            <button class="btn btn-warning me-1 update-btn" data-orderid="${orderId}" data-itemid="${orderItemId}" ${orderItemData.status3 === 'Masuk Dapur' ? 'disabled' : ''}>
            Proses
            </button>
            <button class="btn btn-success me-1 updateSiap-btn" data-orderid="${orderId}" data-itemid="${orderItemId}" ${orderItemData.status3 === 'Siap Disajikan' ? 'disabled' : ''}>
            Siap Saji
            </button>
            </td>
            </tr>`;

            $(row).appendTo('#foodTable');


            // Periksa status dan sembunyikan item jika siap disajikan
            if (orderItemData.status3 === 'Siap Disajikan') {
              $(`tr[data-key="${orderItemId}"][data-name="${orderItemData.itemName3}"]`)
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
      $('#foodTable tr').hide();
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
