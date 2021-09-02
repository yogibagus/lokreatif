  <!-- Card -->
  <div class="card mb-4">
    <div class="card-header">
      <h5 class="card-header-title">Refund biaya pendaftaran kompetisi</h5>
      <button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#atur-via">Metode Refund</button>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-sm-12 col-md-6 p-2">
          <div class="media align-items-center mb-3">
            <span class="d-block font-size-1 mr-3">KODE TRANSAKSI</span>
            <div class="media-body text-right">
              <span class="text-dark font-weight-bold"><?= $dataRefund->KODE_TRANS;?></span>
            </div>
          </div>
          <div class="media align-items-center mb-3 border-bottom">
            <span class="d-block font-size-1 mr-3">Asal PTS</span>
            <div class="media-body text-right">
              <?php if ($this->session->userdata('role') == 1) :?>
                <span class="text-dark font-weight-bold"><?= $dataPendaftaran->namapt;?></span>
              <?php else:?>
                <span class="text-dark font-weight-bold"><?= $this->session->userdata('nama');?></span>
              <?php endif;?>
            </div>
          </div>
          <div class="media align-items-center">
            <h5 class="font-size-1 mr-3">Nama TIM </h5>
          </div>
          <div class="media align-items-center mb-3">
            <div class="w-100">
              <div class="overflow-auto p-3 mb-3 mb-md-0 bg-light rounded " style="max-height: 120px">
                <?php
                foreach ($tim as $item) {
                  echo '
                  <h5><li>' . $item->NAMA_TIM . '</li></h5><br>
                  ';
                }
                ?>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-12 col-md-6 p-2 border-dashed">
          <div class="media align-items-center mb-3">
            <span class="d-block font-size-1 mr-3">Metode Refund <i class="far fa-question-circle text-body ml-1" data-container="body" data-toggle="popover" data-placement="top" data-trigger="hover" title="Apa ini?" data-content="Merupakan media transfer refund ke anda dari admin kami."></i></span>
            <div class="media-body text-right">
              <span class="text-dark font-weight-bold"><?= $dataRefund->VIA != "" ? $dataRefund->VIA : 'belum diatur';?></span>
            </div>
          </div>
          <?php if ($dataRefund->METHOD != "" || $dataRefund->METHOD != null) :?>
            <div class="media align-items-center mb-3">
              <span class="d-block font-size-1 mr-3">Atas nama</span>
              <div class="media-body text-right">
                <span class="text-dark font-weight-bold"><?= $dataRefund->AN_VIA != "" ? $dataRefund->AN_VIA : 'belum diatur';?></span>
              </div>
            </div>
            <div class="media align-items-center mb-3">
              <span class="d-block font-size-1 mr-3">NO Tujuan</span>
              <div class="media-body text-right">
                <span class="text-dark font-weight-bold"><?= $dataRefund->NO_VIA != "" ? $dataRefund->NO_VIA : 'belum diatur';?></span>
              </div>
            </div>
          <?php endif;?>
          <!-- <div class="media align-items-center mb-3">
            <span class="d-block font-size-1 mr-3">Total Bayar sebelumnya</span>
            <div class="media-body text-right">
              <span class="text-dark font-weight-bold">Rp.<?= number_format($dataRefund->BAYAR,0,",",".");?></span>
            </div>
          </div> -->
          <div class="media align-items-center bg-soft-secondary mb-3">
            <span class="d-block font-size-1 mr-3">Jumlah Refund</span>
            <div class="media-body text-right">
              <span class="text-dark font-weight-bold">Rp.<?= number_format($biayaRefund->JML_REFUND,0,",",".");?></span>
            </div>
          </div>
          <div class="media align-items-center">
            <span class="d-block font-size-1 mr-3">Status Refund</span>
            <div class="media-body text-right">
              <?php if ($dataRefund->STAT_REFUND == 0):?>
                <span class="badge badge-secondary">Pilih Metode Refund</span>
              <?php elseif($dataRefund->STAT_REFUND == 1):?>
                <span class="badge badge-warning">Sedang diproses admin</span>
              <?php elseif($dataRefund->STAT_REFUND == 2):?>
                <span class="badge badge-success">Refund telah dikirim</span>
              <?php else:?>
                <span class="badge badge-danger">Refund ditolak</span>
              <?php endif;?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div id="atur-via" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">Metode Refund</h5>
          <button type="button" class="btn btn-xs btn-icon btn-soft-secondary" data-dismiss="modal" aria-label="Close">
            <svg aria-hidden="true" width="10" height="10" viewBox="0 0 18 18" xmlns="http://www.w3.org/2000/svg">
              <path fill="currentColor" d="M11.5,9.5l5-5c0.2-0.2,0.2-0.6-0.1-0.9l-1-1c-0.3-0.3-0.7-0.3-0.9-0.1l-5,5l-5-5C4.3,2.3,3.9,2.4,3.6,2.6l-1,1 C2.4,3.9,2.3,4.3,2.5,4.5l5,5l-5,5c-0.2,0.2-0.2,0.6,0.1,0.9l1,1c0.3,0.3,0.7,0.3,0.9,0.1l5-5l5,5c0.2,0.2,0.6,0.2,0.9-0.1l1-1 c0.3-0.3,0.3-0.7,0.1-0.9L11.5,9.5z"/>
            </svg>
          </button>
        </div>
        <form action="<?= site_url('refund/atur_via');?>" method="POST">
          <input type="hidden" name="KODE_REFUND" value="<?= $dataRefund->KODE_REFUND;?>">
          <input type="hidden" name="JML_REFUND" value="<?= $biayaRefund->JML_REFUND;?>">
          <div class="modal-body">
            <div class="alert alert-soft-info">
              <p class="mb-0"><b>Metode Refund</b>: merupakan melalui media apa anda ingin kami mengirimkan dana refund anda, sedangkan <br><b>NO Tujuan</b>: merupakan Nomor sesuai pilihan Metode Refund anda.</p>
            </div>
            <div class="form-group">
             <!-- Nav -->
              <div class="text-center">
                  <ul class="nav nav-segment nav-pills scrollbar-horizontal" role="tablist">
                      <li class="nav-item">
                          <a class="nav-link active" id="ewallet-tab" data-toggle="pill" href="#tab-menu-ewallet" role="tab" aria-controls="tab-menu-ewallet" aria-selected="true">E-Wallet</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" id="va-tab" data-toggle="pill" href="#tab-menu-va" role="tab" aria-controls="tab-menu-va" aria-selected="false">Rek. Bank</a>
                      </li>
                  </ul>
              </div>
              <!-- End Nav -->
            </div>
            <div class="form-group" id="e_wallet">
              <label class="input-label">Pilih Metode Refund <small class="text-danger">*</small></label>
              <select class="js-select2-custom custom-select" size="1" id="a" 
                data-hs-select2-options='{
                  "minimumResultsForSearch": "Infinity"
                }' required>
                <optgroup label="Current">
                  <?php if ($dataRefund->VIA != "") :?>
                    <option value="<?= $dataRefund->VIA;?>"><?= $dataRefund->VIA;?></option>
                  <?php else:?>
                    <option value="">Pilih Metode</option>
                  <?php endif;?>
                </optgroup>
                <optgroup label="Changes">
                  <option value="OVO">OVO</option>
                  <option value="DANA">DANA</option>
                </optgroup>
              </select>
            </div>
            <div class="form-group d-none" id="bank">
              <label class="input-label">Pilih Metode Refund <small class="text-danger">*</small></label>
              <select class="js-select2-custom custom-select" size="1" id="b"
                data-hs-select2-options='{
                  "minimumResultsForSearch": "Infinity"
                }' required>
                <optgroup label="Current">
                  <?php if ($dataRefund->VIA != "") :?>
                    <option value="<?= $dataRefund->VIA;?>"><?= $dataRefund->VIA;?></option>
                  <?php else:?>
                    <option value="">Pilih Metode</option>
                  <?php endif;?>
                </optgroup>
                <optgroup label="Changes" class="d-none" id="bank">
                  <option value="BCA">BCA</option>
                  <option value="BNI">BNI</option>
                  <option value="BRI">BRI</option>
                </optgroup>
              </select>
            </div>
            <input type="hidden" name="METHOD" class="form-control form-control-sm" value="<?= $dataRefund->METHOD;?>" value="E_WALLET" id="METHOD">
            <input type="hidden" name="VIA" class="form-control form-control-sm" value="<?= $dataRefund->VIA;?>" id="VIA">
          <div class="form-group">
            <label class="input-label">Masukkan Atas Nama <small class="text-muted">(jika diperlukan)</small></label>
            <input type="text" name="AN_VIA" class="form-control form-control-sm" value="<?= $dataRefund->AN_VIA;?>">
          </div>
          <div class="form-group">
            <label class="input-label">Masukkan NO Tujuan <small class="text-danger">*</small></label>
            <input type="text" name="NO_VIA" class="form-control form-control-sm" value="<?= $dataRefund->NO_VIA;?>" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-white" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
    $(document).ready(function() {
        $("#va-tab").click(function() {
          $("#METHOD").val("BANK");
          $('#a optgroup option:selected').attr("selected",null).change();
          $("#e_wallet").addClass("d-none");
          $("#bank").removeClass("d-none");
        });
        $("#ewallet-tab").click(function() {
          $("#METHOD").val("E_WALLET");
          $('#b optgroup option:selected').attr("selected",null).change();
          $("#bank").addClass("d-none");
          $("#e_wallet").removeClass("d-none");
        });

        $(".js-select2-custom optgroup option").filter(function() {
            return $(this).val() == $("#VIA").val();
        }).attr('selected', true);

        $(".js-select2-custom").change(function () {

            $("#VIA").val($(this).find("option:selected").attr("value"));
        });
    });
</script>