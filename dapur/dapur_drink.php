<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rageman Order Menu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">

    <style>
            #tb th:first-child{
              text-align: center;
              font-weight: bold;
            }
            #drinkTable td:first-child{
              text-align: center;
              font-weight: bold;
            }
    </style>
</head>

<body>
    <!-- header -->
    <?php include "header.php" ?>
    <!-- end header -->


    <div class="container-lg">
        <div class="row mt-2">
            <div class="col-lg rounded">
                <div class="card">
                    <div class="card-header">
                        Dapur Drink
                    </div>
                    <div class="card-body">
                      <div class="col-md table-responsive table-container">
                          <table class="table table-hover rounded" id="tb">
                              <thead>
                                  <tr>
                                      <th scope="col">No</th>
                                      <th scope="col">Name</th>
                                      <th scope="col">Porsi</th>
                                      <th scope="col">Catatan</th>
                                      <th scope="col">Status</th>
                                      <th scope="col" class="col-md-2">Action</th>
                                  </tr>
                              </thead>
                              <tbody id="drinkTable">

                              </tbody>
                          </table>
                      </div>
                    </div>
                </div>
            </div>
            <!-- end content -->
        </div>
    </div>

    <?php include('script/config_drink.php') ?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.6.8/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.6.8/firebase-database.js"></script>
    <!-- Include jQuery Mask Plugin -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
</body>

</html>
