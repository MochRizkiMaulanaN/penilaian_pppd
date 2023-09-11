<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Kuota Pegawai</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Kuota Pegawai</li>
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
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_tambah_kuota">
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
                                        <th>Nama Jabatan</th>
                                        <th>Jumlah Kuota</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($kuota_pegawai as $key => $value) { ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $value['nama_jabatan'] ?></td>
                                            <td><?= $value['jumlah_kuota'] ?></td>
                                            <td>
                                                <button class="btn btn-warning btn-sm btn_ubah" data-toggle="modal" data-target="#modal_ubah_kuota" data-id="<?= $value['id_kuotaPegawai'] ?>"><i class="fas fa-solid fa-pencil-alt"></i></button>

                                                <button class="btn btn-danger btn-sm btn_hapus" data-id="<?= $value['id_kuotaPegawai'] ?>"><i class="fas fa-solid fa-trash"></i></button>

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
<div class="modal fade" id="modal_tambah_kuota">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Kuota Pegawai</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="tambah_kuota">

                    <div class="form-group">
                        <label for="tgl_penilaian">Nama Jabatan</label>
                        <select class="form-control select2_jabatan" name="jabatan" id="jabatan">
                            <option value=""></option>
                            <?php
                            foreach ($jabatan as $key => $value) : ?>
                                <option value="<?= $value['id_jabatan'] ?>"><?= $value['nama_jabatan'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="thn_periode">Jumlah Kuota</label>
                        <input class="form-control" id="jumlah_kuota" name="jumlah_kuota" type="text">
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

<!-- modal tambah periode -->
<div class="modal fade" id="modal_ubah_kuota">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ubah Kuota Pegawai</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="ubah_kuota">
                    <input type="hidden" id="id_kuotaPegawai_ubah">
                    <div class="form-group">
                        <label for="">Nama Jabatan</label>
                        <select class="form-control select2_jabatan" name="jabatan_ubah" id="jabatan_ubah">

                        </select>
                    </div>

                    <div class="form-group">
                        <label for="">Jumlah Kuota</label>
                        <input class="form-control" id="jumlah_kuota_ubah" name="jumlah_kuota_ubah" type="text">
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
        $('.select2_tambah').select2({
            placeholder: "Pilih Periode Tahun",
            allowClear: true
        })

        $('.select2_jabatan').select2({
            placeholder: "Pilih Jabatan",
            allowClear: true
        })

        $('.select2_hapus').select2({
            placeholder: "Pilih Periode Tahun",
            allowClear: true
        })


        $('#tambah_kuota').validate({
            ignore: [],
            rules: {
                jabatan: {
                    required: true,
                },
                jumlah_kuota: {
                    required: true,
                    number: true,
                }
            },
            messages: {
                jabatan: {
                    required: "Silahkan pilih jabatan",
                },
                jumlah_kuota: {
                    required: "Silahkan masukkan jumlah kuota",
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
                jabatan = $('#jabatan').val()
                jumlah_kuota = $('#jumlah_kuota').val()

                $.ajax({
                    method: 'post',
                    url: '<?= base_url('Kuota_pegawai/tambah') ?>',
                    data: {
                        jabatan: jabatan,
                        jumlah_kuota: jumlah_kuota,
                    },
                    dataType: 'json',
                    success: function(data) {
                        console.log(status)
                        if (data.status == 1) {
                            $('#modal_tambah_kuota').hide()
                            swall('Ditambahkan')
                        } else {
                            $('#modal_tambah_kuota').hide()
                            swall_gagal('Ditambahkan')
                        }
                    }
                })
            }

        });

        $('#ubah_kuota').validate({
            ignore: [],
            rules: {
                jabatan: {
                    required: true,
                },
                jumlah_kuota: {
                    required: true,
                    number: true,
                }
            },
            messages: {
                jabatan: {
                    required: "Silahkan pilih jabatan",
                },
                jumlah_kuota: {
                    required: "Silahkan masukkan jumlah kuota",
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
                id_kuotaPegawai = $('#id_kuotaPegawai_ubah').val()
                jabatan = $('#jabatan_ubah').val()
                jumlah_kuota = $('#jumlah_kuota_ubah').val()

                $.ajax({
                    method: 'post',
                    url: '<?= base_url('Kuota_pegawai/ubah') ?>',
                    data: {
                        id_kuotaPegawai: id_kuotaPegawai,
                        jabatan: jabatan,
                        jumlah_kuota: jumlah_kuota,
                    },
                    dataType: 'json',
                    success: function(data) {
                        if (data.status == 1) {
                            $('#modal_ubah_kuota').hide()
                            swall('Diubah')
                        } else {
                            $('#modal_ubah_kuota').hide()
                            swall_gagal('Diubah')
                        }
                    }
                })
            }

        });

        $('#hapus_periode').validate({
            ignore: [],
            rules: {
                hapus_tahun: 'required',

            },
            messages: {
                hapus_tahun: {
                    required: "Silahkan masukkan tahun periode",
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
                tahun = $('#hapus_tahun').val()

                $.ajax({
                    method: 'post',
                    url: '<?= base_url('Periode_penilaian/hapus') ?>',
                    data: {
                        tahun: tahun,
                    },
                    dataType: 'json',
                    success: function(status) {
                        console.log(status)
                        if (status == 1) {
                            $('#modal_hapus_periode').hide()
                            swall('Dihapus')
                        } else {
                            $('#modal_hapus_periode').hide()
                            swall_gagal('Dihapus')
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

        $('.btn_ubah').click(function() {
            id = $(this).data('id');
            tampil_kuotaPegawai_id(id)

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
                    url: '<?= base_url('Kuota_pegawai/hapus')  ?>',
                    data: {
                        id_kuotaPegawai: id,
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
            showConfirmButton: true,
            confirmButtonText: 'Ok',
        }).then((result) => {
            location.reload();
        })

    }

    function tampil_kuotaPegawai_id(id) {
        $.ajax({
            method: 'POST',
            url: '<?= base_url('Kuota_pegawai/tampil_kuotaPegawai_id')  ?>',
            data: {
                id_kuotaPegawai: id,
            },
            dataType: 'json',
            success: function(data) {
                if (data.status == 1) {
                    $('#id_kuotaPegawai_ubah').val(data.id_kuotaPegawai)
                    $('#jumlah_kuota_ubah').val(data.jumlah_kuota)
                    let jabatan_id = data.jabatan_id

                    //tampilkan data jabatan
                    data_jabatan = data.jabatan

                    baris = '<option value="" disabled>Pilih salah satu</option>'
                    for (let i = 0; i < data_jabatan.length; i++) {
                        const jabatan = data_jabatan[i];
                        if (jabatan_id === jabatan['id_jabatan']) {
                            baris += '<option value="' + jabatan['id_jabatan'] + '" selected>' + jabatan['nama_jabatan'] + '</option>'
                        } else {
                            baris += '<option value="' + jabatan['id_jabatan'] + '">' + jabatan['nama_jabatan'] + '</option>'
                        }

                    }
                    $('#jabatan_ubah').html(baris)

                }
            }

        })
    }
</script>