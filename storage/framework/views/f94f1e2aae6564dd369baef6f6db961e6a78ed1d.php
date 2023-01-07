<div class="modal-content">
    <form id="formAction" action="<?php echo e($role->id ? route('roles.update', $role->id) : route('roles.store')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <div class="modal-header">
            <h5 class="modal-title" id="largeModalLabel"><?php echo e($judul); ?></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
        </div>
        <div class="modal-body">
                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="role" class="form-label">Role</label>
                        <input type="text" placeholder="Masukan Nama Role" value="<?php echo e($role->name); ?>" class="form-control" id="role" name="name">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="guard" class="form-label">Guard</label>
                        <input type="text" placeholder="Masukan Nama Guard" value="<?php echo e($role->guard_name); ?>" class="form-control" id="guard" name="guard_name">
                    </div>
                </div>
            <?php if(!$role->id): ?>
                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="permissions">Permissions</label>
                        <select class="js-example-placeholder-multiple" data-control="select2" name="permissions[]" id="permissions" multiple>
                            <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($item->name); ?>"><?php echo e($item->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary"
                    data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
    </form>

</div>
<?php /**PATH C:\project\php\e-hospital\resources\views/konfigurasi/role-action.blade.php ENDPATH**/ ?>