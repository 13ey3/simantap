<script type="text/javascript">
    $(function() {
        calldatagrid(0);
        jenisIjin();
        setActiveTab();
    });

    let csrfHash = '<?= $this->security->get_csrf_hash(); ?>';

    $('#nav-pendaftaran').click(() => {
        setTimeout(() => {
            calldatagrid(0);
        }, 200)
    });

    $('#data-lama #pagination').on('click', 'a', function(e) {
        e.preventDefault();
        var pageno = $(this).attr('data-ci-pagination-page');
        calldatagrid(pageno);
    });

    function setActiveTab() {
        const tabActiveted = '<?= $this->session->flashdata('tab_active'); ?>';

        if (tabActiveted == 1) {
            $('#tab-pemohon').removeClass('active');
            $('#data-pemohon').removeClass('active').removeClass('show');

            $('#tab-permohonan').addClass('active');
            $('#data-permohonan').addClass('active').addClass('show');

            setTimeout(() => {
                calldatagrid(0);
            }, 200)
        }
    }

    function jenisIjin() {
        let tab_active = $('.tab-pane.fade.active.show').attr('id');

        $.get(base_url + 'jenis_ijin/getJenisIjin', function(data) {
            var pars = JSON.parse(data);
            var option = '<option value="">Pilih</option>';

            for (let i = 0; i < pars.length; i++) {
                option += '<option value="' + pars[i].id_jenis_ijin + '">' + pars[i].deskripsi + '</option>';
            }

            $('.comboJenisIjin').html(option);
        });
    }

    function calldatagrid(pageno) {
        var tab_active = $('.tab-pane.fade.active.show').attr('id');
        var jenis_ijin = '';


        if ($('#data-lama #comboJenisPermohonan').val() == "") {
            jenis_permohonan = null;
        } else {
            jenis_permohonan = $('#data-lama #comboJenisPermohonan').val();
        }

        if (tab_active === "data-pemohon") {
            url = base_url + 'pendaftaran/pemohon_ajax/';
            rows = $("#data-pemohon #rows").val()

            if ($("#kolomCariPemohon").val().length == 0) {
                cari = null;
            } else {
                cari = $("#kolomCariPemohon").val();
            }
        } else if (tab_active === "data-permohonan") {
            url = base_url + 'pendaftaran/permohonan_ajax/';
            rows = $("#data-permohonan #rows").val()

            if ($("#kolomCariPermohona").val().length == 0) {
                cari = null;
            } else {
                cari = $("#kolomCariPermohona").val();
            }

            if ($('#data-permohonan .comboJenisIjin').val() == "") {
                jenis_ijin = null;
            } else {
                jenis_ijin = $('#data-permohonan .comboJenisIjin').val();
            }
        } else if (tab_active === "data-lama") {
            url = base_url + 'pendaftaran/permohonan_lama_ajax/';
            rows = $("#data-lama #rows").val()

            if ($("#kolomCariPermohonanLama").val().length == 0) {
                cari = null;
            } else {
                cari = $("#kolomCariPermohonanLama").val();
            }

            if ($('#data-lama .comboJenisIjin').val() == "") {
                jenis_ijin = null;
            } else {
                jenis_ijin = $('#data-lama .comboJenisIjin').val();
            }
        }

        var data = {
            row: rows,
            pageno: pageno,
            url: url,
            cari: cari,
            jenisUsaha: null,
            jenisIjin: jenis_ijin,
            jenisPermohonan: jenis_permohonan,
            tab_active: tab_active
        };

        datagrid(data);
    }

    function datagrid(data) {
        $.post(data.url + data.pageno, {
            row: data.row,
            cari: data.cari,
            jenisIjin: data.jenisIjin,
            jenis_usaha: data.jenisUsaha,
            jenisPermohonan: data.jenisPermohonan,
            <?= $this->security->get_csrf_token_name(); ?>: csrfHash
        }, (res) => {
            console.log(res);
            var aa = JSON.parse(res)
            var body_table = (aa.body_table === "") ? '<tr><td colspan="5" class="text-center">Tidak ditemukan data!</td></tr>"' : aa.body_table;

            $("#loading").fadeOut(3000);

            if (data.tab_active === "data-pemohon") {
                setTimeout(() => {
                    $('#data_grid_pemohon tbody').html(body_table);
                    $('#data-pemohon #total_halaman').html(": " + aa.total_halaman);
                    $('#data-pemohon #pagination').html(aa.pagination);
                    $('#data-pemohon #page').val(aa.page);
                    $('#data-pemohon #rows').val(aa.rows);
                    $('#data-pemohon #total_data').html(aa.info);
                }, 200);

            } else if (data.tab_active === "data-permohonan") {
                setTimeout(() => {
                    $('#data_grid_permohonan tbody').html(body_table);
                    $('#data-permohonan #pagination').html(aa.pagination);
                    $('#data-permohonan #rows').val(aa.rows);
                    $('#data-permohonan #page').val(aa.page);
                    $('#data-permohonan #total_data').html(aa.info);
                    $('#data-permohonan #total_halaman').html(": " + aa.total_halaman);
                }, 200);

            } else if (data.tab_active === "data-lama") {
                setTimeout(() => {
                    $('#permohonan_lama tbody').html(body_table);
                    $('#data-lama #pagination').html(aa.pagination);
                    $('#data-lama #rows').val(aa.rows);
                    $('#data-lama #page').val(aa.page);
                    $('#data-lama #total_data').html(aa.info);
                    $('#data-lama #total_halaman').html(": " + aa.total_halaman);
                }, 200);
            }
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