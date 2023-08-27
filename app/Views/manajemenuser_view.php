<?= $this->extend('components/isi') ?>
<?= $this->section('content') ?>

<style>
    .status {
        padding: 5px 10px;
        border-radius: 5px;
        font-weight: bold;
    }

    .aktif {
        background-color: #4CAF50;
        color: white;
    }

    .tidak-aktif {
        background-color: #FF5733;
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

<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Manajemen User</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">

        <div class="card-header py-3">
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="myInput" placeholder="Cari Nama User...">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button">Cari</button>
                    </div>
                </div>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th scope="col">#</th>

                            <th scope="col">Username</th>
                            <th scope="col">Role</th>
                            <th scope="col">Status Akun Saat Ini</th>
                            <th scope="col">Aksi</th>
                        </tr>
                        </tr>
                    </thead>
                    <tbody id="tableData">
                        <?php foreach ($manajemenusers as $index => $manajemenuser) : ?>
                            <tr>
                                <th scope="row"><?php echo $index + 1 ?></th>

                                <td><?php echo $manajemenuser['username'] ?></td>
                                <td><?php echo $manajemenuser['role'] ?></td>
                                <td>
                                    <span class="status <?php echo ($manajemenuser['is_aktif'] == 1) ? 'aktif' : 'tidak-aktif'; ?>">
                                        <?php
                                        if ($manajemenuser['is_aktif'] == 0) {
                                            echo "Tidak Aktif";
                                        } elseif ($manajemenuser['is_aktif'] == 1) {
                                            echo "Aktif";
                                        } else {
                                            echo "Status tidak valid";
                                        }
                                        ?>
                                    </span>
                                </td>

                                <td>

                                    <a data-bs-target="#editModal-<?= $manajemenuser['id'] ?>" class="btn btn-secondary btn-icon-split" data-bs-toggle="modal">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-arrow-right"></i>
                                        </span>
                                        <span class="text">Ubah</span>
                                    </a>

                                    <a href="<?= base_url('manajemenuser/delete/' . $manajemenuser['id']) ?>" class="btn btn-danger btn-icon-split" onclick="return confirm('Yakin hapus data ini ?')">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-trash"></i>
                                        </span>
                                        <!-- <span class="text">Hapus</span> -->
                                    </a>
                                </td>
                            </tr>
                            <!-- Edit Modal Begin -->
                            <div class="modal fade" id="editModal-<?= $manajemenuser['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel-<?= $manajemenuser['id'] ?>">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel-<?= $manajemenuser['id'] ?>">Ubah Status User</h5>
                                            <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <form action="<?= base_url('manajemenuser/edit/' . $manajemenuser['id']) ?>" method="post" enctype="multipart/form-data">
                                            <?= csrf_field(); ?>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="nama">Username</label>
                                                    <input type="text" name="username" class="form-control" id="nama" value="<?= $manajemenuser['username'] ?>" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label for="name">Role</label>
                                                    <select name="role" class="form-control" required>
                                                        <option value="user" <?= $manajemenuser['role'] == 'user' ? 'selected' : '' ?>>user</option>
                                                        <option value="admin" <?= $manajemenuser['role'] == 'admin' ? 'selected' : '' ?>>admin</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="name">Status Akun Saat Ini</label>
                                                    <select name="is_aktif" class="form-control" required>
                                                        <option value="0" <?= $manajemenuser['is_aktif'] == '0' ? 'selected' : '' ?>>Tidak Aktif</option>
                                                        <option value="1" <?= $manajemenuser['is_aktif'] == '1' ? 'selected' : '' ?>>Aktif</option>
                                                    </select>
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
<?= $this->endSection() ?>