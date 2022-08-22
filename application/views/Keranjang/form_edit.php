<div class="container pt-5">
    <h3>Edit Data</h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb ">
            <li class="breadcrumb-item"><a>Data Keranjang</a></li>
            <li class="breadcrumb-item "><a href="<?= base_url('index.php/transaksi/layout'); ?>">Halaman Kasir</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Keranjang</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="<?= base_url() ?>index.php/keranjang/actionEdit" method="post" autocomplete="off" id="editBarang" enctype="multipart/form-data">
                        <div class="form-group row">
                            <label for="Nama" class="col-sm-2 col-form-label">Nama Barang</label>
                            <div class="col-sm-10">
                                <input type="hidden" class="form-control" id="keranjang_id" name="keranjang_id" value="<?= $data_keranjang->keranjang_id; ?>">
                                <input type="text" readonly class="form-control" id="Nama" name="Nama" value="<?= $data_barang->barang_nama; ?>">
                                <small class="text-danger">
                                    <?php echo form_error('Nama') ?>
                                </small>
                            </div>
                        </div>


                        <div class="form-group row">
                            <legend class="col-form-label col-sm-2 pt-0">Harga</legend>
                            <div class="col-sm-10">
                                <input type="text" readonly class="form-control" id="harga" name="harga" value="<?= $data_barang->barang_harga; ?>">
                                <small class="text-danger">
                                    <?php echo form_error('harga') ?>
                                </small>
                            </div>
                            <small class="text-danger">
                                <?php echo form_error('harga') ?>
                            </small>
                        </div>

                        <div class="form-group row">
                            <legend class="col-form-label col-sm-2 pt-0">Stock</legend>
                            <div class="col-sm-10">
                                <input type="text" readonly class="form-control" id="stok" name="stok" value="<?= $data_barang->barang_stock; ?>">
                                <small class="text-danger">
                                    <?php echo form_error('stok') ?>
                                </small>
                            </div>
                            <small class="text-danger">
                                <?php echo form_error('harga') ?>
                            </small>
                        </div>

                        <fieldset class="form-group">
                            <div class="row">
                                <legend class="col-form-label col-sm-2 pt-0">Jumlah Beli</legend>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="jml" name="jml" value="<?= $data_keranjang->keranjang_jml_beli; ?>">
                                    <small class=" text-danger">
                                    <?php echo form_error('jml') ?>
                                    </small>
                                </div>
                                <small class="text-danger">
                                    <?php echo form_error('jml') ?>
                                </small>
                            </div>
                        </fieldset>


                        <div class="form-group row">
                            <div class="col-sm-10 offset-md-2">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a class="btn btn-secondary" href="<?= base_url("index.php/barang/table") ?>">Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>