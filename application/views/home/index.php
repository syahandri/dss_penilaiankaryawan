<div class="container-fluid">

    <!-- info -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card border-info">
                <div class="card-header bg-info" style="color: white"><i class="fas fa-fw fa-users"></i>
                    <span class="font-weight-bold">Jumlah Karyawan</span></div>
                <div class="card-body">
                    <i class="fas fa-fw fa-users fa-3x"></i>
                    <h3 class="card-title jml-karyawan float-right"></h3>
                </div>
                <div class="card-footer">
                    <a href="<?= base_url('karyawan'); ?>" class="badge badge-success float-right">Lihat detail <i
                            class="fas fa-fw fa-chevron-circle-right"></i> </a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-info">
                <div class="card-header bg-info" style="color: white"><i class="fas fa-fw fa-bars"></i>
                    <span class="font-weight-bold">Jumlah Kriteria</span></div>
                <div class="card-body">
                    <i class="fas fa-fw fa-bars fa-3x"></i>
                    <h3 class="card-title jml-kriteria float-right"></h3>
                </div>
                <div class="card-footer">
                    <a href="<?= base_url('kriteria'); ?>" class="badge badge-success float-right">Lihat detail <i
                            class="fas fa-fw fa-chevron-circle-right"></i> </a></div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-info">
                <div class="card-header bg-info" style="color: white"><i class="fas fa-fw fa-archive"></i>
                    <span class="font-weight-bold">Jumlah Sub Kriteria</span></div>
                <div class="card-body">
                    <i class="fas fa-fw fa-archive fa-3x"></i>
                    <h3 class="card-title jml-sub float-right"></h3>
                </div>
                <div class="card-footer">
                    <a href="<?= base_url('sub_kriteria'); ?>" class="badge badge-success float-right">Lihat detail <i
                            class="fas fa-fw fa-chevron-circle-right"></i> </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- chart -->
        <div class="col-md-5">
            <div class="card border-primary">
                <div class="card-header bg-primary" style="color: white"><i class="fas fa-fw fa-chart-bar"></i>
                    <span class="font-weight-bold">Grafik Hasil Penilaian</span>
                    <div class="col-md-5 float-right">
                        <select class="form-control" id="filterTgl" name="filterTgl" style="width:150px"></select>
                    </div>
                </div>
                <div class="card-body">
                    <div id="grafik-mpe" style="height: 250px; width: 100%;">
                    </div>
                </div>
            </div>
        </div>

        <!-- tabel hasil penilaian -->
        <div class="col-md-7">
            <div class="card border-primary">
                <div class="card-header bg-primary" style="color: white"><i class="fas fa-fw fa-server"></i>
                    <span class="font-weight-bold">Tabel Hasil Penilaian</span>
                </div>
                <div class="card-body">
                    <table class="table display responsive nowrap" style="width:100%" id="tablePenilaianHome">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>Tanggal</th>
                                <th>NIP</th>
                                <th>Nama Karyawan</th>
                                <th>Nilai MPE</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                </div>
            </div>
        </div>
    </div>
</div>