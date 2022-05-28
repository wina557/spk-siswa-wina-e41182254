<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rangking</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
    <style>
        body {
            margin-top: 100px;
            background-image: url(<?= base_url('assets/spenba.jpg') ?>);
            background-size: cover;
            background-attachment: fixed;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="text-center">LOGIN</h3>
                    </div>
                    <?php if ($this->session->flashdata()) : ?>
                        <?= $this->session->flashdata('message'); ?>
                    <?php endif; ?>
                    <div class="panel-body">
                        <form action="<?= base_url('login') ?>" method="POST">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" name="username" class="form-control" id="username" placeholder="username" autofocus="on">
                                <small class="text-danger">
                                    <?= form_error('username') ?>
                                </small>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                                <small class="text-danger">
                                    <?= form_error('password') ?>
                                </small>
                            </div>
                            <button type="submit" class="btn btn-info btn-block">Login</button><br>
                            <center>Belum Memiliki Akun? <a href="<?= base_url('login/register'); ?>">Registrasi</a>
                                <center>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
</body>

</html>