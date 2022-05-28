<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rangking</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css'); ?>">
    <style>
        body {
            margin-top: 100px;
            background-image:url(<?= base_url('assets/background.jpg')?>); 
            background-size:cover; 
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
                    <div class="panel-heading"><h3 class="text-center">REGISTRASI</h3></div>
                    <?php  if ($this->session->flashdata()) : ?>
                        <?= $this->session->flashdata('message'); ?>
                    <?php endif; ?>

                    <div class="panel-body">
                        <form action="<?= base_url('login/register')?>" method="POST">
                        <div class="form-group">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" name="username" class="form-control " id="username" placeholder="username minimal 5 digit" autofocus="on">
                                <small class="text-danger">
                                    <?= form_error('username') ?>
                                </small>
                            </div>
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control" id="email" placeholder="ex : nama@gmail.com">
                                <small class="text-danger">
                                    <?= form_error('email') ?>
                                </small>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control " id="password" placeholder="Password minimal 5 digit">
                                <small class="text-danger">
                                    <?= form_error('password') ?>
                                </small>
                            </div>
                            <div class="form-group">
                                <label for="">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="mahasiswa">Mahasiswa</option>
                                    <option value="puket">Puket</option>
                                </select>
                                <small class="text-danger">
                                    <?= form_error('status') ?>
                                </small>
                            </div>
                            <button type="submit" class="btn btn-info btn-block">Daftar</button><br>
                            <center>Sudah Memiliki Akun? <a href="<?= base_url('login');?>">Login</a><center>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
</body>
</html>
