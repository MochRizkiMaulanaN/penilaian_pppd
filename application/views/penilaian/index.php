<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Penilaian</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">Data Penilaian</li>
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
                                        <th>Periode Penilaian</th>
                                        <th>NIP</th>
                                        <th>Nama Pegawai</th>
                                        <th>Jabatan</th>
                                        <th>Staff</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($penilaian as $key => $value) { ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= date('d F Y', strtotime($value['tgl_penilaian'])) ?></td>
                                            <td><?= $value['nip_pegawai'] ?></td>
                                            <td><?= $value['nama_pegawai'] ?></td>
                                            <td><?= $value['nama_jabatan'] ?></td>
                                            <td><?= $value['nama_staff'] ?></td>
                                            <td>
                                                <?php if ($value['status'] == 1) { ?>
                                                    <span class="badge badge-primary">Sudah dinilai</span>
                                                <?php } elseif ($value['status'] == 0) { ?>
                                                    <span class="badge badge-danger">Belum dinilai</span>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <a href="<?= base_url('Penilaian/tambah/' . $value['id_penilaian']) ?>" class="btn btn-primary btn-sm btn_tambah"><i class="fas fa-solid fa-plus"></i></a>

                                                <button class="btn btn-warning btn-sm btn_ubah" data-toggle="modal" data-target="#pengguna_modal_ubah" data-id="<?= $value['id_penilaian'] ?>"><i class="fas fa-solid fa-pencil-alt"></i></button>

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
                    $('#aktif_pengguna_ubah').val(aktif)


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