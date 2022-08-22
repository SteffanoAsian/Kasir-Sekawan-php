<div class="container pt-5">
    <h3>Edit Data Kategori</h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb ">
            <li class="breadcrumb-item"><a>Kategori</a></li>
            <li class="breadcrumb-item "><a href="<?= base_url('index.php/kategori/table'); ?>">List Kategori</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Kategori</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="<?= base_url() ?>index.php/kategori/actionEdit" method="post" autocomplete="off" id="editBarang" enctype="multipart/form-data">
                        <div class="form-group row">
                            <label for="Nama" class="col-sm-2 col-form-label">Nama</label>
                            <div class="col-sm-10">
                                <input type="hidden" class="form-control" id="kategori_id" name="kategori_id" value="<?= $data_kategori->kategori_id; ?>">
                                <input type="text" class="form-control" id="Nama" name="Nama" value="<?= $data_kategori->kategori_nama; ?>">
                                <small class="text-danger">
                                    <?php echo form_error('Name') ?>
                                </small>
                            </div>
                        </div>

                        <fieldset class="form-group">
                            <div class="row">
                                <legend class="col-form-label col-sm-2 pt-0">Kode</legend>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="kode" name="kode" value="<?= $data_kategori->kategori_kode; ?>">
                                    <small class="text-danger">
                                        <?php echo form_error('kode') ?>
                                    </small>
                                </div>
                                <small class="text-danger">
                                    <?php echo form_error('kode') ?>
                                </small>
                            </div>
                        </fieldset>

                        <?php
                        if ($data_kategori->kategori_isaktif == "1") {
                            $status = "Aktif";
                        } else {
                            $status = "Tidak Aktif";
                        }
                        ?>
                        <div class="form-group row">
                            <label for="Role" class="col-sm-2 col-form-label">Status</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="status" name="status">
                                    <option value="" selected><?= $status ?></option>
                                    <option value="1">Aktif</option>
                                    <option value="0">Tidak Aktif</option>
                                </select>
                                <small class="text-danger">
                                    <?php echo form_error('status') ?>
                                </small>
                            </div>
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