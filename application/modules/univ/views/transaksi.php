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

          <tbody></tbody>
          </table>
        </div>
      </div>
      <!-- End Table -->
    </div>
  </div>
</div>
<script>
  $(document).ready(function(){
    $.fn.dataTable.ext.errMode = 'none';
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
        $.ajax({
          url: "<?= site_url("payment/check_payment_mulitTrans")?>",
          method: 'post',
          success: function(res){
            table.ajax.reload();
          }
        })
    }, 5000 );
  })
</script>