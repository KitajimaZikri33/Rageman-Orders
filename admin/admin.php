<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rageman Order Menu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
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

    th,td {
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

</head>

<body>
    <!-- header -->
    <?php include "admin_header.php" ?>
    <!-- end header -->

    <div class="container-lg">
        <div class="row mt-2">
            <!-- sidebar -->
            <?php include "admin_sidebar.php" ?>
            <!-- sidebar end -->

            <!-- content -->
            <?php 
              if (isset($_GET["x"]) && $_GET["x"]=='input_coffee') {include "input_coffee.php";
              }elseif (isset($_GET["x"]) && $_GET["x"]=='input_drink') {include "input_drink.php";
              }elseif (isset($_GET["x"]) && $_GET["x"]=='input_food') {include "input_food.php";
              }elseif (isset($_GET["x"]) && $_GET["x"]=='laporan') {include "laporan.php";
              }
            ?>
            <!-- end content -->
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