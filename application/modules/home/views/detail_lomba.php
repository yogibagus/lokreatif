<!-- CTA Section -->
<div class="bg-primary">
  <div class="container space-2">
    <div class="row justify-content-lg-between align-items-lg-center text-center text-lg-left">
      <div class="col-lg-6 mb-5 mb-lg-0">
        <h2 class="text-white mb-0"><?= $bidangLomba->BIDANG_LOMBA;?></h2>
      </div>
    </div>
  </div>
</div>
<!-- End CTA Section -->

<!-- Description Section -->
<div class="container w-lg-75 space-2">
  <div class="row">
    <div class="col-lg-12">
      <div class="mb-8">
        <!-- Accordion -->
        <div id="bidangLombaContainer<?= $bidangLomba->ID_BIDANG;?>" class="accordion mb-5">
          <!-- Card -->
          <div class="card card-bordered shadow-none">
            <div class="card-body card-collapse" id="keteranganLomba<?= $bidangLomba->ID_BIDANG;?>">
              <a class="btn btn-link btn-block card-btn">
              <span class="row align-items-center">
                <span class="col-9">
                  <span class="media align-items-center">
                    <span class="w-100 max-w-6rem mr-3">
                      <img class="img-fluid" src="<?= base_url();?>assets/frontend/svg/icons/icon-21.svg" alt="SVG">
                    </span>
                    <span class="media-body">
                      <span class="d-block font-size-1 font-weight-bold">Keterangan bidang lomba</span>
                    </span>
                  </span>
                </span>
                <span class="col-3 text-right">
                  <span class="card-btn-toggle">
                    <span class="card-btn-toggle-default">+</span>
                    <span class="card-btn-toggle-active">−</span>
                  </span>
                </span>
              </span>
            </a>
          </div>
          <div id="detailKeteranganLomba<?= $bidangLomba->ID_BIDANG;?>" aria-labelledby="keteranganLomba<?= $bidangLomba->ID_BIDANG;?>" data-parent="#bidangLombaContainer<?= $bidangLomba->ID_BIDANG;?>">
            <div class="card-body">
              <p class="small mb-0"><?= $bidangLomba->KETERANGAN;?></p>
            </div>
          </div>
        </div>
        <!-- End Card -->

        <?php if($tahapPenilaian != false): foreach($tahapPenilaian as $tahap):?>

          <!-- Kriteria -->
          <div class="card card-bordered shadow-none">
            <div class="card-body card-collapse" id="kriteriaPenilaian<?= $tahap->ID_TAHAP;?><?= $bidangLomba->ID_BIDANG;?>">
              <a class="btn btn-link btn-block card-btn collapsed" href="javascript:;" role="button"
              data-toggle="collapse"
              data-target="#detailKriteriaPenilaian<?= $tahap->ID_TAHAP;?><?= $bidangLomba->ID_BIDANG;?>"
              aria-expanded="false"
              aria-controls="detailKriteriaPenilaian<?= $tahap->ID_TAHAP;?>"<?= $bidangLomba->ID_BIDANG;?>>
              <span class="row align-items-center">
                <span class="col-9">
                  <span class="media align-items-center">
                    <span class="w-100 max-w-6rem mr-3">
                      <img class="img-fluid" src="<?= base_url();?>assets/frontend/svg/icons/icon-2.svg" alt="SVG">
                    </span>
                    <span class="media-body">
                      <span class="d-block font-size-1 font-weight-bold">Kriteria penilaian - <?= $tahap->NAMA_TAHAP;?></span>
                    </span>
                  </span>
                </span>
                <span class="col-3 text-right">
                  <span class="card-btn-toggle">
                    <span class="card-btn-toggle-default">+</span>
                    <span class="card-btn-toggle-active">−</span>
                  </span>
                </span>
              </span>
            </a>
          </div>
          <div id="detailKriteriaPenilaian<?= $tahap->ID_TAHAP;?><?= $bidangLomba->ID_BIDANG;?>" class="collapse" aria-labelledby="kriteriaPenilaian<?= $tahap->ID_TAHAP;?><?= $bidangLomba->ID_BIDANG;?>" data-parent="#bidangLombaContainer<?= $bidangLomba->ID_BIDANG;?>">
            <div class="card-body">
              <table class="table table-bordered">
                <thead class="thead-light">
                  <th width="2%">No</th>
                  <th width="95%">Kriteria Penilaian</th>
                  <th width="3%">Bobot</th>
                </thead>
                <tbody>
                  <?php $no = 1; $dataKriteria = $CI->M_home->get_kriteriaPenilaian($tahap->ID_TAHAP, $bidangLomba->ID_BIDANG); if($dataKriteria != false): foreach($dataKriteria as $kriteria):?>
                  <tr>
                    <td rowspan="2"><?= $no++;?></td>
                    <td><?= $kriteria->KRITERIA;?></td>
                    <td rowspan="2"><?= $kriteria->BOBOT;?>%</td>
                  </tr>
                  <tr>
                    <td><?= $kriteria->KETERANGAN;?></td>
                  </tr>
                <?php endforeach; endif;?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!-- End Kriteria -->

    <?php endforeach; endif;?>

  </div>
  <!-- End Accordion -->
</div>
</div>
</div>
</div>