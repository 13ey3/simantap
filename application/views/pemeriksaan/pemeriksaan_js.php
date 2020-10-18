<script type="text/javascript">
    ready(() => {
        calldatagrid(0);
        jenisIjin();
    });

    let csrfHash = '<?= $this->security->get_csrf_hash(); ?>';

    function jenisIjin() {
        $.get(base_url + 'jenis_ijin/getJenisIjin', function(data) {
            var pars = JSON.parse(data);
            var option = '<option value="">Pilih</option>';

            pars.forEach((val, i) => {
                option += '<option value="' + val.id_jenis_ijin + '">' + val.deskripsi + '</option>';
            });

            $('#comboJenisIjin').html(option);
        });
    }

    $('#pagination').on('click', 'a', function(e) {
        e.preventDefault();
        var pageno = $(this).attr('data-ci-pagination-page');
        calldatagrid(pageno);
    });

    function calldatagrid(pageno = 0) {
        let cari = document.getElementById('cari');
        let comboJenisIjin = document.getElementById('comboJenisIjin');

        if (comboJenisIjin.value == "") {
            jenis_ijin = null;
        } else {
            jenis_ijin = comboJenisIjin.value;
        }

        if (cari.value.length == 0) {
            frmCari = null;
        } else {
            frmCari = cari.value;
        }
        console.log(jenis_ijin);
        var data = {
            row: $("#rows").val(),
            pageno: pageno,
            jenisIjin: jenis_ijin,
            cari: frmCari
        };

        datagrid(data);
    }

    function datagrid(data) {
        $.post(base_url + 'pemeriksaan/data_ajax/' + data.pageno, {
            row: rows.value,
            cari: data.cari,
            jenisIjin: data.jenisIjin,
            <?= $this->security->get_csrf_token_name(); ?>: csrfHash
        }, (res) => {
            var aa = JSON.parse(res);
            // generate_body_table(aa.body_table);
            var body_table = (aa.body_table === "") ? '<tr><td colspan="5" class="text-center">Tidak ditemukan data!</td></tr>"' : generate_body_table(aa.body_table);


            $('#data_grid_permohonan tbody').html(body_table);
            $('#pagination').html(aa.pagination);
            $('#rows').val(aa.rows);
            $('#page').val(aa.page);
            $('#total_data').html(aa.info);
            $('#total_halaman').html(": " + aa.total_halaman);
        });
    }

    function generate_body_table(a) {

        let body_table = '';
        a.forEach(val => {
            body_table += '<tr>';
            val.forEach(el => {
                body_table += `<td>${ el }</td>`;
            });
            body_table += '</tr>';
        });

        return body_table;
    }
</script>