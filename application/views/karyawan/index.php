<div class="container">
    <button class="btn btn-primary mt-3 mb-3" id="btnTambahKaryawan"><i class="fas fa-plus"></i> Tambah Data Karyawan</button>

    <div class="row">
        <div class="col">
            <table class="table display responsive nowrap table-striped table-bordere" style="width:100%"
                id="tableKaryawan">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>NIP</th>
                        <th>Nama Karyawan</th>
                        <th>Jenis Kelamin</th>
                        <th>E-mail</th>
                        <th>Telepon</th>
                        <th>Alamat</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody></tbody>
        </div>
    </div>
</div>



<!-- Bootstrap modal Data Karyawan -->
<div class="modal fade" id="modal_Karyawan" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title"></h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="" method="post" id="formKaryawan">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="nip"> NIP </label>
                                <input type="text" class="form-control" id="nip" name="nip" maxlength="20">
                                <small class="form-text text-danger nip"></small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="nama"> Nama Karyawan </label>
                                <input type="text" class="form-control" id="nama" name="nama" maxlength="30">
                                <small class="form-text text-danger nama"></small>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="gender"> Jenis Kelamin </label> <br>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender"
                                        id="rdL" value="L">
                                    <label class="form-check-label" for="rdL">Laki-laki</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender"
                                        id="rdP" value="P">
                                    <label class="form-check-label" for="rdP">Perempuan</label>
                                </div>
                                <small class="form-text text-danger gender"></small>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="alamat"> Alamat </label>
                                <textarea class="form-control" id="alamat" name="alamat" maxlength="100"></textarea>
                                <small class="form-text text-danger alamat"></small>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="email"> E-mail </label>
                                <input type="text" class="form-control" id="email" name="email" maxlength="25">
                                <small class="form-text text-danger email"></small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="telp"> Telepon </label>
                                <input type="text" class="form-control" id="telp" name="telp" maxlength="13">
                                <small class="form-text text-danger telp"></small>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i
                                class="fas fa-times"></i>
                            Batal</button>
                        <button type="submit" class="btn btn-primary buttonSubmit"></button>
                    </div>
            </div>
            </form>
        </div>
    </div>
</div><!-- /.modal -->
<!-- End Bootstrap modal -->