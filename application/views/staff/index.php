<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Staff</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">Data Master</li>
                        <li class="breadcrumb-item active">Data Staff</li>
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
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_tambah_staff">
                                <i class="fa fa-plus"></i> Tambah Data
                            </button>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>NIP</th>
                                        <th>Nama Staff</th>
                                        <th>Jabatan</th>
                                        <th>Jabatan yang akan dinilai</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($staff as $key => $value) { ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $value['nip_staff'] ?></td>
                                            <td><?= $value['nama_penilai'] ?></td>
                                            <td><?= $value['jabatan_staff'] ?></td>
                                            <td><?= $value['nama_staff'] ?></td>
                                            <td>
                                                <button class="btn btn-danger btn-sm btn_hapus" data-id="<?= $value['id_staff'] ?>"><i class="fas fa-solid fa-trash"></i></button>

                                                <button class="btn btn-warning btn-sm btn_ubah" data-toggle="modal" data-target="#modal_ubah_staff" data-id="<?= $value['id_staff'] ?>"><i class="fas fa-solid fa-pencil-alt"></i></button>
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

<!-- modal tambah staff -->
<div class="modal fade" id="modal_tambah_staff">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Staff</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="tambah_staff">
                    <div class="form-group">
                        <label for="nama_penilai">Nama Staff</label>
                        <input type="text" class="form-control" name="nama_penilai" id="nama_penilai">
                    </div>
                    <div class="form-group">
                        <label for="nip_staff">NIP</label>
                        <input type="text" class="form-control" name="nip_staff" id="nip_staff">
                    </div>
                    <div class="form-group">
                        <label for="jabatan_staff">Jabatan</label>
                        <input type="text" class="form-control" name="jabatan_staff" id="jabatan_staff">
                    </div>
                    <div class="form-group">
                        <label for="nama_staff">Jabatan yang akan dinilai</label>
                        <input type="text" class="form-control" name="nama_staff" id="nama_staff">
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

<!-- modal ubah staff -->
<div class="modal fade" id="modal_ubah_staff">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ubah Staff</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="ubah_staff">
                    <input type="hidden" id="id_staff_ubah">
                    <div class="form-group">
                        <label for="nama_penilai_ubah">Nama Staff</label>
                        <input type="text" class="form-control" name="nama_penilai_ubah" id="nama_penilai_ubah">
                    </div>
                    <div class="form-group">
                        <label for="nip_staff_ubah">NIP</label>
                        <input type="text" class="form-control" name="nip_staff_ubah" id="nip_staff_ubah">
                    </div>
                    <div class="form-group">
                        <label for="jabatan_staff_ubah">Jabatan</label>
                        <input type="text" class="form-control" name="jabatan_staff_ubah" id="jabatan_staff_ubah">
                    </div>
                    <div class="form-group">
                        <label for="nama_staff_ubah">Jabatan yang akan dinilai</label>
                        <input type="text" class="form-control" name="nama_staff_ubah" id="nama_staff_ubah">
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

        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');


        $('#tambah_staff').validate({
            ignore: [],
            rules: {
                nama_staff: {
                    required: true,
                    lettersonly: true
                },
                nama_penilai: {
                    required: true,
                    lettersonly: true
                },
                nip_staff: {
                    required: true,
                    number: true,
                    minlength: 8,
                },

                jabatan_staff: {
                    required: true,
                    lettersonly: true
                }

            },
            messages: {
                nama_staff: {
                    required: "Silahkan masukkan nama staff",
                    lettersonly: "Silahkan masukkan huruf"
                },
                nama_penilai: {
                    required: "Silahkan masukkan nama penilai",
                    lettersonly: "Silahkan masukkan huruf"
                },
                nip_staff: {
                    required: "Silahkan masukkan NIP",
                    number: "Silahkan masukkan nip berupa angka",
                    minlength: "Silahkan masukkan nip minimal 8 angka",
                },
                jabatan_staff: {
                    required: "Silahkan masukkan nama jabatan",
                    lettersonly: "Silahkan masukkan huruf"
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
                nama_staff = $('#nama_staff').val()
                nama_penilai = $('#nama_penilai').val()
                nip_staff = $('#nip_staff').val()
                jabatan_staff = $('#jabatan_staff').val()

                $.ajax({
                    method: 'post',
                    url: '<?= base_url('Staff/tambah') ?>',
                    data: {
                        nama_staff: nama_staff,
                        nama_penilai: nama_penilai,
                        nip_staff: nip_staff,
                        jabatan_staff: jabatan_staff,
                    },
                    dataType: 'json',
                    success: function(status) {
                        if (status == 1) {
                            $('#modal_tambah_staff').hide()
                            swall('Ditambahkan')
                        }
                    }
                })
            }

        });

        $('#ubah_staff').validate({
            ignore: [],
            rules: {
                nama_staff_ubah: {
                    required:true,
                    lettersonly: true
                },
                nama_penilai_ubah: {
                    required: true,
                    lettersonly: true
                },
                nip_staff_ubah: {
                    required: true,
                    number: true,
                    minlength: 8,
                },
                jabatan_staff_ubah: {
                    required: true,
                    lettersonly: true
                }

            },
            messages: {
                nama_staff_ubah: {
                    required: "Silahkan masukkan nama staff",
                    lettersonly: "Silahkan masukkan huruf"
                },
                nama_penilai_ubah: {
                    required: "Silahkan masukkan nama penilai",
                    lettersonly: "Silahkan masukkan huruf"
                },
                nip_staff_ubah: {
                    required: "Silahkan masukkan NIP",
                    number: "Silahkan masukkan nip berupa angka",
                    minlength: "Silahkan masukkan nip minimal 8 angka",
                },
                jabatan_staff_ubah: {
                    required: "Silahkan masukkan nama jabatan",
                    lettersonly: "Silahkan masukkan huruf"

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
                id_staff = $('#id_staff_ubah').val()
                nama_staff = $('#nama_staff_ubah').val()
                nama_penilai = $('#nama_penilai_ubah').val()
                nip_staff = $('#nip_staff_ubah').val()
                jabatan_staff = $('#jabatan_staff_ubah').val()

                $.ajax({
                    method: 'post',
                    url: '<?= base_url('Staff/ubah') ?>',
                    data: {
                        id_staff: id_staff,
                        nama_staff: nama_staff,
                        nama_penilai: nama_penilai,
                        nip_staff: nip_staff,
                        jabatan_staff: jabatan_staff,
                    },
                    dataType: 'json',
                    success: function(status) {
                        if (status == 1) {
                            $('#modal_ubah_staff').hide()
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
            tampil_staff_id(id)

        })

    });

    function swall($title) {
        Swal.fire({
            icon: 'success',
            title: 'Data Berhasil ' + $title,
            showConfirmButton: false,
            timer: 1500
        }).then((result) => {
            location.href = '<?= base_url('Staff') ?>';
        })

    }

    function tampil_staff_id(id) {
        $.ajax({
            method: 'POST',
            url: '<?= base_url('Staff/tampil_staff_id')  ?>',
            data: {
                id_staff: id,
            },
            dataType: 'json',
            success: function(data) {
                if (data.status == 1) {
                    $('#id_staff_ubah').val(data.id_staff)
                    $('#nama_staff_ubah').val(data.nama_staff)
                    $('#nip_staff_ubah').val(data.nip_staff)
                    $('#jabatan_staff_ubah').val(data.jabatan_staff)
                    $('#nama_penilai_ubah').val(data.nama_penilai)

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
                    url: '<?= base_url('Staff/hapus')  ?>',
                    data: {
                        id_staff: id,
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