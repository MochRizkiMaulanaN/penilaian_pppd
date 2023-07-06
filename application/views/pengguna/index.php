<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Pengguna</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">Data Master</li>
                        <li class="breadcrumb-item active">Data Pengguna</li>
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
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_tambah_pengguna">
                                <i class="fa fa-plus"></i> Tambah Data
                            </button>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Pengguna</th>
                                        <th>NIP</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Aktif</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($pengguna as $key => $value) { ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $value['nama_pengguna'] ?></td>
                                            <td><?= $value['nip_pengguna'] ?></td>
                                            <td><?= $value['email'] ?></td>
                                            <td><?= $value['nama_role'] ?></td>
                                            <td>
                                                <?php if ($value['aktif'] == '1') { ?>
                                                    <span class="badge badge-primary">Aktif</span>
                                                <?php } elseif ($value['aktif'] == '0') { ?>
                                                    <span class="badge badge-danger">Tidak Aktif</span>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <button class="btn btn-warning btn-sm btn_ubah" data-toggle="modal" data-target="#pengguna_modal_ubah" data-id="<?= $value['id_pengguna'] ?>"><i class="fas fa-solid fa-pencil-alt"></i></button>

                                                <button class="btn btn-danger btn-sm btn_hapus" data-id="<?= $value['id_pengguna'] ?>"><i class="fas fa-solid fa-trash"></i></button>
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

<!-- modal tambah pengguna -->
<div class="modal fade" id="modal_tambah_pengguna">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Pengguna</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="tambah_pengguna">
                    <div class="form-group">
                        <label for="role_pengguna">Role</label>
                        <select class="select2 form-control" name="role_pengguna" id="role_pengguna">
                            <option value="">Pilih salah satu</option>
                            <?php
                            foreach ($role as $key => $value) { ?>
                                <option value="<?= $value['id_role'] ?>"><?= $value['nama_role'] ?></option>
                            <?php }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nama_pengguna">Nama</label>
                        <input type="text" class="form-control nama_pengguna_input" name="nama_pengguna" id="nama_pengguna">
                    </div>
                    <div class="form-group">
                        <label for="nip_pengguna">NIP</label>
                        <input type="text" class="form-control" name="nip_pengguna" id="nip_pengguna">
                    </div>

                    <div class="form-group">
                        <label for="email_pengguna">Email</label>
                        <input type="text" class="form-control" name="email_pengguna" id="email_pengguna">
                    </div>

                    <div class="row">
                        <div class="form-group col-6">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>

                        <div class="form-group col-6">
                            <label for="konfirmasi_password">Konfirmasi Password</label>
                            <input type="password" class="form-control" id="konfirmasi_password" name="konfirmasi_password">
                        </div>
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

<!-- modal ubah pengguna -->
<div class="modal fade" id="pengguna_modal_ubah">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ubah Pengguna</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="ubah_pengguna">
                <div class="modal-body">
                    <input type="hidden" id="id_pengguna_ubah">
                    <div class="form-group">
                        <label for="nama_pengguna">Nama</label>
                        <input type="text" name="nama_pengguna_ubah" class="form-control" id="nama_pengguna_ubah">
                    </div>
                    <div class="form-group">
                        <label for="nip_pengguna">NIP</label>
                        <input type="text" name="nip_pengguna_ubah" class="form-control" id="nip_pengguna_ubah">
                    </div>
                    <div class="form-group">
                        <label for="email_pengguna_ubah">Email</label>
                        <input type="text" class="form-control" name="email_pengguna_ubah" id="email_pengguna_ubah">
                    </div>

                    <div class="form-group">
                        <label for="role_pengguna_ubah">Role</label>
                        <select class="select2 form-control" name="role_pengguna_ubah" id="role_pengguna_ubah">

                        </select>
                    </div>

                    <div class="form-group">
                        <label for="aktif_pengguna_ubah">Aktif</label>
                        <div class="form-check">
                            <input class="form-check-input" name="aktif_pengguna_ubah" id="aktif_pengguna_ubah" type="checkbox">
                        </div>
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

        //Initialize Select2 Elements
        $('.select2').select2()

        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');


        $('#tambah_pengguna').validate({
            ignore: [],
            rules: {
                nama_pengguna: 'required',
                nip_pengguna: {
                    required: true,
                    number: true,
                    minlength: 8

                },
                email_pengguna: {
                    required: true,
                    email: true
                },
                role_pengguna: {
                    required: true
                },
                password: {
                    required: true,
                },
                konfirmasi_password: {
                    required: true,
                    equalTo: '#password'
                },

            },
            messages: {
                nama_pengguna: {
                    required: "Silahkan masukkan nama pengguna",
                },
                nip_pengguna: {
                    required: "Silahkan masukkan NIP",
                    number: "Silahkan masukkan angka",
                    minlength: "Silahkan masukkan minimal 8 angka"


                },
                email_pengguna: {
                    required: "Silahkan masukkan email pengguna",
                    email: "Email tidak sesuai"
                },
                role_pengguna: {
                    required: "Silahkan pilih salah satu",
                },
                password: {
                    required: "Silahkan masukkanpassword",
                },
                konfirmasi_password: {
                    required: "Silahkan masukkan konfirmasi password",
                    equalTo: "Password tidak sama"
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
                nama_pengguna = $('#nama_pengguna').val()
                nip_pengguna = $('#nip_pengguna').val()
                email_pengguna = $('#email_pengguna').val()
                role_pengguna = $('#role_pengguna').val()
                password = $('#password').val()

                $.ajax({
                    method: 'post',
                    url: '<?= base_url('Pengguna/tambah') ?>',
                    data: {
                        nama_pengguna: nama_pengguna,
                        nip_pengguna: nip_pengguna,
                        email_pengguna: email_pengguna,
                        role_pengguna: role_pengguna,
                        password: password
                    },
                    dataType: 'json',
                    success: function(status) {
                        if (status == 1) {
                            $('#modal_tambah_pengguna').hide()
                            swall('Ditambahkan')
                        }
                    }
                })
            }

        });

        $('#ubah_pengguna').validate({
            ignore: [],
            rules: {
                nama_pengguna_ubah: 'required',
                email_pengguna_ubah: {
                    required: true,
                    email: true
                },
                nip_pengguna_ubah: {
                    required: true,
                    number: true,
                    minlength: 8

                },
                role_pengguna_ubah: {
                    required: true
                }

            },
            messages: {
                nama_pengguna_ubah: {
                    required: "Silahkan masukkan nama pengguna",
                },
                nip_pengguna_ubah: {
                    required: "Silahkan masukkan NIP",
                    number: "Silahkan masukkan angka",
                    minlength: "Silahkan masukkan minimal 8 angka"


                },
                email_pengguna_ubah: {
                    required: "Silahkan masukkan email pengguna",
                    email: "Email tidak sesuai"
                },
                role_pengguna_ubah: {
                    required: "Silahkan pilih salah satu",
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
                id_pengguna = $('#id_pengguna_ubah').val()
                nama_pengguna = $('#nama_pengguna_ubah').val()
                nip_pengguna = $('#nip_pengguna_ubah').val()
                email_pengguna = $('#email_pengguna_ubah').val()
                role_pengguna = $('#role_pengguna_ubah').val()

                if (document.getElementById("aktif_pengguna_ubah").checked == true) {
                    aktif_pengguna = '1'
                } else if (document.getElementById("aktif_pengguna_ubah").checked == false) {
                    aktif_pengguna = '0'
                } else {
                    aktif_pengguna = $('#aktif_pengguna_ubah').val()
                }


                $.ajax({
                    method: 'post',
                    url: '<?= base_url('Pengguna/ubah') ?>',
                    data: {
                        id_pengguna: id_pengguna,
                        nama_pengguna: nama_pengguna,
                        nip_pengguna: nip_pengguna,
                        email_pengguna: email_pengguna,
                        role_pengguna: role_pengguna,
                        aktif_pengguna: aktif_pengguna
                    },
                    dataType: 'json',
                    success: function(status) {
                        if (status == 1) {
                            $('#pengguna_modal_ubah').hide()
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
            tampil_pengguna_id(id)

        })

        $('#role_pengguna_1').change(function() {
            id_role = $(this).val()
            $.ajax({
                method: 'POST',
                url: '<?= base_url('Pengguna/tampil_staff_id')  ?>',
                data: {
                    id_role: id_role,
                },
                dataType: 'json',
                success: function(data) {
                    if (data.id_role == 1) {
                        $('#nama_pengguna_input').css("display","block")
                        $('#nama_pengguna_select').css("display","none")
                    } else if (data.id_role == 2) {
                        $('#nama_pengguna_input').css("display","block")
                        $('#nama_pengguna_select').css("display","none")
                    } else if (data.id_role == 3) {
                        $('#nama_pengguna_input').css("display","none")
                        // $('#nip_pengguna').val(data.nip_staff)

                        staff = data.staff
                        baris = '<label for="nama_pengguna">Nama</label><select class="select2 form-control nama_pengguna_select" name="nama_pengguna" id="nama_pengguna"> <option value="" disabled>Pilih salah satu</option>'
                        for (let i = 0; i < staff.length; i++) {
                            const value = staff[i];
                            baris += '<option value="' + value['nama_penilai'] + '">' + value['nama_penilai'] + '</option>'
                        }
                        baris += '</select>'
                        $('.nama_group').html(baris)


                    } else if (data.id_role == 4) {
                        $('#nama_pengguna').hide()
                        pegawai = data.pegawai

                    }
                }

            })

        })

    });


    function swall($title) {
        Swal.fire({
            icon: 'success',
            title: 'Data Berhasil ' + $title,
            showConfirmButton: false,
            timer: 1500
        }).then((result) => {
            location.href = '<?= base_url('Pengguna') ?>';
        })

    }

    function tampil_pengguna_id(id) {
        $.ajax({
            method: 'POST',
            url: '<?= base_url('Pengguna/tampil_pengguna_id')  ?>',
            data: {
                id_pengguna: id,
            },
            dataType: 'json',
            success: function(data) {
                if (data.status == 1) {
                    $('#id_pengguna_ubah').val(data.id_pengguna)
                    $('#nama_pengguna_ubah').val(data.nama_pengguna)
                    $('#nip_pengguna_ubah').val(data.nip_pengguna)
                    $('#email_pengguna_ubah').val(data.email_pengguna)
                    id_role = data.role_pengguna
                    aktif = data.aktif_pengguna
                    // $('#aktif_pengguna_ubah').val(aktif)


                    //tampilkan data role
                    data_role = data.role

                    baris = '<option value="" disabled>Pilih salah satu</option>'
                    for (let i = 0; i < data_role.length; i++) {
                        const role = data_role[i];
                        if (id_role === role['id_role']) {
                            baris += '<option value="' + role['id_role'] + '" selected>' + role['nama_role'] + '</option>'
                        } else {
                            baris += '<option value="' + role['id_role'] + '">' + role['nama_role'] + '</option>'
                        }

                    }
                    $('#role_pengguna_ubah').html(baris)

                    if (aktif == '1') {
                        $('#aktif_pengguna_ubah').attr('checked', true)
                    } else {
                        $('#aktif_pengguna_ubah').removeAttr('checked')
                    }

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
                    url: '<?= base_url('Pengguna/hapus')  ?>',
                    data: {
                        id_pengguna: id,
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