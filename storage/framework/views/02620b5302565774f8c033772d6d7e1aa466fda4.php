

<?php $__env->startPush('css'); ?>
    <link href="<?php echo e(asset('')); ?>vendor/datatables.net-dt/css/jquery.dataTables.min.css" rel="stylesheet" />
    <link href="<?php echo e(asset('')); ?>vendor/datatables.net-responsive-dt/css/responsive.dataTables.min.css" rel="stylesheet" />
    <link href="<?php echo e(asset('')); ?>vendor/select2/dist/css/select2.min.css" rel="stylesheet" />
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="main-content">
        <div class="title">
            Konfigurasi
        </div>
        <div class="content-wrapper">
            <div class="row same-height">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Roles</h4>
                        </div>
                        <div class="card-body">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create konfigurasi/roles')): ?>
                                <button type="button" class="btn btn-primary mb-3 btn-add">Tambah Role</button>
                            <?php endif; ?>
                            <?php echo e($dataTable->table()); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modalAction" tabindex="-1" aria-labelledby="largeModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-lg">
            </div>
        </div>

    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
    <script src="<?php echo e(asset('')); ?>vendor/jquery/dist/jquery.min.js"></script>
    <script src="<?php echo e(asset('')); ?>vendor/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo e(asset('')); ?>vendor/datatables/buttons.server-side.js"></script>
    <script src="<?php echo e(asset('')); ?>vendor/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?php echo e(asset('')); ?>vendor/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <script src="<?php echo e(asset('')); ?>vendor/select2/dist/js/select2.min.js"></script>
    <?php echo e($dataTable->scripts()); ?>

    <script>

        const modal = new bootstrap.Modal($('#modalAction'));

        $('.btn-add').on('click', function (){
            $.ajax({
                method:'get',
                url:`<?php echo e(url('konfigurasi/roles/create')); ?>`,
                success: function (ress) {
                    $('#modalAction').find('.modal-dialog').html(ress).ready(function () {
                        $('.js-example-placeholder-multiple').select2({
                            placeholder: 'Select Permissions',
                            dropdownParent: $('#modalAction')
                        })
                    })
                    modal.show();
                    store()
                }
            })
            function store(){
                $('#formAction').on('submit', function (e){
                    e.preventDefault()
                    const _form = this
                    const Data = new FormData(_form)
                    const urls = this.getAttribute('action');
                    $.ajax({
                        method:'POST',
                        url:urls,
                        headers: {
                            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                        },
                        data:Data,
                        processData:false,
                        contentType:false,
                        success: function (ress) {
                            window.LaravelDataTables["role-table"].ajax.reload()
                            modal.hide()
                        },
                        error: function (ress){
                            let errors = ress.responseJSON?.errors
                            $(_form).find('.text-danger.text-small').remove()
                            if (errors){
                                for (const [key, value] of Object.entries(errors)){
                                    $(`[name='${key}']`).parent().append(`<span class="text-danger text-small">${value}</span>`)
                                }
                            }
                            console.log(errors);
                        }
                    })
                })
            }

            return
        })


        $('#role-table').on('click', '.action', function (){
            let data = $(this).data();
            let id = data.id;
            let jenis = data.type;

            if (jenis == 'delete'){
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            method:'delete',
                            url:`<?php echo e(url('konfigurasi/roles')); ?>/${id}`,
                            headers: {
                                'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function (ress) {
                                window.LaravelDataTables["role-table"].ajax.reload()
                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success'
                                )
                            }
                        })
                    }
                })
                return
            }

            $.ajax({
                method:'get',
                url:`<?php echo e(url('konfigurasi/roles')); ?>/${id}/edit`,
                success: function (ress) {
                    $('#modalAction').find('.modal-dialog').html(ress).ready(function () {
                        $('.js-example-placeholder-multiple').select2({
                            placeholder: 'Select Permissions',
                            dropdownParent: $('#modalAction')
                        })
                    })
                    modal.show();
                    store()
                }
            })

            function store(){
                $('#formAction').on('submit', function (e){
                    e.preventDefault()
                    const _form = this
                    const Data = new FormData(_form)
                    const urls = this.getAttribute('action');
                    $.ajax({
                        method:'POST',
                        url:urls,
                        headers: {
                            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                        },
                        data:Data,
                        processData:false,
                        contentType:false,
                        success: function (ress) {
                            window.LaravelDataTables["role-table"].ajax.reload()
                            modal.hide()
                        },
                        error: function (ress){
                            let errors = ress.responseJSON?.errors
                            $(_form).find('.text-danger.text-small').remove()
                            if (errors){
                                for (const [key, value] of Object.entries(errors)){
                                    $(`[name='${key}']`).parent().append(`<span class="text-danger text-small">${value}</span>`)
                                }
                            }
                            console.log(errors);
                        }
                    })
                })
            }

        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('panels.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\project\php\e-hospital\resources\views/konfigurasi/role.blade.php ENDPATH**/ ?>