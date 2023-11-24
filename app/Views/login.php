<?= $this->extend('layout') ?>

<?= $this->section('title') ?><?= lang('login') ?> <?= $this->endSection() ?>

<?= $this->section('main') ?>

<div class="container d-flex justify-content-center p-5">
    <div class="login-box">

        <div class="login-logo">
            <div class="row">
                <div class="col"><a href="."><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/c9/Department_of_the_Interior_and_Local_Government_%28DILG%29_Seal_-_Logo.svg/600px-Department_of_the_Interior_and_Local_Government_%28DILG%29_Seal_-_Logo.svg.png" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8; width: 100px; height: 100px;"></a></div>
                <div class="w-100"></div>
                <div class="col">Support Ticket System</div>
            </div>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg"><?= lang('Login') ?> to start your session</p>

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
                    <?php if (session()->has('success')) : ?>
                        Swal.fire({
                            icon: 'success',
                            title: 'SUCCESS',
                            text: '<?= session('success'); ?>',
                        });
                    <?php endif; ?>
                </script>

                <form action="<?= base_url('login') ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" id="floatingEmailInput" name="email" inputmode="email" placeholder="Email Address" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <input type="password" class="form-control" id="floatingPasswordInput" name="password" inputmode="password" placeholder="Password" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember" name="remember" class="form-check-input">
                                <label for="remember">
                                    Remember Me
                                </label>
                            </div>
                        </div>


                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block"><?= lang('Login') ?></button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <div class="social-auth-links text-center mb-3">
                    <p>- OR -</p>
                    <a href="#" class="btn btn-block btn-primary">
                        <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
                    </a>
                    <a href="#" class="btn btn-block btn-danger">
                        <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
                    </a>
                </div>


                <p class="text-center">Forgot password?<a href="#"> Reset</a></p>

                <p class="text-center">Need account? <a href="<?= base_url('register') ?>"><?= lang('Register') ?></a></p>


            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
</div>

<?= $this->endSection() ?>