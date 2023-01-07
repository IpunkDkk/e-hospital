<div class="modal-content">
    <form id="formAction" action="<?php echo e(route('pasien.cari')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <div class="modal-header">
            <h5 class="modal-title" id="largeModalLabel"><?php echo e($judul); ?></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="col-md-12">
                <div class="mb-3">
                    <label for="kode" class="form-label">Kode</label>
                    <input type="text"
                           placeholder="Kode Ini Didapat Dari Esp82"
                           class="form-control"
                           id="kode"
                           name="kode"
                           value=""
                           readonly
                           data-toggle="tooltip"
                           data-placement="top"
                           title="Data Ini Tidak Perlu Diinput Cukup Tap KTP Ke scanner"
                    >
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary"
                    data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Cari</button>
        </div>
    </form>

</div>
<?php /**PATH C:\project\php\e-hospital\resources\views/rekam/pasien-cari.blade.php ENDPATH**/ ?>