<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Rekomendasi</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Rekomendasi</li>
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

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="card card-dark">
                                <div class="card-header">
                                    <h3 class="card-title">Tambah Kuota Pegawai</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form class="form-horizontal" method="post">
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label">Tahun</label>
                                            <div class="col-sm-10">
                                                <select name="tahun" class="form-control" id="">
                                                    <?php foreach ($tahun as $key => $value) : ?>
                                                        <option value="<?= $value['periode_tahun'] ?>"> <?= $value['periode_tahun'] ?></option>
                                                    <?php endforeach ?>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label">Jabatan</label>
                                            <div class="col-sm-10">
                                                <select name="jabatan" class="form-control select2_tambah" id="jabatan">
                                                    <option value=""></option>
                                                    <?php foreach ($jabatan as $key => $value) : ?>
                                                        <option value="<?= $value['id_jabatan'] ?>"> <?= $value['nama_jabatan'] ?></option>
                                                    <?php endforeach ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="kuota" class="col-sm-2 col-form-label">Kuota</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="kuota" id="kuota" readonly>
                                            </div>

                                        </div>

                                    </div>
                                    <!-- /.card-body -->
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">Tambah</button>
                                        <a href="<?= base_url('Rekomendasi') ?>" class="btn btn-warning text-white">Kembali</a>
                                    </div>
                                    <!-- /.card-footer -->
                                </form>
                            </div>
                            <!-- /.card -->
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

        $('.select2_tambah').select2({
            placeholder: "Pilih Jabatan",
            allowClear: true
        })

    })

    $("#jabatan").change(function(params) {
        let id_jabatan = $(this).val()

        $.ajax({
            method: 'post',
            url: '<?= base_url('Rekomendasi/tampil_kuota_pegawai') ?>',
            data: {
                id_jabatan: id_jabatan,
            },
            dataType: 'json',
            success: function(data) {
                $("#kuota").val(data.kuota)
                console.log(data.kuota)
            }
        })

    })
</script>