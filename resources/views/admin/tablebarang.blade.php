@extends('admin.layouts.main')

@section('content')

<div class="right_col" role="main">
    <div class="">

      <div class="row" style="display: block;">

        <div class="col-md-12 col-sm-12  ">
          <div class="x_panel">
            <div class="x_title"> 
            <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-info">Tambah barang</button>
              <ul class="nav navbar-right">
              </ul>
              <div class="clearfix"></div>

            <!-- Modal Input Data -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Form Produk</h5>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 ">
                                    <div class="x_panel">
                                        <div class="x_title">
                                            <h2>Masukan Produk</h2>
                                            <ul class="nav navbar-right panel_toolbox">
                                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                                </li>
                                            </ul>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="x_content">
                                            <br />
                                            <form action="{{ url('barang') }}" method="POST" enctype="multipart/form-data" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                                                @csrf
                                                <div class="item form-group">
                                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="">Nama Produk</label>
                                                    <select class="custom-select select-product" name="produk_id" id="produkid">@foreach ($produk as $p)
                                                        <option value="{{ $p->id }}">{{ $p->nama_produk }}</option>
                                                    @endforeach</select>
                                                </div>


                                                <div class="item form-group">
                                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name"> Nama Barang <span class="required">*</span>
                                                    </label>
                                                    <div class="col-md-6 col-sm-6 ">
                                                        <input type="text" id="first-name" required="required" name="nama_barang" class="form-control ">
                                                    </div>
                                                </div>
                                                <div class="item form-group">
                                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name"> Satuan <span class="required">*</span>
                                                    </label>
                                                    <div class="col-md-6 col-sm-6 ">
                                                        <input type="text" id="first-name" required="required" name="satuan" class="form-control ">
                                                    </div>
                                                </div>
                                                <div class="item form-group">
                                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name"> harga Jual <span class="required">*</span>
                                                    </label>
                                                    <div class="col-md-6 col-sm-6 ">
                                                        <input type="text" id="first-name" required="required" name="harga_jual" class="form-control ">
                                                    </div>
                                                </div>
                                                <div class="item form-group">
                                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name"> Stok <span class="required">*</span>
                                                    </label>
                                                    <div class="col-md-6 col-sm-6 ">
                                                        <input type="number" id="first-name" required="required" name="stok" class="form-control ">
                                                    </div>
                                                </div>
                                                <div class="ln_solid"></div>
                                                <div class="item form-group">
                                                        <button type="submit" class="btn btn-success">Submit</button>
                                                </div>
        
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
                </div>
            </div>

            </div>

            <div class="content">
              <div class="table-responsive">
                <table class="table jambo_table bulk_action">
                  <thead>
                    <tr class="headings">
                    <th class="column-title">No</th>
                      <th class="column-title">Kode Barang</th>
                      <th class="column-title">Nama Produk</th>
                      <th class="column-title">Nama Barang</th>
                      <th class="column-title">Satuan</th>
                      <th class="column-title">Harga Jual</th>
                      <th class="column-title">Stok</th>
                      <th class="column-title">Created At</th>
                      <th class="column-title">Update At</th>
                      <th class="column-title no-link last"><span class="nobr">Edit</span></th>
                        <th class="column-title no-link last"><span class="nobr">Delete</span>
                      </th>
                      <th class="bulk-actions" colspan="7">
                        <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                      
                          
                      @foreach ($barang as $key => $b)
                          
                      
                    <tr class="even pointer">
                      <td>{{ ++$key }}</td>
                      <td>{{ $b->kode_barang }}</td>
                      <td>{{ $b->produk->nama_produk }}</td>
                      <td>{{ $b->nama_barang }}</td>
                      <td>{{ $b->satuan }}</td>
                      <td>{{ $b->harga_jual }}</td>
                      <td>{{ $b->stok }}</td>
                      <td>{{ $b->created_at}}</td>
                      <td>{{ $b->updated_at }}</td>
                      <td><a class="btn btn-info" href="{{ url('barang/'.$b->id.'/edit') }}" data-bs-toggle="modal" data-bs-target="#editModal{{ $key }}">Edit</a>
                      </td>
                      <td>
                        <form action="{{ url('barang/'.$b->id) }}" method="POST">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger" type="submit">Delete</button>
                        </form>
                      </td>
                    </tr>

                    {{-- Modal Edit Data --}}
                    <div class="modal fade" id="editModal{{ $key }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Form Produk</h5>
                            </div>
                            <div class="modal-body">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 ">
                                            <div class="x_panel">
                                                <div class="x_title">
                                                    <h2>Masukan Produk</h2>
                                                    <ul class="nav navbar-right panel_toolbox">
                                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                                        </li>
                                                    </ul>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <div class="x_content">
                                                    <br />
                                                    <form action="{{ url('barang/'.$b->id) }}" method="POST" enctype="multipart/form-data" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                                                        @csrf
                                                        <input type="hidden" name="_method" value="PATCH">
                                                        <div class="item form-group">
                                                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="">Nama Produk</label>
                                                            <select class="custom-select select-product" name="produk_id" id="produkid">
                                                                @foreach ($produk as $p)
                                                                <option value="{{ $p->id }}" @if ($p->id == $b->produk_id)
                                                                    selected
                                                                @endif>{{ $p->nama_produk }}</option>
                                                            @endforeach</select>
                                                        </div>
        
        
                                                        <div class="item form-group">
                                                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name"> Nama Barang <span class="required">*</span>
                                                            </label>
                                                            <div class="col-md-6 col-sm-6 ">
                                                                <input type="text" id="first-name" required="required" name="nama_barang" class="form-control " value="{{ $b->nama_barang }}">
                                                            </div>
                                                        </div>
                                                        <div class="item form-group">
                                                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name"> Satuan <span class="required">*</span>
                                                            </label>
                                                            <div class="col-md-6 col-sm-6 ">
                                                                <input type="text" id="first-name" required="required" name="satuan" class="form-control " value="{{ $b->satuan }}">
                                                            </div>
                                                        </div>
                                                        <div class="item form-group">
                                                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name"> harga Jual <span class="required">*</span>
                                                            </label>
                                                            <div class="col-md-6 col-sm-6 ">
                                                                <input type="text" id="first-name" required="required" name="harga_jual" class="form-control " value="{{ $b->harga_jual }}">
                                                            </div>
                                                        </div>
                                                        <div class="item form-group">
                                                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name"> Stok <span class="required">*</span>
                                                            </label>
                                                            <div class="col-md-6 col-sm-6 ">
                                                                <input type="number" id="first-name" required="required" name="stok" class="form-control " value="{{ $b->stok }}">
                                                            </div>
                                                        </div>
                                                        <div class="ln_solid"></div>
                                                        <div class="item form-group">
                                                                <button type="submit" class="btn btn-success">Submit</button>
                                                        </div>
                
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                         
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                        </div>
                    </div>

                    @endforeach
            {{-- Endforeach --}}
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>



@endsection