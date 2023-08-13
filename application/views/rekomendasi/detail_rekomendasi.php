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
                            <?php if ($this->session->flashdata('pesan')) {
                                echo $this->session->flashdata('pesan');
                            } ?>
                            <form action="<?= base_url('Rekomendasi/keputusan') ?>" method="post" onsubmit="konfirmasi()">
                                <input type="hidden" name="jabatan_id" value="<?= $jabatan_id ?>">
                                <input type="hidden" name="periode_tahun" value="<?= $periode_tahun ?>">

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
                                            <!-- <th>Aksi</th> -->
                                            <th>Pemutusan</th>
                                            <th>Perpanjangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($rekomendasi as $key => $value) {
                                            $id_pegawai = $value['id_pegawai']; ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td><?= $value['nip_pegawai'] ?></td>
                                                <td><?= $value['nama_pegawai'] ?></td>
                                                <td><?= $value['nilai_akhir'] ?></td>
                                                <td><?= $value['ranking'] ?></td>
                                                <td><?= $value['rekomendasi'] ?></td>
                                                <td><?= $value['keterangan'] ?></td>
                                                <td><?= date('d F Y', strtotime($value['akhir_kontrak'])) ?></td>
                                                <!-- <td>

                                                <button class="btn btn-success btn-sm btn_perpanjangan" data-nip="<?= $value['nip_pegawai'] ?>" data-nama="<?= $value['nama_pegawai'] ?>" data-id="<?= $value['pegawai_id'] ?>">Perpanjangan</button>

                                                <button class="btn btn-danger btn-sm btn_pemutusan" data-nip="<?= $value['nip_pegawai'] ?>" data-nama="<?= $value['nama_pegawai'] ?>" data-id="<?= $value['pegawai_id'] ?>"> Pemutusan</button>

                                            </td> -->
                                                <input type="hidden" name="id_pegawai[]" value="<?= $id_pegawai ?>">
                                                <td>
                                                    <input type="radio" name="keputusan<?= $id_pegawai ?>" value="0" style="width: 100px; height: 20px; border: 0px;">
                                                </td>
                                                <td>
                                                    <input type="radio" name="keputusan<?= $id_pegawai ?>" value="1" style="width: 100px; height: 20px; border: 0px;">
                                                </td>
                                            </tr>
                                        <?php }
                                        ?>
                                    </tbody>
                                </table>
                                <button type="submit" class="btn btn-success btn_keputusan"><i class="fas fa-solid fa-check "></i> Selesai</button>
                            </form>
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
    function konfirmasi() {
        return confirm('Apakah anda yakin ingin perpanjangan atau pemutusan kontrak pada data yang dipilih?')
    }

    $('.btn_perpanjangan').click(function() {
        nip = $(this).data('nip')
        nama = $(this).data('nama')
        id = $(this).data('id')
        perpanjangan(nip, nama, id)
    })

    $('.btn_pemutusan').click(function() {
        nip = $(this).data('nip')
        nama = $(this).data('nama')
        id = $(this).data('id')
        pemutusan(nip, nama, id)
    })

    function swall($title) {
        Swal.fire({
            icon: 'success',
            title: 'Kontrak Pegawai ' + $title,
            showConfirmButton: false,
            timer: 1500
        }).then((result) => {
            location.href = '<?= base_url('Rekomendasi') ?>';
        })

    }

    function perpanjangan(nip, nama, id) {
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

    function pemutusan(nip, nama, id) {
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