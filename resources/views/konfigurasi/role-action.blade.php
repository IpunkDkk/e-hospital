<div class="modal-content">
    <form id="formAction" action="{{ $role->id ? route('roles.update', $role->id) : route('roles.store')}}" method="POST">
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
                        <input type="text" placeholder="Masukan Nama Role" value="{{$role->name}}" class="form-control" id="role" name="name">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="guard" class="form-label">Guard</label>
                        <input type="text" placeholder="Masukan Nama Guard" value="{{$role->guard_name}}" class="form-control" id="guard" name="guard_name">
                    </div>
                </div>
            @if(!$role->id)
                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="permissions">Permissions</label>
                        <select class="js-example-placeholder-multiple" data-control="select2" name="permissions[]" id="permissions" multiple>
                            @foreach($permissions as $item)
                            <option value="{{$item->name}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            @endif
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary"
                    data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
    </form>

</div>
