<!-- Page Header -->
<div class="page-header">
  <div class="row align-items-end">
    <div class="col-sm mb-2 mb-sm-0">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-no-gutter">
          <li class="breadcrumb-item"><a class="breadcrumb-link" href="<?= site_url('admin') ?>">Dashboard</a></li>
          <li class="breadcrumb-item"><a class="breadcrumb-link" href="javascript:;">Kompetisi</a></li>
          <li class="breadcrumb-item active" aria-current="page">Data kompetisi</li>
        </ol>
      </nav>

      <h1 class="page-header-title">Data kompetisi</h1>
    </div>

    <div class="col-sm-auto">
    </div>
  </div>
  <!-- End Row -->
</div>
<!-- End Page Header -->

<!-- Stats -->
<div class="row gx-2 gx-lg-3">
  <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
    <!-- Card -->
    <a class="card card-hover-shadow h-100" href="<?= site_url('data-penyelenggara') ?>">
      <div class="card-body">
        <h6 class="card-subtitle">Total Penyelenggara</h6>

        <div class="row align-items-center gx-2 mb-1">
          <div class="col-8">
            <span class="card-title h2"><?= number_format($penyelenggara,0,",",".");?></span>
          </div>
        </div>
        <!-- End Row -->

        <span class="badge badge-soft-<?= ($diffPenyelenggara == $penyelenggara ? 'secondary' : ($diffPenyelenggara < $penyelenggara ? 'success' : 'danger'));?>">
          <i class="<?= ($diffPenyelenggara == $penyelenggara ? 'tio-voice-line' : ($diffPenyelenggara < $penyelenggara ? 'tio-trending-up' : 'tio-trending-down'));?>"></i>
          <?= ($penyelenggara == 0 ? '0' : round(((($penyelenggara-$diffPenyelenggara) / $penyelenggara) * 100), 1)) ?>%
        </span>
        <span class="text-body font-size-sm ml-1">dari <?= number_format($diffPenyelenggara,0,",",".");?></span>
      </div>
    </a>
    <!-- End Card -->
  </div>
  <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
    <!-- Card -->
    <a class="card card-hover-shadow h-100" href="<?= site_url('data-kompetisi') ?>">
      <div class="card-body">
        <h6 class="card-subtitle">Total Kompetisi</h6>

        <div class="row align-items-center gx-2 mb-1">
          <div class="col-8">
            <span class="card-title h2"><?= number_format($countKompetisi,0,",",".");?></span>
          </div>
        </div>
        <!-- End Row -->

        <span class="badge badge-soft-<?= ($diffKompetisi == $countKompetisi ? 'secondary' : ($diffKompetisi < $countKompetisi ? 'success' : 'danger'));?>">
          <i class="<?= ($diffKompetisi == $countKompetisi ? 'tio-voice-line' : ($diffKompetisi < $countKompetisi ? 'tio-trending-up' : 'tio-trending-down'));?>"></i>
          <?= ($countKompetisi == 0 ? '0' : round(((($countKompetisi-$diffKompetisi) / $countKompetisi) * 100), 1)) ?>%
        </span>
        <span class="text-body font-size-sm ml-1">dari <?= number_format($diffKompetisi,0,",",".");?></span>
      </div>
    </a>
    <!-- End Card -->
  </div>
  <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
    <!-- Card -->
    <a class="card card-hover-shadow h-100" href="<?= site_url('data-event') ?>">
      <div class="card-body">
        <h6 class="card-subtitle">Total Peserta</h6>

        <div class="row align-items-center gx-2 mb-1">
          <div class="col-8">
            <span class="card-title h2"><?= number_format($peserta,0,",",".");?></span>
          </div>
        </div>
        <!-- End Row -->
      </div>
    </a>
    <!-- End Card -->
  </div>
</div>
<!-- End Stats -->

