<div class="container">
    <!-- info -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card border-info">
                <div class="card-header bg-info" style="color: white"><i class="fas fa-fw fa-users"></i>
                    <span>Jumlah Karyawan</span></div>
                <div class="card-body">
                    <h3 class="card-title jml-karyawan"></h3>
                    <a href="<?= base_url('karyawan'); ?>" class="badge badge-success">Lihat detail <i
                            class="fas fa-fw fa-chevron-circle-right"></i> </a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-info">
                <div class="card-header bg-info" style="color: white"><i class="fas fa-fw fa-bars"></i> <span>Jumlah
                        Kriteria</span></div>
                <div class="card-body">
                    <h3 class="card-title jml-kriteria"></h3>
                    <a href="<?= base_url('kriteria'); ?>" class="badge badge-success">Lihat detail <i
                            class="fas fa-fw fa-chevron-circle-right"></i> </a>

                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-info">
                <div class="card-header bg-info" style="color: white"><i class="fas fa-fw fa-caret-down"></i>
                    <span>Jumlah Sub Kriteria</span></div>
                <div class="card-body">
                    <h3 class="card-title jml-sub"></h3>
                    <a href="<?= base_url('sub_kriteria'); ?>" class="badge badge-success">Lihat detail <i
                            class="fas fa-fw fa-chevron-circle-right"></i> </a>

                </div>
            </div>
        </div>
    </div>

    <!-- chart -->
    <div class="row">
        <div class="col-md-5">
            <div class="card border-primary">
                <div class="card-header bg-primary" style="color: white"><i class="fas fa-fw fa-chart-bar"></i>
                    <span>Grafik Hasil Penilaian</span>
                    <div class="col-md-5 float-right">
                        <select class="form-control" id="filterTgl" name="filterTgl"></select>
                    </div>
                </div>
                <div class="card-body">
                    <div id="grafik-mpe" style="height: 250px; width: 100%;">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-7">
            <div class="card border-primary">
                <div class="card-header bg-primary" style="color: white"><i class="fas fa-fw fa-server"></i>
                    <span>Tabel Hasil Penilaian</span>
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