<!-- Page Header -->
<div class="page-header">
  <div class="row align-items-end">
    <div class="col-sm mb-2 mb-sm-0">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-no-gutter">
          <li class="breadcrumb-item"><a class="breadcrumb-link" href="<?= site_url('manage-kompetisi') ?>">Dashboard</a></li>
          <li class="breadcrumb-item active" aria-current="page">Bidang lomba</li>
        </ol>
      </nav>

      <h1 class="page-header-title">Bidang lomba</h1>
    </div>

    <div class="col-sm-auto">
    </div>
  </div>
  <!-- End Row -->
</div>
<!-- End Page Header -->

<!-- Card -->
<div class="card">
  <div class="card-header">
    <h5 class="card-header-title">Data bidang lomba</h5>
    <button type="button" class="btn btn-xs btn-primary float-right" data-toggle="modal" data-target="#tambah">Tambah bidang lomba</button>

    <div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah bidang lomba</h5>
            <button type="button" class="btn btn-xs btn-icon btn-soft-secondary" data-dismiss="modal" aria-label="Close">
              <svg aria-hidden="true" width="10" height="10" viewBox="0 0 18 18" xmlns="http://www.w3.org/2000/svg">
                <path fill="currentColor" d="M11.5,9.5l5-5c0.2-0.2,0.2-0.6-0.1-0.9l-1-1c-0.3-0.3-0.7-0.3-0.9-0.1l-5,5l-5-5C4.3,2.3,3.9,2.4,3.6,2.6l-1,1 C2.4,3.9,2.3,4.3,2.5,4.5l5,5l-5,5c-0.2,0.2-0.2,0.6,0.1,0.9l1,1c0.3,0.3,0.7,0.3,0.9,0.1l5-5l5,5c0.2,0.2,0.6,0.2,0.9-0.1l1-1 c0.3-0.3,0.3-0.7,0.1-0.9L11.5,9.5z"/>
              </svg>
            </button>
          </div>
          <div class="modal-body">
            <form action="<?= site_url('manage_kompetisi/tambah_bidangLomba');?>" method="post" entype="multipart/form-data">

              <div class="row mb-2">
                <div class="col-12">

                  <div class="form-group">
                    <label class="input-label font-weight-bold">Nama bidang lomba <small class="text-danger">*</small></label>
                    <input type="text" class="form-control form-control-sm" name="BIDANG_LOMBA" placeholder="Masukkan nama bidang lomba" reqired>
                  </div>

                  <div class="form-group mb-0">
                    <label class="input-label font-weight-bold">Keterangan bidang lomba <small class="text-danger">*</small></label>
                    <textarea type="text" class="form-control form-control-sm editor" name="KETERANGAN" rows="3" placeholder="Masukkan keterangan bidang lomba" reqired></textarea>
                  </div>

                </div>
              </div>

              <div class="modal-footer px-0 pb-0">
                <button type="button" class="btn btn-light btn-xs" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary btn-xs">Tambah bidang lomba</button>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="card-body">
    <table id="myTable" class="table table-bordered table-nowrap table-align-middle table-hover" width="100%">
      <thead class="thead-light">
        <tr>
          <th>No</th>
          <th></th>
          <th>Bidang Lomba</th>
          <th>Keterangan</th>
        </tr>
      </thead>
      <tbody>
        <?php if ($bidang_lomba != false) :?>
          <?php $no = 1; foreach ($bidang_lomba as $key): ?>
            <tr>
              <td><?= $no++;?></td>
              <td>
                <button type="button" class="btn btn-xs btn-info" data-toggle="modal" data-target="#edit<?= $no;?>"><i class="tio-edit"></i></button>
                <button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#hapus<?= $no;?>"><i class="tio-delete"></i></button>
              </td>
              <td><?= $key->BIDANG_LOMBA;?></td>
              <td>
                <button type="button" class="btn btn-xs btn-soft-secondary" data-toggle="modal" data-target="#keterangan<?= $no;?>"><i class="tio-eye"></i> keterangan</button>
              </td>
            </tr>

            <div class="modal fade" id="keterangan<?= $no;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Keterangan bidang lomba <?= $key->BIDANG_LOMBA;?></h5>
                    <button type="button" class="btn btn-xs btn-icon btn-soft-secondary" data-dismiss="modal" aria-label="Close">
                      <svg aria-hidden="true" width="10" height="10" viewBox="0 0 18 18" xmlns="http://www.w3.org/2000/svg">
                        <path fill="currentColor" d="M11.5,9.5l5-5c0.2-0.2,0.2-0.6-0.1-0.9l-1-1c-0.3-0.3-0.7-0.3-0.9-0.1l-5,5l-5-5C4.3,2.3,3.9,2.4,3.6,2.6l-1,1 C2.4,3.9,2.3,4.3,2.5,4.5l5,5l-5,5c-0.2,0.2-0.2,0.6,0.1,0.9l1,1c0.3,0.3,0.7,0.3,0.9,0.1l5-5l5,5c0.2,0.2,0.6,0.2,0.9-0.1l1-1 c0.3-0.3,0.3-0.7,0.1-0.9L11.5,9.5z"/>
                      </svg>
                    </button>
                  </div>
                  <div class="modal-body">
                    <p><?= $key->KETERANGAN;?></p>
                    <div class="modal-footer px-0 pb-0">
                      <button type="button" class="btn btn-light btn-xs" data-dismiss="modal">Tutup</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="modal fade" id="edit<?= $no;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit bidang lomba</h5>
                    <button type="button" class="btn btn-xs btn-icon btn-soft-secondary" data-dismiss="modal" aria-label="Close">
                      <svg aria-hidden="true" width="10" height="10" viewBox="0 0 18 18" xmlns="http://www.w3.org/2000/svg">
                        <path fill="currentColor" d="M11.5,9.5l5-5c0.2-0.2,0.2-0.6-0.1-0.9l-1-1c-0.3-0.3-0.7-0.3-0.9-0.1l-5,5l-5-5C4.3,2.3,3.9,2.4,3.6,2.6l-1,1 C2.4,3.9,2.3,4.3,2.5,4.5l5,5l-5,5c-0.2,0.2-0.2,0.6,0.1,0.9l1,1c0.3,0.3,0.7,0.3,0.9,0.1l5-5l5,5c0.2,0.2,0.6,0.2,0.9-0.1l1-1 c0.3-0.3,0.3-0.7,0.1-0.9L11.5,9.5z"/>
                      </svg>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form action="<?= site_url('manage_kompetisi/edit_bidangLomba');?>" method="post">
                      <input type="hidden" name="ID_BIDANG" value="<?= $key->ID_BIDANG;?>">

                      <div class="row mb-2">
                        <div class="col-12">

                          <div class="form-group">
                            <label class="input-label font-weight-bold">Nama bidang lomba <small class="text-danger">*</small></label>
                            <input type="text" class="form-control form-control-sm" name="BIDANG_LOMBA" value="<?= $key->BIDANG_LOMBA;?>" reqired>
                          </div>
                          <div class="form-group mb-0">
                            <label class="input-label font-weight-bold">Keterangan bidang lomba <small class="text-danger">*</small></label>
                            <textarea type="text" class="form-control form-control-sm editor" name="KETERANGAN" rows="3" reqired><?= $key->KETERANGAN;?></textarea>
                          </div>

                        </div>
                      </div>
                      <div class="modal-footer px-0 pb-0">
                        <button type="button" class="btn btn-light btn-xs" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-info btn-xs">Simpan</button>
                      </div>

                      <script type="text/javascript">
                        $("#TEAM<?= $no;?>").change(function() {
                          if(this.checked) {
                            $("#aturMin<?= $no;?>").removeClass('d-none');
                            $("#aturMax<?= $no;?>").removeClass('d-none');
                          }else{
                            $("#aturMin<?= $no;?>").addClass('d-none');
                            $("#aturMax<?= $no;?>").addClass('d-none');
                          }
                        });
                      </script>
                    </form>
                  </div>
                </div>
              </div>
            </div>

            <div class="modal fade" id="hapus<?= $no;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus bidang lomba</h5>
                    <button type="button" class="btn btn-xs btn-icon btn-soft-secondary" data-dismiss="modal" aria-label="Close">
                      <svg aria-hidden="true" width="10" height="10" viewBox="0 0 18 18" xmlns="http://www.w3.org/2000/svg">
                        <path fill="currentColor" d="M11.5,9.5l5-5c0.2-0.2,0.2-0.6-0.1-0.9l-1-1c-0.3-0.3-0.7-0.3-0.9-0.1l-5,5l-5-5C4.3,2.3,3.9,2.4,3.6,2.6l-1,1 C2.4,3.9,2.3,4.3,2.5,4.5l5,5l-5,5c-0.2,0.2-0.2,0.6,0.1,0.9l1,1c0.3,0.3,0.7,0.3,0.9,0.1l5-5l5,5c0.2,0.2,0.6,0.2,0.9-0.1l1-1 c0.3-0.3,0.3-0.7,0.1-0.9L11.5,9.5z"/>
                      </svg>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form action="<?= site_url('manage_kompetisi/hapus_bidangLomba');?>" method="post">
                      <input type="hidden" name="ID_BIDANG" value="<?= $key->ID_BIDANG;?>">
                      <p>Apakah anda yakin ingin menghapus bidang lomba <i><?= $key->BIDANG_LOMBA;?></i>?</p>
                      <div class="modal-footer px-0 pb-0">
                        <button type="button" class="btn btn-light btn-xs" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger btn-xs">Hapus</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          <?php endforeach;?>
        <?php endif;?>
      </tbody>
    </table>
  </div>
</div>
<!-- End Card -->

<script type="text/javascript">
  $("#TEAM").change(function() {
    if(this.checked) {
      $("#aturMin").removeClass('d-none');
      $("#aturMax").removeClass('d-none');
    }else{
      $("#aturMin").addClass('d-none');
      $("#aturMax").addClass('d-none');
    }
  });
</script>


<script type="text/javascript">
  // TINYMCE
  tinymce.init({
    selector: 'textarea.editor',
    height: 300,
    menubar: false,
    branding: false,
    plugins: [
    'advlist autolink lists link image charmap print preview anchor',
    'searchreplace visualblocks code fullscreen',
    'insertdatetime media table paste code help wordcount'
    ],
    toolbar: 'undo redo | formatselect | ' +
    'bold italic backcolor | alignleft aligncenter ' +
    'alignright alignjustify | bullist numlist outdent indent | ' +
    'removeformat | help',
    content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
  });
</script>