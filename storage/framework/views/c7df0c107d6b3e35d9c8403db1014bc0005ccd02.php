<div class="modal-content">
    <form id="formAction" action="<?php echo e(route('users.store')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <div class="modal-header">
            <h5 class="modal-title" id="largeModalLabel"><?php echo e($judul); ?></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
        </div>
        <div class="modal-body">
                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" placeholder="Masukan Nama" class="form-control" id="nama" name="name">
                    </div>
                </div>
            <?php if(!auth()->guard('web')->user()->getRoleNames()->first() == 'Administrator'): ?>
            <div class="col-md-12">
                <div class="mb-3">
                    <label for="kode" class="form-label">Kode</label>
                    <input type="text"
                           placeholder="Kode Ini Didapat Dari Esp82"
                           class="form-control"
                           id="kode"
                           name="kode"
                           value=""
                           disabled
                           data-toggle="tooltip"
                           data-placement="top"
                           title="Data Ini Tidak Perlu Diinput Cukup Tap KTP Ke scanner"
                    >
                </div>
            </div>
            <?php endif; ?>
            <div class="col-md-12">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" placeholder="Masukan Email" class="form-control" id="email" name="email">
                </div>
            </div>
            <div class="col-md-12">
                <div class="mb-3">
                    <label for="no_hp" class="form-label">Nomer Handphone</label>
                    <input type="text" placeholder="Masukan Nomer Hp" class="form-control" id="no_hp" name="no_hp">
                </div>
            </div>
            <div class="col-md-12">
                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <input type="text" placeholder="Masukan Alamat" class="form-control" id="alamat" name="alamat">
                </div>
            </div>
                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="text" placeholder="Masukan Password" class="form-control" id="password" name="password">
                    </div>
                </div>
            <div class="col-md-12">
                <div class="mb-3">
                    <label for="role">Role</label>
                    <select class="js-example-basic-single form-select "  name="role" id="role">
                        <?php $__currentLoopData = $role; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option></option>
                            <option value="<?php echo e($item->name); ?>"><?php echo e($item->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary"
                    data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
    </form>

</div>
<?php /**PATH C:\project\php\e-hospital\resources\views/konfigurasi/users-action.blade.php ENDPATH**/ ?>