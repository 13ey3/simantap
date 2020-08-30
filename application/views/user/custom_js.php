<script type="text/javascript">
    // const base_url = '<?= base_url() ?>';
    var data_user = <?= json_encode($data_user) ?>;
    var btn_upload = document.getElementById('btn-upload');

    btn_upload.addEventListener('click', (e) => {
        e.preventDefault();
        alert("gambar sudah di upload!");
    });

    function getJenisUsaha() {
        $.post(base_url + 'jenis_usaha/getJenisUsahaAjax', (result) => {

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
        $.post(base_url + 'kecamatan/getKecamatanAjax', (result) => {
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
        $.post(base_url + 'kelurahan/getKelurahanAjax', {
            id_kecamatan: $(param).val()
        }, (result) => {
            var data = JSON.parse(result);
            var option = '<option value="">Pilih</option>';

            for (let i = 0; i < data.length; i++) {
                option += '<option value="' + data[i].id_kelurahan + '">' + data[i].deskripsi + '</option>';
            }

            $('#id_kelurahan_pemohon').html(option);
            if (data_user.c_id_kelurahan_pemohon !== null) {
                $('#id_kelurahan_pemohon').val(data_user.c_id_kelurahan_pemohon);
            }
        });
    }

    $(document).ready(() => {
        getKecamatan();
        getJenisUsaha();
    });
</script>