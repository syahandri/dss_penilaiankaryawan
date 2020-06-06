<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-lg-6">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Selamat Datang</h1>
                                </div>
                                <form class="user" method="post" action="<?= base_url('auth/authentication') ?>">
                                    <div class="form-group text-center">
                                        <small class="form-text text-danger"><?= $this->session->flashdata('msg_nip'); ?></small>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" name="nip" id="nip" placeholder="Masukkan NIP" value="<?= $this->session->userdata('ses_nip'); ?>">
                                        <div class="form-group text-center">
                                            <small class="form-text text-danger"><?= form_error('nip'); ?></small>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user" name="password" id="password" placeholder="Kata sandi" value="<?= set_value('password'); ?>">
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