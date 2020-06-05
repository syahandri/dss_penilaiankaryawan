<div class="container">
    <div class="row mt-3 justify-content-center">
        <div class="col-md-8">

            <div class="card">
                <div class="card-header">
                    <strong>Form Profile</strong>
                </div>
                <div class="card-body">

                    <form action="" method="post">
                        <input hidden id="id" name="id">
                        <div class="form-group">
                            <img src="<?= $profile['foto']; ?>" class="rounded mx-auto d-block" id="imgFoto" width="20%" height="20%">
                        </div>

                        <div class="form-group">
                            <label for="nip">NIP</label>
                            <input type="text" name="nip" class="form-control" id="nip" value="<?= $profile['nip']; ?>">
                            <small class="form-text text-danger"><?= form_error('nip'); ?></small>
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" name="nama" class="form-control" id="nama">
                            <small class="form-text text-danger"><?= form_error('nama'); ?></small>
                        </div>
                        <div class="form-group">
                            <label for="foto">Foto Profil</label>
                            <div class="input-group mb-3">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="foto">
                                    <label class="custom-file-label" for="foto">Choose file</label>
                                </div>
                            </div>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary float-right">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>