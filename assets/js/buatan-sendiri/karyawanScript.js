$(function () {
	if ($('.judul').html() == 'Data Karyawan') {
		$('.karyawan').addClass('active');
	}
	// variabel fungsi, akan diisi simpan / ubah (tergantung button yg diklik)
	let fungsi;

	// Tabel Kriteria
	// Fetch Data Table
	let table = $('#tableKaryawan').DataTable({
		"serverSide": true,
		"responsive": true,
		"ordering": true, // Set true agar bisa di sorting
		"pagingType": "full_numbers",
		"order": [],
		"ajax": {
			"url": "karyawan/getKaryawan", // URL file untuk proses select datanya
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

	// focus ke input type nip
	$('#modal_Karyawan').on('shown.bs.modal', function () {
		$('#nip').focus();
	});


	// fungsi hanya angka pada input nip dan telp
	$('#nip, #telp').on('keypress', function (e) {
		let charCode = (e.which) ? e.which : event.keyCode
		if (charCode > 31 && (charCode < 48 || charCode > 57))

			return false;
		return true;
	});

	// method add data
	$('#btnTambahKaryawan').on('click', function () {
		// isi variabel fungsi dengan 'simpan'
		fungsi = 'simpan';

		$('.modal-title').html('Tambah Data Karyawan');
		$('.modal-footer .buttonSubmit').html('<i class="fas fa-save"></i> Simpan');

		$('.nip, .nama, .gender, .alamat, .email, .telp').html('');

		$('#formKaryawan')[0].reset(); // reset form on modals
		$('#modal_Karyawan').modal('show'); // show modal
		$('#nip').attr('readonly', false);
	});

	// method update data
	$(document).on('click', '.updateKaryawan', function () {
		// isi variabel fungsi dengan 'ubah'
		fungsi = 'ubah';

		$('.modal-title').html('Edit Data Karyawan');
		$('.modal-footer .buttonSubmit').html('<i class="fas fa-edit"></i> Ubah data');

		$('.nip, .nama, .gender, .alamat, .email, .telp').html('');

		$('#formKaryawan')[0].reset(); // reset form on modals
		$('#modal_Karyawan').modal('show');
		$('#nip').attr('readonly', true);

		let id = $(this).attr('id');

		//Ajax Load data from ajax
		$.ajax({
			url: 'karyawan/getKaryawanById/',
			data: {
				id: id
			},
			type: "post",
			dataType: "JSON",
			success: function (data) {

				$('#nip').val(data.nip);
				$('#nama').val(data.nama_karyawan);

				if (data.jenis_kelamin == 'L') {
					$('#rdL').prop("checked", true);
				} else {
					$('#rdP').prop("checked", true);
				}

				$('#alamat').val(data.alamat);
				$('#email').val(data.email);
				$('#telp').val(data.no_telp);

			}
		});
	});

	// fungsi simpan & ubah data
	function save() {
		// jika isi dari variabel fungsi = simpan, panggil method tambahKriteria
		// jika isi dari variabel fungsi != simpan (ubah), panggil method ubahKriteria
		if (fungsi == 'simpan') {

			$.ajax({
				url: 'karyawan/tambahKaryawan/',
				type: "POST",
				data: $('#formKaryawan').serialize(),
				dataType: "JSON",
				success: function (data) {

					if (!data.status) {
						$('.nip').html(data.nip);
						$('.nama').html(data.nama);
						$('.gender').html(data.gender);
						$('.alamat').html(data.alamat);
						$('.email').html(data.email);
						$('.telp').html(data.telp);
					} else {
						Swal.fire({
							title: 'Data Karyawan',
							text: 'Berhasil Ditambahkan',
							icon: 'success'
						});

						$('#modal_Karyawan').modal('hide');
					}
				}

			});

		} else {

			$.ajax({
				url: 'karyawan/ubahKaryawan/',
				type: "POST",
				data: $('#formKaryawan').serialize(),
				dataType: "JSON",
				success: function (data) {

					if (!data.status) {
						$('.nip').html(data.nip);
						$('.nama').html(data.nama);
						$('.gender').html(data.gender);
						$('.alamat').html(data.alamat);
						$('.email').html(data.email);
						$('.telp').html(data.telp);
					} else {
						Swal.fire({
							title: 'Data Karyawan',
							text: 'Berhasil Diubah',
							icon: 'success'
						});

						$('#modal_Karyawan').modal('hide');
					}
				}
			});
		}
	}

	// fungsi submit pada form atau button
	$('#formKaryawan').on('submit', function (e) {

		// menghapus fungsi default dari form
		e.preventDefault();

		// panggil method save
		save();

		// panggil method reloadTable
		reloadTable();
	});

	// Method Delete Kriteria
	$(document).on('click', '.deleteKaryawan', function () {

		let id = $(this).attr('id');

		Swal.fire({
			title: 'Apakah anda yakin',
			text: "Karyawan akan dihapus?",
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
					url: "karyawan/hapusKaryawan/",
					data: {
						id: id
					},
					type: "POST",
					dataType: "JSON",
					success: function (data) {
						Swal.fire({
							title: 'Data Karyawan',
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