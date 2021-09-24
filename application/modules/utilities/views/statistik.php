<div class="container" style="margin-bottom:150px;margin-top: 75px; background: url(<?= base_url();?>assets/frontend/svg/components/abstract-shapes-9.svg) center no-repeat;">
    <!-- Jumlah MHS, TIM, PTS -->
    <div class="h2 text-primary" style="text-align: center;">Statistik Lomba</div>
    <div class="row">
        <div class="col-md-3 col-sm-12" style="margin-top: 25px;">
            <div class="card" style="text-align: center;">
                <div class="card-body">
                    <div class="js-counter h2"><?= number_format($jmlMhs->JML_MHS,0,",",".")?></div>
                    <div class="h6">Mahasiswa Terdaftar</div>
                    <div style="position: absolute;right: 10px;bottom: 10px;">
                        <svg height="30pt" width="30pt" enable-background="new 0 0 273.052 273.052" version="1.1" viewBox="0 0 273.05 273.05" xml:space="preserve" xmlns="http://www.w3.org/2000/svg"><g fill="rgba(245,202,153,0.8)"><circle cx="138.17" cy="73.52" r="73.52"/><path d="m126.38 171.37c6.728 3.236 17.65 3.236 24.378 0l67.047-32.243c6.734-3.236 13.989-0.082 16.208 7.054l20.032 64.35c2.219 7.136 0.234 17.65-4.433 23.48l-1.137 1.425c-3.807 4.759-11.058 8.784-17.661 24.797-2.85 6.913-10.378 12.82-17.846 12.82h-149.93c-7.473 0-14.99-5.901-17.873-12.793-6.679-15.947-14.163-19.776-18.259-24.291l-3.263-3.612c-5.015-5.537-6.995-15.719-4.427-22.735l23.279-63.647c2.567-7.016 10.106-10.079 16.839-6.842l67.042 32.237z"/></g></svg>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-12" style="margin-top: 25px;">
            <div class="card" style="text-align: center;">
                <div class="card-body">
                    <div class="js-counter h2"><?= number_format($jmlTim->JML_TIM,0,",",".")?></div>
                    <div class="h6">Tim Terdaftar</div>
                    <div style="position: absolute;right: 10px;bottom: 10px;">
                        <svg height="30pt" width="30pt" viewBox="0 -32 512 512" width="512pt" xmlns="http://www.w3.org/2000/svg"><path fill="rgba(0,201,167,0.8)" d="m271 15c0-8.285156-6.714844-15-15-15s-15 6.714844-15 15v64.265625c0 8.285156 6.714844 15 15 15s15-6.714844 15-15zm0 0"/><path fill="rgba(0,201,167,0.8)" d="m181.128906 105.941406c2.925782 2.925782 6.765625 4.394532 10.605469 4.394532 3.835937 0 7.675781-1.464844 10.605469-4.394532 5.855468-5.859375 5.855468-15.355468 0-21.214844l-32.136719-32.132812c-5.855469-5.859375-15.351563-5.859375-21.210937 0-5.859376 5.859375-5.859376 15.355469 0 21.214844zm0 0"/><path fill="rgba(0,201,167,0.8)" d="m320.265625 110.332031c3.839844 0 7.679687-1.464843 10.605469-4.394531l32.136718-32.132812c5.855469-5.855469 5.855469-15.355469 0-21.210938-5.859374-5.859375-15.355468-5.859375-21.214843 0l-32.132813 32.132812c-5.859375 5.859376-5.859375 15.355469 0 21.210938 2.929688 2.929688 6.769532 4.394531 10.605469 4.394531zm0 0"/><path fill="rgba(0,201,167,0.8)" d="m212.605469 144.914062c-.15625.128907-.304688.253907-.445313.371094l-64.851562 55.59375c-6.007813 5.148438-13.6875 7.988282-21.609375 7.988282h-46.449219c-43.769531 0-79.25 35.417968-79.25 79.25v144.621093c0 8.28125 6.714844 15 15 15h128.53125c8.289062 0 15-6.722656 15-15v-137.703125l76.328125-65.425781c3.898437-3.339844 6.140625-8.21875 6.140625-13.351563v-57.589843c0-14.648438-17.015625-22.980469-28.394531-13.753907zm0 0"/><path fill="rgba(0,201,167,0.8)" d="m432.75 208.867188h-46.449219c-7.921875 0-15.601562-2.839844-21.609375-7.992188l-64.851562-55.589844c-.140625-.117187-.289063-.242187-.445313-.371094-11.378906-9.226562-28.394531-.894531-28.394531 13.753907v57.589843c0 5.132813 2.242188 10.011719 6.140625 13.351563l76.328125 65.425781v137.699219c0 8.28125 6.710938 15 15 15h128.53125c8.285156 0 15-6.714844 15-15v-144.617187c0-43.832032-35.480469-79.25-79.25-79.25zm0 0"/><path fill="rgba(0,201,167,0.8)" d="m142.464844 145.664062c0-34.847656-28.351563-63.199218-63.199219-63.199218s-63.199219 28.351562-63.199219 63.199218c0 34.851563 28.351563 63.203126 63.199219 63.203126s63.199219-28.351563 63.199219-63.203126zm0 0"/><path fill="rgba(0,201,167,0.8)" d="m495.933594 145.664062c0-34.847656-28.351563-63.199218-63.199219-63.199218s-63.199219 28.351562-63.199219 63.199218c0 34.851563 28.351563 63.203126 63.199219 63.203126s63.199219-28.351563 63.199219-63.203126zm0 0"/></svg>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-12" style="margin-top: 25px;">
            <div class="card" style="text-align: center;">
                <div class="card-body">
                    <div class="js-counter h2"><?= number_format($jmlTimBayar->JML_TIM,0,",",".")?></div>
                    <div class="h6">TIM (telah membayar)</div>
                    <div style="position: absolute;right: 10px;bottom: 10px;">
                        <svg height="30pt" width="30pt" viewBox="0 -32 512 512" width="512pt" xmlns="http://www.w3.org/2000/svg"><path fill="rgba(0,201,167,0.8)" d="m271 15c0-8.285156-6.714844-15-15-15s-15 6.714844-15 15v64.265625c0 8.285156 6.714844 15 15 15s15-6.714844 15-15zm0 0"/><path fill="rgba(0,201,167,0.8)" d="m181.128906 105.941406c2.925782 2.925782 6.765625 4.394532 10.605469 4.394532 3.835937 0 7.675781-1.464844 10.605469-4.394532 5.855468-5.859375 5.855468-15.355468 0-21.214844l-32.136719-32.132812c-5.855469-5.859375-15.351563-5.859375-21.210937 0-5.859376 5.859375-5.859376 15.355469 0 21.214844zm0 0"/><path fill="rgba(0,201,167,0.8)" d="m320.265625 110.332031c3.839844 0 7.679687-1.464843 10.605469-4.394531l32.136718-32.132812c5.855469-5.855469 5.855469-15.355469 0-21.210938-5.859374-5.859375-15.355468-5.859375-21.214843 0l-32.132813 32.132812c-5.859375 5.859376-5.859375 15.355469 0 21.210938 2.929688 2.929688 6.769532 4.394531 10.605469 4.394531zm0 0"/><path fill="rgba(0,201,167,0.8)" d="m212.605469 144.914062c-.15625.128907-.304688.253907-.445313.371094l-64.851562 55.59375c-6.007813 5.148438-13.6875 7.988282-21.609375 7.988282h-46.449219c-43.769531 0-79.25 35.417968-79.25 79.25v144.621093c0 8.28125 6.714844 15 15 15h128.53125c8.289062 0 15-6.722656 15-15v-137.703125l76.328125-65.425781c3.898437-3.339844 6.140625-8.21875 6.140625-13.351563v-57.589843c0-14.648438-17.015625-22.980469-28.394531-13.753907zm0 0"/><path fill="rgba(0,201,167,0.8)" d="m432.75 208.867188h-46.449219c-7.921875 0-15.601562-2.839844-21.609375-7.992188l-64.851562-55.589844c-.140625-.117187-.289063-.242187-.445313-.371094-11.378906-9.226562-28.394531-.894531-28.394531 13.753907v57.589843c0 5.132813 2.242188 10.011719 6.140625 13.351563l76.328125 65.425781v137.699219c0 8.28125 6.710938 15 15 15h128.53125c8.285156 0 15-6.714844 15-15v-144.617187c0-43.832032-35.480469-79.25-79.25-79.25zm0 0"/><path fill="rgba(0,201,167,0.8)" d="m142.464844 145.664062c0-34.847656-28.351563-63.199218-63.199219-63.199218s-63.199219 28.351562-63.199219 63.199218c0 34.851563 28.351563 63.203126 63.199219 63.203126s63.199219-28.351563 63.199219-63.203126zm0 0"/><path fill="rgba(0,201,167,0.8)" d="m495.933594 145.664062c0-34.847656-28.351563-63.199218-63.199219-63.199218s-63.199219 28.351562-63.199219 63.199218c0 34.851563 28.351563 63.203126 63.199219 63.203126s63.199219-28.351563 63.199219-63.203126zm0 0"/></svg>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-12" style="margin-top: 25px;">
            <div class="card" style="text-align: center;">
                <div class="card-body">
                    <div class="js-counter h2"><?= number_format($jmlPTS,0,",",".")?></div>
                    <div class="h6">PTS Berpartisipasi</div>
                </div>
                <div style="position: absolute;right: 10px;bottom: 10px;">
                    <svg height="30pt" width="30pt" enable-background="new 0 0 293.764 293.764" version="1.1" viewBox="0 0 293.76 293.76" xml:space="preserve" xmlns="http://www.w3.org/2000/svg"> <path d="m293.76 110.78c0-6.641-4.319-12.031-9.649-12.031s-9.649-5.88-9.649-13.13v-5.472c0-7.25-4.047-17.389-9.045-22.648l-26.619-28.011c-4.993-5.254-14.919-9.513-22.17-9.513h-138.95c-7.25 0-17.459 3.976-22.795 8.877l-30.715 28.196c-5.341 4.906-9.671 14.756-9.671 22.006v6.565c0 7.25-3.247 13.13-7.25 13.13s-7.25 5.39-7.25 12.031c0 6.647 3.247 12.037 7.25 12.037 4.009 0 7.25 5.88 7.25 13.13v100.66c0 7.25-3.247 13.124-7.25 13.124s-7.25 5.391-7.25 12.032c0 6.647 5.88 12.037 13.13 12.037h267.5c7.25 0 13.13-5.39 13.13-12.037s-4.226-12.031-9.437-12.031-9.437-5.874-9.437-13.124v-100.66c0-7.25 4.226-13.13 9.437-13.13 5.21 0 9.442-5.39 9.442-12.037zm-121.72 25.167v100.66c0 7.25-5.88 13.124-13.13 13.124h-28.446c-7.25 0-13.13-5.874-13.13-13.124v-100.66c0-7.25 5.88-13.13 13.13-13.13h28.452c7.245 0 13.124 5.88 13.124 13.13zm-120.35-13.13h28.452c7.25 0 13.13 5.88 13.13 13.13l-0.011 100.66c0 7.25-5.88 13.124-13.13 13.124h-28.446c-7.25 0-13.13-5.874-13.13-13.124v-100.66c5e-3 -7.25 5.885-13.13 13.135-13.13zm185.99 126.91h-28.446c-7.25 0-13.13-5.874-13.13-13.124v-100.66c0-7.25 5.88-13.13 13.13-13.13h28.452c7.25 0 13.13 5.88 13.13 13.13v100.66c-6e-3 7.251-5.886 13.125-13.136 13.125z" fill="rgba(11,76,138,0.8)"/></svg>
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