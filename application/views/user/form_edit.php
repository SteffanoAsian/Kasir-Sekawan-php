<div class="container pt-5">
    <h3>Edit Data User</h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb ">
            <li class="breadcrumb-item"><a>User</a></li>
            <li class="breadcrumb-item "><a href="<?= base_url('index.php/user/table'); ?>">List Data</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Data</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="<?= base_url() ?>index.php/user/actionEdit" method="post" autocomplete="off" id="FrmAddUser" enctype="multipart/form-data">
                        <div class="form-group row">
                            <label for="Nama" class="col-sm-2 col-form-label">Nama</label>
                            <div class="col-sm-10">
                                <input type="hidden" class="form-control" id="User_id" name="user_id" value="<?= $data_user->user_id; ?>">
                                <input type="text" class="form-control" id="Name" name="Nama" value="<?= $data_user->user_name; ?>">
                                <small class="text-danger">
                                    <?php echo form_error('Name') ?>
                                </small>
                            </div>
                        </div>

                        <fieldset class="form-group">
                            <div class="row">
                                <legend class="col-form-label col-sm-2 pt-0">Username</legend>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="Username" name="Username" value="<?= $data_user->user_username; ?>">
                                    <small class="text-danger">
                                        <?php echo form_error('Username') ?>
                                    </small>
                                </div>
                                <small class="text-danger">
                                    <?php echo form_error('Username') ?>
                                </small>
                            </div>
                        </fieldset>

                        <div class="form-group row">
                            <legend class="col-form-label col-sm-2 pt-0">Old Password</legend>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="Password" name="OldPassword" onkeyup="checkPassword(this)">
                                <small class="text-danger">
                                    <?php echo form_error('OldPassword') ?>
                                </small>
                            </div>
                            <small class="text-danger">
                                <?php echo form_error('OldPassword') ?>
                            </small>
                        </div>
                        
                        <div class="form-group row">
                            <legend class="col-form-label col-sm-2 pt-0">New Password</legend>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="PasswordNew" name="Password" readonly>
                                <small class="text-danger">
                                    <?php echo form_error('Password') ?>
                                </small>
                            </div>
                            <small class="text-danger">
                                <?php echo form_error('Password') ?>
                            </small>
                        </div>

                        <div class="form-group row">
                            <label for="Role" class="col-sm-2 col-form-label">Role</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="Role" name="Role">
                                    <option value="Administrator" selected><?= $data_user->user_role ?></option>
                                    <option value="Administrator">Administrator</option>
                                    <option value="User">User</option>
                                </select>
                                <small class="text-danger">
                                    <?php echo form_error('Role') ?>
                                </small>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="Role" class="col-sm-2 col-form-label">Current Profile Picture</label>
                            <div class="col-sm-10">
                            <img src="<?= base_url('uploads/'.$data_user->user_image) ?>" width="80px" height="80px"></td>
                                <small class="text-danger">
                                    <?php echo form_error('Profile') ?>
                                </small>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="Role" class="col-sm-2 col-form-label">Profile Picture</label>
                            <div class="col-sm-10">
                                <input type="hidden" name="fotolama" value="<?= set_value('Foto', $data_user->user_image) ?>">
                                <input type="file" accept="image.png, image/jpeg" name="photo">
                                <small class="text-danger">
                                    <?php echo form_error('Profile') ?>
                                </small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-10 offset-md-2">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a class="btn btn-secondary" href="<?= base_url("index.php/user/table") ?>">Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function checkPassword(el){
        if($(el).val() == ""){
            $('#PasswordNew').attr({
                readonly:true,
                required: false,
            })
        }else{
            $('#PasswordNew').attr({
                readonly:false,
                required: true,
            })
        }

    }
</script>