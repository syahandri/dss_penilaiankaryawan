$('.filterTgl').remove()
$.ajax({
	url: 'home/getTgl',
	type: 'post',
	dataType: 'JSON',
	success: function (data) {
		$.each(data, function (index) {
			$('#filterTgl').append(
				$('<option class="filterTgl" value ="' + data[index].tgl_penilaian + '">' + data[index].tgl_penilaian + '</option>')
			)
		})
	}
})

if ($('.judul').html() == 'Beranda') {
	$('.beranda').addClass('active');
}

$(document).ready(function () {
	load_data();
	dataTable();

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
		url: 'home/countKriteria',
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

function load_data() {
	$(document).ready(function () {
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
	})
}

function tampilGrafik(myData, tgl) {
	$(document).ready(function () {

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
	})
}

function dataTable() {
	$(document).ready(function () {

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

			"columnDefs": [{
				responsivePriority: 10001,
				targets: 2
			}],

			fixedHeader: true,
			fixedColumn: true
		})


		$("#tablePenilaianHome_filter > label > input[type='search']").prop('type', 'hidden');
		$("#tablePenilaianHome_filter > label").remove();

		// filter tabel hasil penilaian dengan tgl di grafik
		$('#filterTgl').change(function () {
			load_data();
			table.search($(this).val()).draw();
		})

		table.search($('#filterTgl').val()).draw();
	})
}
