$('#formProfile').ready(function () {

    let nip = $('.profile').attr('id');

    $('.file-error').html('* pastikan unggah file gambar (".jpeg", ".jpg", ".png", ".gif") ');

    //Ajax Load data from ajax
    $.ajax({
        url: 'profile/getProfileById',
        data: {
            nipProfile: nip
        },
        type: "post",
        dataType: "JSON",
        success: function (data) {
            // $('#nip').val(data.nip);
            $('#old_foto').val(data.foto)
            $('#nipProfile').val(data.nip);
            $('#namaProfile').val(data.nama);
            $('#imgFoto').attr('src', 'assets/img/upload/' + data.foto);

            $('#nipProfile, #namaProfile').attr('readonly', true);

            $('.profile-image').attr('src', 'assets/img/upload/' + data.foto);
            $('.profile-name').html(data.nama);

            $(".custom-file-input").on("change", function () {
                let fileName = $(this).val().split("\\").pop();
                $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
                if (fileName == '') {
                    $('#imgFoto').attr('src', 'assets/img/upload/' + data.foto);
                    $('.custom-file-label').addClass("selected").html('Choose file');
                } else if (this.files && this.files[0]) {
                    let reader = new FileReader();
                    reader.onload = function (e) {
                        $('#imgFoto').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(this.files[0]);
                }
            });
        }
    });

    $('#formProfile').on('submit', function (e) {
        e.preventDefault();

        $.ajax({
            url: 'profile/ubahProfile/',
            type: "POST",
            // data: $('#formProfile').serialize(),
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            dataType: "JSON",
            success: function (data) {

                if (data.status == true) {
                    Swal.fire({
                        title: 'Data Profile',
                        text: 'Berhasil Diubah',
                        icon: 'success'
                    });
                    $('.file-error').html('* pastikan unggah file gambar (".jpeg", ".jpg", ".png", ".gif") ');
                    $('.nipProfile, .namaProfile').html('');
                    $('.custom-file-label').addClass("selected").html('Choose file');

                    $.ajax({
                        url: 'profile/getProfileById',
                        data: {
                            nipProfile: nip
                        },
                        type: "post",
                        dataType: "JSON",
                        success: function (data) {
                            $('.profile-name').html(data.nama);
                            $('.profile-image').attr('src', 'assets/img/upload/' + data.foto);
                        }
                    });
                } else {
                    $('.file-error').html(data.error);
                    $('.nipProfile').html(data.nipProfile);
                    $('.namaProfile').html(data.namaProfile);
                }
            }

        });
    });
});