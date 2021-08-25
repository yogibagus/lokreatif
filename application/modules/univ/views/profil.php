  <div class="row mt-4 mb-4">
    <div class="col-md-6 col-sm-12">
      <div class="card card-frame h-100">
        <div class="card-body">
          <!-- Icon Block -->
          <div class="media d-block d-sm-flex">
            <div class="media-body">
              <h6 class="card-subtitle mb-2">Total Tim</h6>

              <div class="row align-items-center gx-2">
                <div class="col">
                  <span class="js-counter display-4 text-dark"><?= number_format(5,0,",",".");?></span>
                </div>
              </div>
            </div>
          </div>
          <!-- End Icon Block -->
        </div>
      </div>
    </div>
    <div class="col-md-6 col-sm-12">
      <div class="card card-frame h-100">
        <div class="card-body">
          <!-- Icon Block -->
          <div class="media d-block d-sm-flex">
            <div class="media-body">
              <h6 class="card-subtitle mb-2">Tim Lunas</h6>

              <div class="row align-items-center gx-2">
                <div class="col">
                  <span class="js-counter display-4 text-dark"><?= number_format(5,0,",",".");?></span>
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
                <button class="btn btn-sm btn-success shadow-sm" id="bayarMultiple" data-toggle="modal" data-target="#mdlBayarMulti" disabled>
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cash" viewBox="0 0 16 16">
                    <path d="M8 10a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"/>
                    <path d="M0 4a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V4zm3 0a2 2 0 0 1-2 2v4a2 2 0 0 1 2 2h10a2 2 0 0 1 2-2V6a2 2 0 0 1-2-2H3z"/>
                  </svg>
                    Bayar
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
                </tr>
              </thead>

              <tbody>
                <?php
                  $no = 1;
                  foreach ($transaksi as $item) {
                    $status = $item->STAT_BAYAR == 1 ? '<span style="color: #fff;" class="badge bg-success">Lunas</span>' : '<span style="color: #fff;" class="badge bg-secondary">Belum Lunas</span>';
                    echo '
                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox" style="text-align:center;">
                              <input type="checkbox" class="custom-control-input checkItem" id="chck_' . $no . '" value="' . $item->KODE_USER . '" checked>
                              <label class="custom-control-label" for="chck_' . $no . '"></label>
                          </div>
                        </td>
                        <td>'.$item->NAMA_TIM.'</td>
                        <td>'.$item->NAMA.'</td>
                        <td>'.$item->BIDANG_LOMBA.'</td>
                        <td>'.$status.'</td>
                      </tr>
                    ';
                    $no++;
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
                        Apakah anda yakin untuk membayar transaksi tim ini <span id="mdlBayarMulti_item"></span> ?
                    </p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <form action="<?= site_url('debitnote/downloadPdf') ?>" id="formDownload" method="post">
                        <input type="hidden" id="mdlBayarMulti_id" name="PATH_DEBITNOTE" />
                        <button type="submit" class="btn btn-success" onclick="submit_form();", data-dismiss="modal">Bayar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
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