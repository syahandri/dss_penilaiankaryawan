$(function () {

	if ($('.judul').html() == 'Daftar Kriteria' || $('.judul').html() == 'Daftar Sub Kriteria') {
		$('.kriterias').addClass('active');
	}

	// variabel fungsi, akan diisi simpan / ubah (tergantung button yg diklik)
	let fungsi;

	// Tabel Kriteria
	// Fetch Data Table
	table = $('#tableKriteria').DataTable({
		"serverSide": true,
		"responsive": true,
		"ordering": true, // Set true agar bisa di sorting
		"pagingType": "full_numbers",
		"order": [],

		"ajax": {
			"url": "kriteria/getKriteria/", // URL file untuk proses select datanya
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

	// focus ke input type kriteria
	$('#modal_Kriteria').on('shown.bs.modal', function () {
		$('#kriteria').focus();
	});

	// fungsi hanya angka pada input bobot
	$('#bobot').on('keypress', function (e) {
		let charCode = (e.which) ? e.which : event.keyCode
		if (charCode > 31 && (charCode < 48 || charCode > 57))

			return false;
		return true;
	});

	// fungsi kode kriteria terisi otomatis
	function kodeOtomatis() {
		$.ajax({
			url: 'kriteria/kodeOtomatis/',
			type: "post",
			dataType: "JSON",
			success: function (data) {

				$('#kodeKriteria').val(data.kodeUrut);
			}
		});
	}

	// method add data
	$('#btnTambahKriteria').on('click', function () {
		// isi variabel fungsi dengan 'simpan'
		fungsi = 'simpan';

		$('.modal-title').html('Tambah Data Kriteria');
		$('.modal-footer .buttonSubmit').html('<i class="fas fa-save"></i> Simpan');

		$('.kodeKriteria, .kriteria, .bobot').html('');

		$('#formKriteria')[0].reset(); // reset form on modals
		$('#modal_Kriteria').modal('show');
		$('#kodeKriteria').attr('readonly', true);
		kodeOtomatis();
	});

	// method update data
	$(document).on('click', '.updateKriteria', function () {
		// isi variabel fungsi dengan 'ubah'
		fungsi = 'ubah';

		$('.modal-title').html('Edit Data Kriteria');
		$('.modal-footer .buttonSubmit').html('<i class="fas fa-edit"></i> Ubah data');

		$('.kodeKriteria, .kriteria, .bobot').html('');

		$('#formKriteria')[0].reset(); // reset form on modals
		$('#modal_Kriteria').modal('show'); // show bootstrap modal when complete loaded
		$('#kodeKriteria').attr('readonly', true);

		let id = $(this).attr('id');

		//Ajax Load data from ajax
		$.ajax({
			url: 'kriteria/getKriteriaById/',
			data: {
				id: id
			},
			type: "post",
			dataType: "JSON",
			success: function (data) {

				$('#kodeKriteria').val(data.kode_kriteria);
				$('#kriteria').val(data.kriteria);
				$('#bobot').val(data.bobot);
			}
		});
	});

	// fungsi simpan & ubah data
	function save() {
		// jika isi dari variabel fungsi = simpan, panggil method tambahKriteria
		// jika isi dari variabel fungsi != simpan (ubah), panggil method ubahKriteria
		if (fungsi == 'simpan') {

			$.ajax({
				url: 'kriteria/tambahKriteria/',
				type: "POST",
				data: $('#formKriteria').serialize(),
				dataType: "JSON",
				success: function (data) {

					if (!data.status) {
						$('.kodeKriteria').html(data.kodeKriteria);
						$('.kriteria').html(data.kriteria);
						$('.bobot').html(data.bobot);
					} else {
						Swal.fire({
							title: 'Data Kriteria',
							text: 'Berhasil Ditambahkan',
							icon: 'success'
						});

						$('#modal_Kriteria').modal('hide');
					}
				}

			});

		} else {

			$.ajax({
				url: 'kriteria/ubahKriteria/',
				type: "POST",
				data: $('#formKriteria').serialize(),
				dataType: "JSON",
				success: function (data) {

					if (!data.status) {
						$('.kodeKriteria').html(data.kodeKriteriaEdit);
						$('.kriteria').html(data.kriteriaEdit);
						$('.bobot').html(data.bobotEdit);
					} else {
						Swal.fire({
							title: 'Data Kriteria',
							text: 'Berhasil Diubah',
							icon: 'success'
						});
						$('#modal_Kriteria').modal('hide');
					}
				}

			});
		}
	}

	// fungsi submit pada form atau button
	$('#formKriteria').on('submit', function (e) {

		// menghapus fungsi default dari form
		e.preventDefault();

		// panggil method save
		save();

		// panggil method reloadTable
		reloadTable();
	});

	// Method Delete Kriteria
	$(document).on('click', '.deleteKriteria', function () {

		let id = $(this).attr('id');

		Swal.fire({
			title: 'Apakah anda yakin?',
			text: 'Menghapus data kriteria juga akan menghapus data subkriteria',
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
					url: "kriteria/hapusKriteria/",
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
								Data Kriteria tidak dapat dihapus karena terhubung dengan data di penilaian
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>`)
						} else {
							Swal.fire({
								title: 'Data Kriteria',
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