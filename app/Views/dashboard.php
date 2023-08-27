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

<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Dashboard</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
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
                            <th>Create By</th>
                        </tr>
                    </thead>
                    <tbody id="tableData">
                        <?php foreach ($barangs as $index => $barang) : ?>
                            <tr>
                                <th scope="row"><?php echo $index + 1 ?></th>
                                <td><?php echo $barang['nama'] ?></td>
                                <td><?php echo $barang['jumlah'] ?></td>
                                <td><?php echo $barang['keterangan'] ?></td>
                                <td><?php echo $barang['tanggal'] ?></td>
                                <td class="<?php
                                            if ($barang['status'] == 0) {
                                                echo "status-menunggu";
                                            } elseif ($barang['status'] == 1) {
                                                echo "status-selesai";
                                            } else {
                                                echo "status-tidak-valid";
                                            }
                                            ?>">
                                    <?php
                                    if ($barang['status'] == 0) {
                                        echo "Menunggu";
                                    } elseif ($barang['status'] == 1) {
                                        echo "Selesai";
                                    } else {
                                        echo "Status tidak valid";
                                    }
                                    ?>
                                </td>
                                <td><?php echo $barang['username'] ?></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <a href="generate-pdf" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Pdf</a>
                </div>
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


