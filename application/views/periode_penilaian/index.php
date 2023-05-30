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
                            <table id="example1" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Tanggal Penilaian</th>
                                        <th>Nama Penilai</th>
                                        <th>Staff</th>
                                        <th>Jumlah</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    
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
                <form id="tambah_staff">
                    <div class="form-group">
                        <label for="nama_penilai">Nama Penilai</label>
                        <input type="text" class="form-control" name="nama_penilai" id="nama_penilai">
                    </div>
                    <div class="form-group">
                        <label for="nip_staff">NIP</label>
                        <input type="text" class="form-control" name="nip_staff" id="nip_staff">
                    </div>
                    <div class="form-group">
                        <label for="nama_staff">Nama Staff</label>
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
                        <label for="nama_penilai_ubah">Nama Penilai</label>
                        <input type="text" class="form-control" name="nama_penilai_ubah" id="nama_penilai_ubah">
                    </div>
                    <div class="form-group">
                        <label for="nip_staff_ubah">NIP</label>
                        <input type="text" class="form-control" name="nip_staff_ubah" id="nip_staff_ubah">
                    </div>
                    <div class="form-group">
                        <label for="nama_staff_ubah">Nama Staff</label>
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
        // Select2 Single  with Placeholder
        $('.select2-single-placeholder').select2({
            placeholder: "Pilih Perusahaan",
            allowClear: true,
            // dropdownParent: $("#modal_tambah")
        });

    })

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

    function reset() {
        $('#form')[0].reset();
    }

    function tambah() {
        nama_perusahaan = $('#perusahaan').val()
        jumlah_sequrity = $('#jml_sequrity').val()
        tgl_periode = $('#tgl_periode').val()

        $.ajax({
            method: 'POST',
            url: '<?= base_url('Periode_penilaian/tambah')  ?>',
            data: {
                nama_perusahaan: nama_perusahaan,
                jumlah_sequrity: jumlah_sequrity,
                tgl_periode: tgl_periode
            },
            dataType: 'json',
            success: function(data) {
                if (data.status == 'gagal') {
                    $('#nama_perusahaan_error').html(data.nama_perusahaan)
                    $('#tgl_periode_error').html(data.tgl_periode)
                } else
                if (data.status == 'berhasil') {
                    $('#modal_tambah').modal('hide')
                    swall('Ditambahkan')
                }
            }

        })
    }

    function tampil_jumlah() {
        perusahaan = $('#perusahaan').val()
        $.ajax({
            method: 'POST',
            url: '<?= base_url('Penilaian_ka/tampil_jumlah')  ?>',
            data: {
                perusahaan: perusahaan,
            },
            dataType: 'json',
            success: function(data) {
                $('#jml_sequrity').val(data)
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
                    url: '<?= base_url('Penilaian_ka/hapus')  ?>',
                    data: {
                        id: id,
                    },
                    dataType: 'json',
                    success: function(data) {
                        if (data == 'berhasil') {
                            swall('Dihapus')
                        }
                    }

                })
            }
        })
    }
</script>