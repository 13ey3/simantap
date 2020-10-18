<div class="container-fluid">
    <!-- Welcome message -->

    <!-- DataTales Example -->
    <div class="card shadow-sm mb-4">
        <div class="card-header py-2">
            <div class="row">
                <div class="col-sm-6">
                    <h6 class="m-0 font-weight-bold text-primary"><?= $page_title ?></h6>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row mb-1">
                <div class="col-sm-6 form-inline">
                    <label for="rows">Tampil: </label>
                    <select id="rows" class="form-control form-control-sm ml-1" onchange="calldatagrid(1)">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>

                <div class="col-sm-3 ml-auto">
                    <input type="text" placeholder="Cari " class="form-control form-control-sm float-right" name="cari" id="cari" onkeyup="calldatagrid()">
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover table-sm" id="data_grid_permohonan">
                    <thead>
                        <tr class="bg-info text-white">
                            <th>ID Register</th>
                            <th>Pemohon</th>
                            <th style="width: 300px;">Jenis Ijin</th>
                            <th>Target Selesai</th>
                            <th class="text-center">#</th>
                        </tr>
                    </thead>
                    <tbody class="text-md">
                        <tr>
                            <td colspan="5" id="loading">
                                <div id="loading-center">
                                    <div id="loading-center-absolute">
                                        <div class="object" id="object_one"></div>
                                        <div class="object" id="object_two" style="left: 20px"></div>
                                        <div class="object" id="object_three" style="left: 40px"></div>
                                        <div class="object" id="object_four" style="left: 60px"></div>
                                        <div class="object" id="object_five" style="left: 80px"></div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td></td>
                            <td></td>
                            <td id="jeni_ijin">
                                <select id="comboJenisIjin" class="form-control form-control-sm" onchange="calldatagrid()">
                                </select>
                            </td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>

                <!-- Paginate -->
            </div>
            <div class="row">
                <div class="col-sm-6" id="total_data"></div>
                <div class="col-sm-6" id='pagination'></div>
            </div>
        </div>
    </div>
</div>