<!-- Card -->
<div class="card">
  <!-- Header -->
  <div class="card-header">
    <div class="row justify-content-between align-items-center flex-grow-1">
      <div class="col-sm-6 col-md-4 mb-3 mb-sm-0">
        <form>
          <!-- Search -->
          <div class="input-group input-group-merge input-group-flush">
            <div class="input-group-prepend">
              <div class="input-group-text">
                <i class="tio-search"></i>
              </div>
            </div>
            <input id="datatableSearch" type="search" class="form-control" placeholder="Cari data" aria-label="Search users">
          </div>
          <!-- End Search -->
        </form>
      </div>
    </div>
    <!-- End Row -->
  </div>
  <!-- End Header -->

  <!-- Table -->
  <div class="table-responsive datatable-custom">
    <table id="datatable" class="table table-lg table-borderless table-thead-bordered table-nowrap table-align-middle card-table"
    data-hs-datatables-options='{
      "columnDefs": [{
      "targets": [0, 4],
      "orderable": false
      }],
        "order": [],
        "info": {
        "totalQty": "#datatableWithPaginationInfoTotalQty"
      },
      "search": "#datatableSearch",
      "entries": "#datatableEntries",
      "pageLength": 10,
      "isResponsive": false,
      "isShowPaging": false,
      "pagination": "datatablePagination"
      }'>
      <thead class="thead-light">
        <tr>
          <th class="table-column-pr-0">No</th>
          <th></th>
          <th>JUDUL</th>
          <th>WAKTU</th>
          <th>STATUS</th>
        </tr>
      </thead>

      <tbody>
        <?php if ($kompetisi > 0): ?>
          <?php $no = 1; foreach ($kompetisi as $key): ?>
          <tr>
            <td class="table-column-pr-0"><?= $no++; ?></td>
            <td>
              <a class="btn btn-xs btn-white" href="<?= site_url('kompetisi/'.$key->KODE_KOMPETISI);?>" target="_blank">
                <i class="tio-eye"></i> View
              </a>
            </td>
            <td><?= $key->JUDUL ?></td>
            <td><?= date("d F Y", strtotime($key->TANGGAL)) ?></td>
            <td>
              <span class="badge badge-<?= $key->STATUS_KOMPETISI == 0 ? 'secondary' : ($key->STATUS_KOMPETISI == 1 ? 'success' : 'primary');?>"><?= $key->STATUS_KOMPETISI == 0 ? 'belum dibuka' : ($key->STATUS_KOMPETISI == 1 ? 'berlangsung' : 'berakhir');?></span>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php endif; ?>
      </tbody>
    </table>
  </div>
  <!-- End Table -->

  <!-- Footer -->
  <div class="card-footer">
    <!-- Pagination -->
    <div class="row justify-content-center justify-content-sm-between align-items-sm-center">
      <div class="col-sm mb-2 mb-sm-0">
        <div class="d-flex justify-content-center justify-content-sm-start align-items-center">
          <span class="mr-2">Menampilkan:</span>

          <!-- Select -->
          <select id="datatableEntries" class="js-select2-custom"
            data-hs-select2-options='{
              "minimumResultsForSearch": "Infinity",
              "customClass": "custom-select custom-select-sm custom-select-borderless",
              "dropdownAutoWidth": true,
              "width": true
            }'>
            <option value="10" selected>10</option>
            <option value="15">15</option>
            <option value="20">20</option>
          </select>
          <!-- End Select -->

          <span class="text-secondary mr-2">dari</span>

          <!-- Pagination Quantity -->
          <span id="datatableWithPaginationInfoTotalQty"></span>
        </div>
      </div>

      <div class="col-sm-auto">
        <div class="d-flex justify-content-center justify-content-sm-end">
          <!-- Pagination -->
          <nav id="datatablePagination" aria-label="Activity pagination"></nav>
        </div>
      </div>
    </div>
    <!-- End Pagination -->
  </div>
  <!-- End Footer -->
</div>
<!-- End Card -->