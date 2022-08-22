<script type="text/javascript">
    var BASE_URL = "<?= base_url('index.php/') ?>";
    var BASE_ASSETS = "<?= base_url() ?>";
    
    document.getElementById('Password').oninput = function() {
    document.getElementById('PassworrdNew').removeAttribute('readonly');
    }
</script>
<!-- var BASE_URL = "<?= base_url('index.php/') ?>";
    var BASE_ASSETS = "<?= base_url() ?>";

    $(() => {
        loadData();
    })

    function showForm() {
        $('#load-data').hide()
        $('#form-data').show()
    }

    function onBack() {
        $('#load-data').show()
        $('#form-data').hide()
    }

    function loadData() {
        $.ajax({
            url: BASE_URL + 'user/loadData',
            type: "GET",
            success: function(res) {
                var res = JSON.parse(res);

                $('#table-user tbody').html('')
                var html = ''
                $.each(res, function(i, v) {
                    html += `<tr>
                        <td>
                        <a href="<?= site_url('index.php/user/edit/' . $row->user_id) ?>" class="btn btn-success btn-sm"><i class="fa fa-edit"></i> </a>
                        <a href="<?= site_url('index.php/user/delete/' . $row->user_id) ?>" class="btn btn-danger btn-sm item-delete"><i class="fa fa-trash"></i> </a>
                        </td>
                        <td><?= $row->user_name ?></td>
                        <td><?= $row->user_username ?></td>
                        <td><?= $row->user_role ?></td>
                        <td><img src="<?= base_url('uploads/' . $row->user_image) ?>" width="80px" height="80px"></td>
                      </tr>`
                })

            }
        })
    }

    function save() {
        var data = new FormData($("#form-user")[0]);
        var id = $('[name=user_id]').val();

        $.ajax({
            url: BASE_URL + 'user/' + (id ? 'update' : "add"),
            type: "POST",
            data: data,
            processData: false,
            contentType: false,
            success: function(res) {
                var res = JSON.parse(res);
                alert(res.message);
                if (res.success) {
                    onBack()
                    loadData()
                }
            }
        })
    } -->