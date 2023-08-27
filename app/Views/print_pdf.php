<?= $this->extend('components/layout_pdf') ?>
<?= $this->section('content') ?>
<style>
    .logo {
        display: inline-block;
        vertical-align: middle;
    }

    .judul-dashboard {
        display: inline-block;
        vertical-align: middle;
    }
</style>
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">
        <img src="<?php echo base_url('public/assets/img/favicon_custom.png') ?>" width="40px" class="logo">
        <span class="judul-dashboard">ATK Humas</span>
    </h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Barang</th>
                            <th>Jumlah</th>
                            <th>Keterangan</th>
                            <th>Tanggal</th>
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
                                <td><?php echo $barang['username'] ?></td>
                            </tr>
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