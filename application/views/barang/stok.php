<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><?= $title; ?></h1>
        </div>
        <?= $this->session->flashdata('message') ?>
        <?php if (validation_errors()) { ?>
            <div class="alert alert-danger" role="alert">
                <?= validation_errors() ?>
            </div>
        <?php } ?>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <form class="form-inline mr-auto" method="get" action="<?= base_url('barang/'); ?>">
                                <ul class="navbar-nav mr-3">

                                    <div class="form-group">
                                        <select class="form-control form-control-sm" name="searchid">
                                            <option>Tanggal</option>
                                            <?php
                                            foreach ($allDateBarang as $b) { // Lakukan looping pada tabel satuan dari controller -> model
                                                echo "<option value='" . date('d F Y', $b['date_created']) . "'>" . date('d F Y', $b['date_created']) . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>

                                </ul>
                                <div class="search-element">
                                    <input class="form-control" type="search" name="search" placeholder="Search" aria-label="Search" data-width="250">
                                    <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                                    <a class="btn btn-info" href="<?= base_url('barang')?>"><i class="fas fa-sync"></i></a>
                                    <div class="search-backdrop"></div>
                                </div>
                            </form>
                            <div class="card-header-action">
                            <?php if($this->session->userdata('role_id') == '1') {?> <div class="input-group">
                            <button class="btn btn-success" data-toggle="modal" data-target="#addModal"><i class="fas fa-cart-arrow-down"></i> Add</button> </div> <?php } ?>
                            </div>

                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped" id="sortable-table">
                                <thead>
                                    <tr>
                                        <th class="text-center">
                                            <i class="fas fa-th"></i>
                                        </th>
                                        <th>Kode Barang</th>
                                        <th>Nama Barang</th>
                                        <th>Harga Beli</th>
                                        <th>Harga Jual</th>
                                        <th>Stock</th>
                                        <th>Tanggal Input</th>
                                        <?php if($this->session->userdata('role_id') == '1') {?> <th>Action</th> <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($allBarang as $barang) { ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $barang['kode_barang']; ?></td>
                                            <td><?= $barang['nama_barang']; ?></td>
                                            <td><?php echo "Rp." . number_format($barang['harga'], "0", ".", ".") ?></td>
                                            <td><?php echo "Rp." . number_format($barang['harga_jual'], "0", ".", ".") ?></td>
                                            <td><?= $barang['stock']; ?></td>
                                            <td><?= date('d F Y', $barang['date_created']); ?></td>
                                            <?php if($this->session->userdata('role_id') == '1') {?>
                                            <td>
                                                    <a class="btn btn-primary" href="<?= base_url('barang/update/' . $barang['id']) ?>"><i class="fas fa-edit"></i></a>
                                                    <a href="<?= site_url('barang/delete/' . $barang['id']) ?>" class="btn btn-icon icon-left btn-danger" onClick="return confirm('Yakin menghapus Barang?');" title="delete"><i class="fas fa-trash-alt"></i></a>
                                            </td>
                                                <?php } ?>
                                        </tr>

                                    <?php } ?>
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade" tabindex="-1" role="dialog" id="addModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Barang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('barang'); ?>" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" class="form-control" name="kode_barang" value="<?= $kode_barang ?>" readonly>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="nama_barang" value="<?= set_value('nama_barang') ?>" placeholder="Nama Barang.." autocomplete="off">
                        </div>
                        <div class="form-group">
                            <select class="form-control" name="satuan_id">
                                <option> -- Pilih Satuan --</option>
                                <?php
                                foreach ($allSatuan as $satuan) { // Lakukan looping pada tabel satuan dari controller -> model
                                    echo "<option value='" . $satuan['satuan_id'] . "'>" . $satuan['satuan'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="keterangan" value="<?= set_value('keterangan') ?>" placeholder="Keterangan.." autocomplete="off">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="stock" value="<?= set_value('stock') ?>" placeholder="Stock.." autocomplete="off">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="harga" id="inputku" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);" value="<?= set_value('harga') ?>" placeholder="harga.." autocomplete="off">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="harga_jual" id="inputku" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);" value="<?= set_value('harga_jual') ?>" placeholder="harga Jual.." autocomplete="off">
                        </div>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>