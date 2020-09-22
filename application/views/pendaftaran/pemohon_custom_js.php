<script type="text/javascript">
    var rows = document.getElementById('rows');
    var cari = document.getElementById('cari');

    $('#pagination').on('click', 'a', function(e) {
        e.preventDefault();
        var pageno = $(this).attr('data-ci-pagination-page');
        calldatagrid(pageno);
    });

    function jenisIjin() {
        $.get(base_url + 'jenis_ijin/getJenisIjin', function(data) {
            var pars = JSON.parse(data);
            var option = '<option value="">Pilih</option>';

            for (let i = 0; i < pars.length; i++) {
                option += '<option value="' + pars[i].id_jenis_ijin + '">' + pars[i].deskripsi + '</option>';
            }

            $('#comboJenisIjin').html(option);
        });
    }

    ready(function() {
        calldatagrid();
        jenisIjin();
    });

    let csrfHash = '<?= $this->security->get_csrf_hash(); ?>';

    $('#nav-pendaftaran').click(() => {
        setTimeout(() => {
            calldatagrid(0);
        }, 200)
    });

    function datagrid(data) {
        $.post(base_url + 'pendaftaran/permohonan_lama_ajax/' + data.pageno, {
            row: data.row,
            cari: data.cari,
            jenisIjin: data.jenisIjin,
            jenis_usaha: data.jenisUsaha,
            jenisPermohonan: data.jenisPermohonan,
            <?= $this->security->get_csrf_token_name(); ?>: csrfHash
        }, (res) => {
            // console.log(data);
            var aa = JSON.parse(res)
            var body_table = (aa.body_table === "") ? '<tr><td colspan="5" class="text-center">Tidak ditemukan data!</td></tr>"' : aa.body_table;


            $('#pemohon_data_grid tbody').html(body_table);
            $('#pagination').html(aa.pagination);
            $('#rows').val(aa.rows);
            $('#page').val(aa.page);
            $('#total_data').html(aa.info);
            $('#total_halaman').html(": " + aa.total_halaman);

        });
    }

    function pilihJenisIjin() {
        $.get(base_url + 'jenis_ijin/getJenisIjin', function(data) {
            var pars = JSON.parse(data);
            var option = '<option value="">Pilih</option>';

            for (let i = 0; i < pars.length; i++) {
                option += '<option value="' + pars[i].id_jenis_ijin + '">' + pars[i].deskripsi + '</option>';
            }

            $('#comboJenisIjinModal').html(option);
            $('#jeniIjinModal').modal('show');
        });
    }
</script>