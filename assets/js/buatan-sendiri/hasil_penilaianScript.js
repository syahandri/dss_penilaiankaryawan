$(function () {
    if ($('.judul').html() == 'Hasil Penilaian Karyawan') {
    	$('.laporan').addClass('active');
    }
    // Fetch Data Table
    let table = $('#tableHasilPenilaian').DataTable({
        "serverSide": true, // serverside datatable
        "responsive": true, // datatable responsive
        "ordering": true, // Set true agar bisa di sorting
        "pagingType": "full_numbers", // paging type full number
        "order": [], // order by ... [1, 'asc']

        // add element search by date
        "dom": "<'row'<'col-sm-12 col-md-12 tombol mb-3'B>>" +
            "<'row'<'col-sm-12 col-md-1 dataTables_filter datesearchhasil'>>" +
            "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",

        buttons: [{
            className: 'cetak',
            extend: 'print',
            text: 'Cetak atau simpan ke PDF',
            // autoPrint: false
            customize: function (win) {
                $(win.document.body).find('h1').css('text-align', 'center');
            }
        }],


        "ajax": {
            "url": "hasil_penilaian/getDataHasil", // URL file untuk proses select datanya
            "type": "POST"
        },

        "columnDefs": [{
            "responsivePriority": 1,
            "targets": [-1],
        }],
        fixedHeader: true,
        fixedColumn: true
    });

    $('.cetak').toggleClass('btn-secondary btn-primary');

    // add input datepicker
    $("div.datesearchhasil").html('<label>Search by date: <input type="hidden" id="datesearchhasil"></label>');

    // change element input to datepicker
    $('#datesearchhasil').datepicker({
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

    $('.cetak').prepend('<i class="fas fa-print"></i> ')
});