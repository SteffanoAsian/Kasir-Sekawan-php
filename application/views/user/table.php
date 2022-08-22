        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">List Data user</h1>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <a class="nav-link" href="<?= base_url('index.php/user/add') ?>">
                <h6 class="m-0 font-weight-bold text-primary">Input User</h6>
              </a>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" cellspacing="0">
                  <thead>
                    <tr>
                      <td width="10%"></td>
                      <th width="25%">Name</th>
                      <th width="20%">Username</th>
                      <th width="15%">Role</th>
                      <th width="30%">Profile</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <td></td>
                      <th>Name</th>
                      <th>Username</th>
                      <th>Role</th>
                      <th>Profile</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <?php foreach ($data_user as $row) : ?>
                      <tr>
                        <td>
                          <a href="<?= site_url('index.php/user/edit/' . $row->user_id) ?>" class="btn btn-success btn-sm"><i class="fa fa-edit"></i> </a>
                          <a href="<?= site_url('index.php/user/delete/' . $row->user_id) ?>" onclick="return confirm('Apa anda yakin ingin menghapus data ini?')" data="<?= $row->user_id ?>" class="btn btn-danger btn-sm item-delete"><i class="fa fa-trash"></i> </a>
                        </td>
                        <td><?= $row->user_name ?></td>
                        <td><?= $row->user_username ?></td>
                        <td><?= $row->user_role ?></td>
                        <td><img src="<?= base_url('uploads/' . $row->user_image) ?>" width="80px" height="80px"></td>
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