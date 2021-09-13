<div class="container" style="margin-bottom:150px;margin-top: 75px; background: url(<?= base_url();?>assets/frontend/svg/components/abstract-shapes-9.svg) center no-repeat;">
    <!-- Jumlah data verifikasi -->
    <div class="h2 text-primary" style="text-align: center;">Statistik Lomba</div>
    <div class="row">
        <div class="col-md-4 col-sm-12" style="margin-top: 25px;">
            <div class="card" style="text-align: center;">
                <div class="card-body">
                    <div class="js-counter h2"><?= number_format($jmlPesertaVerif->JML,0,",",".")?></div>
                    <div class="h6">Peserta Sudah Diverifikasi</div>
                    <div style="position: absolute;right: 10px;bottom: 10px;">
                        <svg  height="40pt" width="40pt" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 196.407 196.407" style="enable-background:new 0 0 196.407 196.407;" xml:space="preserve"> <g> <path style="fill:rgba(0,201,167,0.8);" d="M56.084,189.137c-1.735,0.897-3.807,1.012-5.891-1.071L2.651,139.517 c-4.204-4.291-3.225-9.943,1.648-13.462c6.228-4.498,14.555-11.83,21.582-22.55c3.291-5.026,7.995-5.363,11.248-0.315 l11.727,18.205c3.258,5.053,7.006,11.389,9.018,10.677c0.816-0.288,1.806-0.995,2.986-2.393L156.169,9.877 c3.742-4.699,9.023-4.194,11.803,1.131l27.054,51.894c2.779,5.325,1.235,12.695-3.448,16.459L69.1,177.786 C64.422,181.55,59.272,187.5,56.084,189.137z"/></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-12" style="margin-top: 25px;">
            <div class="card" style="text-align: center;">
                <div class="card-body">
                    <div class="js-counter h2"><?= number_format($jmlPesertaBelum->JML,0,",",".")?></div>
                    <div class="h6">Peserta Belum Diverifikasi</div>
                    <div style="position: absolute;right: 10px;bottom: 10px;">
                        <svg height="40pt" width="40pt" enable-background="new 0 0 310.201 310.201" version="1.1" viewBox="0 0 310.2 310.2" xml:space="preserve" xmlns="http://www.w3.org/2000/svg"> <path d="m155.48 283.16c-69.821 0-126.4-57.235-126.4-127.04s56.583-126.4 126.4-126.4c69.805 0 126.38 56.61 126.38 126.4 0 69.8-56.577 127.04-126.38 127.04zm0-228.16c-55.843 0-101.12 45.269-101.12 101.12 0 55.859 45.28 101.75 101.12 101.75 55.832 0 101.1-45.895 101.1-101.75 0-55.854-45.269-101.12-101.1-101.12zm5.053 116.6s-2.263 0.071-5.058 0.163c-2.796 0.092-8.246-0.984-11.417-3.546-2.023-1.626-3.742-3.715-3.742-6.097v-71.404c0-5.771 4.335-10.432 10.1-10.432s10.111 4.656 10.111 10.432v43.795c0 9.317 7.555 16.872 16.877 16.872h33.679c5.771 0 10.438 4.041 10.438 9.807 0 5.744-4.672 10.405-10.438 10.405h-50.551v5e-3z" fill="rgba(245,202,153,0.8)"/> <path d="m300.02 130.48c-4.591 0-8.757-3.127-9.872-7.789-7.37-30.627-25.275-58.122-50.42-77.425-4.455-3.416-5.292-9.801-1.871-14.256 3.416-4.449 9.801-5.287 14.25-1.871 28.822 22.121 49.354 53.656 57.806 88.793 1.316 5.455-2.045 10.949-7.506 12.26-0.804 0.201-1.604 0.288-2.387 0.288z" fill="rgba(245,202,153,0.8)"/><path d="m10.174 133.75c-0.713 0-1.436-0.076-2.159-0.234-5.488-1.191-8.969-6.598-7.783-12.086 7.565-34.913 27.065-66.65 54.902-89.363 4.346-3.541 10.748-2.899 14.299 1.452 3.552 4.351 2.899 10.753-1.452 14.299-24.285 19.815-41.288 47.483-47.886 77.915-1.033 4.764-5.243 8.017-9.921 8.017z" fill="rgba(245,202,153,0.8)"/></svg>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-12" style="margin-top: 25px;">
            <div class="card" style="text-align: center;">
                <div class="card-body">
                    <div class="js-counter h2"><?= number_format($jmlPeserta->JML,0,",",".")?></div>
                    <div class="h6">Total Peserta</div>
                </div>
                <div style="position: absolute;right: 10px;bottom: 10px;">
                    <svg height="40pt" width="40pt" enable-background="new 0 0 293.764 293.764" version="1.1" viewBox="0 0 293.76 293.76" xml:space="preserve" xmlns="http://www.w3.org/2000/svg"> <path d="m293.76 110.78c0-6.641-4.319-12.031-9.649-12.031s-9.649-5.88-9.649-13.13v-5.472c0-7.25-4.047-17.389-9.045-22.648l-26.619-28.011c-4.993-5.254-14.919-9.513-22.17-9.513h-138.95c-7.25 0-17.459 3.976-22.795 8.877l-30.715 28.196c-5.341 4.906-9.671 14.756-9.671 22.006v6.565c0 7.25-3.247 13.13-7.25 13.13s-7.25 5.39-7.25 12.031c0 6.647 3.247 12.037 7.25 12.037 4.009 0 7.25 5.88 7.25 13.13v100.66c0 7.25-3.247 13.124-7.25 13.124s-7.25 5.391-7.25 12.032c0 6.647 5.88 12.037 13.13 12.037h267.5c7.25 0 13.13-5.39 13.13-12.037s-4.226-12.031-9.437-12.031-9.437-5.874-9.437-13.124v-100.66c0-7.25 4.226-13.13 9.437-13.13 5.21 0 9.442-5.39 9.442-12.037zm-121.72 25.167v100.66c0 7.25-5.88 13.124-13.13 13.124h-28.446c-7.25 0-13.13-5.874-13.13-13.124v-100.66c0-7.25 5.88-13.13 13.13-13.13h28.452c7.245 0 13.124 5.88 13.124 13.13zm-120.35-13.13h28.452c7.25 0 13.13 5.88 13.13 13.13l-0.011 100.66c0 7.25-5.88 13.124-13.13 13.124h-28.446c-7.25 0-13.13-5.874-13.13-13.124v-100.66c5e-3 -7.25 5.885-13.13 13.135-13.13zm185.99 126.91h-28.446c-7.25 0-13.13-5.874-13.13-13.124v-100.66c0-7.25 5.88-13.13 13.13-13.13h28.452c7.25 0 13.13 5.88 13.13 13.13v100.66c-6e-3 7.251-5.886 13.125-13.136 13.125z" fill="rgba(11,76,138,0.8)"/></svg>
                </div>
            </div>
        </div>
    </div>
    <!-- Jumlah TIM -->
    <div class="row" style="margin-top: 25px;">
        <div class="col-md-4 col-sm-12" style="margin-top: 25px;">
            <div class="card">
                <div class="card-body">
                    <h5 style="text-align: center;">Peserta</h5>
                    <div style="text-align: center;font-size: 10px;">Statistik status validasi peserta per lomba</div>
                    <hr>
                    <h6 id="kategori_title" style="text-align: center;"><?= str_replace('"', ' ', $bidangLomba[0])?></h6>
                    <div style="margin-top: 25px;" id="chartKategori"></div>
                    <div style="float: right;margin-bottom: 13px;">
                        <img id="kategori_img" src=<?= $posterLomba[0]?> style="max-width: 50px;" />
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8 col-sm-12" style="margin-top: 25px;">
            <div class="card">
                <div class="card-body">
                    <h5 style="text-align: center;">Jumlah Peserta</h5>
                    <div style="text-align: center;font-size: 10px;">Statistik jumlah peserta yang telah mendaftar</div>
                    <hr>
                    <h6 style="text-align: center;">Total Peserta : <?= number_format($jmlPeserta->JML, 0, ",", ".")?></h6>
                    <div style="margin-top: 25px;padding-left: 120px;">
                        <div  id="chartTim"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- List PT -->
    <div class="row" style="margin-top: 50px;">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 style="text-align: center;">List Perguruan Tinggi</h5>
                    <hr>
                    <table id="tablePT" class="table table-thead-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode</th>
                                <th>Institusi</th>
                                <th>Peserta Terverifikasi</th>
                                <th>Total Peserta</th>
                            </tr>
                        </thead>
                        <tbody>
                           <?php
                            $x = 1;
                            foreach ($listPTDetail as $item) {
                                echo '
                                    <tr>
                                        <td>'.$x.'</td>
                                        <td>'.$item->kodept.'</td>
                                        <td>'.$item->namapt.'</td>
                                        <td>'.$item->JML_TERVERIFIKASI.'</td>
                                        <td>'.$item->JML_PESERTA.'</td>
                                    </tr>
                                ';
                                $x++;
                            }
                           ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $("#tablePT").DataTable()
        let kategoriData = []
        <?php for($x = 0; $x < count($bidangLomba); $x++){
            echo '
                kategoriData['.$x.'] = {
                    title: '.$bidangLomba[$x].',
                    img: '.$posterLomba[$x].',
                    data: [
                        '.$jmlVerifPerLomba[$x].',
                        '.$jmlBelumPerLomba[$x].',
                        '.$jmlTolakPerLomba[$x].',
                    ]
                }
            ';
        }?>

        // chart per lomba
        var optionsDonut = {
            chart: {
                type: 'donut'
            },
            series: [
                <?= $jmlVerifPerLomba[0]?>,
                <?= $jmlBelumPerLomba[0]?>,
                <?= $jmlTolakPerLomba[0]?>,
            ],
            noData: {
                text: undefined,
                align: 'center',
                verticalAlign: 'middle',
                offsetX: 0,
                offsetY: 0,
                style: {
                    color: undefined,
                    fontSize: '14px',
                    fontFamily: undefined
                }
            },
            labels: ['Verifikasi', 'Belum', 'Ditolak'],
            colors:['#00C9A7', '#F5CA99', '#EE2A61']
        }
        var chartKategori = new ApexCharts(document.querySelector("#chartKategori"), optionsDonut);
        chartKategori.render()

        // chart total tim 
        var optionsPie = {
            chart: {
                type: 'pie',
                width: 405
            },
            series: [<?= implode(',', $jmlPesertaPerLomba)?>],
            labels: [<?= implode(',', $bidangLomba)?>],
            plotOptions: {
                pie: {
                    customScale: 1,
                    size: 50
                }
            },
            legend: {
                fontSize: '10px',
                horizontalAlign: 'right'
            },
            colors:['#0B4C8A', '#71869D', '#00C9A7', '#EE2A61', '#F5CA99', '#09A5BE', '#21325B', '#8e44ad']
        }

        var chartTim = new ApexCharts(document.querySelector("#chartTim"), optionsPie);
        chartTim.render()


        let number = 1
        setInterval(function(){
            $("#kategori_img").attr("src", kategoriData[number].img)
            $("#kategori_title").html(kategoriData[number].title)
            chartKategori.updateSeries(kategoriData[number].data)
            number == 7 ? number = 0 : number++
        }, 2000)
    })
    
</script>