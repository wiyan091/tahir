<?= $this->extend('components/layout_clear') ?>
<?= $this->section('content') ?>
<?php
$username = [
    'name' => 'username',
    'id' => 'username',
    'class' => 'form-control'
];

$password = [
    'name' => 'password',
    'id' => 'password',
    'class' => 'form-control'
];

?>
<style>
    .btn-close {
        width: 30px;
        height: 30px;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 1.25rem;
        font-weight: bold;
        color: #f00; 
        background-color: #fff;
        border-radius: 50%;
        opacity: 0.5;
        border: none;
        cursor: pointer;
        transition: background-color 0.3s, color 0.3s, opacity 0.3s;
    }

    .btn-close:hover {
        color: #fff; 
        background-color: #f00; 
        opacity: 1;
    }
</style>
<?php if (session()->getFlashData('success')) { ?>
    <div class="alert alert-success alert-dismissible fade show d-flex justify-content-between align-items-center border rounded-0" role="alert">
        <span><?= session()->getFlashData('success') ?></span>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">X</button>
        </a>
    </div>
<?php } ?>

<section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                <div class="d-flex justify-content-center py-4">
                    <a href="index.html" class="logo d-flex align-items-center w-auto">
                        <img src="<?php echo base_url() ?>public/assets/img/favicon_custom.png" alt="">
                        <span class="d-none d-lg-block">Atk Humas | DPRD Semarang</span>
                    </a>
                </div><!-- End Logo -->

                <div class="card mb-3">

                    <div class="card-body">

                        <div class="pt-4 pb-2">
                            <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                            <p class="text-center small">Enter your username & password to login</p>
                        </div>

                        <?php
                        if (session()->getFlashData('failed')) {
                        ?>
                            <div class="col-12 alert alert-danger" role="alert">
                                <hr>
                                <p class="mb-0">
                                    <?= session()->getFlashData('failed') ?>
                                </p>
                            </div>
                        <?php
                        }
                        ?>
                        <?= form_open('login', 'class = "row g-3 needs-validation"') ?>
                        <div class="col-12">
                            <label for="yourUsername" class="form-label">Username</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text" id="inputGroupPrepend">@</span>
                                <?= form_input($username) ?>
                                <div class="invalid-feedback">Please enter your username.</div>
                            </div>
                        </div>

                        <div class="col-12">
                            <label for="yourPassword" class="form-label">Password</label>
                            <?= form_password($password) ?>
                            <div class="invalid-feedback">Please enter your password!</div>
                        </div>
                        <div class="col-12">
                            <?= form_submit('submit', 'Login', ['class' => 'btn btn-primary w-100']) ?>
                        </div >
                        <div class="col-12">
                        <a class="btn btn-success w-100" href="<?php echo base_url() ?>login/register">SignUp</a>
                        <?= form_close() ?>
                        </div >

                    </div>
                </div>

                <?= $this->include('components/footer') ?>

            </div>
        </div>
    </div>

</section>
<?= $this->endSection() ?>