<?php include('../controller/createShippingController.php') ?>
<html>
    <head>
        <meta charset="utf-8">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    </head>
    <body>
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-6 mt-4">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-lg-6">
                                    <h3 class="card-title">Create Shipping Address Form</h3>
                                </div>
                                <div class="col-lg-6">
                                    <a href="../view/index.php" type="button" class="btn btn-danger float-end">Vissza</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="" class="mt-3" method="POST">
                                <div class="mb-3">
                                    <label for="" class="form-label">Szállítási cím</label>
                                    <input type="text" class="form-control" name="shipping_address">
                                    <div class="error">
                                        <?php
                                            if(isset($errors['shipping_address'])){
                                                echo $errors['shipping_address'];
                                            }else{
                                                '';
                                            }
                                        ?>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary float-end" name="submit">Küld</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> 
        <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    </body>
</html>