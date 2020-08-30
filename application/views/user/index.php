<div class="container-fluid">
    <!-- Welcome message -->

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
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
                    <input type="text" placeholder="Cari " class="form-control form-control-sm float-right" name="kolomcari" id="kolomCariPemohon" onkeyup="calldatagrid()">
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover table-sm" id="data_grid_pemohon">
                    <thead>
                        <tr class="bg-info text-white">
                            <th>No</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Aktif</th>
                            <th class="text-center">#</th>
                        </tr>
                    </thead>
                    <tbody class="text-md">
                        <tr>
                            <td colspan="4" class="text-center">Tidak ada data!</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr class="bg-info">
                            <td></td>
                            <td></td>
                            <td></td>
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