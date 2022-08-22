

<div class="container pt-5">
    <h3>Edit Data</h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb ">
            <li class="breadcrumb-item"><a>Data Barang</a></li>
            <li class="breadcrumb-item "><a href="<?= base_url('index.php/barang/table'); ?>">List Barang</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Data</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="<?= base_url() ?>index.php/barang/actionEdit" method="post" autocomplete="off" id="editBarang" enctype="multipart/form-data">
                        <div class="form-group row">
                            <label for="Nama" class="col-sm-2 col-form-label">Nama</label>
                            <div class="col-sm-10">
                                <input type="hidden" class="form-control" id="barang_id" name="barang_id" value="<?= $data_barang->barang_id; ?>">
                                <input type="text" class="form-control" id="Nama" name="Nama" value="<?= $data_barang->barang_nama; ?>">
                                <small class="text-danger">
                                    <?php echo form_error('Nama') ?>
                                </small>
                            </div>
                        </div>

                        <fieldset class="form-group">
                            <div class="row">
                                <legend class="col-form-label col-sm-2 pt-0">Kode</legend>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="kode" name="kode" value="<?= $data_barang->barang_kode; ?>">
                                    <small class="text-danger">
                                        <?php echo form_error('kode') ?>
                                    </small>
                                </div>
                                <small class="text-danger">
                                    <?php echo form_error('kode') ?>
                                </small>
                            </div>
                        </fieldset>

                        <div class="form-group row">
                            <legend class="col-form-label col-sm-2 pt-0">Kategori</legend>
                            <div class="col-sm-10">
                                <select class="form-control" name="kategori" id="kategori">
                                    <?php foreach ($kategori as $row) : ?>
                                        <option value="<?= $row->kategori_id ?>" <?= $row->kategori_id == $data_barang->barang_kategori_id ? "selected":""?>><?= $row->kategori_nama ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <small class="text-danger">
                                    <?php echo form_error('kategori') ?>
                                </small>
                            </div>
                        </div>

                        <div class="form-group row">
                            <legend class="col-form-label col-sm-2 pt-0">Harga</legend>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="harga" name="harga" value="<?= $data_barang->barang_harga; ?>">
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
                                <input type="text" class="form-control" id="stok" name="stok" value="<?= $data_barang->barang_stock; ?>">
                                <small class="text-danger">
                                    <?php echo form_error('stok') ?>
                                </small>
                            </div>
                            <small class="text-danger">
                                <?php echo form_error('harga') ?>
                            </small>
                        </div>

                        <div class="form-group row">
                            <label for="Role" class="col-sm-2 col-form-label">Status</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="status" name="status">
                               
                                    <option value="1"  <?= "1" == $data_barang->barang_isaktif ? "selected":""?>>Aktif</option>
                                    <option value="0" <?= "0" == $data_barang->barang_isaktif ? "selected":""?>>Tidak Aktif</option>
                                </select>
                            </div>
                        </div>
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