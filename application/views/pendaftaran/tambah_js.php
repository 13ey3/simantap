<script type="text/javascript">
    function jenisIjin() {
        $.get(base_url + 'jenis_ijin/getJenisIjin', function(data) {
            var pars = JSON.parse(data);
            var option = '<option value="">Pilih</option>';

            for (let i = 0; i < pars.length; i++) {
                option += `<option value="${ pars[i].id_jenis_ijin }"> ${ pars[i].deskripsi }</option>`;
            }

            $('#id_jenis_ijin').html(option);
        });
    }

    function getKecamatan() {
        $.get(base_url + 'kecamatan/getKecamatanAjax', (result) => {
            let pars = JSON.parse(result);
            let option = '<option value="">Pilih</option>';

            pars.forEach((pars) => {
                option += `<option value="${ pars.id_kecamatan }"> ${pars.deskripsi} </option>`;
            });

            $('#kec_usaha').html(option);
        });
    }

    function getKelurahanAjax(param) {
        let csrfHash = '<?= $this->security->get_csrf_hash(); ?>';
        $.post(base_url + 'kelurahan/getKelurahanAjax', {
            id_kecamatan: param.value,
            <?= $this->security->get_csrf_token_name(); ?>: csrfHash
        }, (result) => {
            var data = JSON.parse(result);
            var option = '<option value="">Pilih</option>';

            data.forEach((pars) => {
                option += `<option value="${ pars.id_kelurahan }"> ${ pars.deskripsi } </option>`;
            });

            $('#kel_usaha').html(option);
        });
    }

    function getKelengkapanDokumen(param) {
        let csrfHash = '<?= $this->security->get_csrf_hash(); ?>';
        $.post(base_url + 'pendaftaran/kelengkapan_dokumen_ajax', {
            id_jenis_ijin: param.value,
            <?= $this->security->get_csrf_token_name(); ?>: csrfHash
        }, (result) => {
            let checkBoxValues = JSON.parse(result);
            let checkBoxs = '';
            console.log(checkBoxValues);
            checkBoxValues.forEach((val) => {
                checkBoxs += `<div class="form-check">
                                <input class="form-check-input" type="checkbox" name="kelengkapan_dokumen[${ val.id_dokumen }]" value="${ val.id_dokumen }" id="defaultCheck${ val.id_dokumen }">
                                <label class="form-check-label col-form-label-sm" for="defaultCheck${ val.id_dokumen }">
                                    ${ val.deskripsi}
                                </label>
                                </div>`;
            });
            $('#kelengkapan_dokumen').html(checkBoxs);
        });
    }

    function getDataPemohon() {
        let csrfHash = '<?= $this->security->get_csrf_hash(); ?>';
        let nip = document.getElementById('nip').value;

        $.post(base_url + 'pemohon/getPemohonByNip', {
            nip: nip,
            <?= $this->security->get_csrf_token_name(); ?>: csrfHash
        }, (result) => {
            let res = JSON.parse(result);
            let nama_pemohon = (res.c_id_usaha === 3) 
                                ? res.c_nama_pemohon 
                                : res.c_nama_badan_usaha;

            $('#nik').val(res.c_no_identitas).prop("disabled", true);
            $('#nama_pemohon').val(nama_pemohon).prop("disabled", true);
            $('#jenis_usaha').val(res.jenis_usaha).prop("disabled", true);
            $('#kecamatan').val(res.nama_kecamatan).prop("disabled", true);
            $('#kelurahan').val(res.nama_kelurahan).prop("disabled", true);
            $('#kab_kot_pemohon').val(res.c_kota).prop("disabled", true);
            $('#alamat_pemohon').val(res.c_alamat_pemohon).prop("disabled", true);
        });
    }

    ready(function() {
        jenisIjin();
        getKecamatan();
    });
</script>