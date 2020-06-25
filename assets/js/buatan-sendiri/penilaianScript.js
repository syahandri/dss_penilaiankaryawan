$(function () {
    if ($('.judul').html() == 'Form Penilaian Karyawan') {
    	$('.penilaian').addClass('active');
    }
    // Fetch Data Table
    let table = $('#tablePenilaian').DataTable({
        "serverSide": true, // serverside datatable
        "responsive": true, // datatable responsive
        "ordering": true, // Set true agar bisa di sorting
        "pagingType": "full_numbers", // paging type full number
        "order": [], // order by ... [1, 'asc']

        // add element search by date
        "dom": "<'row'<'col-sm-12 col-md-1'<'dataTables_filter datesearchbox'>>>" + "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",

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

    // add input datepicker
    $("div.datesearchbox").html('<label>Search by date: <input hidden id="datesearch"></label>');

    // change element input to datepicker
    $('#datesearch').datepicker({
        dateFormat: "yy-mm-dd",
        showAnim: "slideDown",
        gotoCurrent: true,
        showOn: "button",
        buttonImage: "assets/css/images/calender.gif",
        buttonImageOnly: false,
        buttonText: "Select date",
        onSelect: function () {
            table.search($(this).val()).draw();
        }
    });

    // reload data table
    function reloadTable() {
        table.ajax.reload(null, false); //reload datatable ajax 
    }

    // datepicker
    $('#tgl_penilaian').datepicker({
        // autoSize: true,
        dateFormat: "yy-mm-dd",
        showAnim: "slideDown",
        gotoCurrent: true
    });

    function getNipKriteriaSub() {
        // Nip
        $.ajax({
            url: 'penilaian/getNip',
            type: "post",
            dataType: "JSON",
            success: function (data) {
                $.each(data, function (index) {
                    $('#nip_nilai').append($('<option class="temp" value ="' + data[index].nip + '">' + data[index].nip_nama + '</option>'));

                });
            }
        });

        // Kriteria
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

        // Sub Kriteria
        $('#kriteria_nilai').on('change', function () {
            let kode = $(this).val();

            $.ajax({
                data: {
                    kriteria_nilai: kode
                },
                url: 'penilaian/getSubKriteria',
                type: "post",
                dataType: "JSON",
                success: function (data) {
                    $('option').remove('.tempp');
                    $.each(data, function (index) {
                        $('#sub_nilai').append($('<option class="tempp" value ="' + data[index].kode_subkriteria + '">' + data[index].subkriteria + '</option>'));
                    });
                }
            });
        });
    }

    // method add data
    $('#btnTambahPenilaian').on('click', function () {

        $('.tgl_penilaian, .nip_nilai, .kriteria_nilai, .sub_nilai').html('');

        $('.modal-title').html('Tambah Data Penilaian');
        $('.modal-footer .btnSimpan').html('<i class="fas fa-save"></i> Simpan');

        $('#formPenilaian')[0].reset(); // reset form on modals
        $('#modal_penilaian').modal('show');

        $('.tempp, .temp').remove();

        getNipKriteriaSub();
    });

    // Method submit / simpan
    $('#formPenilaian').on('submit', function (e) {

        // menghapus fungsi default dari form
        e.preventDefault();

        $.ajax({
            url: 'penilaian/tambahPenilaian/',
            type: "POST",
            data: $('#formPenilaian').serialize(),
            dataType: "JSON",
            success: function (data) {

                if (!data.status) {
                    $('.tgl_penilaian').html(data.tgl_penilaian);
                    $('.nip_nilai').html(data.nip_nilai);
                    $('.kriteria_nilai').html(data.kriteria_nilai);
                    $('.sub_nilai').html(data.sub_nilai);
                } else {
                    Swal.fire({
                        title: 'Data Penilaian',
                        text: 'Berhasil Ditambahkan',
                        icon: 'success'
                    });

                    $('#modal_penilaian').modal('hide');
                }
            }

        });

        // panggil method reloadTable
        reloadTable();
    });

    // Method Delete Kriteria
    $(document).on('click', '.deletePenilaian', function () {

        let nip_nilai = $(this).attr('id');
        let tgl_penilaian = $(this).attr('name');

        Swal.fire({
            title: 'Apakah anda yakin',
            text: "Data Penilaian yang terkait akan dihapus?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Batal',
            confirmButtonText: 'Hapus data'
        }).then((result) => {
            if (result.value) {
                // ajax delete data to database
                $.ajax({
                    url: "penilaian/hapusPenilaian/",
                    data: {
                        nip_nilai: nip_nilai,
                        tgl_penilaian: tgl_penilaian
                    },
                    type: "POST",
                    dataType: "JSON",
                    success: function (data) {
                        Swal.fire({
                            title: 'Data Penilaian',
                            text: 'Berhasil Dihapus',
                            icon: 'success'
                        });
                        reloadTable();
                    }
                });
            }
        })

    });
});