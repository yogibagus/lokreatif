<!-- Page Header -->
<div class="page-header">
  <div class="row align-items-end">
    <div class="col-sm mb-2 mb-sm-0">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-no-gutter">
          <li class="breadcrumb-item"><a class="breadcrumb-link" href="<?= site_url('admin') ?>">dashboard</a></li>
          <li class="breadcrumb-item"><a class="breadcrumb-link" href="javascript:;">PTS</a></li>
          <li class="breadcrumb-item active" aria-current="page">Data PTS</li>
        </ol>
      </nav>

      <h1 class="page-header-title">Data PTS</h1>
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
  <div class="card-body">
    <table id="myTable" class="table table-stripped table-nowrap table-align-middle table-hover" width="100%">
      <thead class="thead-light">
        <tr>
          <th class="table-column-pr-0">No</th>
          <th class="table-column-pl-0">PTS</th>
          <th>EMAIL</th>
          <th>Telepon</th>
          <th>Kopertis</th>
        </tr>
      </thead>

      <tbody>
        <?php if ($pts != false): ?>
          <?php $no = 1; foreach ($pts as $key): ?>
          <tr>
            <td class="table-column-pr-0"><?= $no++; ?></td>
            <td><?= $key->namapt ?></td>
            <td><?= $key->EMAIL ?></td>
            <td><a href="tel:+62<?= $key->HP ?>" target="_blank">+62<?= $key->HP ?></a></td>
            <td><?= $key->kopertis ?></td>
          </tr>
        <?php endforeach; ?>
      <?php endif; ?>
    </tbody>
  </table>
</div>
<!-- End Table -->
</div>
<!-- End Card -->
