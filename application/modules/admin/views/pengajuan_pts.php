<!-- Page Header -->
<div class="page-header">
  <div class="row align-items-end">
    <div class="col-sm mb-2 mb-sm-0">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-no-gutter">
          <li class="breadcrumb-item"><a class="breadcrumb-link" href="<?= site_url('admin') ?>">Dashboard</a></li>
          <li class="breadcrumb-item">Data Master</li>
          <li class="breadcrumb-item active" aria-current="page">Pengajuan PTS</li>
        </ol>
      </nav>

      <h1 class="page-header-title">Pengajuan PTS</h1>
    </div>

    <div class="col-sm-auto">
    </div>
  </div>
  <!-- End Row -->
</div>
<!-- End Page Header -->

<!-- Card -->
<div class="card">

  <!-- Table -->
  <div class="table-responsive">
    <table class="table table-lg table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
      <thead class="thead-light">
        <tr>
          <th class="table-column-pr-0">No</th>
          <th></th>
          <th>Status</th>
          <th>Kode PTS</th>
          <th>Nama</th>
          <th>Jenis</th>
          <th>Provinsi</th>
        </tr>
      </thead>

      <tbody>
        <?php if ($ptsBaru > 0): ?>
          <?php $no = 1; foreach ($ptsBaru as $key): ?>
          <tr>
            <td class="table-column-pr-0"><?= $no; ?></td>
            <td>
              <?php if ($key->status == 0) :?>
                <button type="button" class="btn btn-xs btn-success" data-toggle="modal" data-target="#terima<?= $no;?>">
                  Verifikasi
                </button>
              <?php else:?>
                <button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#tolak<?= $no;?>">
                  Tolak
                </button>
              <?php endif;?>
            </td>
            <td>
              <span class="badge badge-<?= $key->status == 0 ? 'secondary' : 'success';?>"><?= $key->status == 0 ? 'belum diproses' : 'telah diproses';?></span>
            </td>
            <td><?= $key->kodept ?></td>
            <td><?= ucwords($key->namapt) ?></td>
            <td><?= strtoupper($key->jenis) ?></td>
            <td><?= strtoupper($key->provinsi) ?></td>
          </tr>

          <div class="modal fade" id="terima<?= $no;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Terima pengajuan PTS baru</h5>
                  <button type="button" class="btn btn-xs btn-icon btn-soft-secondary" data-dismiss="modal" aria-label="Close">
                    <svg aria-hidden="true" width="10" height="10" viewBox="0 0 18 18" xmlns="http://www.w3.org/2000/svg">
                      <path fill="currentColor" d="M11.5,9.5l5-5c0.2-0.2,0.2-0.6-0.1-0.9l-1-1c-0.3-0.3-0.7-0.3-0.9-0.1l-5,5l-5-5C4.3,2.3,3.9,2.4,3.6,2.6l-1,1 C2.4,3.9,2.3,4.3,2.5,4.5l5,5l-5,5c-0.2,0.2-0.2,0.6,0.1,0.9l1,1c0.3,0.3,0.7,0.3,0.9,0.1l5-5l5,5c0.2,0.2,0.6,0.2,0.9-0.1l1-1 c0.3-0.3,0.3-0.7,0.1-0.9L11.5,9.5z"/>
                    </svg>
                  </button>
                </div>
                <div class="modal-body">
                  <form action="<?= site_url('admin/terima_pts/'.$key->id);?>" method="POST">
                    <input type="hidden" name="kodept" value="<?= $key->kodept;?>" required>
                    <div class="form-group">
                      <label class="input-label">Kopertis</label>
                      <input type="text" name="KOPERTIS" class="form-control form-control-sm" placeholder="Kopertis PTS" required>
                    </div>
                    <div class="form-group">
                      <label class="input-label">Wilayah</label>
                      <input type="text" name="WILAYAH" class="form-control form-control-sm" placeholder="Wilayah PTS" required>
                    </div>
                    <div class="form-group">
                      <label class="input-label">Agama</label>
                      <select class="js-select2-custom custom-select" size="1" name="AGAMA" 
                        data-hs-select2-options='{
                          "minimumResultsForSearch": "Infinity"
                        }' required>
                        <option value="UMUM" selected>UMUM</option>
                        <option value="ISLAM">ISLAM</option>
                        <option value="KRISTEN">KRISTEN</option>
                        <option value="KATOLIK">KATOLIK</option>
                        <option value="HINDU">HINDU</option>
                      </select>
                    </div>
                    <div class="modal-footer mt-3 px-0">
                      <button type="button" class="btn btn-sm btn-white" data-dismiss="modal">Batal</button>
                      <button type="submit" class="btn btn-sm btn-primary">Terima</button>
                    </div>
                    <!-- End Form Group -->
                  </form>
                </div>
              </div>
            </div>
          </div>

          <div class="modal fade" id="tolak<?= $no;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Tolak pengajuan PTS baru</h5>
                  <button type="button" class="btn btn-xs btn-icon btn-soft-secondary" data-dismiss="modal" aria-label="Close">
                    <svg aria-hidden="true" width="10" height="10" viewBox="0 0 18 18" xmlns="http://www.w3.org/2000/svg">
                      <path fill="currentColor" d="M11.5,9.5l5-5c0.2-0.2,0.2-0.6-0.1-0.9l-1-1c-0.3-0.3-0.7-0.3-0.9-0.1l-5,5l-5-5C4.3,2.3,3.9,2.4,3.6,2.6l-1,1 C2.4,3.9,2.3,4.3,2.5,4.5l5,5l-5,5c-0.2,0.2-0.2,0.6,0.1,0.9l1,1c0.3,0.3,0.7,0.3,0.9,0.1l5-5l5,5c0.2,0.2,0.6,0.2,0.9-0.1l1-1 c0.3-0.3,0.3-0.7,0.1-0.9L11.5,9.5z"/>
                    </svg>
                  </button>
                </div>
                <div class="modal-body">
                  <p class="mb-0">Apakah anda yakin ingin menolak pengajuan PTS <b><?= $key->namapt;?></b>?</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-sm btn-white" data-dismiss="modal">Batal</button>
                  <a href="<?= site_url('admin/tolak_pts/'.$key->id);?>" class="btn btn-sm btn-danger">Tolak</a>
                </div>
                <!-- End Form Group -->
              </div>
            </div>
          </div>
          <?php  $no++; endforeach; ?>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
  <!-- End Table -->
</div>
<!-- End Card -->