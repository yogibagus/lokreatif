<div class="row mb-4">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h5 class="card-header-title">Daftar Transaksi</h5>
      </div>
      <!-- Table -->
      <div class="card-body px-0 pb-0">
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
            </tr>
          </thead>

          <tbody>
            <?php
              foreach ($transaksi as $item) {
                $status = $item->STAT_BAYAR == "0" ? '<span style="color: #fff;" class="badge bg-warning">Tertunda</span>' : '<span style="color: #fff;" class="badge bg-primary">Terbayar</span>';
                $date = date_create($item->LOG_TIME);
                echo '
                  <tr>
                    <td><a href="'.site_url('payment/checkout/'.$item->KODE_TRANS).'">'.$item->KODE_TRANS.'</a></td>
                    <td>'.date_format($date, 'd M Y').'</td>
                    <td>'.$status.'</td>
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