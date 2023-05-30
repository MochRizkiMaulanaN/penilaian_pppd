<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-2">
        <h1 class="h3 mb-0 text-gray-800">Form Penilaian</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('Penilaian_ka'); ?>">Penilaian</a></li>
            <li class="breadcrumb-item active" aria-current="page">Form Penilaian</li>
        </ol>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <!-- Form Basic -->
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-primary">
                    <h6 class="m-0 font-weight-bold text-white"><?= $nama_sequrity ?> - <?= $nama_perusahaan ?></h6>
                </div>
                <div class="card-body">
                    <form method="post">
                        <div class="row">
                            <div class="col-sm-3">
                                <small class="form-text text-danger"><?= form_error('total_hadir') ?></small>
                                <small class="form-text text-danger"><?= form_error('total_tidak_hadir') ?></small>
                                <small class="form-text text-danger"><?= form_error('lari') ?></small>
                            </div>
                            <div class="col-sm-3">
                                <small class="form-text text-danger"><?= form_error('pull_up') ?></small>
                                <small class="form-text text-danger"><?= form_error('sit_up') ?></small>
                            </div>
                            <div class="col-sm-3">
                                <small class="form-text text-danger"><?= form_error('push_up') ?></small>
                                <small class="form-text text-danger"><?= form_error('shuttle_run') ?></small>
                            </div>
                        </div>

                        <table id="form_penilaian" style="width: 100%;">
                            <tr>
                                <th>Kriteria</th>
                                <th>Subkriteria</th>
                                <th>Nilai</th>
                            </tr>
                            <tr>
                                <th>Kehadiran</th>
                                <td></td>
                                <td>
                                    <input class="form-control" type="number" name="total_hadir" placeholder="Masukkan total hadir  (P)">
                                    <input class="form-control" type="number" name="total_tidak_hadir" placeholder="Masukkan total tidak hadir (A)">
                                </td>
                            </tr>
                            <tr>
                                <th rowspan="5">SMAPTA</th>
                                <td>Lari 3200 Meter</td>
                                <td>
                                    <input class="form-control" type="number" name="lari">
                                </td>
                            </tr>
                            <tr>
                                <td>Pull Up</td>
                                <td>
                                    <input class="form-control" type="number" name="pull_up">
                                </td>
                            </tr>
                            <tr>
                                <td>Sit up</td>
                                <td>
                                    <input class="form-control" type="number" name="sit_up">
                                </td>
                            </tr>
                            <tr>
                                <td>Push Up</td>
                                <td>
                                    <input class="form-control" type="number" name="push_up">
                                </td>
                            </tr>
                            <tr>
                                <td>Shuttle Run</td>
                                <td>
                                    <input class="form-control" type="number" name="shuttle_run">
                                </td>
                            </tr>
                        </table>
                        <button style="width: 100%; margin-top: 1%;" type="submit" class="btn btn-primary btn-sm">SIMPAN NILAi</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
<!---Container Fluid-->

<script>
    $(function() {
        // Select2 Single  with Placeholder
        $('.select2-single-placeholder').select2({
            placeholder: "Pilih Perusahaan",
            allowClear: true,
            // dropdownParent: $("#modal_tambah")
        });

    })
</script>