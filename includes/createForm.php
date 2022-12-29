<div class="container">
    <div class="row">
        <div class="col-lg-12 mt-4">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-6">
                            <h3 class="card-title">Create Form</h3>
                        </div>
                        <div class="col-lg-6">
                            <a href="../index.php" type="button" class="btn btn-danger float-end">Vissza</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="" class="mt-3" method="POST">
                        <div class="mb-3">
                            <label for="" class="form-label">Név</label>
                            <input type="text" class="form-control" name="full_name">
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
                            <label for="" class="form-label">Számlázási cím</label>
                            <input type="text" class="form-control" name="billing_address">
                            <div class="error">
                                <?php
                                    if(isset($errors['billing_address'])){
                                        echo $errors['billing_address'];
                                    }else{
                                        '';
                                    }
                                ?>
                            </div>
                        </div>
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
                            <label for="" class="form-label">E-mail</label>
                            <input type="email" class="form-control" name="email" autocomplete="off">
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
                        <div class="mb-3">
                            <label for="" class="form-label">Adószám</label>
                            <input type="text" class="form-control" name="tax_number">
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
                            <input type="password" class="form-control" name="passw" autocomplete="new-password">
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
                            <button class="btn btn-primary float-end" type="submit" name="submit">Küld</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
