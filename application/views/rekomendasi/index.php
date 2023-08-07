<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Rekomendasi</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Rekomendasi</li>
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
                            <!-- <button class="btn btn-primary" data-toggle="modal" data-target="#modal_tambah"><i class="fa fa-plus"></i> Kuota Pegawai Perpanjangan</button> -->
                            <a class="btn btn-primary" href="<?= base_url('Rekomendasi/tambah') ?>"><i class="fa fa-plus"></i> Tambah</a>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <?php if ($this->session->flashdata('pesan')) {
                                echo $this->session->flashdata('pesan');
                            } ?>
                            <table id="example1" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Tahun</th>
                                        <th>Jabatan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($rekomendasi as $key => $value) { ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $value['periode_tahun'] ?></td>
                                            <td><?= $value['nama_jabatan'] ?></td>
                                            <td>
                                                <a href="<?= base_url('Rekomendasi/detail/') . $value['jabatan_id'] . '/' . $value['periode_tahun'] ?>" class="btn btn-primary btn-sm btn_lihat"><i class="fas fa-solid fa-eye"></i></a>

                                                <button class="btn btn-danger btn-sm btn_hapus" data-jabatanid="<?= $value['jabatan_id'] ?>" data-tahun="<?= $value['periode_tahun'] ?>"><i class="fas fa-solid fa-trash"></i></button>
                                            </td>
                                        </tr>
                                    <?php }
                                    ?>
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

<script>
    $('.btn_hapus').click(function() {
        jabatan_id = $(this).data('jabatanid');
        tahun = $(this).data('tahun');
        hapus(jabatan_id,tahun)
    })

    function swall($title) {
        Swal.fire({
            icon: 'success',
            title: 'Data Berhasil ' + $title,
            showConfirmButton: false,
            timer: 1500
        }).then((result) => {
            location.href = '<?= base_url('Rekomendasi') ?>';
        })

    }

    function hapus(jabatan_id,tahun) {
        Swal.fire({
            title: 'Apakah kamu yakin?',
            text: "ingin menghapus data ini",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    method: 'POST',
                    url: '<?= base_url('Rekomendasi/hapus')  ?>',
                    data: {
                        jabatan_id: jabatan_id,
                        tahun: tahun
                    },
                    dataType: 'json',
                    success: function(status) {
                        if (status == 1) {
                            swall('Dihapus')
                        }
                    }

                })
            }
        })
    }
</script>