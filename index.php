<?php include "database/connection.php"; ?>
<?php //include('../controller/selectUsersController.php') ?>

<!-- Header -->
<?php include "includes/header.php"; ?>

<!-- Navigation -->
<?php include "includes/navigation.php"; ?>

    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-12 mt-4">
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

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

<?php include "includes/footer.php"; ?>