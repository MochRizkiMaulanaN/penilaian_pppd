<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-2">
        <h1 class="h3 mb-0 text-gray-800">Profile</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Profile</li>
        </ol>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <!-- Form Basic -->
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-primary">
                    <h6 class="m-0 font-weight-bold text-white">Profile Saya</h6>
                </div>
                <div class="card-body">
                    <form method="POST">

                        <div class="row mb-1">
                            <div class="col-md-6">
                                <label for="email">Email</label>
                                <p class="font-weight-bold"></p>
                            </div>
                            <div class="col-md-6">
                                <label for="nama">Nama Pengguna</label>
                                <p class="font-weight-bold"></p>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-md-6">
                                <label for="jabatan">Jabatan</label>
                                <p class="font-weight-bold"></p>
                            </div>
                            <div class="col-md-6">
                                <label for="perusahaan">Perusahaan</label>
                                <p class="font-weight-bold"></p>
                            </div>
                        </div>
                        
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