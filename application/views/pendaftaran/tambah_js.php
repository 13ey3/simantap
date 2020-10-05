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
            let nama_pemohon = (res.c_id_usaha === 3) ?
                res.c_nama_pemohon :
                res.c_nama_badan_usaha;

            $('#nik').val(res.c_no_identitas).prop("readonly", true);
            $('#nama_pemohon').val(nama_pemohon).prop("readonly", true);
            $('#jenis_usaha').val(res.jenis_usaha).prop("readonly", true);
            $('#kecamatan').val(res.nama_kecamatan).prop("readonly", true);
            $('#kelurahan').val(res.nama_kelurahan).prop("readonly", true);
            $('#kab_kot_pemohon').val(res.c_kota).prop("readonly", true);
            $('#alamat_pemohon').val(res.c_alamat_pemohon).prop("readonly", true);
        });
    }

    function validasiForm() {
        let validasi = true;

        if ($('#nip').val() <= 0 || $('#nip').val() == '') {
            $('#nip').focus();
            $('#error_nip').text('NIP tidak boleh kosong!');
            validasi = false;
        }

        if ($('#id_jenis_ijin').val() <= 0 || $('#id_jenis_ijin').val() == '') {
            $('#id_jenis_ijin').focus();
            $('#error_id_jenis_ijin').text('Pilih salah satu izin!');
            validasi = false;
        }

        if ($('#kec_usaha').val() <= 0 || $('#kec_usaha').val() == '') {
            $('#kec_usaha').focus();
            $('#error_kec_usaha').text('Pilih salah dahulu!');
            validasi = false;
        }

        if ($('#kel_usaha').val() <= 0 || $('#kel_usaha').val() == '') {
            $('#kel_usaha').focus();
            $('#error_kel_usaha').text('Pilih dahulu!');
            validasi = false;
        }

        if ($('#no_surat_permohonan').val() <= 0 || $('#no_surat_permohonan').val() == '') {
            $('#no_surat_permohonan').focus();
            $('#error_no_surat_permohonan').text('No Surat Permohonan tidak boleh kosong!');
            validasi = false;
        }

        if ($('#tgl_permohonan').val() <= 0 || $('#tgl_permohonan').val() == '') {
            $('#tgl_permohonan').focus();
            $('#error_tgl_permohonan').text('Tanggal Surat Permohonan tidak boleh kosong!');
            validasi = false;
        }

        if ($('#alamat_usaha').val() <= 0 || $('#alamat_usaha').val() == '') {
            $('#alamat_usaha').focus();
            $('#error_alamat_usaha').text('Alamat Usaha tidak boleh kosong!');
            validasi = false;
        }

        return validasi;
    }

    ready(function() {
        // dateSetting;
        jenisIjin();
        getKecamatan();

        $('#nik').prop("readonly", true);
        $('#nama_pemohon').prop("readonly", true);
        $('#jenis_usaha').prop("readonly", true);
        $('#kecamatan').prop("readonly", true);
        $('#kelurahan').prop("readonly", true);
        $('#kab_kot_pemohon').prop("readonly", true);
        $('#alamat_pemohon').prop("readonly", true);
    });
</script>