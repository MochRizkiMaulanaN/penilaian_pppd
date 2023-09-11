<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Periode Penilaian</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Periode Penilaian</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">

            </div>
            <!-- /.row -->

            <!-- Main row -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="<?= base_url('Laporan_penilaian/detail_penilaian_staff/' . $staff_id . '/' . $tahun . '/' . $jabatan_id . '/' . $jabatan) ?>" class="btn btn-warning text-white">Kembali</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <strong>Nama Pegawai : <?= rawurldecode($nama_pegawai); ?></strong><br>
                            <strong>Jabatan : <?= rawurldecode($jabatan); ?></strong>
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Tanggal Periode</th>
                                        <th>Nilai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $total = 0;
                                    foreach ($periode_nilai as $key => $value) :
                                        $nilai_akhir = $value['nilai_akhir'];
                                    ?>
                                        <tr>
                                            <td><?= date('d F Y', strtotime($value['tgl_periode'])) ?></td>
                                            <td><?= $nilai_akhir ?></td>
                                        </tr>
                                    <?php
                                        $total += $nilai_akhir;
                                    endforeach; ?>
                                    <tr>
                                        <th>Total Nilai Akhir</th>
                                        <th><?= $total ?></th>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->