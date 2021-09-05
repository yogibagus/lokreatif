<div class="row mb-4">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h5 class="card-header-title">Daftar Transaksi</h5>
      </div>
      <!-- Table -->
      <div class="card-body px-0 pb-0">
        <div class="table-responsive datatable-custom" style="padding-bottom: 25px;">
          <table id="tbTrans" class="table table-lg table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
          <thead class="thead-light" style="padding-top: 15px;">
            <tr>
              <th>Kode Transaksi</th>
              <th>Tgl Transaksi</th>
              <th>Jatuh Tempo</th>
              <th>Metode</th>
              <th>Nominal</th>
              <th>Status</th>
              <th>Aksi</th>
            </tr>
          </thead>

          <tbody>
            <?php
              // foreach ($transaksi as $item) {
              //   if($item->STAT_BAYAR == null){
              //     $status   = '<span class="badge bg-success text-white">Baru</span>';
              //   }else if($item->STAT_BAYAR == "1" || $item->STAT_BAYAR == "2"){
              //     $status = '<span class="badge bg-warning text-white">Proses</span>';
              //   }else if($item->STAT_BAYAR == "3"){
              //     $status = '<span class="badge bg-primary text-white">Sukses</span>';
              //   }else if($item->STAT_BAYAR == "4"){
              //     $status = '<span class="badge bg-danger text-white">Gagal</span>';
              //   }
              //   $date = date_create($item->LOG_TIME);

              //   if($CI->General->cek_refeundUniv($item->KODE_TRANS) == true){
              //     $btnRefund = '
              //       <a href="'.site_url('refund').'" class="btn btn-xs btn-success">
              //       <i class="tio-credit-card-add"></i>
              //         Refund Transaksi
              //       </a>
              //     ';
              //   }else{
              //     $btnRefund = '
              //       <a href="#" class="btn btn-xs btn-secondary disabled">
              //         <i class="tio-credit-card-add"></i>
              //         Tidak Ada Refund
              //       </a>
              //     ';
              //   }

              //   echo '
              //     <tr>
              //       <td><a href="'.site_url('payment/checkout/'.$item->KODE_TRANS).'" target="_blank">'.$item->KODE_TRANS.'</a></td>
              //       <td>'.date_format($date, 'd M Y').'</td>
              //       <td>'.$status.'</td>
              //       <td>
              //         <a href="#" data-toggle="collapse" data-target="#'.$item->KODE_TRANS.'" class="accordion-toggle btn btn-xs btn-info">
              //           <i class="tio-info-outined"></i>
              //           Riwayat Pembayaran
              //         </a>
              //         '.$btnRefund.'
              //       </td>
              //     </tr>
              //     <tr>
              //       <td colspan="12" style="padding-top: 0 !important;padding-bottom: 0 !important;">
              //         <div class="accordian-body collapse" id="'.$item->KODE_TRANS.'">
              //           <div class="card card-body">
              //             <h4 style="text-align: center;margin-top: 25px;margin-bottom: 25px;">Riwayat Pembayaran '.$item->KODE_TRANS.'</h4>
              //             <div class="table-responsive datatable-custom">
              //               <table id="datatable" class="table table-lg table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
              //                 <thead class="thead-light">
              //                   <th>Tanggal Transaksi</th>
              //                   <th>Tanggal Expired</th>
              //                   <th>Metode</th>
              //                   <th>Status</th>
              //                   <th>Aksi</th>
              //                 </thead>
              //                 <tbody>
              //                 ';
              //                 foreach ($payment[$item->KODE_TRANS] as $item2) {
              //                   $dateTrans = date_create($item2->CREATED_TIME);
              //                   $dateExp   = date_create($item2->EXP_TIME);

              //                   if($item2->STAT_PAY == "2"){
              //                     $status = '<span class="badge bg-warning text-white">Proses</span>';
              //                   }else if($item2->STAT_PAY == "3"){
              //                     $status = '<span class="badge bg-primary text-white">Terbayar</span>';
              //                   }else if($item2->STAT_PAY == "4"){
              //                     $status = '<span class="badge bg-danger text-white">Gagal</span>';
              //                   }else if($item2->STAT_PAY == "5"){
              //                     $status   = '<span class="badge bg-success text-white">Refund</span>';
              //                   }
              //                   echo '
              //                     <tr>
              //                       <td>'.date_format($dateTrans, 'd M Y H:i:s').'</td>
              //                       <td>'.date_format($dateExp, 'd M Y H:i:s').'</td>
              //                       <td><img style="max-width: 50px;" class="img-fluid w-90 fit-image" src="'.$this->transaksi->get_imageMethodPayment($item2->METHOD).'"></td>
              //                       <td>'.$status.'</td>
              //                       <td>
              //                         <a href="'.site_url('payment/details/'.$item2->KODE_PAY).'" class="btn btn-xs btn-info" target="_blank">
              //                           <i class="tio-shopping-basket-outlined"></i>
              //                           Checkout
              //                         </a>
              //                       </td>
              //                     </tr>
              //                   ';
              //                 }
              //                 echo '
              //                 </tbody>
              //               </table>
              //           </div>
              //       </td>
              //     </tr>
              //   ';
              // }
            ?>
          </tbody>
          </table>
        </div>
      </div>
      <!-- End Table -->
    </div>
  </div>
</div>
<script>
  $(document).ready(function(){
    console.log('<?= $this->session->userdata('kode_user')?>')
    var table = $("#tbTrans").DataTable({
      'responsive': true,
      'proccessing': true,
      'serverSide': true,
      'serverMethod': 'post',
      "ajax": {
        'url': '<?= site_url('payment/get_PaymentMultiTrans')?>'
      },
      'columns': [
          { data: 'kodeTrans' },
          { data: 'tgl' },
          { data: 'tglExp' },
          { data: 'metode' },
          { data: 'nominal' },
          { data: 'stat' },
          { data: 'aksi' }
      ],
      "language": {
        "emptyTable": '<div class="text-center p-4">' +
        '<img class="mb-3" src="<?= base_url() ?>assets/backend/svg/illustrations/sorry.svg" alt="Image Description" style="width: 7rem;">' +
        '<p class="mb-0">Tidak ada data untuk ditampilkan</p>' +
        '</div>'
      },
      "ordering": false,
      "searching": true
    });
    setInterval( function () {
        // $(table).clear().draw();
        table.ajax.reload(null, false);
    }, 5000 );
  })
</script>