<script type="text/javascript">
    // const base_url = '<?= base_url() ?>';
    var rows = document.getElementById('rows');
    var cari = document.getElementById('cari');

    $('#pagination').on('click', 'a', function(e) {
        e.preventDefault();
        var pageno = $(this).attr('data-ci-pagination-page');
        calldatagrid(pageno);
    });

    function calldatagrid(pageno = 0) {
        if (cari.value.length == 0) {
            frmCari = null;
        } else {
            frmCari = cari.value;
        }

        var data = {
            row: $("#data-lama #rows").val(),
            pageno: pageno,
            cari: frmCari,
        };

        datagrid(data);
    }

    function datagrid(data) {
        // console.log("isi param: " + JSON.stringify(data));
        $.post(base_url + 'jenis_izin/jenisijin_ajax/' + data.pageno, {
            row: rows.value,
            cari: data.cari,
            jenisIjin: data.jenisIjin,
            jenis_usaha: data.jenisUsaha,
            jenisPermohonan: data.jenisPermohonan
        }, (res) => {
            // console.log(res);
            var aa = JSON.parse(res)
            var body_table = (aa.body_table === "") ? '<tr><td colspan="5" class="text-center">Tidak ditemukan data!</td></tr>"' : aa.body_table;

            // console.log(aa.pagination);
            $('#data_grid_ijin tbody').html(body_table);
            $('#pagination').html(aa.pagination);
            $('#rows').val(aa.rows);
            $('#page').val(aa.page);
            $('#total_data').html(aa.info);
            $('#total_halaman').html(": " + aa.total_halaman);

        });
    }

    ready(function() {
        calldatagrid();
    });
</script>