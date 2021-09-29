        <?php if ($tahap != false) :?>
          <div class="col-sm-12 col-lg-12 mb-3 mb-lg-5">
            <div class="card card-shadow">
              <div class="card-body">
                <table id="myTable" class="table table-stripped table-nowrap table-align-middle table-hover" width="100%">
                  <thead class="thead-light">
                    <tr>
                      <th>No</th>
                      <th>TIM</th>
                      <th>PTS</th>
                      <th>Total Nilai</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no=1; if($nilai_tim != false):foreach ($nilai_tim as $key):?>
                    <tr>
                      <td><?= $no++;?></td>
                      <td><?= $key->NAMA_TIM;?></td>
                      <td><?= $key->namapt;?></td>
                      <td><?= ($key->nilai == null ? '<span class="badge badge-secondary">belum dinilai</span>' : $key->tot_nilai);?></td>
                    </tr>
                  <?php endforeach; endif;?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      <?php endif;?>