<!-- Modal -->
<div class="modal fade" id="editModal{{$c->id}}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="editModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('admin.customer.update',$c->id)}}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col">
                            <label for="">Nama Pelanggan</label>
                            <input class="form-control form-control-sm" type="text" name="name" value="{{$c->name}}" required>
                        </div>
                        <div class="col">
                            <label for="">Email</label>
                            <input class="form-control form-control-sm" type="email" name="email" value="{{$c->email}}" required>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col">
                            <label for="">Password</label>
                            <input class="form-control form-control-sm" type="password" name="password" value="" required>
                        </div>
                        <div class="col">
                            <label for="">No Telepon</label>
                            <input class="form-control form-control-sm" type="text" name="no_telp" value="{{$c->no_telp}}">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col">
                            <label for="">Tempat Kerja</label>
                            <input class="form-control form-control-sm" type="text" name="work_place" value="{{$c->work_place}}">
                        </div>
                        <div class="col">
                            <label for="">Alamat</label>
                            <textarea class="form-control form-control-sm" name="address" cols="30"
                                rows="4">{{$c->address}}</textarea>
                        </div>
                    </div>
                    <button type="submit"
                        class="btn btn-sm btn-primary form-control form-control-sm mt-2">Ubah</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Show-->
<div class="modal fade" id="showModal{{$c->id}}" tabindex="-1" role="dialog" aria-labelledby="showModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="showModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
   
                    <div class="row">
                        <div class="col">
                            <label for="">Nama Pelanggan</label>
                            <input class="form-control form-control-sm" type="text" readonly placeholder="{{$c->name}}">
                        </div>
                        <div class="col">
                            <label for="">Email</label>
                            <input class="form-control form-control-sm" type="email" readonly placeholder="{{$c->email}}">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col">
                            <label for="">No Telepon</label>
                            <input class="form-control form-control-sm" type="number"  readonly placeholder="{{$c->no_telp}}">
                        </div>
                        <div class="col">
                            <label for="">Tempat Kerja</label>
                            <input class="form-control form-control-sm" type="text" readonly placeholder="{{$c->work_place}}">
                        </div>
                    </div>
                    <div class="row mt-2">
                       
                        <div class="col">
                            <label for="">Alamat</label>
                            <textarea class="form-control form-control-sm"readonly placeholder="{{$c->address}}" cols="30" rows="4"></textarea>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
