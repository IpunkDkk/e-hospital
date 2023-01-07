<div class="modal-content">
    <form id="formAction" action="{{route('rekam.create')}}" method="POST">
        @csrf
        <div class="modal-header">
            <h5 class="modal-title" id="largeModalLabel">{{$judul}}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <input hidden name="user_id" value="{{$id}}">
            <div class="col-md-12">
                <div class="mb-3">
                    <label for="nama" class="form-label">Type Rekam Medis</label>
                    <select id="masuk" name="masuk">
                        <option></option>
                        <option value="inap">Inap</option>
                        <option value="konsultasi">Konsultasi</option>
                    </select>
                </div>
            </div>
            <div class="col-md-12">
                <div class="mb-3">
                    <label for="diagnosa" class="form-label">Diagnosa</label>
                    <input type="text" placeholder="Masukan Diagnosa" class="form-control" id="diagnosa" name="diagnosa">
                </div>
            </div>
            <div class="col-md-12">
                <div class="mb-3">
                    <label for="tindakan" class="form-label">Tindakan</label>
                    <input type="text" placeholder="Masukan Tindakan" class="form-control" id="tindakan" name="tindakan">
                </div>
            </div>
            <div class="col-md-12">
                <div class="mb-3">
                    <label for="k-krs" class="form-label">Keadaan Keluar Rumah Sakit</label>
                    <select id="k-krs" name="k-krs" >
                        <option></option>
                        <option name="Sembuh">Sembuh</option>
                        <option name="Membaik">Membaik</option>
                        <option name="Belum Sembuh">Belum Sembuh</option>
                        <option name="Meninggal < 48 Jam">Meninggal < 48 Jam</option>
                        <option name="Meninggal > 48 Jam">Meninggal > 48 Jam</option>
                    </select>
                </div>
            </div>
            <div class="col-md-12">
                <div class="mb-3">
                    <label for="c-krs" class="form-label">Cara Keluar Rumah Sakit</label>
                    <select id="c-krs" name="c-krs" >
                        <option></option>
                        <option name="DiPulangkan">DiPulangkan</option>
                        <option name="Pulang Paksa">Pulang Paksa</option>
                        <option name="Pindah Rumah Sakit">Pindah Rumah Sakit</option>
                        <option name="Lari">Lari</option>
                        <option name="Lain-Lain">Lain-Lain</option>
                    </select>
                </div>
            </div>
            <div class="col-md-12">
                <div class="mb-3">
                    <label for="c-mrs" class="form-label">Cara Keluar Rumah Sakit</label>
                    <select id="c-mrs" name="c-mrs" >
                        <option></option>
                        <option name="Admission">Admission</option>
                        <option name="UGD">UGD</option>
                        <option name="Klinik Spesialis">Klinik Spesialis</option>
                        <option name="RS Lain">RS Lain</option>
                        <option name="Lain-Lain">Lain-Lain</option>
                    </select>
                </div>
            </div>
            <div class="col-md-12">
                <div class="mb-3">
                    <label for="d-merawat" class="form-label">Dokter Yang Merawat</label>
                    <select id="d-merawat" name="d-merawat" >
                        <option></option>
                        @foreach($role as $dokter)
                            <option value="{{$dokter->id}}">{{$dokter->profile->name}}</option>
                        @endforeach
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
