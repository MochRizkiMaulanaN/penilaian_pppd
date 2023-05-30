<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Kriteria</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Data Kriteria</li>
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
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#kriteria_modal_tambah">
                                <i class="fa fa-plus"></i> Tambah Data
                            </button>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Kriteria</th>
                                        <th>Bobot</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($kriteria as $key => $value) { ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $value['nama_kriteria'] ?></td>
                                            <td><?= $value['bobot_kriteria'] ?></td>
                                            <td>
                                                <button class="btn btn-warning btn-sm btn_ubah" data-toggle="modal" data-target="#kriteria_modal_ubah" data-id="<?= $value['id_kriteria'] ?>"><i class="fas fa-solid fa-pencil-alt"></i></button>

                                                <button class="btn btn-danger btn-sm btn_hapus" data-id="<?= $value['id_kriteria'] ?>"><i class="fas fa-solid fa-trash"></i></button>

                                                <a href="<?= base_url('Subkriteria/index/') . $value['id_kriteria'] . '/' . $value['nama_kriteria'] ?>" class="btn btn-primary btn-sm"><i class="fas fa-solid fa-eye"></i></a>
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

<!-- modal tambah kriteria -->
<div class="modal fade" id="kriteria_modal_tambah">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Kriteria</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="tambah_kriteria">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_kriteria">Nama Kriteria</label>
                        <input type="text" name="nama_kriteria" class="form-control" id="nama_kriteria">
                    </div>
                    <div class="form-group">
                        <label for="bobot_kriteria">Bobot</label>
                        <input type="text" name="bobot_kriteria" class="form-control" id="bobot_kriteria">
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

<!-- modal ubah kriteria -->
<div class="modal fade" id="kriteria_modal_ubah">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ubah Kriteria</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="ubah_kriteria">
                <div class="modal-body">
                    <input type="hidden" id="id_kriteria_ubah">
                    <div class="form-group">
                        <label for="nama_kriteria">Nama Kriteria</label>
                        <input type="text" name="nama_kriteria_ubah" class="form-control" id="nama_kriteria_ubah">
                    </div>
                    <div class="form-group">
                        <label for="bobot_kriteria">Bobot</label>
                        <input type="text" name="bobot_kriteria_ubah" class="form-control" id="bobot_kriteria_ubah">
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

        $('#tambah_kriteria').validate({
            rules: {
                nama_kriteria: {
                    required: true,
                },
                bobot_kriteria: {
                    required: true,
                },

            },
            messages: {
                nama_kriteria: {
                    required: "Silahkan masukkan nama kriteria",
                },
                bobot_kriteria: {
                    required: "Silahkan masukkan bobot kriteria",
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
                nama_kriteria = $('#nama_kriteria').val()
                bobot_kriteria = $('#bobot_kriteria').val()
                console.log(nama_kriteria, bobot_kriteria)
                $.ajax({
                    method: 'post',
                    url: '<?= base_url('Kriteria/tambah') ?>',
                    data: {
                        nama_kriteria: nama_kriteria,
                        bobot_kriteria: bobot_kriteria
                    },
                    dataType: 'json',
                    success: function(data) {
                        if (data.status == 1) {
                            $('#kriteria_modal_tambah').hide()
                            swall('Ditambahkan')
                        }
                    }
                })
            }

        });

        $('#ubah_kriteria').validate({
            rules: {
                nama_kriteria_ubah: {
                    required: true,
                },
                bobot_kriteria_ubah: {
                    required: true,
                },

            },
            messages: {
                nama_kriteria_ubah: {
                    required: "Silahkan masukkan nama kriteria",
                },
                bobot_kriteria_ubah: {
                    required: "Silahkan masukkan bobot kriteria",
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
                nama_kriteria = $('#nama_kriteria_ubah').val()
                bobot_kriteria = $('#bobot_kriteria_ubah').val()
                id_kriteria = $('#id_kriteria_ubah').val()
                $.ajax({
                    method: 'post',
                    url: '<?= base_url('Kriteria/ubah') ?>',
                    data: {
                        nama_kriteria: nama_kriteria,
                        bobot_kriteria: bobot_kriteria,
                        id_kriteria: id_kriteria
                    },
                    dataType: 'json',
                    success: function(data) {
                        if (data.status == 1) {
                            $('#kriteria_modal_ubah').hide()
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
            tampil_kriteria_id(id)

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

    function tampil_kriteria_id(id) {
        $.ajax({
            method: 'POST',
            url: '<?= base_url('Kriteria/tampil_kriteria_id')  ?>',
            data: {
                id_kriteria: id,
            },
            dataType: 'json',
            success: function(data) {
                if (data.status == 1) {
                    $('#id_kriteria_ubah').val(data.id_kriteria)
                    $('#nama_kriteria_ubah').val(data.nama_kriteria)
                    $('#bobot_kriteria_ubah').val(data.bobot_kriteria)
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
                    url: '<?= base_url('Kriteria/hapus')  ?>',
                    data: {
                        id_kriteria: id,
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