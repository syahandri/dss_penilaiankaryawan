// canvasJS chart
$(document).ready(function () {

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

  $('#filterTgl').change(function () {
    let tgl = $(this).val()
    if (tgl != '' || tgl != '--- Pilih Tanggal ---') {
      load_data()
    }
  })
})
