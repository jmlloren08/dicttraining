<?= $this->extend('layout') ?>

<?= $this->section('title') ?><?= lang('Register') ?> <?= $this->endSection() ?>

<?= $this->section('main') ?>

<div class="container d-flex justify-content-center p-5">

    <div class="register-box">

        <div class="login-logo">
            <div class="row">
                <div class="col"><a href="#"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/c9/Department_of_the_Interior_and_Local_Government_%28DILG%29_Seal_-_Logo.svg/600px-Department_of_the_Interior_and_Local_Government_%28DILG%29_Seal_-_Logo.svg.png" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8; width: 100px; height: 100px;"></a></div>
                <div class="w-100"></div>
                <div class="col">Support Ticket System</div>
            </div>
        </div>

        <div class="card">
            <div class="card-body register-card-body">
                <p class="login-box-msg"><?= lang('Register') ?> a new membership</p>

                <script>
                    <?php if (isset($error) && !empty($error)) : ?>
                        Swal.fire({
                            icon: 'error',
                            title: 'ERROR',
                            text: '<?= $error; ?>',
                        });
                    <?php endif; ?>
                </script>

                <script>
                    function validateTerms() {
                        if (!document.getElementById('agreeTerms').checked) {
                            Swal.fire({
                                icon: 'error',
                                title: 'ERROR',
                                text: 'Please agree to the terms to proceed.',
                            });
                            return false;
                        }
                        return true;
                    }
                </script>

                <form action="<?= base_url('register') ?>" method="post" onsubmit="return validateTerms()">
                    <?= csrf_field() ?>

                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="firstname" name="firstname" inputmode="text" placeholder="Firstname" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="lastname" name="lastname" inputmode="text" placeholder="Lastname" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="username" name="username" inputmode="text" placeholder="Username" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <input type="email" class="form-control" id="email" name="email" inputmode="email" placeholder="Email Address" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <input type="password" class="form-control" id="password" name="password" inputmode="password" placeholder="Password" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" id="passwordconfirm" name="passwordconfirm" inputmode="password" placeholder="Password confirm" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="agreeTerms" name="agreeTerms" value="agree" >
                                <label for="agreeTerms">
                                    I agree to the <a href="#">terms</a>
                                </label>
                            </div>
                        </div>

                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block"><?= lang('Register') ?></button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <div class="social-auth-links text-center">
                    <p>- OR -</p>
                    <a href="#" class="btn btn-block btn-primary">
                        <i class="fab fa-facebook mr-2"></i>
                        Sign up using Facebook
                    </a>
                    <a href="#" class="btn btn-block btn-danger">
                        <i class="fab fa-google-plus mr-2"></i>
                        Sign up using Google+
                    </a>
                </div>

                <p class="text-center">Already have an account? <a href="<?= base_url('login') ?>"><?= lang('Login') ?></a></p>

            </div>
            <!-- /.form-box -->
        </div><!-- /.card -->
    </div>
</div>

<?= $this->endSection() ?>