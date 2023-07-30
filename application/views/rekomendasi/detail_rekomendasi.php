<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Detail Rekomedasi</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Detail Rekomendasi</li>
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
                            <a href="<?= base_url('Rekomendasi') ?>" class="btn btn-warning text-white">Kembali</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <!--<strong>Jabatan : <?= rawurldecode($nama_jabatan); ?></strong> -->
                            <table id="example1" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>NIP</th>
                                        <th>Nama</th>
                                        <th>Nilai Akhir</th>
                                        <th>Ranking</th>
                                        <th>Rekomendasi</th>
                                        <th>Keterangan</th>
                                        <th>Akhir Kontrak</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($rekomendasi as $key => $value) { ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $value['nip_pegawai'] ?></td>
                                            <td><?= $value['nama_pegawai'] ?></td>
                                            <td><?= $value['nilai_akhir'] ?></td>
                                            <td><?= $value['ranking'] ?></td>
                                            <td><?= $value['rekomendasi'] ?></td>
                                            <td><?= $value['keterangan'] ?></td>
                                            <td><?= date('d F Y', strtotime($value['akhir_kontrak'])) ?></td>
                                            <td>

                                                <button class="btn btn-success btn-sm btn_perpanjangan" data-nip="<?= $value['nip_pegawai'] ?>" data-nama="<?= $value['nama_pegawai'] ?>" data-id="<?= $value['pegawai_id'] ?>">Perpanjangan</button>

                                                <button class="btn btn-danger btn-sm btn_pemutusan" data-nip="<?= $value['nip_pegawai'] ?>" data-nama="<?= $value['nama_pegawai'] ?>" data-id="<?= $value['pegawai_id'] ?>"> Pemutusan</button>

                                            </td>
                                        </tr>
                                    <?php }
                                    ?>
                                </tbody>
                            </table>
                            <!-- <p>Tekan tombol, jika ingin semua pegawai dengan keterangan perpanjangan kontrak diperpanjang :</p>
                            <button class="btn btn-success btn_perpanjangan_semua" data-idstaff=""><i class="fas fa-solid fa-check "></i> Selesai</button> -->
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
    $('.btn_perpanjangan').click(function() {
        nip = $(this).data('nip')
        nama = $(this).data('nama')
        id = $(this).data('id')
        perpanjangan(nip, nama,id)
    })

    $('.btn_pemutusan').click(function() {
        nip = $(this).data('nip')
        nama = $(this).data('nama')
        id = $(this).data('id')
        pemutusan(nip, nama,id)
    })

    function swall($title) {
        Swal.fire({
            icon: 'success',
            title: 'Kontrak Pegawai ' + $title,
            showConfirmButton: false,
            timer: 1500
        }).then((result) => {
            location.href = '<?= base_url('Penilaian') ?>';
        })

    }

    function perpanjangan(nip, nama,id) {
        Swal.fire({
            title: 'Apakah kamu yakin?',
            text: "Pegawai dengan nama " + nama + " akan perpanjangan masa kontrak",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    method: 'POST',
                    url: '<?= base_url('Rekomendasi/perpanjangan')  ?>',
                    data: {
                        nip: nip,
                        id: id,
                    },
                    dataType: 'json',
                    success: function(data) {
                        if (data.status == 1) {
                            swall('Diperpanjang')
                        }
                    }

                })
            }
        })
    }

    function pemutusan(nip, nama,id) {
        Swal.fire({
            title: 'Apakah kamu yakin?',
            text: "Pegawai dengan nama " + nama + " tidak diperpanjang masa kontrak",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    method: 'POST',
                    url: '<?= base_url('Rekomendasi/pemutusan')  ?>',
                    data: {
                        nip: nip,
                        id: id,
                    },
                    dataType: 'json',
                    success: function(data) {
                        if (data.status == 1) {
                            swall('Tidak Diperpanjang')
                        }
                    }

                })
            }
        })
    }
</script>