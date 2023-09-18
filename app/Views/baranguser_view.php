<?= $this->extend('components/isi') ?>
<?= $this->section('content') ?>
<style>
    .status-menunggu {
        background-color: red;
        color: white;
    }

    .status-selesai {
        background-color: green;
        color: white;
    }
</style>
<style>
    .btn-close {
        width: 30px;
        height: 30px;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 1.25rem;
        font-weight: bold;
        color: #f00;
        background-color: #fff;
        border-radius: 50%;
        opacity: 0.5;
        border: none;
        cursor: pointer;
        transition: background-color 0.3s, color 0.3s, opacity 0.3s;
    }

    .btn-close:hover {
        color: #fff;
        background-color: #f00;
        opacity: 1;
    }
</style>
<?php if (session()->getFlashData('success')) { ?>
    <div class="alert alert-success alert-dismissible fade show d-flex justify-content-between align-items-center border rounded-0" role="alert">
        <span><?= session()->getFlashData('success') ?></span>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">X</button>
        </a>
    </div>
<?php } ?>

<?php if (session()->has('validationErrors')) : ?>
    <div class="alert alert-danger alert-dismissible fade show d-flex justify-content-between align-items-center border rounded-0" role="alert">
        <ul class="text-danger">
            <?php foreach (session('validationErrors') as $error) : ?>
                <?= esc($error) ?>
            <?php endforeach ?>
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">X</button>
    </div>
<?php endif ?>


<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">TABEL</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">

        <div class="card-header py-3">
            <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
                +
            </button> -->
            <a href="#" class="btn btn-primary btn-icon-split" data-bs-toggle="modal" data-bs-target="#createModal">
                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">Tambah ATK</span>
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="myInput" placeholder="Cari Nama Barang...">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button">Cari</button>
                    </div>
                </div>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Barang</th>
                            <th>Jumlah</th>
                            <th>Keterangan</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="tableData">
                        <?php foreach ($barangusers as $index => $baranguser) : ?>
                            <tr>
                                <th scope="row"><?php echo $index + 1 ?></th>
                                <td><?php echo $baranguser['nama'] ?></td>
                                <td><?php echo $baranguser['jumlah'] ?></td>
                                <td><?php echo $baranguser['keterangan'] ?></td>
                                <td><?php echo $baranguser['tanggal'] ?></td>

                                <td class="<?php
                                            if ($baranguser['status'] == 0) {
                                                echo "status-menunggu";
                                            } elseif ($baranguser['status'] == 1) {
                                                echo "status-selesai";
                                            } else {
                                                echo "status-tidak-valid";
                                            }
                                            ?>">
                                    <?php
                                    if ($baranguser['status'] == 0) {
                                        echo "Menunggu";
                                    } elseif ($baranguser['status'] == 1) {
                                        echo "Selesai";
                                    } else {
                                        echo "Status tidak valid";
                                    }
                                    ?>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editModal-<?= $baranguser['id'] ?>">
                                        Ubah
                                    </button>

                                    <a href="<?= base_url('baranguser/delete/' . $baranguser['id']) ?>" class="btn btn-danger btn-icon-split" onclick="return confirm('Yakin hapus data ini ?')">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-trash"></i>
                                        </span>
                                        <span class="text">Hapus</span>
                                    </a>

                                    <div class="my-2"></div>
                                </td>
                            </tr>
                            <!-- Edit Modal Begin -->
                            <div class="modal fade" id="editModal-<?= $baranguser['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel-<?= $baranguser['id'] ?>">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel-<?= $baranguser['id'] ?>">Ubah ATK</h5>
                                            <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <form action="<?= base_url('baranguser/edit/' . $baranguser['id']) ?>" method="post" enctype="multipart/form-data">
                                            <?= csrf_field(); ?>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="nama">Nama</label>
                                                    <input type="text" name="nama" class="form-control" id="nama" value="<?= $baranguser['nama'] ?>" placeholder="Nama Barang" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="jumlah">Jumlah</label>
                                                    <input type="text" name="jumlah" class="form-control" id="jumlah" value="<?= $baranguser['jumlah'] ?>" placeholder="Jumlah Barang" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="keterangan">Keterangan</label>
                                                    <input type="text" name="keterangan" class="form-control" id="keterangan" value="<?= $baranguser['keterangan'] ?>" placeholder="Keterangan" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="tanggal">Tanggal</label>
                                                    <input type="date" name="tanggal" class="form-control" value="<?= $baranguser['tanggal'] ?>" required>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- Edit Modal End -->
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#tableData tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Tambah ATK</h5>
                <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="<?= base_url('baranguser') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama Barang" required>
                    </div>
                    <div class="form-group">
                        <label for="jumlah">Jumlah</label>
                        <input type="text" name="jumlah" class="form-control" id="jumlah" placeholder="Jumlah Barang" required>
                        
                        <?php if (isset($error_message)) { ?>
                            <span class="text-danger"><?= $error_message; ?></span>
                        <?php } ?>
                    </div>
                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <input type="text" name="keterangan" class="form-control" id="keterangan" placeholder="Keterangan" required>
                    </div>
                    <div class="form-group">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" name="tanggal" class="form-control" required>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>


<?= $this->endSection() ?>