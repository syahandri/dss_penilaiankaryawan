window.onload = function () {
  load_data();

  let table = $('#tablePenilaianHome').DataTable({
    "serverSide": true, // serverside datatable
    "responsive": true, // datatable responsive
    "ordering": true, // Set true agar bisa di sorting
    "pagingType": "simple", // paging type full number
    "order": [], // order by ... [1, 'asc']

    "ajax": {
      "url": "hasil_penilaian/getDataHasil", // URL file untuk proses select datanya
      "type": "POST"
    },

    "columnDefs": [
      {
        responsivePriority: 10001,
        targets: 2
      }
    ],

    fixedHeader: true,
    fixedColumn: true
  })

  table.search($('#filterTgl').val()).draw();

  $('#filterTgl').change(function () {
    let tgl = $(this).val()
    if (tgl != '' || tgl != '--- Pilih Tanggal ---') {
      load_data();
      table.search($(this).val()).draw();
    }
  })
}

$(document).ready(function () {
  load_data();

  // jumlah karyawan
  $.ajax({
    url: 'home/countKaryawan',
    type: 'post',
    dataType: 'JSON',
    success: function (data) {
      $('.jml-karyawan').html(data + ' Karyawan')
    }
  })

  // jumlah kriteria
  $.ajax({
    url: 'home/countkriteria',
    type: 'post',
    dataType: 'JSON',
    success: function (data) {
      $('.jml-kriteria').html(data + ' Kriteria')
    }
  })

  // jumlah sub
  $.ajax({
    url: 'home/countSub',
    type: 'post',
    dataType: 'JSON',
    success: function (data) {
      $('.jml-sub').html(data + ' Sub Kriteria')
    }
  })
})


// canvasJS chart
$('.filterTgl').remove()

$.ajax({
  url: 'home/getTgl',
  type: 'post',
  dataType: 'JSON',
  success: function (data) {
    $.each(data, function (index) {
      $('#filterTgl').append(
        $(
          '<option class="filterTgl" value ="' +
          data[index].tgl_penilaian +
          '">' +
          data[index].tgl_penilaian +
          '</option>'
        )
      )
    })
  }
})

function load_data() {

  let tgl = $('#filterTgl').val();

  $.ajax({
    url: 'home/getHasil',
    method: 'POST',
    data: {
      filterTgl: tgl
    },
    dataType: 'JSON',
    success: function (data) {
      tampilGrafik(data, tgl)
    }
  })
}

function tampilGrafik(myData, tgl) {

  let jsonData = myData;
  let dataPoints = [];

  for (let i = 0; i < jsonData.length; i++) {
    dataPoints.push({
      label: jsonData[i].nama_karyawan,
      y: jsonData[i].nilai_mpe
    });
  }

  let options = {
    animationEnabled: true,
    exportEnabled: true,
    theme: "light2",
    title: {
      text: "Penilaian pada tanggal " + tgl,
      fontSize: 13,
      fontWeight: "normal"
    },
    axisY: {
      title: "Nilai MPE",
      includeZero: true,
      minimum: 0,
      maximum: 1
    },
    axisX: {
      title: "Karyawan"
    },
    data: [{
      type: "column",
      dataPoints: dataPoints
    }]
  };

  $("#grafik-mpe").CanvasJSChart(options);
}