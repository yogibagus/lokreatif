<div class="row gx-2 gx-lg-3">
  <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
    <div class="card card-frame h-100">
        <div class="card-body">
          <!-- Icon Block -->
          <div class="media d-block d-sm-flex">
            <div class="media-body">
              <h6 class="card-subtitle mb-2">Total Tim</h6>

              <div class="row align-items-center gx-2">
                <div class="col">
                  <span class="js-counter display-4 text-dark"><?= number_format($allTim,0,",",".");?></span>
                </div>
              </div>
            </div>
          </div>
          <!-- End Icon Block -->
        </div>
      </div>
  </div>
  <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
    <div class="card card-frame h-100">
      <div class="card-body">
        <!-- Icon Block -->
        <div class="media d-block d-sm-flex">
          <div class="media-body">
            <h6 class="card-subtitle mb-2">Tim Terbayar</h6>

            <div class="row align-items-center gx-2">
              <div class="col">
                <span class="js-counter display-4 text-dark"><?= number_format($allTimTerbayar,0,",",".");?></span>
              </div>
            </div>
          </div>
        </div>
        <!-- End Icon Block -->
      </div>
    </div>
  </div>
</div>
  <hr class="mb-4 mt-0">
  <div class="row mb-4">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h5 class="card-header-title">Daftar Tim</h5>
            <div>
                <button class="btn btn-sm btn-block btn-success mb-2" id="bayarMultiple" data-toggle="modal" data-target="#mdlBayarMulti" disabled>
                  <i class="tio-credit_card_outlined "></i> Bayar
                </button>
              </div>
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
                  <th>
                    <div class="custom-control custom-checkbox" style="text-align:center;">
                        <input type="checkbox" class="custom-control-input" id="checkAll">
                        <label class="custom-control-label" for="checkAll"></label>
                    </div>
                  </th>
                  <th>Tim</th>
                  <th>Ketua</th>
                  <th>Bidang Lomba</th>
                  <th>Status</th>
                  <th>Pembayaran</th>
                </tr>
              </thead>

              <tbody>
                <?php
                  $no = 1;
                  foreach ($transaksiDetail as $item) {
                    
                    if($item->STAT_BAYAR == null){
                      $status   = '<span class="badge bg-success text-white">Baru</span>';
                    }else if($item->STAT_BAYAR == "1" || $item->STAT_BAYAR == "2"){
                      $status = '<span class="badge bg-warning text-white">Proses bayar</span>';
                    }else if($item->STAT_BAYAR == "3"){
                      $status = '<span class="badge bg-primary text-white">Terbayar</span>';
                    }else if($item->STAT_BAYAR == "4"){
                      $status = '<span class="badge bg-danger text-white">Gagal</span>';
                    }
                    
                    if($item->ROLE_USER_BILL == null){
                      $pembayaran   = '-';
                    }else if($item->ROLE_USER_BILL == "1"){
                      $pembayaran = '<span class="badge bg-soft-dark text-dark">Mandiri</span>';
                    }else if($item->ROLE_USER_BILL == "3"){
                      $pembayaran = '<span class="badge bg-soft-info text-info">Universitas</span>';
                    }

                    if($item->STAT_BAYAR == null){
                      $checkbox = '
                            <div class="custom-control custom-checkbox" style="text-align:center;">
                                <input type="checkbox" class="custom-control-input checkItem" id="chck_' . $no . '" value="' . $item->KODE_PENDAFTARAN . '">
                                <label class="custom-control-label" for="chck_' . $no . '"></label>
                            </div>
                      ';
                      $no++;
                    }else{
                      $checkbox = '
                            <div class="custom-control custom-checkbox" style="text-align:center;">
                                <input type="checkbox" class="custom-control-input" checked disabled>
                                <label class="custom-control-label"></label>
                            </div>
                      ';
                    }
                    
                    echo '
                      <tr>
                        <td>'.$checkbox.'</td>
                        <td>'.$item->NAMA_TIM.'</td>
                        <td>'.$item->NAMA.'</td>
                        <td>'.$item->BIDANG_LOMBA.'</td>
                        <td>'.$status.'</td>
                        <td>'.$pembayaran.'</td>
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
    <!-- Modal Bayar -->
    <div class="modal fade" id="mdlBayarMulti" tabindex="-1" aria-labelledby="mdlBayarMulti" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="mdlBayarMulti">Bayar Transaksi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>
                        Apakah anda yakin untuk membayar transaksi untuk <span id="mdlBayarMulti_count"></span> tim tersebut  ?
                    </p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <form action="<?= site_url('universitas/order') ?>" method="post">
                        <input type="hidden" id="mdlBayarMulti_itemId" name="KODE_PENDAFTARAN" />
                        <input type="hidden" id="" name="TOTAL_TIM" value="<?= $allTim?>" />
                        <button type="submit" class="btn btn-success">Bayar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
      $('#bayarMultiple').click(function() {
        const kodePendaftaran = $('.checkItem:checkbox:checked').map((_, elm) => elm.value).get()
        $('#mdlBayarMulti_count').html(kodePendaftaran.length)
        $('#mdlBayarMulti_itemId').val(kodePendaftaran.toString())

    })
      $('#checkAll').change(function() {
        const isChecked = $(this).prop('checked')
          if (isChecked) {
              $('.checkItem').prop('checked', true)
          } else {
              $('.checkItem').prop('checked', false)
          }
          buttonMultipleAvailable()
      })
      $('.checkItem').change(function() {
          buttonMultipleAvailable()
      })
      const buttonMultipleAvailable = () => {
          const isChecked = $('.checkItem:checkbox:checked').prop('checked')
          if (isChecked)
              $('#bayarMultiple').attr('disabled', false)
          else
              $('#bayarMultiple').attr('disabled', true)
      }
    </script>