@extends('panels.master')

@push('css')
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.13.1/r-2.4.0/sc-2.0.7/datatables.min.css"/>
    <link rel="stylesheet" href="{{asset('')}}vendor/izitoast/dist/css/iziToast.min.css">
    @vite('resources/css/app.css')

@endpush

@section('content')
    <div class="main-content">
        <div class="title">
            Rekam Medis
        </div>
        <div class="content-wrapper">
            <div class="row same-height">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Pasien</h4>
                        </div>
                        <div class="card-body">
                            <div class="d-flex flex-row bd-highlight mb-3">
                                <div class="p-2 bd-highlight">
                                    @can('create rekam-medis/pasien')
                                        <button type="button" class="btn btn-primary mb-3 btn-add">Tambah Pasien</button>
                                    @endcan
                                </div>
                                <div class="p-2 bd-highlight">
                                    <button type="button" class="btn btn-info mb-3 btn-cari">Cari Pasien</button>
                                </div>
                            </div>

                            <table class="table" id="table-pasien">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Kode</th>
                                    <th>Email</th>
                                    <th>Opsi</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
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
        <input type="hidden" id="table-user-url" value="{{route('pasien.data')}}">
    </div>
@endsection

@push('js')
    @vite('resources/js/app.js')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.13.1/r-2.4.0/sc-2.0.7/datatables.min.js"></script>
    <script src="{{asset('')}}vendor/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <script src="{{asset('')}}vendor/izitoast/dist/js/iziToast.min.js"></script>


    <script>
    $('#table-pasien').DataTable({
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
            {data: 'profile.name', name: 'profile.name', orderable: false, searchable: false},
            {data: 'kode', name:'kode', orderable: false, searchable: false},
            {data: 'email', name:'email', orderable: false, searchable: false},
            {data: 'opsi', name: 'opsi', orderable: false, searchable: false, class: 'text-center'}
        ],
    });
    </script>
    <script>
        const modal = new bootstrap.Modal($('#modalAction'));
        $('.btn-cari').on('click', function (){
            $.ajax({
                method:'get',
                url:`{{ url('rekam-medis/pasien/cari')}}`,
                success: function (ress) {
                    $('#modalAction').find('.modal-dialog').html(ress).ready(function () {
                        Echo.channel('test-channel')
                            .listen('IotEvent', (e) => {
                                $('#kode').val(e.kode)
                            });
                    })
                    modal.show();
                }
            })

            return
        });
        $('.btn-add').on('click', function (){
            $.ajax({
                method:'get',
                url:`{{ url('rekam-medis/pasien/create')}}`,
                success: function (ress) {
                    $('#modalAction').find('.modal-dialog').html(ress).ready(function () {
                        Echo.channel('test-channel')
                            .listen('IotEvent', (e) => {
                                $('#kode').val(e.kode)
                            });
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
                            let table = $('#table-pasien').DataTable();
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
        $('#table-pasien').on('click', '.action', function () {
            let data = $(this).data();
            let id = data.id;
            let jenis = data.type;
            if (jenis === 'delete') {
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
                            method: 'delete',
                            url: `{{ url('rekam-medis/pasien/delete/')}}/${id}`,
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function (ress) {
                                let table = $('#table-pasien').DataTable();
                                table.cleanData;
                                table.ajax.reload();
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
        })
    </script>

@endpush
