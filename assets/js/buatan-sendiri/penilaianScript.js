$(document).ready(function () {
    let table;

    // variabel fungsi, akan diisi simpan / ubah (tergantung button yg diklik)
    let fungsi;

    // Tabel Kriteria
    // Fetch Data Table
    table = $('#tablePenilaian').DataTable({
        "serverSide": true,
        "responsive": true,
        "ordering": true, // Set true agar bisa di sorting
        "pagingType": "full_numbers",
        "order": [],
        "ajax": {
            "url": "penilaian/getDataPenilaian", // URL file untuk proses select datanya
            "type": "POST"
        },

        "columnDefs": [{
            "responsivePriority": 1,
            "targets": [-1],
            "width": '5%',
            "targets": -1
        }],
        fixedHeader: true,
        fixedColumn: true
    });

    // reload data table
    function reloadTable() {
        table.ajax.reload(null, false); //reload datatable ajax 
    }

    // isi option value dengan kriteria
    function getNip() {
        $.ajax({
            url: 'penilaian/getNip',
            type: "post",
            dataType: "JSON",
            success: function (data) {
                $.each(data, function (index) {
                    $('#nip_nilai').append($('<option class="temp" value ="' + data[index].nip + '">' + data[index].nip + " - " + data[index].nama_karyawan + ' </option>'));

                })

            }
        });

        $('select[name="nip_nilai"]').on('change', function () {
            console.log($(this).text());
        });


    }

    function getKriteria() {
        $.ajax({
            url: 'penilaian/getKriteria',
            type: "post",
            dataType: "JSON",
            success: function (data) {
                $.each(data, function (index) {
                    $('#kriteria_nilai').append($('<option class="temp" value ="' + data[index].kode_kriteria + '">' + data[index].kriteria + '</option>'));
                });
            }
        });
    }

    function getSubKriteria() {
        $.ajax({
            url: 'penilaian/getSubKriteria',
            type: "post",
            dataType: "JSON",
            success: function (data) {
                $.each(data, function (index) {
                    $('#sub_nilai').append($('<option class="temp" value ="' + data[index].kode_subkriteria + '">' + data[index].subkriteria + '</option>'));
                });
            }
        });
    }

    // method add data
    $('#btnTambahPenilaian').on('click', function () {
        // isi variabel fungsi dengan 'simpan'
        fungsi = 'simpan';

        $('.modal-title').html('Tambah Data Penilaian');
        $('.modal-footer .buttonSubmit').html('<i class="fas fa-save"></i> Simpan');

        $('.kodesubKriteria').html('');
        $('.kodeKriteria').html('');
        $('.subKriteria').html('');
        $('.nilai').html('');

        $('#formPenilaian')[0].reset(); // reset form on modals
        $('#modal_penilaian').modal('show');

        $('option').remove('.temp');
        getNip();
        getKriteria();
        getSubKriteria();
    });
});