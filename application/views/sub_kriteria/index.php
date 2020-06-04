<div class="container">
    <button class="btn btn-primary mt-3 mb-3" id="btnTambahSubKriteria"><i class="fas fa-plus"></i> Tambah Sub Kriteria</button>

    <div class="row">
        <div class="col">
            <table class="table display responsive nowrap table-striped table-bordere" style="width:100%"
                id="tableSubKriteria">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>Kode Sub Kriteria</th>
                        <th>Kode Kriteria</th>
                        <th>Sub Kriteria</th>
                        <th>Nilai</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody></tbody>
        </div>
    </div>
</div>



<!-- Bootstrap modal tambah data-->
<div class="modal fade" id="modal_subKriteria" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Tambah Data Sub Kriteria</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="" method="post" id="formSubKriteria">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="kodesubKriteria"> Kode Sub Kriteria </label>
                                <input type="text" class="form-control" id="kodesubKriteria" name="kodesubKriteria"
                                    maxlength="7">
                                <small class="form-text text-danger kodesubKriteria"></small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="kodeKriteria"> Kriteria </label>
                                <select class="form-control" id="kodeKriteria" name="kodeKriteria">
                                </select>
                                <small class="form-text text-danger kodeKriteria"></small>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="subKriteria"> Sub Kriteria </label>
                                <input type="text" class="form-control" id="subKriteria" name="subKriteria"
                                    maxlength="20">
                                <small class="form-text text-danger subKriteria"></small>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="nilai"> Nilai </label>
                                <input type="text" class="form-control" id="nilai" name="nilai" maxlength="3">
                                <small class="form-text text-danger nilai"></small>
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