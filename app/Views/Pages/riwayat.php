<?php $this->extend('template'); ?>

<?php $this->section('css'); ?>
<style>
  #datatable_wrapper {
    padding: 0;
  }

  #datatable_wrapper .row:nth-child(1),
  #datatable_wrapper .row:nth-child(3) {
    padding: 20px 15px;
  }

  label {
    color: #fff;
  }
</style>
<?php $this->endSection(); ?>

<?php $this->section('content'); ?>

<div class="clearfix pt-5"></div>
<div class="pt-5 pb-5">
  <div class="container">
  <div class="pt-3 pb-4">
					            <h5 class="btn btn-primary">Daftar Transaksi Hari Ini</h5>
					            <!--<span class="strip-primary"></span>-->
					        </div>
    <div class="row justify-content-center pt-4">
      <div class="col-lg-12">
        <div class="card">
          <table class="table table-bordered table-striped table-white table-responsive">

            <thead>
              <tr>
                <th>Tanggal Transaksi</th>
                <th>ID Transaksi</th>
                <th>Produk</th>
                <th>Harga</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($data as $u) : ?>
                <tr>
                  <td><?= $u['date_create']; ?></td>
                  <?php
                    $phone=$u['order_id'];
                    $jumlah_sensor=10;
                    $setelah_angka_ke=10;
                    
                    //ambil 4 angka di tengah yan akan disensor
                    $censored = mb_substr($phone, $setelah_angka_ke, $jumlah_sensor);
                    
                    //pecah kelompok angka pertama dan terakhir
                    $phone2=explode($censored,$phone);
                    
                    //gabung angka perama dan terakhir dengan angka tengah yang telah di sensor
                    $phone_new=$phone2[0]."XXXX".$phone2[1];
                    ?>
                  <td><?= $phone_new; ?></td>
                  <td><?= $u['product']; ?></td>
                  <td><?= "Rp " . number_format($u['price'],0,',','.'); ?></td>
                  
                  <?php if ($u['status'] == 'Pending') : ?>
                    <td align="center"><span class="badge badge-warning"><?= $u['status']; ?></span></td>
                  <?php else : ?>
                    <td align="center"><span class="badge badge-success"><?= $u['status']; ?></span></td>
                  <?php endif; ?>
                </tr>
              <?php endforeach ?>
            </tbody>
          </table>
        </div>

      </div>
    </div>
  </div>
</div>
<?php $this->endSection(); ?>

<?php $this->section('js'); ?>
<script>
  $("#datatable").DataTable({
    ordering: false,
  });
</script>
<?php $this->endSection(); ?>