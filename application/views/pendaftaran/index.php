<div class="container-fluid">
  <!-- Welcome message -->
  
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
      <div class="card-header py-2">
        <div class="row">
          <div class="col-sm-6">
            <h6 class="m-0 font-weight-bold text-primary">Data <?= $page_title ?></h6>
          </div>
          <div class="col-sm-6">
            <a href="#" class="btn btn-sm btn-primary float-right">Tambah</a>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="row mb-3">
          <div class="col-sm-6 form-inline">
            <label for="rows">Tampil: </label>
            <select id="rows" class="form-control ml-1" onchange="calldatagrid(1)">
              <option value="5">5</option>
              <option value="10">10</option>
              <option value="25">25</option>
              <option value="50">50</option>
              <option value="100">100</option>
            </select>
          </div>

          <div class="col-sm-3 ml-auto">
            <input type="text" placeholder="Cari " class="form-control float-right" name="kolomcari" id="kolomcari" onkeyup="calldatagrid()">
          </div>
        </div>  

        <div class="table-responsive">
          <table class="table table-bordered table-sm" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>ID Register</th>
                <th>Jenis Permohonan</th>
                <th>Pemohon</th>
                <th>Jenis Ijin</th>
                <th>#</th>
              </tr>
            </thead>
            <tbody id="data_grid">
            </tbody>
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