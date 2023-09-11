<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Pegawai</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">Data Master</li>
                        <li class="breadcrumb-item active">Data Pegawai</li>
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
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_tambah_pegawai">
                                <i class="fa fa-plus"></i> Tambah Data
                            </button>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Pegawai</th>
                                        <th>NIP</th>
                                        <th>Jabatan</th>
                                        <th>Staff Penilai</th>
                                        <th>Masa Akhir Kontrak</th>
                                        <th>Status Pegawai</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($pegawai as $key => $value) { ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $value['nama_pegawai'] ?></td>
                                            <td><?= $value['nip_pegawai'] ?></td>
                                            <td><?= $value['nama_jabatan'] ?></td>
                                            <td><?= $value['nama_staff'] ?></td>
                                            <td><?= date('d F Y', strtotime($value['akhir_kontrak']))  ?></td>
                                            <td>
                                                <?php if ($value['status_pegawai'] == 1) { ?>
                                                    <span class="badge badge-primary">Aktif</span>
                                                <?php } else { ?>
                                                    <span class="badge badge-danger">Tidak Aktif</span>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <button class="btn btn-warning btn-sm btn_ubah" data-toggle="modal" data-target="#pegawai_modal_ubah" data-id="<?= $value['id_pegawai'] ?>"><i class="fas fa-solid fa-pencil-alt"></i></button>

                                                <button class="btn btn-danger btn-sm btn_hapus" data-id="<?= $value['id_pegawai'] ?>"><i class="fas fa-solid fa-trash"></i></button>
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

<!-- modal tambah pegawai -->
<div class="modal fade" id="modal_tambah_pegawai">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Pegawai</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="tambah_pegawai">
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="nama_pegawai">Nama Pegawai</label>
                            <input type="text" class="form-control" name="nama_pegawai" id="nama_pegawai">
                        </div>
                        <div class="form-group col-6">
                            <label for="nip_pegawai">NIP</label>
                            <input type="text" class="form-control" name="nip_pegawai" id="nip_pegawai">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-6">
                            <label for="nama_jabatan">Jabatan</label>
                            <select class="select2 form-control" name="nama_jabatan" id="nama_jabatan">
                                <option value="">Pilih salah satu</option>
                                <?php
                                foreach ($jabatan as $key => $value) { ?>
                                    <option value="<?= $value['id_jabatan'] ?>"><?= $value['nama_jabatan'] ?></option>
                                <?php }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-6">
                            <label for="masa_kontrak">Masa Akhir Kontrak</label>
                            <input type="date" class="form-control" name="masa_kontrak" id="masa_kontrak">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-6">
                            <label for="nama_staff">Staff Penilai</label>
                            <select class="select2 form-control" name="nama_staff" id="nama_staff">
                                <option value="">Pilih salah satu</option>
                                <?php
                                foreach ($staff as $key => $value) { ?>
                                    <option value="<?= $value['id_staff'] ?>"><?= $value['nama_staff'] ?></option>
                                <?php }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-6">
                            <label for="alamat_pegawai">Alamat</label>
                            <input type="text" class="form-control" name="alamat_pegawai" id="alamat_pegawai">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-6">
                            <label for="no_telp">No Telp</label>
                            <input type="text" class="form-control" name="no_telp" id="no_telp">
                        </div>
                        <div class="form-group col-6">
                            <label for="email_pegawai">Email</label>
                            <input type="text" class="form-control" name="email_pegawai" id="email_pegawai">
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

<!-- modal ubah pegawai -->
<div class="modal fade" id="pegawai_modal_ubah">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ubah Pegawai</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="ubah_pegawai">
                    <input type="hidden" id="id_pegawai_ubah">
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="nama_pegawai_ubah">Nama Pegawai</label>
                            <input type="text" class="form-control" name="nama_pegawai_ubah" id="nama_pegawai_ubah">
                        </div>
                        <div class="form-group col-6">
                            <label for="nip_pegawai_ubah">NIP</label>
                            <input type="text" class="form-control" name="nip_pegawai_ubah" id="nip_pegawai_ubah">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-6">
                            <label for="nama_jabatan_ubah">Jabatan</label>
                            <select class="select2 form-control" name="nama_jabatan_ubah" id="nama_jabatan_ubah">

                            </select>
                        </div>
                        <div class="form-group col-6">
                            <label for="masa_kontrak_ubah">Masa Akhir Kontrak</label>
                            <input type="date" class="form-control" name="masa_kontrak_ubah" id="masa_kontrak_ubah">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-6">
                            <label for="nama_staff_ubah">Staff Penilai</label>
                            <select class="select2 form-control" name="nama_staff_ubah" id="nama_staff_ubah">

                            </select>
                        </div>
                        <div class="form-group col-6">
                            <label for="alamat_pegawai_ubah">Alamat</label>
                            <input type="text" class="form-control" name="alamat_pegawai_ubah" id="alamat_pegawai_ubah">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-6">
                            <label for="no_telp_ubah">No Telp</label>
                            <input type="text" class="form-control" name="no_telp_ubah" id="no_telp_ubah">
                        </div>
                        <div class="form-group col-6">
                            <label for="email_pegawai_ubah">Email</label>
                            <input type="text" class="form-control" name="email_pegawai_ubah" id="email_pegawai_ubah">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <label for="aktif_pegawai_ubah">Aktif</label>
                            <div class="form-check">
                                <input class="form-check-input" name="aktif_pegawai_ubah" id="aktif_pegawai_ubah" type="checkbox">
                            </div>
                        </div>
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


        $('#tambah_pegawai').validate({
            ignore: [],
            rules: {
                nama_pegawai: {
                    required:true,
                    lettersonly: true
                },
                email_pegawai: {
                    required: true,
                    email: true
                },
                nip_pegawai: {
                    required: true,
                    number: true,
                    minlength: 8
                },
                alamat_pegawai: {
                    required: true
                },
                no_telp: {
                    required: true,
                },
                nama_jabatan: {
                    required: true,
                },
                masa_kontrak: {
                    required: true,
                },
                nama_staff: {
                    required: true,
                },

            },
            messages: {
                nama_pegawai: {
                    required: "Silahkan masukkan nama pegawai",
                    lettersonly: "Silahkan masukkan huruf"
                },
                nip_pegawai: {
                    required: "Silahkan masukkan nip pegawai",
                    number: "Silahkan masukkan nip berupa angka",
                    minlength: "Silahkan masukkan nip minimal 8 angka",
                },
                email_pegawai: {
                    required: "Silahkan masukkan email pegawai",
                    email: "Email tidak sesuai"
                },
                alamat_pegawai: {
                    required: "Silahkan pilih salah satu",
                },
                no_telp: {
                    required: "Silahkan masukkan no telp",
                },
                nama_jabatan: {
                    required: "Silahkan pilih salah satu",
                },
                masa_kontrak: {
                    required: "Silahkan masa akhir kontrak",
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
                nama_pegawai = $('#nama_pegawai').val()
                nip_pegawai = $('#nip_pegawai').val()
                email_pegawai = $('#email_pegawai').val()
                alamat_pegawai = $('#alamat_pegawai').val()
                nama_jabatan = $('#nama_jabatan').val()
                masa_kontrak = $('#masa_kontrak').val()
                nama_staff = $('#nama_staff').val()
                no_telp = $('#no_telp').val()

                //console.log(nama_pengguna, email_pengguna, role_pengguna, password)
                $.ajax({
                    method: 'post',
                    url: '<?= base_url('Pegawai/tambah') ?>',
                    data: {
                        nama_pegawai: nama_pegawai,
                        nip_pegawai: nip_pegawai,
                        email_pegawai: email_pegawai,
                        alamat_pegawai: alamat_pegawai,
                        nama_jabatan: nama_jabatan,
                        masa_kontrak: masa_kontrak,
                        nama_staff: nama_staff,
                        no_telp: no_telp
                    },
                    dataType: 'json',
                    success: function(status) {
                        if (status == 1) {
                            $('#modal_tambah_pegawai').hide()
                            swall('Ditambahkan')
                        }
                    }
                })
            }

        });

        $('#ubah_pegawai').validate({
            ignore: [],
            rules: {
                nama_pegawai_ubah: 'required',
                nip_pegawai_ubah: {
                    required: true,
                    number: true,
                    minlength: 8
                },
                email_pegawai_ubah: {
                    required: true,
                    email: true
                },
                alamat_pegawai_ubah: {
                    required: true
                },
                no_telp_ubah: {
                    required: true,
                },
                nama_jabatan_ubah: {
                    required: true,
                },
                masa_kontrak_ubah: {
                    required: true,
                },
                nama_staff_ubah: {
                    required: true,
                },

            },
            messages: {
                nama_pegawai_ubah: {
                    required: "Silahkan masukkan nama pegawai",
                },
                nip_pegawai_ubah: {
                    required: "Silahkan masukkan nip pegawai",
                    number: "Silahkan masukkan nip berupa angka",
                    minlength: "Silahkan masukkan nip minimal 8 angka",
                },
                email_pegawai_ubah: {
                    required: "Silahkan masukkan email pegawai",
                    email: "Email tidak sesuai"
                },
                alamat_pegawai_ubah: {
                    required: "Silahkan pilih salah satu",
                },
                no_telp_ubah: {
                    required: "Silahkan masukkan no telp",
                },
                nama_jabatan_ubah: {
                    required: "Silahkan pilih salah satu",
                },
                masa_kontrak_ubah: {
                    required: "Silahkan masukkan masa akhir kontrak",
                },
                nama_staff_ubah: {
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
                id_pegawai = $('#id_pegawai_ubah').val()
                nama_pegawai = $('#nama_pegawai_ubah').val()
                nip_pegawai = $('#nip_pegawai_ubah').val()
                email_pegawai = $('#email_pegawai_ubah').val()
                alamat_pegawai = $('#alamat_pegawai_ubah').val()
                nama_jabatan = $('#nama_jabatan_ubah').val()
                masa_kontrak = $('#masa_kontrak_ubah').val()
                nama_staff = $('#nama_staff_ubah').val()
                no_telp = $('#no_telp_ubah').val()

                if (document.getElementById("aktif_pegawai_ubah").checked == true) {
                    status_pegawai = 1
                } else if (document.getElementById("aktif_pegawai_ubah").checked == false) {
                    status_pegawai = 0
                } else {
                    status_pegawai = $('#aktif_pegawai_ubah').val()
                }


                $.ajax({
                    method: 'post',
                    url: '<?= base_url('Pegawai/ubah') ?>',
                    data: {
                        id_pegawai: id_pegawai,
                        nama_pegawai: nama_pegawai,
                        nip_pegawai: nip_pegawai,
                        email_pegawai: email_pegawai,
                        alamat_pegawai: alamat_pegawai,
                        nama_jabatan: nama_jabatan,
                        masa_kontrak: masa_kontrak,
                        nama_staff: nama_staff,
                        no_telp: no_telp,
                        status_pegawai: status_pegawai,
                    },
                    dataType: 'json',
                    success: function(status) {
                        if (status == 1) {
                            $('#pegawai_modal_ubah').hide()
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
            tampil_pegawai_id(id)

        })

    });

    function swall($title) {
        Swal.fire({
            icon: 'success',
            title: 'Data Berhasil ' + $title,
            showConfirmButton: false,
            timer: 1500
        }).then((result) => {
            location.href = '<?= base_url('Pegawai') ?>';
        })

    }

    function tampil_pegawai_id(id) {
        $.ajax({
            method: 'POST',
            url: '<?= base_url('Pegawai/tampil_pegawai_id')  ?>',
            data: {
                id_pegawai: id,
            },
            dataType: 'json',
            success: function(data) {
                if (data.status == 1) {
                    $('#id_pegawai_ubah').val(data.id_pegawai)
                    $('#nama_pegawai_ubah').val(data.nama_pegawai)
                    $('#nip_pegawai_ubah').val(data.nip_pegawai)
                    $('#email_pegawai_ubah').val(data.email_pegawai)
                    $('#no_telp_ubah').val(data.no_telp)
                    $('#alamat_pegawai_ubah').val(data.alamat_pegawai)
                    $('#masa_kontrak_ubah').val(data.masa_kontrak)
                    aktif = data.status_pegawai
                    $('#aktif_pegawai_ubah').val(data.status_pegawai)
                    id_jabatan = data.id_jabatan
                    id_staff = data.id_staff

                    if (aktif == 1) {
                        $('#aktif_pegawai_ubah').attr('checked', true)
                    } else {
                        $('#aktif_pegawai_ubah').removeAttr('checked')
                    }

                    //tampilkan data jabatan
                    data_jabatan = data.nama_jabatan

                    baris_jabatan = '<option value="" disabled>Pilih salah satu</option>'
                    for (let i = 0; i < data_jabatan.length; i++) {
                        const jabatan = data_jabatan[i];
                        if (id_jabatan === jabatan['id_jabatan']) {
                            baris_jabatan += '<option value="' + jabatan['id_jabatan'] + '" selected>' + jabatan['nama_jabatan'] + '</option>'
                        } else {
                            baris_jabatan += '<option value="' + jabatan['id_jabatan'] + '">' + jabatan['nama_jabatan'] + '</option>'
                        }

                    }
                    $('#nama_jabatan_ubah').html(baris_jabatan)

                    //tampilkan data staff
                    data_staff = data.nama_staff

                    baris_staff = '<option value="" disabled>Pilih salah satu</option>'
                    for (let i = 0; i < data_staff.length; i++) {
                        const staff = data_staff[i];
                        if (id_staff === staff['id_staff']) {
                            baris_staff += '<option value="' + staff['id_staff'] + '" selected>' + staff['nama_staff'] + '</option>'
                        } else {
                            baris_staff += '<option value="' + staff['id_staff'] + '">' + staff['nama_staff'] + '</option>'
                        }

                    }
                    $('#nama_staff_ubah').html(baris_staff)


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
                    url: '<?= base_url('Pegawai/hapus')  ?>',
                    data: {
                        id_pegawai: id,
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