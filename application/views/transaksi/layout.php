<div class="container pt-1">
    <h3><?=$this->session->userdata('id')?></h3>
    <div class="card">
        <!-- <div class="card-header">

        </div> -->
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <form action="<?= base_url() ?>index.php/keranjang/action" method="POST" class="border border-2 rounded-1 p-3">
                        <div class="row m-1">
                            <div class="col-md-7">
                                <label for="Nama" id="Nama" name="Nama">Nama Barang</label> <br>
                                <input type="hidden" name="keranjang_id">
                                <select class="form-control" name="namaBarang" onchange="showDetail(this)" id="barang_id">
                                    <option value="">Pilih</option>
                                    <?php foreach ($data_barang as $row) : ?>
                                        <option data-kategori="<?= $row->kategori_nama ?>" data-harga="<?= $row->barang_harga ?>" data-stok="<?= $row->barang_stock ?>" value="<?= $row->barang_id ?>"><?= $row->barang_nama ?></option>
                                        <? $cek = $_POST['namaBarang']; ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-4 pl-3 pt-1">
                                <h6>Stock Barang : <span id="showStok"></span></h6>
                                <h6>Harga : <span id="showHarga"></span></h6>
                                <h6>Kategori Barang : <span id="showKategori"></span></h6>

                            </div>
                        </div>
                        <div class="row m-1">
                            <div class="col-md-7">
                                <label for="jumlah" id="" name="">Jumlah Barang</label> <br>
                                <input type="number" onkeyup="qtyCheck(this) " name="jumlah" id="jumlah" class="form-control" placeholder="Input Jumlah">
                            </div>
                        </div>
                        <div class="row m-3">
                            <button class="btn btn-success mt-1" type="submit">Tambah</button>
                        </div>
                    </form>
                </div>

                <div class="col-md-6">
                    <form action="<?= base_url() ?>index.php/transaksi/action" method="POST" class="border border-2 rounded-1 p-3">
                        <div class="col-md-12 mr-1 p-2">
                            <?php
                            $total = 0;
                            ?>
                            <?php foreach ($data_keranjang as $row) : ?>
                                <?php
                                $total += (float) $row->keranjang_jml_beli * $row->barang_harga;
                                ?>
                            <?php endforeach; ?>
                            <?php
                            	$showTotal = "IDR " . number_format($total,2,',','.');
                            ?>
                            <label for="Total" id="Total" name="Total">Total</label> <br>
                            <input type="hidden" name="total" id="total" class="form-control" value="<?= $total?>" readonly>
                            <input type="text" name="showTotal" id="showTotal" class="form-control" value="<?= $showTotal?>" readonly>

                            <br>

                            <label for="Jumlah" id="Jumlah" name="Jumlah">Jumlah Pembayaran</label> <br>
                            <input type="number" name="jumlah" id="jumlah" class="form-control" onkeyup="balek(this)" placeholder="Ketik Uang Pembayaran Disini...">

                            <br>

                            <label for="Kembali" id="Kembali" name="Kembali">Uang Kembalian</label> <br>
                            <input type="text" name="showKembali" id="showKembali" class="form-control" readonly>
                            <input type="hidden" name="kembali" id="kembali" class="form-control" readonly>

                        </div>
                        <button class="btn btn-success ml-2" type="submit">Proses</button>
                    </form>
                </div>
            </div>

            <br>
            <div class="row">
                <table class="table table-bordered" id="dataTable" cellspacing="0" width="25px">
                    <thead>
                        <tr>
                            <th>Nama Barang</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Qty</th>
                            <th>Total</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php foreach ($data_keranjang as $row) : ?>
                            <?php
                            $total = (float) $row->keranjang_jml_beli * $row->barang_harga
                            ?>
                            <tr>
                                <td><?= $row->barang_nama ?></td>
                                <td><?= $row->kategori_nama ?></td>
                                <td><?= number_format($row->barang_harga, 0, ",", ".") ?></td>
                                <td><?= $row->keranjang_jml_beli ?></td>
                                <td><?= number_format($total, 0, ",", ".") ?></td>
                                <td>
                                    <a href="javascript:;" data-stok="<?= $row->barang_stock ?>" data-keranjangid="<?= $row->keranjang_id ?>" data-barangid="<?= $row->barang_id ?>" data-jumlah="<?= $row->keranjang_jml_beli ?>" class="btn btn-success btn-sm" onclick="editKeranjang(this)"><i class="fa fa-edit"></i> </a>
                                    <a href="<?= site_url('index.php/keranjang/delete/' . $row->keranjang_id) ?>" onclick="return confirm('Apa anda yakin ingin menghapus item ini?')" data="<?= $row->keranjang_id ?>" class="btn btn-danger btn-sm item-delete"><i class="fa fa-trash"></i> </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php
$this->load->view("transaksi/javascript");
?>