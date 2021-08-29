<div class="row mb-4">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h5 class="card-header-title">Daftar Transaksi</h5>
      </div>
      <!-- Table -->
      <div class="card-body px-0 pb-0">
      <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
        Link with href
      </a>
      <div class="collapse" id="collapseExample">
        <div class="card card-body">
          Some placeholder content for the collapse component. This panel is hidden by default but revealed when the user activates the relevant trigger.
        </div>
      </div>
        <div class="table-responsive datatable-custom">
          <table id="datatable" class="table table-lg table-borderless table-thead-bordered table-nowrap table-align-middle card-table"
          data-hs-datatables-options='{
            "columnDefs": [{
              "targets": [0, 5],
              "orderable": false
            }],
            "order": [],
            "info": {
              "totalQty": "#datatableWithPaginationInfoTotalQty"
            },
            "search": "#datatableSearch",
            "entries": "#datatableEntries",
            "pageLength": 15,
            "isResponsive": false,
            "isShowPaging": false,
            "pagination": "datatablePagination"
          }'>
          <thead class="thead-light">
            <tr>
              <th>Kode Transaksi</th>
              <th>Tanggal</th>
              <th>Status</th>
              <th>Aksi</th>
            </tr>
          </thead>

          <tbody>
            <?php
              foreach ($transaksi as $item) {
                if($item->STAT_BAYAR == null){
                  $status   = '<span class="badge bg-success text-white">Baru</span>';
                }else if($item->STAT_BAYAR == "1" || $item->STAT_BAYAR == "2"){
                  $status = '<span class="badge bg-warning text-white">Proses</span>';
                }else if($item->STAT_BAYAR == "3"){
                  $status = '<span class="badge bg-primary text-white">Sukses</span>';
                }else if($item->STAT_BAYAR == "4"){
                  $status = '<span class="badge bg-danger text-white">Gagal</span>';
                }
                $date = date_create($item->LOG_TIME);

                if($CI->General->cek_refeundUniv($item->KODE_TRANS) == true){
                  $btnRefund = '
                    <a href="'.site_url('refund').'" class="btn btn-xs btn-success">
                    <i class="tio-credit-card-add"></i>
                      Refund Transaksi
                    </a>
                  ';
                }else{
                  $btnRefund = '
                    <a href="'.site_url('refund').'" class="btn btn-xs btn-secondary disabled">
                      <i class="tio-credit-card-add"></i>
                      Tidak Ada Refund
                    </a>
                  ';
                }

                echo '
                  <tr>
                    <td><a href="'.site_url('payment/checkout/'.$item->KODE_TRANS).'">'.$item->KODE_TRANS.'</a></td>
                    <td>'.date_format($date, 'd M Y').'</td>
                    <td>'.$status.'</td>
                    <td>
                      <a href="#" data-toggle="collapse" data-target="#demo1" class="accordion-toggle btn btn-xs btn-info">
                        <i class="tio-info-outined"></i>
                        History Pembayaran
                      </a>
                      '.$btnRefund.'
                    </td>
                  </tr>
                  <tr class="hiddenRow">
                    <td colspan="12">
                      <div class="accordian-body collapse" id="demo1">
                          <!-- List Group -->
                          <ul class="list-group">
                            <li class="list-group-item">
                              <div class="row">
                                <div class="col-4">Tokek</div>
                                <div class="col-4">Kii</div>
                                <div class="col-4">Okee</div>
                              </div>
                            </li>
                            <li class="list-group-item">
                              <i class="bi-person list-group-icon"></i> Profile
                            </li>
                            <li class="list-group-item">
                              <i class="bi-list-task list-group-icon"></i> Tasks
                            </li>
                            <li class="list-group-item">
                              <i class="bi-layers list-group-icon"></i> Projects
                            </li>
                            <li class="list-group-item">
                              <i class="bi-people list-group-icon"></i> Members
                            </li>
                          </ul>
                          <!-- End List Group -->
                        </div>
                    </td>
                  </tr>
                ';
              }
            ?>
          </tbody>
          </table>
        </div>
      </div>
      <!-- End Table -->
    </div>
  </div>
</div>