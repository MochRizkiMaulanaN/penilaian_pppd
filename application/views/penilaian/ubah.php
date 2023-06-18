<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Ubah Data Penilaian</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">Ubah Data Penilaian</li>
                        <li class="breadcrumb-item active"><?= $pegawai['nama_pegawai'] ?></li>
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
                        <div class="card-header bg-primary">
                            <h7><?= $pegawai['nip_pegawai'] ?> - <?= $pegawai['nama_pegawai'] ?> (<?= $pegawai['nama_staff'] ?>) </h7>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-hover">
                                <thead>
                                    <input type="hidden" id="penilaian_id" value="<?= $pegawai['id_penilaian'] ?>">
                                    <input type="hidden" id="pegawai_id" value="<?= $pegawai['pegawai_id'] ?>">
                                    <?php
                                    foreach ($detail_penilaian as $key => $dpvalue) { ?>

                                        <tr>
                                            <th class="text-white" bgcolor="#8496a9" colspan="2"><?= $dpvalue['nama_kriteria']; ?></th>
                                        </tr>
                                        <tr>
                                            <td>
                                                <?= $dpvalue['nama_subkriteria'] ?>
                                            </td>
                                            <td>
                                                <input type="hidden" id="subkriteria<?= $dpvalue['subkriteria_id'] ?>" value="<?= $dpvalue['subkriteria_id'] ?>">
                                                <select name="" id="nilaisub<?= $dpvalue['subkriteria_id'] ?>" class="form-control">
                                                    <?php foreach ($level_nilai as $key => $value) { ?>
                                                        <option value="<?= $value['nilai_level'] ?>" <?= $dpvalue['nilai'] == $value['nilai_level'] ? 'selected' : null  ?>><?= $value['nilai_level'] ?> - <?= $value['nama_level'] ?></option>
                                                    <?php } ?>
                                                    <?php
                                                    ?>

                                                </select>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                            <div class="mt-3">
                                <button onclick="tambah()" class="btn btn-primary">Submit</button>
                                <a href="<?= base_url('Penilaian') ?>" class="btn btn-warning text-white">Kembali</a>
                            </div>

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
    function swall($title) {
        Swal.fire({
            icon: 'success',
            title: 'Data Berhasil ' + $title,
            showConfirmButton: false,
            timer: 1500
        }).then((result) => {
            location.href = '<?= base_url('Penilaian') ?>';
        })

    }

    function ubah() {
        Swal.fire({
            title: 'Apakah kamu yakin?',
            text: "sudah selesai dan ingin menyimpan data penilain ini",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, simpan!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                pegawai_id = $('#pegawai_id').val()
                penilaian_id = $('#penilaian_id').val()
                subkriteria1 = $('#subkriteria1').val()
                subkriteria2 = $('#subkriteria2').val()
                subkriteria3 = $('#subkriteria3').val()
                subkriteria4 = $('#subkriteria4').val()
                subkriteria5 = $('#subkriteria5').val()
                subkriteria6 = $('#subkriteria6').val()
                subkriteria7 = $('#subkriteria7').val()
                subkriteria8 = $('#subkriteria8').val()
                subkriteria9 = $('#subkriteria9').val()
                subkriteria10 = $('#subkriteria10').val()
                subkriteria11 = $('#subkriteria11').val()
                subkriteria12 = $('#subkriteria12').val()

                nilaisub1 = $('#nilaisub1').val()
                nilaisub2 = $('#nilaisub2').val()
                nilaisub3 = $('#nilaisub3').val()
                nilaisub4 = $('#nilaisub4').val()
                nilaisub5 = $('#nilaisub5').val()
                nilaisub6 = $('#nilaisub6').val()
                nilaisub7 = $('#nilaisub7').val()
                nilaisub8 = $('#nilaisub8').val()
                nilaisub9 = $('#nilaisub9').val()
                nilaisub10 = $('#nilaisub10').val()
                nilaisub11 = $('#nilaisub11').val()
                nilaisub12 = $('#nilaisub12').val()

                $.ajax({
                    method: 'post',
                    url: '<?= base_url('Penilaian/tambah') ?>',
                    data: {
                        pegawai_id: pegawai_id,
                        penilaian_id: penilaian_id,
                        subkriteria1: subkriteria1,
                        subkriteria2: subkriteria2,
                        subkriteria3: subkriteria3,
                        subkriteria4: subkriteria4,
                        subkriteria5: subkriteria5,
                        subkriteria6: subkriteria6,
                        subkriteria7: subkriteria7,
                        subkriteria8: subkriteria8,
                        subkriteria9: subkriteria9,
                        subkriteria10: subkriteria10,
                        subkriteria11: subkriteria11,
                        subkriteria12: subkriteria12,
                        nilaisub1: nilaisub1,
                        nilaisub2: nilaisub2,
                        nilaisub3: nilaisub3,
                        nilaisub4: nilaisub4,
                        nilaisub5: nilaisub5,
                        nilaisub6: nilaisub6,
                        nilaisub7: nilaisub7,
                        nilaisub8: nilaisub8,
                        nilaisub9: nilaisub9,
                        nilaisub10: nilaisub10,
                        nilaisub11: nilaisub11,
                        nilaisub12: nilaisub12,
                    },
                    dataType: 'json',
                    success: function(status) {
                        if (status == 1) {
                            swall('Ditambahkan')
                        }
                    }
                })
            }
        })
    }
</script>