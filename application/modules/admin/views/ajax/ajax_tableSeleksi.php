<div class="card-header">
  <h5 class="card-header-title">Daftar Tim</h5>
  <div>
    <button type="button" class="btn btn-sm btn-block btn-success mb-2" id="seleksi" data-toggle="modal" data-target="#seleksi-btn">
      <i class="tio-credit-card-outlined "></i> Seleksi
    </button>
  </div>
</div>
<!-- Table -->
<div class="card-body" id="table-tim">
  <table id="myTable2" class="table table-lg table-borderless table-thead-bordered table-nowrap table-align-middle card-table w-100">
    <thead class="thead-light">
      <tr>
        <th>No</th>
        <th>
          <div class="custom-control custom-checkbox" style="text-align:center;">
            <input type="checkbox" class="custom-control-input" id="checkAll">
            <label class="custom-control-label" for="checkAll"></label>
          </div>
        </th>
        <th>Tim</th>
        <th>Tahap TIM</th>
      </tr>
    </thead>

    <tbody>
      <?php
      $no = 1;
      if($tim != false) { foreach ($tim as $item) {

        if($no <= $max_tim || $max_tim == 0){
          $checkbox = '
          <div class="custom-control custom-checkbox" style="text-align:center;">
          <input type="checkbox" class="custom-control-input checkItem" id="chck_' . $no . '" value="' . $item->KODE_PENDAFTARAN . '">
          <label class="custom-control-label" for="chck_' . $no . '"></label>
          </div>
          ';
        }else{
          $checkbox = '
          <div class="custom-control custom-checkbox" style="text-align:center;">
          <input type="checkbox" class="custom-control-input" checked disabled>
          <label class="custom-control-label"></label>
          </div>
          ';
        }

        echo '
        <tr>
        <td>'.$no.'</td>
        <td>'.$checkbox.'</td>
        <td>'.$item->NAMA_TIM.'</td>
        <td>'.($CI->M_admin->get_tahapData($item->TAHAP) == false ? "Menunggu seleksi" : $CI->M_admin->get_tahapData($item->TAHAP)->NAMA_TAHAP).'</td>
        </tr>
        ';
        $no++;
      } }
      ?>
    </tbody>
  </table>
</div>

<div class="modal fade" id="seleksi-btn" tabindex="-1" aria-labelledby="mdlBayarMulti" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mdlBayarMulti">Seleksi TIM</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>
                    Apakah anda yakin untuk menyeleksi sebanyak <span id="mdlBayarMulti_count"></span> tim ?
                </p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <form action="<?= site_url('admin/seleksi_tim') ?>" method="post">
                    <input type="hidden" name="TAHAP" value="<?= $tahap?>" />
                    <input type="hidden" id="mdlBayarMulti_itemId" name="KODE_PENDAFTARAN" />
                    <button type="submit" class="btn btn-success">Seleksi TIM</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $('#seleksi').click(function() {
        const kodePendaftaran = $('.checkItem:checkbox:checked').map((_, elm) => elm.value).get()
        $('#mdlBayarMulti_count').html(kodePendaftaran.length)
        $('#mdlBayarMulti_itemId').val(kodePendaftaran.toString())

    })
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