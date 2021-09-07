<!-- Blogs Section -->
<div class="container space-1 space-lg-1 <?= $CI->agent->is_mobile() ? 'space-3' : '';?>">
  <div class="row justify-content-lg-between">
    <div class="col-lg-8">
      <!-- Blog -->
      <p>- Belum ada pengumuman -</p>
<!--       <article class="row mb-7">
        <div class="col-md-5">
          <img class="card-img" src="<?= base_url();?>assets/frontend/img/400x500/img16.jpg" alt="poster">
        </div>
        <div class="col-md-7">
          <div class="card-body d-flex flex-column h-100 px-0 pt-0">
            <h3><a class="text-inherit" href="<?= site_url('artikel/123');?>">Front becomes an official Instagram Marketing Partner</a></h3>
            <p>Great news we're eager to share.</p>
            <div class="media align-items-center mt-auto">
              <a class="avatar avatar-sm avatar-circle mr-3">
                <img class="avatar-img" src="<?= base_url();?>assets/frontend/img/100x100/img12.jpg" alt="writer">
              </a>
              <div class="media-body">
                <span class="text-dark">
                  <a class="d-inline-block text-inherit font-weight-bold" href="<?= site_url('artikel/123');?>">Aaron Larsson</a>
                </span>
                <small class="d-block">Feb 15, 2020</small>
              </div>
            </div>
          </div>
        </div>
      </article> -->
      <!-- End Blog -->
    </div>

    <div class="col-lg-3">
      <?= $CI->agent->is_mobile() ? '<hr>' : '';?>

      <div class="mb-7">
        <div class="mb-3">
          <h3>Pengumuman terbaru</h3>
        </div>

        <!-- Blog -->
        <article class="mb-3">
          <a class="card card-frame p-3" href="">
            <div class="media align-items-center">
              <div class="media-body mr-2">
                <h4 class="h6 mb-0">belum ada pengumuman</h4>
              </div>
              <i class="fas fa-angle-right"></i>
            </div>
          </a>
        </article>
        <!-- End Blog -->
      </div>
  </div>
</div>




<!-- Pagination -->
<!-- <nav aria-label="Page navigation">
  <ul class="pagination mb-0">
    <li class="page-item active"><a class="page-link" href="#">1</a></li>
    <li class="page-item"><a class="page-link" href="#">2</a></li>
    <li class="page-item disabled"><a class="page-link" href="#">...</a></li>
    <li class="page-item"><a class="page-link" href="#">5</a></li>
    <li class="page-item">
      <a class="page-link" href="#" aria-label="Next">
        <span class="d-none d-sm-inline-block mr-1">Next</span>
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
  </ul>
</nav> -->
<!-- End Pagination -->

</div>
<!-- End Blogs Section -->