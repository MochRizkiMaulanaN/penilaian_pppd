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
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_tambah_periode">
                                <i class="fa fa-plus"></i> Tambah Data
                            </button>
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
                                        <th>Tanggal Penilaian</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($periode as $key => $value) { ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= date('d F Y', strtotime($value['tgl_penilaian']))  ?></td>
                                            <td>
                                                <?php if ($value['status'] == 'belum') { ?>
                                                    <span class="badge badge-danger">belum</span>
                                                <?php } elseif ($value['status'] == 'sedang dinilai') { ?>
                                                    <span class="badge badge-success">sedang dinilai</span>
                                                <?php } else { ?>
                                                    <span class="badge badge-primary">selesai</span>
                                                <?php } ?>
                                            </td>
                                            <td>

                                                <?php if ($value['status'] == 'belum') { ?>
                                                    <button class="btn btn-success btn-sm btn_kirim" data-idperiode="<?= $value['id_periode'] ?>" data-tglpenilaian="<?= $value['tgl_penilaian'] ?>"><i class="fas fa-solid fa-paper-plane"></i></button>

                                                    <button class="btn btn-danger btn-sm btn_hapus" data-id="<?= $value['id_periode'] ?>"><i class="fas fa-solid fa-trash"></i></button>
                                                <?php } elseif ($value['status'] == 'sedang dinilai') { ?>
                                                    <a href="<?= base_url('Periode_penilaian/detail_periode/') . $value['id_periode'] ?>" class="btn btn-primary btn-sm btn_lihat"><i class="fas fa-solid fa-eye"></i></a>
                                                <?php } ?>

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


        $('#tambah_periode').validate({
            ignore: [],
            rules: {
                tgl_penilaian: 'required',
                nama_staff: 'required',

            },
            messages: {
                tgl_penilaian: {
                    required: "Silahkan masukkan tanggal penilaian",
                },
                nama_staff: {
                    required: "Silahkan pilih salah satu",

                },


            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },

            submitHandler: function() {
                tgl_penilaian = $('#tgl_penilaian').val()
                nama_staff = $('#nama_staff').val()

                //console.log(nama_pengguna, email_pengguna, role_pengguna, password)
                $.ajax({
                    method: 'post',
                    url: '<?= base_url('Periode_penilaian/tambah') ?>',
                    data: {
                        tgl_penilaian: tgl_penilaian,
                        nama_staff: nama_staff
                    },
                    dataType: 'json',
                    success: function(status) {
                        if (status == 1) {
                            $('#modal_tambah_periode').hide()
                            swall('Ditambahkan')
                        } else {
                            $('#modal_tambah_periode').hide()
                            swall_gagal('Ditambahkan')
                        }
                    }
                })
            }

        });

        $('.btn_hapus').click(function() {
            id = $(this).data('id');
            // console.log(id)
            hapus(id)
        })

        $('.btn_kirim').click(function() {
            id_periode = $(this).data('idperiode');
            // staff_id = $(this).data('staffid');
            tgl_penilaian = $(this).data('tglpenilaian');
            kirim(id_periode, tgl_penilaian)
        })

    })

    function hapus(id) {
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
                    url: '<?= base_url('Periode_penilaian/hapus')  ?>',
                    data: {
                        id_periode: id,
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

    function kirim(id_periode, tgl_penilaian) {
        Swal.fire({
            title: 'Apakah kamu yakin?',
            text: "Form penilaian pegawai akan dikirim ke tabel penilaian",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, kirim',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    method: 'POST',
                    url: '<?= base_url('Periode_penilaian/tambah_detail_periode')  ?>',
                    data: {
                        id_periode: id_periode,
                        tgl_penilaian: tgl_penilaian,
                    },
                    dataType: 'json',
                    success: function(status) {
                        if (status == 1) {
                            swall('Dikirim')
                        } else {
                            swall_gagal_kirim('dikirim')
                        }
                    }

                })
            }
        })
    }

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

    function swall_gagal($title) {
        Swal.fire({
            icon: 'error',
            title: 'Data Gagal ' + $title,
            text: "Tanggal periode penilaian gagal ditambahkan !!",
            showConfirmButton: true,
            confirmButtonText: 'Ok',
        }).then((result) => {
            location.reload();
        })

    }

    function swall_gagal_kirim($title) {
        Swal.fire({
            icon: 'error',
            title: 'Data Gagal ' + $title,
            text: "Data pegawai yang akan dinilai belum diinputkan !!",
            showConfirmButton: true,
            confirmButtonText: 'Ok',
        }).then((result) => {
            location.reload();
        })

    }
</script>