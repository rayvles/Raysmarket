@extends('admin.layouts.main')

@section('content')

<div class="right_col" role="main">
    <div class="">

      <div class="row" style="display: block;">

        <div class="col-md-12 col-sm-12  ">
          <div class="x_panel">
            <div class="x_title"> 
            <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-info">Tambah Produk</button>
              <ul class="nav navbar-right panel_toolbox">
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
                                                </li>
                                            </ul>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="x_content">
                                            <br />
                                            <form action="{{ url('produk') }}" method="POST" enctype="multipart/form-data" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                                                @csrf
                                                <div class="item form-group">
                                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name"> Nama Produk <span class="required">*</span>
                                                    </label>
                                                    <div class="col-md-6 col-sm-6 ">
                                                        <input type="text" id="first-name" required="required" name="nama_produk" class="form-control ">
                                                    </div>
                                                </div>
                                                <div class="ln_solid"></div>
                                                <div class="item form-group">
                                                        <button type="submit" class="btn btn-success tambah-produk">Submit</button>
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
                      <th class="column-title">Nama Produk</th>
                      <th class="column-title">Created At</th>
                      <th class="column-title">Update At</th>
                      <th class="column-title no-link last"><span class="nobr">Edit</span>
                        <th class="column-title no-link last"><span class="nobr">Delete</span>
                      </th>
                      <th class="bulk-actions" colspan="7">
                        <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach ($datas as $key=>$value)
                          
                      
                    <tr class="even pointer">
                      <td>{{ ++$key }}</td>
                      <td>{{ $value->nama_produk }}</td>
                      <td>{{ $value->created_at }}</td>
                      <td>{{ $value->updated_at }}</td>
                      <td><a class="btn btn-info" href="{{ url('produk/'.$value->id.'/edit') }}" data-bs-toggle="modal" data-bs-target="#editModal{{ $key }}">Edit</a>
                      </td>
                      <td>
                        <form action="{{ url('produk/'.$value->id) }}" method="POST">
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
                                                        </li>
                                                    </ul>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <div class="x_content">
                                                    <br />
                                                    <form action="{{ url('produk/'.$value->id) }}" method="POST" enctype="multipart/form-data" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                                                        @csrf
                                                        <input type="hidden" name="_method" value="PATCH">
                                                        <div class="item form-group">
                                                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name"> Nama Produk <span class="required">*</span>
                                                            </label>
                                                            <div class="col-md-6 col-sm-6 ">
                                                                <input type="text" id="first-name" required="required" name="nama_produk" class="form-control" value="{{ $value->nama_produk }}">
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
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script> 
    $('.tambah-produk').click(function(e) {
                        e.preventDefault()
                        let data = $(this).closest('tr').find('td:eq(1)').text()
                        Swal.fire({
                            
                        }).then((result) => {
                            if (result.isConfirmed) {
                                Swal.fire()
                                $(e.target).closest('form').submit()
                            }
                        })
                    })

    </script>

  </div>

  {{-- @if (session()->has(success))
      <script>
              Swal.fire({
              position: 'top-end',
              icon: 'success',
              title: 'Your work has been saved',
              showConfirmButton: false,
              timer: 1500
            })
      </script>
  @endif --}}
 


@endsection