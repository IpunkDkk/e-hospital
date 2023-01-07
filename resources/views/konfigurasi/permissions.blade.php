@extends('panels.master')

@push('css')
    <link href="{{asset('')}}vendor/datatables.net-dt/css/jquery.dataTables.min.css" rel="stylesheet" />
    <link href="{{asset('')}}vendor/datatables.net-responsive-dt/css/responsive.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/scroller/2.0.7/css/scroller.dataTables.min.css" rel="stylesheet">
@endpush

@section('content')
    <div class="main-content">
        <div class="title">
            Konfigurasi
        </div>
        <div class="content-wrapper">
            <div class="row same-height">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Permissions</h4>
                        </div>
                        <div class="card-body">
                            @can('create konfigurasi/permissions')
                                <button type="button" class="btn btn-primary mb-3 btn-add">Tambah Permissions</button>
                            @endcan
                            {{$dataTable->table()}}
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
@endsection

@push('js')
    <script src="{{asset('')}}vendor/jquery/dist/jquery.min.js"></script>
    <script src="{{asset('')}}vendor/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{asset('')}}vendor/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{asset('')}}vendor/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdn.datatables.net/scroller/2.0.7/js/dataTables.scroller.min.js"></script>
    {{$dataTable->scripts()}}

    <script>

        const modal = new bootstrap.Modal($('#modalAction'));

        $('.btn-add').on('click', function (){
            $.ajax({
                method:'get',
                url:`{{ url('konfigurasi/permissions/create')}}`,
                success: function (ress) {
                    $('#modalAction').find('.modal-dialog').html(ress)
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
                            window.LaravelDataTables["permission-table"].ajax.reload()
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


        $('#permission-table').on('click', '.action', function (){
            let data = $(this).data();
            let id = data.id;
            let jenis = data.type;
            console.log("test");

            if (jenis == 'delete'){
                console.log(id);
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
                            url:`{{ url('konfigurasi/permissions')}}/${id}`,
                            headers: {
                                'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function (ress) {
                                window.LaravelDataTables["permission-table"].ajax.reload()

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
                url:`{{ url('konfigurasi/permissions')}}/${id}/edit`,
                success: function (ress) {
                    $('#modalAction').find('.modal-dialog').html(ress)
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
                            window.LaravelDataTables["permission-table"].ajax.reload()

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
@endpush
