<script type="text/javascript">
    $(function () {
        calldatagrid(0);
        jenisIjin();
    });

    const base_url = '<?= base_url() ?>';

    $('#pagination').on('click','a',function(e){
       e.preventDefault(); 
       var pageno = $(this).attr('data-ci-pagination-page');
       calldatagrid(pageno);
     });

    function jenisIjin() {
        $.get(base_url + 'jenis_ijin/getJenisIjin', function (data)  {
            var pars = JSON.parse(data);
            var option = '<option value="">Pilih</option>';

            for (let i = 0; i < pars.length; i++) {
                option += '<option value="'+ pars[i].id_jenis_ijin +'">'+ pars[i].deskripsi +'</option>';
            }

            $('#comboJenisIjin').html(option);
        });
    }

    function calldatagrid(pageno) {

        if ($("#kolomCari").val().length == 0) {
            cari = null;
        } else {
            cari = $("#kolomCari").val();
        }

        if ($('#comboJenisIjin').val() == ""){
            jenis_ijin = null;
        } else {  
            jenis_ijin = $('#comboJenisIjin').val();
        }

        if ($('#comboJenisPermohonan').val() == ""){
            jenis_permohonan = null;
        } else {  
            jenis_permohonan = $('#comboJenisPermohonan').val();
        }

        var data = {row: $("#rows").val(), pageno: pageno, cari: cari, jenisIjin: jenis_ijin, jenisPermohonan: jenis_permohonan};

        datagrid(data);
    }

    function datagrid(data) {
        console.log(data);
        $.post(base_url+ 'pendaftaran/ajax_grid/' +data.pageno, {
            row: data.row,
            cari: data.cari,
            jenisIjin: data.jenisIjin,
            jenisPermohonan: data.jenisPermohonan
        }, (data) => {
            var aa = JSON.parse(data)
            var body_table = (aa.body_table === "") ? '<tr><td colspan="5" class="text-center">Tidak ditemukan data!</td></tr>"' : aa.body_table;
            
            $('#pagination').html(aa.pagination);
            $("#data_grid").html(body_table);
            $("#rows").val(aa.rows);
            $("#page").val(aa.page);
            $("#total_data").html(aa.info);
            $("#total_halaman").html(": " + aa.total_halaman);
        });
    }

    
</script>