<script type="text/javascript">
    $(function () {
        calldatagrid(0);
    });

    $('#pagination').on('click','a',function(e){
       e.preventDefault(); 
       var pageno = $(this).attr('data-ci-pagination-page');
       calldatagrid(pageno);
     });

    function calldatagrid(pageno) {
        if ($("#kolomcari").val().length == 0)
            cari = null;
        else
            cari = $("#kolomcari").val()
        datagrid($("#rows").val(), pageno, cari);
    }

    function datagrid(row, pageno, cari) {
        $.post('<?= base_url() ?>pendaftaran/ajax_grid/'+pageno,{
            // page: pagewp,
            row: row,
            cari: cari,
        }, function (data) {
            var aa = JSON.parse(data)
            $('#pagination').html(aa.pagination);
            $("#data_grid").html(aa.body_table);
            $("#rows").val(aa.rows);
            $("#page").val(aa.page);
            $("#total_data").html(aa.info);
            $("#total_halaman").html(": " + aa.total_halaman);
        });
    }
</script>