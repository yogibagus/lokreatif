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
              <th>Refund</th>
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
                echo '
                  <tr>
                    <td><a href="'.site_url('payment/checkout/'.$item->KODE_TRANS).'">'.$item->KODE_TRANS.'</a></td>
                    <td>'.date_format($date, 'd M Y').'</td>
                    <td>'.$status.'</td>
                    <td>'.($CI->General->cek_refeundUniv($item->KODE_TRANS) == true ? '<a href="'.site_url('refund').'" class="btn btn-xs btn-success">dapat melakukan refund</a>' : '<span class="btn btn-xs btn-secondary">tidak ada refund</span>').'</td>
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