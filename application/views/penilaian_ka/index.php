<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Penilaian</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('Halaman_utama'); ?>">Halaman utama</a></li>
            <li class="breadcrumb-item active" aria-current="page">Penilaian</li>
        </ol>
    </div>

    <div class="row">
        <!-- DataTable with Hover -->
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#modal_tambah"><i class="fa fa-plus"></i> Tambah Data</button>
                    <button class="btn btn-danger ml-2" data-toggle="modal" data-target="#modal_hapus"><i class="fa fa-trash"></i> Hapus Data</button>

                </div><?php if ($this->session->flashdata('pesan')) { ?>
                    <div class="card-header py-3 ">
                        <?= $this->session->flashdata('pesan'); ?>
                    </div>
                <?php } ?>
                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush " id="dataTable">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>Tanggal Penilaian</th>
                                <th>NIK</th>
                                <th>Nama Sequrity</th>
                                <th>Nama Perusahaan</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Tanggal Penilaian</th>
                                <th>NIK</th>
                                <th>Nama Sequrity</th>
                                <th>Nama Perusahaan</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($penilaian_ka as $key => $value) { ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= date('d-F-Y', strtotime($value['tanggal_penilaian'])) ?></td>
                                    <td><?= $value['nik'] ?></td>
                                    <td><?= $value['nama_sequrity'] ?></td>
                                    <td><?= $value['nama_perusahaan'] ?></td>
                                    <td><?= $value['status'] ?></td>
                                    <td>
                                        <?php
                                        if ($value['status'] == 'Belum Dinilai') { ?>
                                            <a href="<?= base_url('Penilaian_ka/form_penilaian/' . $value['nama_sequrity'] . '/' . $value['nama_perusahaan'] . '/' . $value['id_sequrity']) ?>" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>
                                        <?php } else { ?>
                                            <a href="<?= base_url('Penilaian_ka/hasil_penilaian/' . $value['id_sequrity'] . '/' . $value['nama_sequrity'] . '/' . $value['nama_perusahaan']) ?>" class="btn btn-success btn-sm"><i class="fa fa-check"></i></a>

                                            <a href="<?= base_url('Penilaian_ka/edit_penilaian/' . $value['nama_sequrity'] . '/' . $value['nama_perusahaan'] . '/' . $value['id_sequrity']) ?>" class="btn btn-warning btn-sm"><i class="fa fa-pencil-alt"></i></a>
                                        <?php }
                                        ?>

                                    </td>
                                </tr>
                            <?php }
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
<!---Container Fluid-->

<!-- Modal tambah -->
<div class="modal fade" id="modal_tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Penilaian</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form">
                    <div class="form-group">
                        <label for="perusahaan">Nama Perusahaan</label>
                        <select class="select2-single-placeholder form-control" id="perusahaan" onchange="tampil_jumlah()">
                            <option value="">Pilih perusahaan</option>
                            <?php foreach ($perusahaan as $key => $value) { ?>
                                <option value="<?= $value['id_perusahaan']; ?>"><?= $value['nama_perusahaan']; ?></option>
                            <?php } ?>
                        </select>
                        <small class="form-text text-danger" id="nama_perusahaan_error"></small>
                    </div>
                    <div class="form-group">
                        <label for="jml_sequrity">Jumlah Sequrity</label>
                        <input type="text" class="form-control" id="jml_sequrity" readonly>
                    </div>
                    <div class="form-group">
                        <label for="tgl_penilaian">Tanggal Penilaian</label>
                        <input type="date" class="form-control" id="tgl_penilaian">
                        <small class="form-text text-danger" id="tgl_penilaian_error"></small>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="reset()" class="btn btn-outline-danger" data-dismiss="modal">Tutup</button>
                <button type="button" onclick="tambah()" class="btn btn-primary">Tambah</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal hapus -->
<div class="modal fade" id="modal_hapus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hapus Data Penilaian</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form" method="post" action="<?= base_url('Penilaian_ka/hapus') ?>">
                    <div class="form-group">
                        <label for="perusahaan">Nama Perusahaan</label>
                        <select class="select2-single-placeholder form-control" name="perusahaan">
                            <option value="">Pilih perusahaan</option>
                            <?php foreach ($hapus_perusahaan as $key => $value) { ?>
                                <option value="<?= $value['id_perusahaan']; ?>"><?= $value['nama_perusahaan']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-danger">Hapus</button>
            </div>
            </form>
        </div>
    </div>
</div>

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
        tanggal_penilaian = $('#tgl_penilaian').val()

        $.ajax({
            method: 'POST',
            url: '<?= base_url('Penilaian_ka/tambah')  ?>',
            data: {
                nama_perusahaan: nama_perusahaan,
                jumlah_sequrity: jumlah_sequrity,
                tanggal_penilaian: tanggal_penilaian
            },
            dataType: 'json',
            success: function(data) {
                if (data.status == 'gagal') {
                    $('#nama_perusahaan_error').html(data.nama_perusahaan)
                    $('#tgl_penilaian_error').html(data.tanggal_penilaian)
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