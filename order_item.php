<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rageman Order Menu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
</head>

<style>
#dataTblBody td:first-child {
    text-align: center;
    font-weight: bold;
}

#dataTblBody td:last-child {
    text-align: center;
}

#dataTbl th:first-child {
    text-align: center;
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






                        <div class="col-md table-responsive table-container">
                            <table class="table table-striped table-hover align-middle rounded" id="dataTbl">
                                <thead class="table-info">
                                    <tr>
                                        <th scope="col" class="col-md-1">No</th>
                                        <th scope="col">Menu</th>
                                        <th scope="col">Jumlah porsi</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Catatan</th>
                                        <th scope="col">Total</th>
                                        <th scope="col" class="col-md-2">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="dataTblBody">
                                    <!-- Data will be inserted here -->
                                </tbody>
                                <tfooter>
                                <th scope="col">Total Harga</th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                                <th scope="col">47.000</th>
                                </tfooter>
                            </table>

                            <button type="button" class="btn btn-outline-info"><i class="bi bi-plus-circle-fill"></i> Coffee</button>
                            <button type="button" class="btn btn-outline-info"><i class="bi bi-plus-circle-fill"></i> Minuman</button>
                            <button type="button" class="btn btn-outline-info"><i class="bi bi-plus-circle-fill"></i> Makanan</button>
                            <button type="button" class="btn btn-outline-success"><i class="bi bi-cash-coin"></i> Bayar</button>

                        </div>
                    </div>

                </div>
            </div>

            <?php include 'config_order.php' ?>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-mC9aaQvwKVpKjWSF8F1bVI6CDhpXnEN9Fjozj5aPiOMk5Frr4cJFCpB2ZH15N7fy" crossorigin="anonymous">
    </script>
    <script src="https://www.gstatic.com/firebasejs/10.6.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/10.6.0/firebase-database.js"></script>
    <!-- Include jQuery Mask Plugin -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
</body>

</html>