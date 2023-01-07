<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.13.1/r-2.4.0/sc-2.0.7/datatables.min.css"/>
    <link href="<?php echo e(asset('')); ?>vendor/select2/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo e(asset('')); ?>vendor/izitoast/dist/css/iziToast.min.css">

<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <div class="main-content">
        <div class="title">
            Rekam Medis
        </div>
        <div class="content-wrapper">
            <div class="row same-height">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex bd-highlight mb-3">
                            <div class="me-auto p-2 bd-highlight">
                                <h4>Detail Pasien</h4>
                            </div>
                            <div class="p-2 bd-highlight">
                                <a type="button" class="btn btn-primary btn-sm flex-" href="<?php echo e(redirect()->getUrlGenerator()->previous()); ?>">Kembali</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <tr>
                                    <th>Nama</th>
                                    <th><?php echo e($user->profile->name); ?></th>
                                </tr>
                                <tr>
                                    <th>Kode</th>
                                    <th><?php echo e($user->kode); ?></th>
                                </tr>
                                <tr>
                                    <th>Nik</th>
                                    <th><?php echo e($user->profile->no_kk); ?></th>
                                </tr>
                                <tr>
                                    <th>No Hp</th>
                                    <th><?php echo e($user->profile->no_hp); ?></th>

                                <tr>
                                    <th>Alamat</th>
                                    <th><?php echo e($user->profile->alamat); ?></th>
                                </tr>
                            </table>
                        </div>
                        <div class="card-header d-flex bd-highlight mb-3">
                            <div class="me-auto p-2 bd-highlight">
                                <h4>Rekam Medik</h4>
                            </div>
                            <div class="p-2 bd-highlight">
                                <button type="button" class="btn btn-primary btn-sm mb-3 btn-add">Tambah Rekam Medik</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table" id="rekam-data">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode</th>
                                    <th>Masuk</th>
                                    <th>Keluhan</th>
                                    <th>Status</th>
                                    <th>Opsi</th>
                                </tr>
                                </thead>
                            </table>
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
        <input type="hidden" id="table-user-url" value="<?php echo e(route('rekam.data', $user->id)); ?>">
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('js'); ?>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.13.1/r-2.4.0/sc-2.0.7/datatables.min.js"></script>
    <script src="<?php echo e(asset('')); ?>vendor/select2/dist/js/select2.min.js"></script>
    <script src="<?php echo e(asset('')); ?>vendor/izitoast/dist/js/iziToast.min.js"></script>
    <script>
        const modal = new bootstrap.Modal($('#modalAction'));
        $('.btn-add').on('click', function (){
            $.ajax({
                method:'get',
                url:`<?php echo e(url('rekam-medis/pasien/rekam-medik/create/' . $user->id)); ?>`,
                success: function (ress) {
                    $('#modalAction').find('.modal-dialog').html(ress).ready(function () {
                        let idModal = $('#modalAction')
                        $('#masuk').select2({
                            placeholder: 'Pilih Masuk',
                            dropdownParent: idModal
                        })
                        $('#k-krs').select2({
                            placeholder: 'Masukan Keadaan Keluar',
                            dropdownParent: idModal
                        })
                        $('#c-krs').select2({
                            placeholder: 'Masukan Keadaan Pulang',
                            dropdownParent: idModal
                        })
                        $('#c-mrs').select2({
                            placeholder: 'Masukan Cara Masuk',
                            dropdownParent: idModal
                        })
                        $('#d-merawat').select2({
                            placeholder: 'Masukan Dokter Merawat',
                            dropdownParent: idModal
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
                            let table = $('#rekam-data').DataTable();
                            table.cleanData;
                            table.ajax.reload();
                            modal.hide()
                            iziToast.success({
                                title: ress.status,
                                message: ress.massage,
                                position: 'topRight'
                            });
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
    </script>
    <script>
        $('#rekam-data').DataTable({
            searching : false,
            ordering: true,
            scrollCollapse: true,
            scrollX:true,
            serverSide:true,
            processing: true,
            // responsive:true,
            ajax: {
                url: $('#table-user-url').val()
            },
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', width: '10px', orderable: false, searchable: false},
                {data: 'no-medik', name: 'no-medik'},
                {data: 'masuk', name: 'masuk'},
                {data: 'd-utama', name: 'd-utama'},
                {data: 'status', name: 'status', orderable: false, searchable: false, class: 'text-center'},
                {data: 'opsi', name: 'opsi', orderable: false, searchable: false, class: 'text-center'}
            ],
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('panels.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\project\php\e-hospital\resources\views/rekam/pasien-show.blade.php ENDPATH**/ ?>