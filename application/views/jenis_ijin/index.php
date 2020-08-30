<div class="container-fluid">
    <!-- Welcome message -->

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-2">
            <div class="row">
                <div class="col-sm-6">
                    <h6 class="m-0 font-weight-bold text-primary"><?= $page_title ?></h6>
                </div>
                <div class="col-sm-6">
                    <a href="#" class="btn btn-sm btn-primary float-right">
                        <span class="fas fa-plus"></span> Tambah</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row mb-1">
                <div class="col-sm-6 form-inline">
                    <label for="rows">Tampil: </label>
                    <select id="rows" class="form-control form-control-sm ml-1" onchange="calldatagrid()">
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
                <table class="table table-hover table-sm" id="data_grid_ijin">
                    <thead>
                        <tr class="bg-info text-white">
                            <th>No</th>
                            <th>Jenis Ijin</th>
                            <th>Dinas</th>
                            <th>Aktif</th>
                            <th class="text-center">#</th>
                        </tr>
                    </thead>
                    <tbody class="text-md">
                        <tr>
                            <td colspan="5" class="text-center">Tidak ada data!</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr class="bg-info">
                            <td>&nbsp;</td>
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