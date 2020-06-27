<div class="container-fluid">
    <button class="btn btn-primary mt-3 mb-3" id="btnTambahKriteria"><i class="fas fa-plus"></i> Tambah
        Kriteria</button>

    <div class="row">
        <div class="col">
            <table class="table display responsive nowrap table-striped" style="width:100%"
                id="tableKriteria">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>Kode Kriteria</th>
                        <th>Kriteria</th>
                        <th>Bobot</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody></tbody>
        </div>
    </div>
</div>



<!-- Bootstrap modal Data Kriteria-->
<div class="modal fade" id="modal_Kriteria" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title"></h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="" method="post" id="formKriteria">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="kodeKriteria"> Kode Kriteria </label>
                                <input type="text" class="form-control" id="kodeKriteria" name="kodeKriteria"
                                    maxlength="7">
                                <small class="form-text text-danger kodeKriteria"></small>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="kriteria"> Kriteria </label>
                                <input type="text" class="form-control" id="kriteria" name="kriteria" maxlength="30">
                                <small class="form-text text-danger kriteria"></small>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="bobot"> Bobot </label>
                                <input type="text" class="form-control" id="bobot" name="bobot" maxlength="3">
                                <small class="form-text text-danger bobot"></small>
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