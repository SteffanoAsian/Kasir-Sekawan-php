
<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">Data Barang</h1>

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <a class="nav-link" href="<?= base_url('index.php/barang/add') ?>">
        <h6 class="m-0 font-weight-bold text-primary">Input Barang</h6>
      </a>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="barangTable" cellspacing="0">
          <thead>
            <tr>
              <td width="10%"></td>
              <th width="25%">Nama</th>
              <th width="20%">Kode</th>
              <th width="15%">Kategori</th>
              <th width="30%">Harga</th>
              <th width="30%">Stok</th>
              <th width="30%">Status</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <td></td>
              <th>Name</th>
              <th>Kode</th>
              <th>Kategori</th>
              <th>Harga</th>
              <th>Stok</th>
              <th>Status</th>
            </tr>
          </tfoot>
          <tbody>
            <?php foreach ($data_barang as $row) : ?>
              <tr>
                <td>
                  <a href="<?= site_url('index.php/barang/edit/' . $row->barang_id) ?>" class="btn btn-success btn-sm"><i class="fa fa-edit"></i> </a>
                  <a href="<?= site_url('index.php/barang/delete/' . $row->barang_id) ?>" onclick="return confirm('Apa anda yakin ingin menghapus data ini?')" data="<?= $row->barang_id ?>" class="btn btn-danger btn-sm item-delete"><i class="fa fa-trash"></i> </a>
                </td>
                <td><?= $row->barang_nama ?></td>
                <td><?= $row->barang_kode ?></td>
                <td><?= $row->kategori_nama ?></td>
                <td><?= $row->barang_harga ?></td>
                <td><?= $row->barang_stock ?></td>
                <td><?php
                    if ($row->barang_isaktif == "1") {
                      echo "Aktif";
                    } else {
                      echo " Tidak Aktif";
                    }
                    ?>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->