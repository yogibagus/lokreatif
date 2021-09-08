<div class="container" style="margin-bottom:150px;margin-top: 75px;">
    <!-- Jumlah data verifikasi -->
    <div class="h2 text-primary" style="text-align: center;">Statistik</div>
    <div class="row" style="margin-top: 25px;">
        <div class="col-4">
            <div class="card bg-primary" style="text-align: center;">
                <div class="card-body">
                    <div class="text-white js-counter h2"><?= number_format(102,0,",",".")?></div>
                    <div class="text-white h6">Total PT</div>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card bg-success" style="text-align: center;">
                <div class="card-body">
                    <div class="text-white js-counter h2"><?= number_format(12,0,",",".")?></div>
                    <div class="text-white h6">PT Sudah Diverifikasi</div>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card bg-danger" style="text-align: center;">
                <div class="card-body">
                    <div class="text-white js-counter h2"><?= number_format(34,0,",",".")?></div>
                    <div class="text-white h6">PT Belum Diverifikasi</div>
                </div>
            </div>
        </div>
    </div>
    <!-- Jumlah TIM -->
    <div class="row" style="margin-top: 50px;">
        <div class="col-4">
            <div class="card">
                <div class="card-body">
                    <h5 style="text-align: center;">Tim</h5>
                    <div style="text-align: center;font-size: 10px;">Statistik status validasi tim per lomba</div>
                    <hr>
                    <h6 style="text-align: center;">TikTok</h6>
                    <div style="margin-top: 25px;" id="chartKategori"></div>
                    <div style="float: right;">
                        <img src="<?= base_url('berkas/kompetisi/bidang-lomba/tiktok.png')?>" style="max-width: 50px;" />
                    </div>
                </div>
            </div>
        </div>
        <div class="col-8">
            <div class="card">
                <div class="card-body">
                    <h5 style="text-align: center;">Jumlah Tim</h5>
                    <div style="text-align: center;font-size: 10px;">Statistik jumlah tim yang telah mendaftar</div>
                    <hr>
                    <h6 style="text-align: center;">Total Tim : <?= number_format(28983, 0, ",", ".")?></h6>
                    <div style="margin-top: 25px;margin-left: 50px;text-align: center;">
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
                    <h5 style="text-align: center;">List PT yang sudah diverifikasi</h5>
                    <hr>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        // per lomba
        var optionsDonut = {
            chart: {
                type: 'donut'
            },
            series: [75, 15, 22],
            labels: ['Valid', 'Ditolak', 'Belum'],
            colors:['#00C9A7', '#EE2A61', '#71869D']
        }
        var chartKategori = new ApexCharts(document.querySelector("#chartKategori"), optionsDonut);
        chartKategori.render()

        // total tim 
        var optionsPie = {
            chart: {
                type: 'pie',
                width: 405
            },
            series: [75, 15, 22, 11, 22, 33, 44, 55],
            labels: ['Aplikasi Web/Mobile', 'Video Pendek', 'Desain Poster', 'Ide Bisnis', 'Fotografi', 'Game', 'TIKTOK', 'Unjuk Talenta'],
            plotOptions: {
                pie: {
                    customScale: 1,
                    size: 50
                }
            },
            legend: {
                fontSize: '10px',
                horizontalAlign: 'right'
            }
            // colors:['#00C9A7', '#EE2A61', '#71869D']
        }

        var chartTim = new ApexCharts(document.querySelector("#chartTim"), optionsPie);
        chartTim.render()
        // setInterval(function(){
        //     console.log("ilham");
        //     chartKategori.updateSeries([{
        //         series: [12, 12, 12]
        //     }], true)
        // }, 2000)
    })
    
</script>