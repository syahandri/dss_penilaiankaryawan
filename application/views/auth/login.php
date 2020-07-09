<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block">
                            <div class="info-login">
                                <h1>DSS PENILAIAN KARYAWAN</h1><br>
                                <p>Masuk untuk melanjutkan</p>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <div class="row">
                                        <div class="col-md-4"></div>
                                        <div class="col-md-4 login-profile">
                                            <img src="assets/img/profileHome.png" style="width: 100px;" alt="">
                                        </div>
                                    </div>
                                    <!-- <h1 class="h4 text-gray-900 mb-4">Selamat Datang</h1> -->
                                </div>
                                <form class="user" method="post" action="<?= base_url('auth') ?>" autocomplete="off">
                                    <div class="form-group text-center">
                                        <small class="form-text text-danger"><?= $this->session->flashdata('msg_nip'); ?></small>
                                    </div>
                                    <div class="form-group mb-4">

                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-user mt-2" aria-hidden="true"></i>
                                            </div>
                                            <input type="text" class="form-control" name="nip" id="nip" placeholder="Masukkan NIP" value="<?= $this->input->post('nip'); ?>">
                                        </div>
                                        <hr class="input">
                                        <div class="form-group text-center">
                                            <small class="form-text text-danger"><?= form_error('nip'); ?></small>
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-key mt-2" aria-hidden="true"></i>
                                            </div>
                                            <input type="password" class="form-control" name="password" id="password" placeholder="Kata sandi" value="<?= set_value('password'); ?>">
                                        </div>
                                        <hr class="input">
                                        <div class="form-group text-center">
                                            <small class="form-text text-danger"><?= form_error('password'); ?></small>
                                            <small class="form-text text-danger"><?= $this->session->flashdata('msg_password'); ?></small>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-user btn-block"><i class="fas fa-sign-in-alt"></i>
                                        Masuk
                                    </button>
                                </form>
                                <hr>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>