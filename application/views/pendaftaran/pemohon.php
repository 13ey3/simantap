<div class="card shadow-sm mb-4">
    <div class="card-header py-2">
        <div class="row">
            <div class="col-sm-6">
                <h6 class="m-0 font-weight-bold text-primary">Data <?= $page_title ?></h6>
            </div>
            <div class="col-sm-6">
                <button class="btn btn-sm btn-primary float-right" onclick="pilihJenisIjin()">Tambah</button>
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
                        <th>NIP</th>
                        <th>Pemohon</th>
                        <th>Jenis Usaha</th>
                        <th class="text-center">#</th>
                    </tr>
                </thead>
                <tbody class="text-md">
                    <tr>
                        <td colspan="4" id="loading">
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
                        <td id="jenis_usaha">
                            <select id="comboJenisUsaha" class="form-control form-control-sm" onchange="">
                                <option value="">Pilih</option>
                                <option value="1">Koperasi</option>
                                <option value="2">Perusahaan</option>
                                <option value="3">Perseorangan</option>
                                <option value="4">UD</option>
                                <option value="5">Firma</option>
                            </select>
                        </td>
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