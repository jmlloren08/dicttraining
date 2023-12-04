<?= $this->extend('template/admin_template'); ?>

<?= $this->section('content'); ?>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">User Profile</h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<section class="content">
    <div class="container d-flex justify-content-center p-5">

        <div class="register-box">

            <div class="login-logo">
                <div class="row">
                    <div class="col"><a href="#"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/c9/Department_of_the_Interior_and_Local_Government_%28DILG%29_Seal_-_Logo.svg/600px-Department_of_the_Interior_and_Local_Government_%28DILG%29_Seal_-_Logo.svg.png" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8; width: 100px; height: 100px;"></a></div>
                    <div class="w-100"></div>
                    <!-- <div class="col">Support Ticket System</div> -->
                </div>
            </div>

            <div class="card">
                <div class="card-body register-card-body">
                    <p class="login-box-msg">Update Profile</p>

                    <form action="<?= base_url('profile') ?>" method="post">
                        <?= csrf_field() ?>

                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="firstname" name="firstname" inputmode="text" placeholder="Firstname" value="<?= $user['firstname']; ?>">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                        </div>

                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="lastname" name="lastname" inputmode="text" placeholder="Lastname" value="<?= $user['lastname']; ?>">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                        </div>

                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="username" name="username" inputmode="text" placeholder="Username" value="<?= $user['username']; ?>">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                        </div>

                        <div class="input-group mb-3">
                            <input type="email" class="form-control" id="email" name="email" inputmode="email" placeholder="Email Address" value="<?= $user['email']; ?>">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>

                        <div class="input-group mb-3">
                            <input type="password" class="form-control" id="password" name="password" inputmode="password" placeholder="Password" value="<?= $user['password']; ?>">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control" id="passwordconfirm" name="passwordconfirm" inputmode="password" placeholder="Password confirm" value="<?= $user['password']; ?>">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <!-- /.col -->
                            <div class="col-4">
                                <button type="submit" class="btn btn-primary btn-block">Save</button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>

                </div>
                <!-- /.form-box -->
            </div><!-- /.card -->
        </div>
    </div>
</section>

<?= $this->endSection(); ?>

<?= $this->section('pagescripts'); ?>



<?= $this->endSection(); ?>