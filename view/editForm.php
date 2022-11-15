<?php include('../controller/editController.php') ?>
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

                <?php
                    //Törlés utáni visszajelzés
                    if(isset($_SESSION["message"])){
                        ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong><?php echo $_SESSION["message"]; ?></strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php
                        unset($_SESSION["message"]);
                    }
                ?>

                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-lg-6">
                                    <h3 class="card-title">Update Form</h3>
                                </div>
                                <div class="col-lg-6">
                                    <a href="../view/index.php" type="button" class="btn btn-danger float-end">Vissza</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="" class="mt-3" method="POST">
                                <div class="mb-3">
                                    <label for="" class="form-label">Név</label>
                                    <input type="text" class="form-control" name="full_name" value="<?php echo $value['name']; ?>">
                                    <div class="error">
                                        <?php
                                            if(isset($errors['full_name'])){
                                                echo $errors['full_name'];
                                            }else{
                                                '';
                                            }
                                        ?>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <label for="" class="form-label">Számlázási cím</label>
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-striped">
                                                    <?php
                                                        $tr = "";
                                                        //Számlázási cím kiíratása tömbe szerkesztés és törlés gombokkal (és a törlés modaljával)
                                                        foreach ($billingAddresses as $billingAddress){
                                                            $billingId = $billingAddress['id'];
                                                            $tr .= "<tr>
                                                                        <td>".$billingAddress["billing_address"]."</td>
                                                                        <td>
                                                                            <a href='../view/editBillingAddressForm.php?id=$billingId' class='btn btn-primary'><i class='bi bi-pencil'></i></a>
                                                                            <button type='button' data-bs-toggle='modal' data-bs-target='#modalBilling$billingId' class='btn btn-danger class='btn btn-primary'><i class='bi bi-trash'></i></button>
                                                                                <div class='modal fade' id='modalBilling$billingId' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                                                                                    <div class='modal-dialog'>
                                                                                        <div class='modal-content'>
                                                                                        <div class='modal-header'>
                                                                                            <h5 class='modal-title' id='exampleModalLabel'>Modal title</h5>
                                                                                            <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                                                                        </div>
                                                                                        <div class='modal-body'>
                                                                                            Biztos törölni akarja?
                                                                                        </div>
                                                                                        <div class='modal-footer'>
                                                                                            <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Nem</button>
                                                                                            <a type='button' class='btn btn-primary' href='../controller/deleteBillingAddressController.php?id=$billingId&req=delete'>Igen</a>
                                                                                        </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                        </td>
                                                                    </tr>";
                                                        }
                                                        echo $tr;
                                                    ?>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <label for="" class="form-label">Szállítási cím</label>
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-striped">
                                                    <?php
                                                        //Szállítási cím kiíratása tömbe szerkesztés és törlés gombokkal (és a törlés modaljával)
                                                        $tr = "";
                                                        foreach ($shippingAddresses as $shippingAddress){
                                                            $shippingId = $shippingAddress['id'];
                                                                $tr .= "<tr>
                                                                            <td>".$shippingAddress["shipping_address"]."</td>
                                                                            <td>
                                                                                <a href='../view/editShippingAddressForm.php?id=$shippingId' class='btn btn-primary'><i class='bi bi-pencil'></i></a>
                                                                                <button type='button' data-bs-toggle='modal' data-bs-target='#modalShipping$shippingId' class='btn btn-danger class='btn btn-primary'><i class='bi bi-trash'></i></button>
                                                                                <div class='modal fade' id='modalShipping$shippingId' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                                                                                    <div class='modal-dialog'>
                                                                                        <div class='modal-content'>
                                                                                        <div class='modal-header'>
                                                                                            <h5 class='modal-title' id='exampleModalLabel'>Modal title</h5>
                                                                                            <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                                                                        </div>
                                                                                        <div class='modal-body'>
                                                                                            Biztos törölni akarja?
                                                                                        </div>
                                                                                        <div class='modal-footer'>
                                                                                            <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Nem</button>
                                                                                            <a type='button' class='btn btn-primary' href='../controller/deleteShippingAddressController.php?id=$shippingId&req=delete'>Igen</a>
                                                                                        </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                        </tr>";
                                                        }
                                                        echo $tr;
                                                    ?>
                                            </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">E-mail</label>
                                    <input type="text" class="form-control" name="email" value="<?php echo $value['email']; ?>">
                                    <div class="error">
                                        <?php
                                            if(isset($errors['email'])){
                                                echo $errors['email'];
                                            }else{
                                                '';
                                            }
                                        ?>
                                    </div>
                                </div>
                                <div>
                                    <label for="" class="form-label">Adószám</label>
                                    <input type="text" class="form-control" name="tax_number" value="<?php echo $value['tax_number']; ?>">
                                    <div class="error">
                                        <?php
                                            if(isset($errors['tax_number'])){
                                                echo $errors['tax_number'];
                                            }else{
                                                '';
                                            }
                                        ?>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Jelszó</label>
                                    <input type="password" class="form-control" name="passw">
                                    <div class="error">
                                        <?php
                                            if(isset($errors['passw'])){
                                                echo $errors['passw'];
                                            }else{
                                                '';
                                            }
                                        ?>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <button class="btn btn-primary float-end" type="submit" name="edit">Küld</button>
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