<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Ubah <?= $title; ?> <?= $user['name'] ?></h1>
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
                        <form method="post" action="<?= base_url('user/update/' . $user['id']); ?>">
                            <div class="card card-primary">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-sm-8">
                                            <label for="">Nama Lengkap</label>
                                            <input type="text" class="form-control" name="name" value="<?= $user['name'] ?>">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-sm-8">
                                            <label for="">Email Aktif</label>
                                            <input type="text" class="form-control" name="email" value="<?= $user['email'] ?>">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-sm-8">
                                            <label for="">Password</label>
                                            <input type="text" class="form-control" name="password1" value="<?= $user['password'] ?>">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-sm-8">
                                            <label for="">Role</label>
                                            <input type="text" class="form-control" name="role" value="<?= $user['role'] ?>" disabled >
                                        </div>
                                    </div>
                                </div>
                            </div>
                                <div class="card-footer text-right">
                                    <button class="btn btn-primary mr-1" type="submit">Update</button>
                                    <a class="btn btn-secondary" href="<?= base_url('user') ?>">Back</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script>
    document.getElementById('satuan').value = <?php echo $barang['satuan_id']; ?>;
</script>