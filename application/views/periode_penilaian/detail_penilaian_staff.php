<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Detail Penilaian Staff</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Detail Penilaian Staff</li>
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
                            <a href="<?= base_url('Periode_penilaian/detail_periode/' . $id_periode) ?>" class="btn btn-warning text-white">kembali</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>NIP</th>
                                        <th>Nama Pegawai</th>
                                        <th>Jabatan</th>
                                        <th>Nilai</th>
                                        <th>Passing Grade</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($detail_penilaian as $key => $value) { ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $value['nip_pegawai'] ?></td>
                                            <td><?= $value['nama_pegawai'] ?></td>
                                            <td><?= $value['nama_jabatan'] ?></td>
                                            <td><?= $value['nilai'] ?></td>
                                            <td><?= $value['passing_grade'] ?></td>
                                            <td>
                                                <a href="<?= base_url('Periode_penilaian/detail_penilaian_pegawai/' . $value["id_penilaian"] . '/' . $value["pegawai_id"]) ?>" class="btn btn-primary btn-sm"><i class="fas fa-solid fa-eye"></i></a>
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

<!-- modal tambah periode -->
<div class="modal fade" id="modal_tambah_periode">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Periode</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="tambah_periode">
                    <div class="form-group">
                        <label for="tgl_penilaian">Tanggal Penilaiain</label>
                        <input type="date" class="form-control" name="tgl_penilaian" id="tgl_penilaian">
                    </div>

                    <!-- <div class="form-group">
                        <label for="nama_staff">Staff yang dinilai</label>
                        <select class="select2 form-control" name="nama_staff" id="nama_staff">
                            <option value="">Pilih salah satu</option>
                            <?php foreach ($staff as $key => $value) { ?>
                                <option value="<?= $value['id_staff'] ?>"><?= $value['nama_staff'] ?></option>
                            <?php } ?>

                        </select>
                    </div> -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Tambahkan</button>
            </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- modal ubah periode -->
<div class="modal fade" id="modal_ubah_periode">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ubah periode</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="ubah_periode">
                    <input type="hidden" id="id_periode_ubah">
                    <div class="form-group">
                        <label for="tgl_penilaian_ubah">Tanggal Penilaian</label>
                        <input type="text" class="form-control" name="tgl_penilaian_ubah" id="tgl_penilaian_ubah">
                    </div>
                    <!-- <div class="form-group">
                        <label for="nama_staff_ubah">Staff yang dinilai</label>
                        <input type="text" class="form-control" name="nama_staff_ubah" id="nama_staff_ubah">
                    </div> -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script>
    $(function() {
        //Initialize Select2 Elements
        $('.select2').select2()


        $('.btn_hitung').click(function() {
            id_periode = $(this).data('idperiode');
            hitung(id_periode)
        })

    })

    function swall($title) {
        Swal.fire({
            icon: 'success',
            title: 'Data Berhasil ' + $title,
            showConfirmButton: false,
            timer: 1500
        }).then((result) => {
            location.reload();
        })

    }

    function hitung(id_periode) {
        Swal.fire({
            title: 'Apakah kamu yakin?',
            text: "Data penilaian pegawai akan dihitung secara keseluruhan",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hitung',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    method: 'POST',
                    url: '<?= base_url('Periode_penilaian/hitung_nilaiAkhir')  ?>',
                    data: {
                        id_periode: id_periode
                    },
                    dataType: 'json',
                    success: function(status) {
                        if (status == 1) {
                            swall('Dihitung')
                        }
                    }

                })
            }
        })
    }
</script>