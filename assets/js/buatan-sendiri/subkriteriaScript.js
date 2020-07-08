$(function () {
	// variabel fungsi, akan diisi simpan / ubah (tergantung button yg diklik)
	let fungsi;

	// Tabel Kriteria
	// Fetch Data Table
	let table = $('#tableSubKriteria').DataTable({
		"serverSide": true,
		"responsive": true,
		"ordering": true, // Set true agar bisa di sorting
		"pagingType": "full_numbers",
		"order": [],
		"ajax": {
			"url": "sub_kriteria/getSubKriteria", // URL file untuk proses select datanya
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

	// focus ke input type kriteria saat modal terbuka
	$('#modal_subKriteria').on('shown.bs.modal', function () {
		$('#kodeKriteria').focus();
	});

	// fungsi hanya angka pada input bobot
	$('#nilai').on('keypress', function (e) {
		let charCode = (e.which) ? e.which : event.keyCode
		if (charCode > 31 && (charCode < 48 || charCode > 57))

			return false;
		return true;
	});

	// fungsi kode sub kriteria terisi otomatis
	function kodeOtomatis() {
		$.ajax({
			url: 'Sub_kriteria/kodeOtomatis/',
			type: "post",
			dataType: "JSON",
			success: function (data) {

				$('#kodesubKriteria').val(data.kodeUrut);
			}
		});
	}

	// isi option value dengan kriteria
	function getKriteria() {
		$.ajax({
			url: 'Sub_kriteria/getKodeKriteria/',
			type: "post",
			dataType: "JSON",
			success: function (data) {
				$.each(data, function (index) {
					$('#kodeKriteria').append($('<option class="temp" value ="' + data[index].kode_kriteria + '">' + data[index].kriteria + '</option>'));
				});
			}
		});
	}
	// method add data
	$('#btnTambahSubKriteria').on('click', function () {
		// isi variabel fungsi dengan 'simpan'
		fungsi = 'simpan';

		$('.modal-title').html('Tambah Data Kriteria');
		$('.modal-footer .buttonSubmit').html('<i class="fas fa-save"></i> Simpan');

		$('.kodesubKriteria, .kodeKriteria, .subKriteria, .nilai').html('');

		$('#formSubKriteria')[0].reset(); // reset form on modals
		$('#modal_subKriteria').modal('show');
		$('#kodesubKriteria').attr('readonly', true);

		kodeOtomatis();
		$('.temp').remove();
		getKriteria();
	});

	// method update data
	$(document).on('click', '.updateSubKriteria', function () {
		// isi variabel fungsi dengan 'ubah'
		fungsi = 'ubah';

		$('.temp').remove();
		getKriteria();

		$('.modal-title').html('Edit Data Kriteria');
		$('.modal-footer .buttonSubmit').html('<i class="fas fa-edit"></i> Ubah data');

		$('.kodesubKriteria, .kodeKriteria, .subKriteria, .nilai').html('');

		$('#formSubKriteria')[0].reset(); // reset form on modals
		$('#modal_subKriteria').modal('show'); // show bootstrap modal when complete loaded
		$('#kodesubKriteria').attr('readonly', true);

		let id = $(this).attr('id');

		//Ajax Load data from ajax
		$.ajax({
			url: 'sub_kriteria/getSubKriteriaById/',
			data: {
				id: id
			},
			type: "post",
			dataType: "JSON",
			success: function (data) {

				$('#kodeKriteria').val(data.kode_kriteria);
				$('#kodesubKriteria').val(data.kode_subkriteria);
				$('#subKriteria').val(data.subkriteria);
				$('#nilai').val(data.nilai);
			}
		});
	});

	// fungsi simpan & ubah data
	function save() {
		// jika isi dari variabel fungsi = simpan, panggil method tambahKriteria
		// jika isi dari variabel fungsi != simpan (ubah), panggil method ubahKriteria
		if (fungsi == 'simpan') {

			$.ajax({
				url: 'sub_kriteria/tambahSubKriteria/',
				type: "POST",
				data: $('#formSubKriteria').serialize(),
				dataType: "JSON",
				success: function (data) {

					if (!data.status) {
						$('.kodeKriteria').html(data.kodeKriteria);
						$('.kodesubKriteria').html(data.kodesubKriteria);
						$('.subKriteria').html(data.subKriteria);
						$('.nilai').html(data.nilai);
					} else {
						Swal.fire({
							title: 'Data Sub Kriteria',
							text: 'Berhasil Ditambahkan',
							icon: 'success'
						});

						$('#modal_subKriteria').modal('hide');
					}
				}

			});

		} else {

			$.ajax({
				url: 'sub_kriteria/ubahSubKriteria/',
				type: "POST",
				data: $('#formSubKriteria').serialize(),
				dataType: "JSON",
				success: function (data) {

					if (!data.status) {
						$('.kodeKriteria').html(data.kodeKriteria);
						$('.kodesubKriteria').html(data.kodesubKriteria);
						$('.subKriteria').html(data.subKriteria);
						$('.nilai').html(data.nilai);
					} else {
						Swal.fire({
							title: 'Data Sub Kriteria',
							text: 'Berhasil Diubah',
							icon: 'success'
						});

						$('#modal_subKriteria').modal('hide');
					}
				}

			});
		}
	}

	// fungsi submit pada form atau button
	$('#formSubKriteria').on('submit', function (e) {

		// menghapus fungsi default dari form
		e.preventDefault();

		// panggil method save
		save();

		// panggil method reloadTable
		reloadTable();
	});

	// Method Delete Kriteria
	$(document).on('click', '.deleteSubKriteria', function () {

		let id = $(this).attr('id');

		Swal.fire({
			title: 'Apakah anda yakin',
			text: "Sub Kriteria akan dihapus?",
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
					url: "sub_kriteria/hapusSubKriteria/",
					data: {
						id: id
					},
					type: "POST",
					dataType: "JSON",
					success: function (data) {
						if (data.code != 0) {

							$('.hapus-alert').html(`
							<div class="alert alert-danger alert-dismissible fade show" role="alert">
								<strong>` + data.code + `</strong>` +  ` - `  + data.message +
								`<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>`
							+
							`<div class="alert alert-danger alert-dismissible fade show" role="alert">
								Data Sub Kriteria tidak dapat dihapus karena terhubung dengan data di penilaian
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>`)
						} else {
							Swal.fire({
								title: 'Data Sub Kriteria',
								text: 'Berhasil Dihapus',
								icon: 'success'
							});
						}
						reloadTable();
					}
				});
			}
		})

	});
});