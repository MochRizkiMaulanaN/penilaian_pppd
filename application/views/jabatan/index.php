<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Jabatan</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">Data Master</li>
                        <li class="breadcrumb-item active">Data Jabatan</li>
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
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_tambah_jabatan">
                                <i class="fa fa-plus"></i> Tambah Data
                            </button>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Jabatan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($jabatan as $key => $value) { ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $value['nama_jabatan'] ?></td>
                                            <td>
                                                <button class="btn btn-danger btn-sm btn_hapus" data-id="<?= $value['id_jabatan'] ?>"><i class="fas fa-solid fa-trash"></i></button>

                                                <button class="btn btn-warning btn-sm btn_ubah" data-id="<?= $value['id_jabatan'] ?>" data-toggle="modal" data-target="#modal_ubah_jabatan"><i class="fas fa-solid fa-pencil-alt"></i></button>
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

<!-- modal tambah jabatan -->
<div class="modal fade" id="modal_tambah_jabatan">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Jabatan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="tambah_jabatan">
                    <div class="form-group">
                        <label for="nama_jabatan">Nama Jabatan</label>
                        <input type="text" class="form-control" name="nama_jabatan" id="nama_jabatan">
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

<!-- modal ubah jabatan -->
<div class="modal fade" id="modal_ubah_jabatan">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ubah Jabatan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="ubah_jabatan">
                    <input type="hidden" id="id_jabatan_ubah">
                    <div class="form-group">
                        <label for="nama_jabatan_ubah">Nama Jabatan</label>
                        <input type="text" class="form-control" name="nama_jabatan_ubah" id="nama_jabatan_ubah">
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

<script>
    $(function() {

        //Initialize Select2 Elements
        $('.select2').select2()

        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');


        $('#tambah_jabatan').validate({
            ignore: [],
            rules: {
                nama_jabatan: 'required'

            },
            messages: {
                nama_jabatan: {
                    required: "Silahkan masukkan nama jabatan",
                }

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
                nama_jabatan = $('#nama_jabatan').val()

                $.ajax({
                    method: 'post',
                    url: '<?= base_url('Jabatan/tambah') ?>',
                    data: {
                        nama_jabatan: nama_jabatan,
                    },
                    dataType: 'json',
                    success: function(status) {
                        if (status == 1) {
                            $('#modal_tambah_jabatan').hide()
                            swall('Ditambahkan')
                        }
                    }
                })
            }

        });

        $('#ubah_jabatan').validate({
            ignore: [],
            rules: {
                nama_jabatan_ubah: 'required'

            },
            messages: {
                nama_jabatan_ubah: {
                    required: "Silahkan masukkan nama jabatan",
                }

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
                id_jabatan = $('#id_jabatan_ubah').val()
                nama_jabatan = $('#nama_jabatan_ubah').val()

                $.ajax({
                    method: 'post',
                    url: '<?= base_url('Jabatan/ubah') ?>',
                    data: {
                        id_jabatan: id_jabatan,
                        nama_jabatan: nama_jabatan,
                    },
                    dataType: 'json',
                    success: function(status) {
                        if (status == 1) {
                            $('#modal_ubah_jabatan').hide()
                            swall('Diubah')
                        }
                    }
                })
            }

        });

        $('.btn_hapus').click(function() {
            id = $(this).data('id');
            hapus(id)
        })

        $('.btn_ubah').click(function() {
            id = $(this).data('id');
            tampil_jabatan_id(id)
        })

    });

    function swall($title) {
        Swal.fire({
            icon: 'success',
            title: 'Data Berhasil ' + $title,
            showConfirmButton: false,
            timer: 1500
        }).then((result) => {
            location.href = '<?= base_url('Jabatan') ?>';
        })

    }

    function tampil_jabatan_id(id) {
        $.ajax({
            method: 'POST',
            url: '<?= base_url('Jabatan/tampil_jabatan_id')  ?>',
            data: {
                id_jabatan: id,
            },
            dataType: 'json',
            success: function(data) {
                if (data.status == 1) {
                    $('#id_jabatan_ubah').val(data.id_jabatan)
                    $('#nama_jabatan_ubah').val(data.nama_jabatan)
                

                }
            }

        })
    }

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
                    url: '<?= base_url('Jabatan/hapus')  ?>',
                    data: {
                        id_jabatan: id,
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