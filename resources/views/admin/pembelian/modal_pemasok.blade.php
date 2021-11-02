 {{-- Modal Pemasok --}}
 <div class="modal fade" id="modalPilihPemasok" aria-labelledby="modalPilihPemasok" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Pilih Pemasok</h5>
            </div>
            <div class="modal-body">
                <table id="tablePilihPemasok" class="table table-striped table-sm">
                    <thead>
                        <th>#</th>
                        <th>Nama Pemasok</th>
                        <th>No. Telepon</th>
                        <th>Alamat</th>
                        <th>Kota</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody>
                        @foreach ($pemasok as $p)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$p->nama_pemasok}}</td>
                            <td>{{$p->no_telp}}</td>
                            <td>{{$p->alamat}}</td>
                            <td>{{$p->kota}}</td>
                            <td>
                                <button type="button" class="button-pilih-pemasok btn btn-sm btn-success" data-bs-dismiss="modal" data-pemasok-id="{{$p->id}}"> Pilih</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
        </div>
    </div>
</div>

