<div class="container-fluid">
    <div class="row mt-3 justify-content-center">
        <div class="col-md-8">

            <div class="card">
                <div class="card-body">
                    <form action="" method="post" id="formProfile">
                        <input hidden id="old_foto" name="old_foto">
                        <div class="form-group">
                            <div class="text-center">
                                <img src="" class="img-fluid rounded" width="50%" id="imgFoto">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nipProfile">NIP</label>
                            <input type="text" name="nipProfile" class="form-control" id="nipProfile">
                            <small class="form-text text-danger nipProfile"></small>
                        </div>
                        <div class="form-group">
                            <label for="namaProfile">Nama</label>
                            <input type="text" name="namaProfile" class="form-control" id="namaProfile">
                            <small class="form-text text-danger namaProfile"></small>
                        </div>
                        <div class="form-group">
                            <label for="image">Foto Profil</label>
                            <div class="input-group mb-3">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="image"
                                        accept="image/png, image/jpg, image/jpeg, image/gif" name="image">
                                    <label class="custom-file-label" for="image">Choose file</label>
                                </div>
                            </div>
                            <small class="form-text text-danger file-error"></small>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary float-right"><i class="fas fa-save">
                            </i> Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>