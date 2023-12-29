<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rageman Order Menu</title>
    <link rel="stylesheet" href="../bootstrap-5.2.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">


</head>

<body>
    <!-- header -->
    <?php include "header.php" ?>
    <!-- end header -->


    <div class="container-lg">
        <di class="row mt-2">
            <div class="col-lg rounded">
                <div class="card">
                    <div class="card-header">
                        Dapur
                    </div>
                    <div class="card-body">
                        <div class="col-md table-responsive table-container">
                            <table class="table table-hover rounded" id="tb">
                                <thead>
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Porsi</th>
                                        <th scope="col">Catatan</th>
                                        <th scope="col">Status</th>
                                        <th scope="col" class="col-md-2">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="foodTable">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </div>

    <?php include('script/config_food.php') ?>

    </script>


    <script src="../bootstrap-5.2.3-dist/js/bootstrap.bundle.min.js"></script>
    </script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.6.8/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.6.8/firebase-database.js"></script>
    <!-- Include jQuery Mask Plugin -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
</body>

</html>