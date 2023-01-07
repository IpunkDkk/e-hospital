<div class="modal-content">
    <form id="formAction" action="{{ $permissions->id ? route('permissions.update', $permissions->id) : route('permissions.store')}}" method="POST">
        @csrf
        <div class="modal-header">
            <h5 class="modal-title" id="largeModalLabel">{{$judul}}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
        </div>
        <div class="modal-body">
                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="role" class="form-label">Role</label>
                        <input type="text" placeholder="Masukan Nama Permissions" value="{{$permissions->name}}" class="form-control" id="role" name="name">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="guard" class="form-label">Guard</label>
                        <input type="text" placeholder="Masukan Nama Guard" value="{{$permissions->guard_name}}" class="form-control" id="guard" name="guard_name">
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
