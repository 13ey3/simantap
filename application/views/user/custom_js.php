<script type="text/javascript">
    var data_user = <?= json_encode($data_user) ?>;
    var btn_upload = document.getElementById('btn-upload');
    var csrfHash = '<?= $this->security->get_csrf_hash(); ?>';

    btn_upload.addEventListener('click', (e) => {
        e.preventDefault();
        alert("gambar sudah di upload!");
    });

    function getJenisUsaha() {
        $.post(base_url + 'jenis_usaha/getJenisUsahaAjax', {
            <?= $this->security->get_csrf_token_name(); ?>: csrfHash
        }, (result) => {

            var data = JSON.parse(result);
            var option = '<option value="">Pilih</option>';

            for (let i = 0; i < data.length; i++) {
                option += '<option value="' + data[i].id_usaha + '">' + data[i].deskripsi + '</option>';
            }

            $('#jenis_usaha').html(option);
            if (data_user.c_id_usaha !== null) {
                $('#jenis_usaha').val(data_user.c_id_usaha);
            }
        });
    }

    function getKecamatan() {
        $.post(base_url + 'kecamatan/getKecamatanAjax', {
            <?= $this->security->get_csrf_token_name(); ?>: csrfHash
        }, (result) => {
            var data = JSON.parse(result);
            var option = '<option value="">Pilih</option>';

            for (let i = 0; i < data.length; i++) {
                option += '<option value="' + data[i].id_kecamatan + '">' + data[i].deskripsi + '</option>';
            }

            $('#id_kecamatan_pemohon').html(option);
            if (data_user.c_id_kecamatan_pemohon !== null) {
                $('#id_kecamatan_pemohon').val(data_user.c_id_kecamatan_pemohon);
            }
        });

    }

    function getKelurahan(param) {
        let csrfHash = '<?= $this->security->get_csrf_hash(); ?>';
        $.post(base_url + 'kelurahan/getKelurahanAjax', {
            id_kecamatan: param,
            <?= $this->security->get_csrf_token_name(); ?>: csrfHash
        }, (result) => {
            var data = JSON.parse(result);
            var option = '<option value="">Pilih</option>';

            for (let i = 0; i < data.length; i++) {
                option += '<option value="' + data[i].id_kelurahan + '">' + data[i].deskripsi + '</option>';
            }

            $('#id_kelurahan_pemohon').html(option);
            if (data_user.c_id_kelurahan_pemohon != null) {
                $('#id_kelurahan_pemohon').val(data_user.c_id_kelurahan_pemohon);
            }
        });
    }

    ready(function() {
        getKecamatan();
        getJenisUsaha();

        if (data_user.c_id_kecamatan_pemohon !== null) {
            getKelurahan(data_user.c_id_kecamatan_pemohon);
        }

        $("#succes-alert").fadeTo(2000, 500).slideUp(500, function() {
            $("#succes-alert").slideUp(500);
        });
    });
</script>