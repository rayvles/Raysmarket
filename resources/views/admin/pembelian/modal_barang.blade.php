<div class="modal fade" role="dialog" id="modalPilihBarang">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Pilih Barang</h5>
            </div>
            <div class="modal-body">
                <table id="tablePilihBarang" class="table table-striped table-sm">
                    <thead>
                        <th>#</th>
                        <th>Kode</th>
                        <th>Nama Barang</th>
                        <th>Jenis Produk</th>
                        <th>Harga Jual</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody>
                        @foreach ($barang as $b)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$b->kode_barang}}</td>
                            <td>{{$b->nama_barang}}</td>
                            <td>{{$b->produk->nama_produk}}</td>
                            <td>{{$b->harga_jual}}</td>
                            <td>
                                <button type="button" class="button-pilih-barang btn btn-sm btn-success" data-bs-dismiss="modal" data-barang-id="{{$b->id}}">Pilih</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>