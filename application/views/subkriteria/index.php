<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Subkriteria (<?= rawurldecode($nama_kriteria) ?>)</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item ">Data kriteria</li>
                        <li class="breadcrumb-item active"><?= rawurldecode($nama_kriteria) ?></li>
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
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#subkriteria_modal_tambah">
                                <i class="fa fa-plus"></i> Tambah Data
                            </button>

                            <a href="<?= base_url('Kriteria') ?>" class="btn btn-warning text-white">Kembali</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Subkriteria</th>
                                        <th>Passing Grade</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($subkriteria as $key => $value) { ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $value['nama_subkriteria'] ?></td>
                                            <td><?= $value['passing_grade'] ?></td>
                                            <td>
                                                <button class="btn btn-warning btn-sm btn_ubah" data-toggle="modal" data-target="#subkriteria_modal_ubah" data-id="<?= $value['id_subkriteria'] ?>"><i class="fas fa-solid fa-pencil-alt"></i></button>

                                                <button class="btn btn-danger btn-sm btn_hapus" data-id="<?= $value['id_subkriteria'] ?>"><i class="fas fa-solid fa-trash"></i></button>

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

<!-- modal tambah subkriteria -->
<div class="modal fade" id="subkriteria_modal_tambah">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Subkriteria</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="tambah_subkriteria">
                <div class="modal-body">
                    <input type="hidden" id="id_kriteria" value="<?= $id_kriteria ?>">
                    <div class="form-group">
                        <label for="nama_subkriteria">Nama Subkriteria</label>
                        <input type="text" name="nama_subkriteria" class="form-control" id="nama_subkriteria">
                    </div>
                    <div class="form-group">
                        <label for="passing_grade">Passing Grade</label>
                        <input type="text" name="passing_grade" class="form-control" id="passing_grade">
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

<!-- modal ubah subkriteria -->
<div class="modal fade" id="subkriteria_modal_ubah">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ubah Subkriteria</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="ubah_subkriteria">
                <div class="modal-body">
                    <input type="hidden" id="id_subkriteria_ubah">
                    <div class="form-group">
                        <label for="nama_subkriteria">Nama Subkriteria</label>
                        <input type="text" name="nama_subkriteria_ubah" class="form-control" id="nama_subkriteria_ubah">
                    </div>
                    <div class="form-group">
                        <label for="passing_grade">Passing Grade</label>
                        <input type="text" name="passing_grade_ubah" class="form-control" id="passing_grade_ubah">
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

        $('#tambah_subkriteria').validate({
            rules: {
                nama_subkriteria: {
                    required: true,
                },
                passing_grade: {
                    required: true,
                    number: true
                },

            },
            messages: {
                nama_subkriteria: {
                    required: "Silahkan masukkan nama subkriteria",
                },
                passing_grade: {
                    required: "Silahkan masukkan passing grade",
                    number: "Silahkan masukkan berupa angka",
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
                nama_subkriteria = $('#nama_subkriteria').val()
                id_kriteria = $('#id_kriteria').val()
                passing_grade = $('#passing_grade').val()

                $.ajax({
                    method: 'post',
                    url: '<?= base_url('Subkriteria/tambah') ?>',
                    data: {
                        nama_subkriteria: nama_subkriteria,
                        id_kriteria: id_kriteria,
                        passing_grade: passing_grade
                    },
                    dataType: 'json',
                    success: function(data) {
                        if (data.status == 1) {
                            $('#subkriteria_modal_tambah').hide()
                            swall('Ditambahkan')
                        }
                    }
                })
            }

        });

        $('#ubah_subkriteria').validate({
            rules: {
                nama_subkriteria_ubah: {
                    required: true,
                },
                passing_grade_ubah: {
                    required: true,
                    number: true,
                },

            },
            messages: {
                nama_subkriteria_ubah: {
                    required: "Silahkan masukkan nama subkriteria",
                },
                passing_grade_ubah: {
                    required: "Silahkan masukkan passing grade",
                    number: "Silahkan masukkan berupa angka",
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
                id_subkriteria = $('#id_subkriteria_ubah').val()
                nama_subkriteria = $('#nama_subkriteria_ubah').val()
                passing_grade = $('#passing_grade_ubah').val()
                $.ajax({
                    method: 'post',
                    url: '<?= base_url('Subkriteria/ubah') ?>',
                    data: {
                        nama_subkriteria: nama_subkriteria,
                        passing_grade: passing_grade,
                        id_subkriteria: id_subkriteria
                    },
                    dataType: 'json',
                    success: function(data) {
                        if (data.status == 1) {
                            $('#subkriteria_modal_ubah').hide()
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
            tampil_subkriteria_id(id)

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

    function tampil_subkriteria_id(id) {
        $.ajax({
            method: 'POST',
            url: '<?= base_url('Subkriteria/tampil_subkriteria_id')  ?>',
            data: {
                id_subkriteria: id,
            },
            dataType: 'json',
            success: function(data) {
                if (data.status == 1) {
                    $('#id_subkriteria_ubah').val(data.id_subkriteria)
                    $('#nama_subkriteria_ubah').val(data.nama_subkriteria)
                    $('#passing_grade_ubah').val(data.passing_grade)
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
                    url: '<?= base_url('Subkriteria/hapus')  ?>',
                    data: {
                        id_subkriteria: id,
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