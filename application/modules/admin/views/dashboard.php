<!-- Page Header -->
<div class="page-header">
  <div class="row align-items-center">
    <div class="col-sm mb-2 mb-sm-0">
      <h1 class="page-header-title">Dashboard</h1>
    </div>

    <div class="col-sm-auto">
    </div>
  </div>
</div>
<!-- End Page Header -->
<div class="" style="background: url(<?= base_url();?>assets/frontend/svg/components/abstract-shapes-9.svg) center no-repeat;">
    <!-- Jumlah MHS, TIM, PTS -->
    <div class="row">
        <div class="col-md-3 col-sm-12" style="margin-top: 25px;">
            <div class="card" style="text-align: center;">
                <div class="card-body">
                    <div class="js-counter h2"><?= number_format($jmlMhs->JML_MHS,0,",",".")?></div>
                    <div class="h6">Mahasiswa Terdaftar</div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-12" style="margin-top: 25px;">
            <div class="card" style="text-align: center;">
                <div class="card-body">
                    <div class="js-counter h2"><?= number_format($jmlTim->JML_TIM,0,",",".")?></div>
                    <div class="h6">Tim Terdaftar</div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-12" style="margin-top: 25px;">
            <div class="card" style="text-align: center;">
                <div class="card-body">
                    <div class="js-counter h2"><?= number_format($jmlTimBayar->JML_TIM,0,",",".")?></div>
                    <div class="h6">TIM (telah membayar)</div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-12" style="margin-top: 25px;">
            <div class="card" style="text-align: center;">
                <div class="card-body">
                    <div class="js-counter h2"><?= number_format($jmlPTS,0,",",".")?></div>
                    <div class="h6">PTS Berpartisipasi</div>
                </div>
            </div>
        </div>
    </div>
    <!-- END Jumlah MHS, TIM, PTS -->

    <!-- Jumlah Tim Menurut Kategori Lomba -->
    <div class="row">
        <div class="col-md-12 com-sm-12" style="margin-top: 25px;">
            <div class="card">
                <div class="card-body">
                    <h5 style="text-align: center;">Jumlah Tim Menurut Kategori Lomba</h5>
                    <hr>
                    <div id="chartTimKategori"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Jumlah Tim Menurut Kategori Lomba -->

    <!-- Jumlah Tim Berdasarkan LLDIKTI -->
    <div class="row">
        <div class="col-md-12 com-sm-12" style="margin-top: 25px;">
            <div class="card">
                <div class="card-body">
                    <h5 style="text-align: center;">Jumlah Tim Berdasarkan LLDIKTI</h5>
                    <hr>
                    <div id="chartTimLLDIKTI"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Jumlah Tim Berdasarkan LLDIKTI -->

    <!-- Jumlah Tim Berdasarkan PTS Asal -->
    <div class="row">
        <div class="col-md-12 com-sm-12" style="margin-top: 25px;">
            <div class="card">
                <div class="card-body">
                    <h5 style="text-align: center;">Jumlah Tim Berdasarkan PTS Asal</h5>
                    <hr>
                    <table id="tblTimPTS" class="table table-borderless table-thead-bordered dt-responsive display nowrap w-100">
                        <thead class="thead-light">
                            <tr>
                                <th>No</th>
                                <th>Kode</th>
                                <th>Institusi</th>
                                <th>Jumlah Tim</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $no = 1;
                                foreach ($timPTS as $item) {
                                    echo '
                                        <tr>
                                            <td>'.$no.'</td>
                                            <td>'.$item->kodept.'</td>
                                            <td>'.$item->namapt.'</td>
                                            <td>'.number_format($item->JML_TIM,0,",",".").'</td>
                                        </tr>
                                    ';
                                    $no++;
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- End Jumlah Tim Berdasarkan PTS Asal -->

    <!-- Jumlah Tim Berdasarkan PTS Asal -->
    <div class="row">
        <div class="col-md-12 com-sm-12" style="margin-top: 25px;">
            <div class="card">
                <div class="card-body">
                    <h5 style="text-align: center;">Detail Status Tim</h5>
                    <hr>
                    <table id="tblDetailTimPTS" class="table table-borderless table-thead-bordered dt-responsive display nowrap w-100">
                        <thead class="thead-light">
                            <tr>
                                <th>No</th>
                                <th>Nama Tim</th>
                                <th>PTS</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $no = 1; 
                                foreach ($detStatTim as $item) {
                                    $status = "";
                                    if($item->ID_KARYA != null){
                                        $status = '<span class="badge bg-success text-white">Sudah Unggah Karya</span>';
                                    }else if($item->STAT_BAYAR != null){
                                        if($item->STAT_BAYAR == "3"){
                                            $status = '<span class="badge bg-info text-white">Sudah Bayar</span>';
                                        }elseif($item->STAT_BAYAR == "2"){
                                            $status = '<span class="badge bg-primary text-white">Sedang diproses</span>';
                                        }else{
                                            $status = '<span class="badge bg-warning text-white">Belum Bayar</span>';
                                        }
                                    }else{
                                        $status = '<span class="badge bg-secondary text-white">Daftar Kompetisi</span>';
                                    }

                                    echo '
                                        <tr>
                                            <th>'.$no.'</th>
                                            <th>'.$item->NAMA_TIM.'</th>
                                            <th>'.$item->NAMA_PTS.'</th>
                                            <th>'.$status.'</th>
                                        </tr>
                                    ';
                                    $no++;
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- End Jumlah Tim Berdasarkan PTS Asal -->
</div>
<script>
    $(document).ready(function(){
        $('#tblTimPTS').DataTable( {
        "scrollX": true
    } );
        $('#tblDetailTimPTS').DataTable( {
        "scrollX": true
    } );
        var optChartKategori = {   
            chart: {
                type: 'bar',
                height: '400px'
            },
            series: [{
                name: 'Jml Tim',
                data: [<?= implode(',', $timKategori['jmlTim'])?>]
            }],
            xaxis: {
                categories: [<?= implode(',', $timKategori['lomba'])?>]
            },
            colors: ['rgba(0,201,167)']
        }

        var optChartLLDIKTI = {   
            chart: {
                type: 'bar',
                height: '400px'
            },
            series: [{
                name: 'Jml Tim',
                data: [<?= implode(',', $timLLDIKTI['jmlTim'])?>]
            }],
            xaxis: {
                categories: [<?= implode(',', $timLLDIKTI['lldikti'])?>]
            },
            colors: ['rgba(11,76,138)']
        }

        var chartTimKategori = new ApexCharts(document.querySelector("#chartTimKategori"), optChartKategori);
        var chartTimLLDIKTI = new ApexCharts(document.querySelector("#chartTimLLDIKTI"), optChartLLDIKTI);

        chartTimKategori.render();
        chartTimLLDIKTI.render();
    })
    
</script>