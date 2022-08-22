<div class="container pt-5">
    <h3>Input Data Kategori Barang</h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb ">
            <li class="breadcrumb-item"><a>Kategori</a></li>
            <li class="breadcrumb-item "><a href="<?= base_url('index.php/user/table'); ?>">List Kategori</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add Kategori</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="<?= base_url() ?>index.php/kategori/action" method="post" autocomplete="off" id="addKategori" enctype="multipart/form-data">
                        <div class="form-group row">
                            <label for="Nama" class="col-sm-2 col-form-label">Nama</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="Nama" name="Nama" value="<?= set_value('Nama'); ?>">
                                <small class="text-danger">
                                    <?php echo form_error('Nama') ?>
                                </small>
                            </div>
                        </div>

                        <fieldset class="form-group">
                            <div class="row">
                                <legend class="col-form-label col-sm-2 pt-0">Kode</legend>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="kode" name="kode" value="<?= set_value('kode'); ?>">
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
                            <legend class="col-form-label col-sm-2 pt-0">Status</legend>
                            <div class="col-sm-10">
                                <select class="form-control" id="status" name="status">
                                    <option value="1" selected disabled>Pilih</option>
                                    <option value="1">Aktif</option>
                                    <option value="0">Tidak Aktif</option>
                                </select>
                            </div>
                            <small class="text-danger">
                                <?php echo form_error('Username') ?>
                            </small>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-10 offset-md-2">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a class="btn btn-secondary" href="<?= base_url("index.php/kategori/table") ?>">Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>