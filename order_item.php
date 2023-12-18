<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rageman Order Menu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <!-- Masukkan ini di dalam bagian head tag -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11">





</head>
<!-- Masukkan ini sebelum tag </body> untuk skrip JS-nya -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
#ordersTableBody td:first-child {
    text-align: center;
    font-weight: bold;
}

#ordersTableBody td:last-child {
    text-align: center;
}

#dataTbl th:first-child {
    text-align: center;
}
.catatan-cell {
        white-space: pre-line;
    }



table {
    border-collapse: collapse;
    width: 100%;
    border-radius: 5px;
    overflow: hidden;
}

th,
td {
    padding: 15px;
    text-align: left;
    border-bottom: 1px solid #ddd;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

th {
    background-color: #f2f2f2;
}

.table-container {
    overflow-x: auto;
    max-width: 100%;
}

table.rounded {
    border-radius: 10px;
    overflow: hidden;
}
</style>

<body>
    <!-- header -->
    <?php include "header.php" ?>
    <!-- end header -->


    <div class="container-lg">
        <div class="row mt-2">
            <div class="col-lg">
                <div class="card">
                    <div class="card-header">
                        Halaman Item Order
                    </div>
                    <div class="card-body">
                        <h5 class="card-title text-start">
                            <a class="btn btn-outline-dark" href="index.php" role="button">
                                <i class="bi bi-arrow-left"></i>
                            </a>
                        </h5>

                        <div class="row g-2 mb-2">
                            <div class="col-3">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="orderName"
                                        placeholder="name@example.com" disabled>
                                    <label for="floatingInputGrid">Nama Pelanggan</label>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="orderNomor"
                                        placeholder="name@example.com" disabled>
                                    <label for="floatingInputGrid">Nomor Meja</label>
                                </div>
                            </div>
                        </div>






                        <div class="col-md table-responsive table-container">
                            <table class="table table-striped table-hover align-middle rounded" id="dataTbl">
                                <thead class="table-info">
                                    <tr>
                                        <th scope="col" class="col-md-1">No</th>
                                        <th scope="col">Menu</th>
                                        <th scope="col">Jumlah porsi</th>
                                        <th scope="col" class="catatan-cell">Catatan</th>
                                        <th scope="col">Harga</th>
                                        <th scope="col">Total</th>
                                        <th scope="col">Status</th>
                                        <th scope="col" class="col-md-2">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="ordersTableBody">
                                    <!-- Data will be inserted here -->
                                </tbody>
                                <tfooter>
                                    <th scope="col">Total Harga</th>
                                    <th scope="col"></th>
                                    <th scope="col"></th>
                                    <th scope="col"></th>
                                    <th scope="col"></th>
                                    <th id="totalHargaFooter" scope="col"></th>
                                    <th></th>
                                    <th></th>
                                </tfooter>
                            </table>



                            <div class="card-body">
                                <h5 class="card-title text-end mb-1">
                                    <button type="button" class="btn btn-outline-info" data-bs-toggle="modal" id="addCoffeeButton"
                                        data-bs-target="#exampleModalCoffee">
                                        <i class="bi bi-plus-circle-fill"></i>
                                        Add Coffee
                                    </button>

                                    <button type="button" class="btn btn-outline-info" data-bs-toggle="modal" id="addMinumanButton"
                                        data-bs-target="#exampleModalDrink">
                                        <i class="bi bi-plus-circle-fill"></i>
                                        Add Minuman
                                    </button>

                                    <button type="button" class="btn btn-outline-info" data-bs-toggle="modal" id="addMakananButton"
                                        data-bs-target="#exampleModalFood">
                                        <i class="bi bi-plus-circle-fill"></i>
                                        Add Makanan
                                    </button>


                                    <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" id="buttonBayar"
                                        data-bs-target="#modalBayar">
                                        <i class="bi bi-cash-coin"></i> Bayar
                                    </button>
                                </h5>
                            </div>



                            <!-- Modal -->
                            <div class="modal fade" id="modalBayar" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalBayar">Pembayaran</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">

                                            <div class="col-md table-responsive table-container">
                                                <table class="table table-hover align-middle rounded"
                                                    id="dataTb2">
                                                    <thead class="table-info">
                                                        <tr>
                                                            <th scope="col">Menu</th>
                                                            <th scope="col">Jumlah porsi</th>
                                                            <th scope="col">Harga</th>
                                                            <th scope="col">Total</th>

                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tbBayar">

                                                    </tbody>
                                                    <tfooter>
                                                      <tr>
                                                        <th scope="col"></th>
                                                        <th scope="col"></th>
                                                        <th scope="col"></th>
                                                        <th scope="col"></th>
                                                        <th scope="col"></th>
                                                      </tr>
                                                      <tr>
                                                        <th scope="col">Total Harga</th>
                                                        <th scope="col"></th>
                                                        <th scope="col"></th>
                                                        <th id="total" scope="col"></th>
                                                        <th id="totalBayar" scope="col" hidden></th>
                                                        <th></th>
                                                        </tr>
                                                        <tr>
                                                          <th scope="col">PPN 10%</th>
                                                          <th scope="col"></th>
                                                          <th scope="col"></th>
                                                          <th id="totalHargaPPN" scope="col"></th>
                                                          <th></th>
                                                        </tr>
                                                        <tr>
                                                          <th scope="col">Total Harga + PPN</th>
                                                          <th scope="col"></th>
                                                          <th scope="col"></th>
                                                          <th id="totalHargaModal" scope="col"></th>
                                                          <th></th>
                                                        </tr>
                                                    </tfooter>

                                                </table>
                                            </div>

                                            <h4 style="color: salmon;">Apakah Anda Yakin Ingin Melakukan Pembayaran?
                                            </h4>

                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="bayar"
                                                    placeholder="name@example.com">
                                                <label for="bayar">Nominal Bayar</label>
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" id="bayarButton" class="btn btn-success">Bayar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- Modal -->
                            <div class="modal fade" id="exampleModalCoffee" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Add Item</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">

                                            <div class="row g-2 mb-3">

                                                <div class="col-md">
                                                    <select class="form-select" aria-label="Default select example"
                                                        id="menuCoffee">
                                                        <option selected>Menu Pesanan</option>

                                                    </select>
                                                </div>
                                            </div>


                                            <div class="row g-2">
                                                <div class="col-md-2">
                                                    <div class="form-floating mb-3">
                                                        <input type="number" class="form-control" id="porsi"
                                                            placeholder="name@example.com" value="1">
                                                        <label for="floatingInput">Jumlah Porsi</label>
                                                    </div>
                                                </div>
                                                <div class="col-md">
                                                    <div class="form-floating mb-3">
                                                        <input type="text" class="form-control" id="catatan"
                                                            placeholder="name@example.com">
                                                        <label for="floatingInput">Catatan</label>
                                                    </div>
                                                </div>

                                                <span id="itemName" hidden></span>
                                                <span type="number" id="itemPrice" hidden></span>
                                                <input type="text" id="status" hidden></input>

                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" id="submitButton"
                                                class="btn btn-primary">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModalDrink" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Add Item</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">

                                            <div class="row g-2 mb-3">

                                                <div class="col-md">
                                                    <select class="form-select" aria-label="Default select example"
                                                        id="menuDrink">
                                                        <option selected>Menu Pesanan</option>

                                                    </select>
                                                </div>
                                            </div>


                                            <div class="row g-2">
                                                <div class="col-md-2">
                                                    <div class="form-floating mb-3">
                                                        <input type="number" class="form-control" id="porsi2"
                                                            placeholder="name@example.com" value="1">
                                                        <label for="floatingInput">Jumlah Porsi</label>
                                                    </div>
                                                </div>
                                                <div class="col-md">
                                                    <div class="form-floating mb-3">
                                                        <input type="text" class="form-control" id="catatan2"
                                                            placeholder="name@example.com">
                                                        <label for="floatingInput">Catatan</label>
                                                    </div>
                                                </div>

                                                <span id="itemName2" hidden></span>
                                                <span type="number" id="itemPrice2" hidden></span>
                                                <input type="text" id="status2" hidden></input>

                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" id="submitButton2"
                                                class="btn btn-primary">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModalFood" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Add Item</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">

                                            <div class="row g-2 mb-3">

                                                <div class="col-md">
                                                    <select class="form-select" aria-label="Default select example"
                                                        id="menuFood">
                                                        <option selected>Menu Pesanan</option>

                                                    </select>
                                                </div>
                                            </div>


                                            <div class="row g-2">
                                                <div class="col-md-2">
                                                    <div class="form-floating mb-3">
                                                        <input type="number" class="form-control" id="porsi3"
                                                            placeholder="name@example.com" value="1">
                                                        <label for="floatingInput">Jumlah Porsi</label>
                                                    </div>
                                                </div>
                                                <div class="col-md">
                                                    <div class="form-floating mb-3">
                                                        <input type="text" class="form-control" id="catatan3"
                                                            placeholder="name@example.com">
                                                        <label for="floatingInput">Catatan</label>
                                                    </div>
                                                </div>

                                                <span id="itemName3" hidden></span>
                                                <span type="number" id="itemPrice3" hidden></span>
                                                <input type="text" id="status3" hidden></input>

                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" id="submitButton3"
                                                class="btn btn-primary">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </div>




                        </div>
                    </div>

                </div>
            </div>

            <?php include('script/config_order_item.php') ?>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

    <!-- Firebase v8.6.8 -->
    <script src="https://www.gstatic.com/firebasejs/8.6.8/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.6.8/firebase-database.js"></script>
    <!-- ... (Tambahkan skrip untuk modul lain yang Anda butuhkan) -->

    <!-- Include jQuery Mask Plugin -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
</body>

</html>
