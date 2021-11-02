@extends('admin.layouts.main')

@section('content')

<div class="right_col" role="main">
    <div class="">

      <div class="row" style="display: block;">

        <div class="col-md-12 col-sm-12  ">
          <div class="x_panel">
            <div class="x_title"> 
            <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-info">Tambah Pelanggan</button>
              <ul class="nav navbar-right panel_toolbox">
              </ul>
              <div class="clearfix"></div>

            <!-- Modal Input Data -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Form Pelanggan</h5>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 ">
                                    <div class="x_panel">
                                        <div class="x_title">
                                            <h2>Masukan Nama Pelanggan</h2>
                                            <ul class="nav navbar-right panel_toolbox">
                                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                                </li>
                                            </ul>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="x_content">
                                            <br />
                                            <form action="{{ url('pelanggan') }}" method="POST" enctype="multipart/form-data" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                                                @csrf
                                                <div class="item form-group">
                                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name"> Nama Pelanggan <span class="required">*</span>
                                                    </label>
                                                    <div class="col-md-6 col-sm-6 ">
                                                        <input type="text" id="first-name" required="required" name="nama" class="form-control ">
                                                    </div>
                                                </div>
                                                <div class="item form-group">
                                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name"> Alamat Pelanggan <span class="required">*</span>
                                                    </label>
                                                    <div class="col-md-6 col-sm-6 ">
                                                        <input type="text" id="first-name" required="required" name="alamat" class="form-control ">
                                                    </div>
                                                </div>
                                                <div class="item form-group">
                                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name"> No Telphone <span class="required">*</span>
                                                    </label>
                                                    <div class="col-md-6 col-sm-6 ">
                                                        <input type="text" id="first-name" required="required" name="no_telp" class="form-control ">
                                                    </div>
                                                </div>
                                                <div class="item form-group">
                                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name"> Alamat Email <span class="required">*</span>
                                                    </label>
                                                    <div class="col-md-6 col-sm-6 ">
                                                        <input type="text" id="first-name" required="required" name="email" class="form-control ">
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
                      <th class="column-title">Kode Pelanggan</th>
                      <th class="column-title">Nama Pelanggan</th>
                      <th class="column-title">Alamat Pelanggan</th>
                      <th class="column-title">No Telphone</th>
                      <th class="column-title">Alamat Email</th>
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
                      
                          
                      @foreach ($customer as $key => $c)
                          
                      
                    <tr class="even pointer">
                      <td>{{ ++$key }}</td>
                      <td>{{ $c->kode_pelanggan }}</td>
                      <td>{{ $c->nama }}</td>
                      <td>{{ $c->alamat }}</td>
                      <td>{{ $c->no_telp }}</td>
                      <td>{{ $c->email }}</td>
                      <td>{{ $c->created_at}}</td>
                      <td>{{ $c->updated_at }}</td>
                      <td><a class="btn btn-info" href="{{ url('pelanggan/'.$c->id.'/edit') }}" data-bs-toggle="modal" data-bs-target="#editModal{{ $key }}">Edit</a>
                      </td>
                      <td>
                        <form action="{{ url('pelanggan/'.$c->id) }}" method="POST">
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
                            <h5 class="modal-title" id="exampleModalLabel">Form Edit Pelanggan</h5>
                            </div>
                            <div class="modal-body">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 ">
                                            <div class="x_panel">
                                                <div class="x_title">
                                                    <h2>Edit Pelanggan</h2>
                                                    <ul class="nav navbar-right panel_toolbox">
                                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                                        </li>
                                                    </ul>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <div class="x_content">
                                                    <br />
                                                    <form action="{{ url('pelanggan/'.$c->id) }}" method="POST" enctype="multipart/form-data" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                                                        @csrf
                                                        <input type="hidden" name="_method" value="PATCH">
                                                        <div class="item form-group">
                                                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name"> Nama Pelanggan <span class="required">*</span>
                                                            </label>
                                                            <div class="col-md-6 col-sm-6 ">
                                                                <input type="text" id="first-name" required="required" name="nama" class="form-control " value="{{ $c->nama }}">
                                                            </div>
                                                        </div>
                                                        <div class="item form-group">
                                                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name"> Alamat Pelanggan <span class="required">*</span>
                                                            </label>
                                                            <div class="col-md-6 col-sm-6 ">
                                                                <input type="text" id="first-name" required="required" name="alamat" class="form-control " value="{{ $c->alamat }}">
                                                            </div>
                                                        </div>
                                                        <div class="item form-group">
                                                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name"> No Telphone <span class="required">*</span>
                                                            </label>
                                                            <div class="col-md-6 col-sm-6 ">
                                                                <input type="text" id="first-name" required="required" name="no_telp" class="form-control " value="{{ $c->no_telp }}">
                                                            </div>
                                                        </div>
                                                        <div class="item form-group">
                                                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name"> Alamat Email <span class="required">*</span>
                                                            </label>
                                                            <div class="col-md-6 col-sm-6 ">
                                                                <input type="text" id="first-name" required="required" name="email" class="form-control " value="{{ $c->email }}">
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