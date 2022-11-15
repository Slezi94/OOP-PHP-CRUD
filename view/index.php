<?php include('../controller/selectUsersController.php') ?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-12 mt-4">

            <?php
                //Műveletek utáni visszajelzés
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

                <a href="createForm.php" type="button" class="btn btn-success mb-3">Új felhasználó</a>

                <div class="table-responsive">
                    <table class="table table-bordered table-striped index-table">
                        <thead class="text-center">
                            <tr>
                                <th>Név</th>
                                <th>Számlázási cím</th>
                                <th>Szállítási cím</th>
                                <th>E-mail</th>
                                <th>Adószám</th>
                                <th>Műveletek</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $tr = "";
                                foreach($records as $record){
                                    $recordId = $record["id"];

                                    $billing = "";
                                    foreach($record["billing_address"] as $address){
                                        $billing .= $address["billing_address"]."<br>";
                                    }

                                    $shipping = "";
                                    foreach($record["shipping_address"] as $address){
                                        $shipping .= $address["shipping_address"]."<br>";
                                    }

                                    $tr .= "<tr>
                                        <td>".$record["name"]."</td>
                                        <td>".$billing."</td>
                                        <td>".$shipping."</td>
                                        <td>".$record["email"]."</td>
                                        <td>".$record["tax_number"]."</td>
                                        <td>
                                        <a class='btn btn-success' href='../view/createBillingForm.php?id=$recordId' name='billing'>Új számlázási cím</a>
                                        <a class='btn btn-success' href='../view/createShippingForm.php?id=$recordId' name='shipping'>Új szállítási cím</a>
                                        <a href='../view/editForm.php?id=$recordId&req=edit' class='btn btn-primary'><i class='bi bi-pencil'></i></a>
                                        <button data-bs-toggle='modal' data-bs-target='#modal$recordId' class='btn btn-danger' name='delete'><i class='bi bi-trash'></i></button>
                                        <div class='modal fade' id='modal$recordId' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
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
                                                    <a type='button' class='btn btn-primary' href='../controller/deleteController.php?id=$recordId&req=delete'>Igen</a>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                        </td>
                                    </tr>";
                                }

                                echo $tr;
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> 
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
</body>
</html>