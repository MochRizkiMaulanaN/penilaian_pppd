<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Role</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">Data Master</li>
                        <li class="breadcrumb-item active">Data Role</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
           
            <!-- Main row -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#role_modal_tambah">
                                <i class="fa fa-plus"></i> Tambah Data
                            </button>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Role</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($role as $key => $value) { ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $value['nama_role'] ?></td>
                                            <td>
                                                <button class="btn btn-warning btn-sm btn_ubah" data-toggle="modal" data-target="#role_modal_ubah" data-id="<?= $value['id_role'] ?>"><i class="fas fa-solid fa-pencil-alt"></i></button>

                                                <button class="btn btn-danger btn-sm btn_hapus" data-id="<?= $value['id_role'] ?>"><i class="fas fa-solid fa-trash"></i></button>
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

<!-- modal tambah role -->
<div class="modal fade" id="role_modal_tambah">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Role</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="tambah_role">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_role">Nama Role</label>
                        <input type="text" name="nama_role" class="form-control" id="nama_role">
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Tambahkan</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- modal ubah role -->
<div class="modal fade" id="role_modal_ubah">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ubah Role</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="ubah_role">
                <div class="modal-body">
                    <input type="hidden" id="id_role_ubah">
                    <div class="form-group">
                        <label for="nama_role">Nama Role</label>
                        <input type="text" name="nama_role_ubah" class="form-control" id="nama_role_ubah">
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
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
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

        $('#tambah_role').validate({
            rules: {
                nama_role: {
                    required: true,
                },

            },
            messages: {
                nama_role: {
                    required: "Silahkan masukkan nama role",
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
                nama_role = $('#nama_role').val()
                $.ajax({
                    method: 'post',
                    url: '<?= base_url('Role/tambah') ?>',
                    data: {
                        nama_role: nama_role
                    },
                    dataType: 'json',
                    success: function(data) {
                        if (data.status == 1) {
                            $('#role_modal_tambah').hide()
                            swall('Ditambahkan')
                        }
                    }
                })
            }

        });

        $('#ubah_role').validate({
            rules: {
                nama_role_ubah: {
                    required: true,
                },

            },
            messages: {
                nama_role_ubah: {
                    required: "Silahkan masukkan nama role",
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
                nama_role = $('#nama_role_ubah').val()
                id_role = $('#id_role_ubah').val()
                $.ajax({
                    method: 'post',
                    url: '<?= base_url('Role/ubah') ?>',
                    data: {
                        nama_role: nama_role,
                        id_role: id_role
                    },
                    dataType: 'json',
                    success: function(data) {
                        if (data.status == 1) {
                            $('#role_modal_ubah').hide()
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
            tampil_role_id(id)
            
        })

    });

    function swall($title) {
        Swal.fire({
            icon: 'success',
            title: 'Data Berhasil ' + $title,
            showConfirmButton: false,
            timer: 1500
        }).then((result) => {
            location.reload()
        })

    }

    function tampil_role_id(id) {
        $.ajax({
            method: 'POST',
            url: '<?= base_url('Role/tampil_role_id')  ?>',
            data: {
                id_role: id,
            },
            dataType: 'json',
            success: function(data) {
                if (data.status == 1) {
                    $('#id_role_ubah').val(data.id_role)
                    $('#nama_role_ubah').val(data.nama_role)
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
                    url: '<?= base_url('Role/hapus')  ?>',
                    data: {
                        id_role: id,
                    },
                    dataType: 'json',
                    success: function(data) {
                        if (data.status == 1) {
                            swall('Dihapus')
                        }
                    }

                })
            }
        })
    }
</script>