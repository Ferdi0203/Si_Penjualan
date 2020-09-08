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
                    <div class="card-body p-0">
                        <div class="card card-primary">
                            <div class="card-body">
                                <form method="post" action="<?= base_url('transaksi/add_barang_temp'); ?>">

                                    <div class="row">
                                        <div class="form-group col-sm-4">
                                            <label for="">Cari Barang</label>
                                            <input type="text" class="form-control" name="nama" id="nama" placeholder="Ketik Nama Barang..">
                                            <input name="id" hidden>
                                        </div>
                                        <div class="form-group col-sm-2">
                                            <label for="">Stock</label>
                                            <input type=" text" class="form-control" name="stock" placeholder="Stock.." readonly>
                                        </div>
                                        <div class="form-group col-sm-2">
                                            <label for="">Harga</label>
                                            <input type="text" class="form-control" name="harga" placeholder="Harga.." readonly>
                                        </div>
                                        <div class="form-group col-sm-2">
                                            <label for="">Satuan</label>
                                            <input type="text" class="form-control" name="satuan" placeholder="Satuan.." readonly>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-sm-3">
                                            <label for="">Qty</label>
                                            <input type="number" class="form-control" name="qty">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <button class="btn btn-primary" id=type="submit"><span class="fas fa-shopping-cart"></span> Tambahkan</button>
                                        </div>
                                    </div>
                                </form>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <h4>
                                            <i class="fas fa-shopping-cart"></i> List Pembelian Barang
                                        </h4>

                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-12">
                                        <form action="<?= base_url('transaksi/save_transaksi') ?>" method="post">
                                            <?php if ($this->cart->total_items()) { ?>
                                                <div class="table-responsive">
                                                    <table class="table table-striped" id="sortable-table">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center">
                                                                    <i class="fas fa-th"></i>
                                                                </th>
                                                                <th>Nama Barang</th>
                                                                <th>Harga</th>
                                                                <th>Qty</th>
                                                                <th>Total Harga</th>
                                                                <th>Aksi</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="detail_barang">
                                                            <?php $no = 1;
                                                            foreach ($cart_contents as $content) { ?>
                                                                <tr>
                                                                    <td class="text-center"><?= $no++; ?></td>
                                                                    <td><?= $content['name'] ?></td>
                                                                    <td><?= "Rp." . number_format($content['price'], "0", ".", ".") ?></td>
                                                                    <td><?= $content['qty'] ?></td>
                                                                    <td><?= "Rp." . number_format($content['subtotal'], "0", ".", ".") ?></td>
                                                                    <td>
                                                                        <form action="<?= base_url('transaksi/remove_barang'); ?>" method="post">
                                                                            <input type="hidden" name="rowid" value="<?php echo $content['rowid'] ?>" />
                                                                            <input type="submit" name="submit" value="X" />
                                                                        </form>
                                                                    </td>
                                                                </tr>
                                                            <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <button class="btn btn-primary" type="submit"><i class="fas fa-shopping-cart"></i> Beli</button>
                                                <div style="margin-left:550px">
                                                    <h5>Total : <?= "Rp." . number_format($this->cart->total(), "0", ".", ".") ?></h5>
                                                </div>
                                            <?php
                                            }
                                            ?>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- Main Content -->
<link rel="stylesheet" href="<?= base_url() ?>assets/css/jquery-ui.css">
<script type="text/javascript" src="<?= base_url() ?>assets/js/jquery-ui.js"></script>
<script type="text/javascript">
    $(document).ready(function() {

        $('#nama').autocomplete({
            source: "<?php echo base_url('kasir/transaksi/get_autocomplete'); ?>",

            select: function(event, ui) {
                $('[name="nama_barang"]').val(ui.item.nama_barang);
                $('[name="id"]').val(ui.item.id);
                $('[name="stock"]').val(ui.item.stock);
                $('[name="harga"]').val(ui.item.harga);
                $('[name="satuan"]').val(ui.item.satuan);
                $('[name="qty"]').val(ui.item.qty);
            }
        });
    });
</script>