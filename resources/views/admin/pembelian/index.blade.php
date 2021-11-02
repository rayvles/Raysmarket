@extends('admin.layouts.main')

@section('content')

<div class="right_col" role="main">
    <div class="">

      <div class="row" style="display: block;">

        <div class="col-md-12 col-sm-12  ">
          <div class="x_panel">
            <div class="x_title"> 
              <ul class="nav navbar-right panel_toolbox">
              </ul>
              <div class="clearfix"></div>

              <a class="btn btn-success" href="{{ route('pembelian.create') }}">Pembelian Baru</a>

            </div>

            {{-- @include('pembelian.form') --}}

            <div class="content">
              <div class="table-responsive">
                <table id="tablePembelian" class="table jambo_table bulk_action">
                  <thead>
                    <tr class="headings">
                      <th>
                        No
                    </th>
                    <th>Kode Masuk</th>
                    <th>Pemasok</th>
                    <th>Operator</th>
                    <th>Tanggal</th>
                    <th>Jenis Barang</th>
                    <th>Total Bayar</th>
                    <th>Detail</th>
                      
                      <th class="bulk-actions" colspan="7">
                        <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                        
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
              
  @push('bottom')

  <!-- Modal Detail Pembelian -->
  @include('admin.pembelian.modal_detail');

  @endpush


          </div>
        </div>
      </div>
    </div>
  </div>



@endsection

@push('script')

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.7/dist/sweetalert2.all.min.js"></script>

<!-- DataTables -->
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js">
</script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js">
</script>

<script>
    let table;
    let tableDetailPembelian;

    $(function() {
        table = $('#tablePembelian').DataTable({
            paging: true,
            lengthChange: true,
            searching: true,
            ordering: true,
            responsive: true,
            autoWidth: true,
            ajax: {
                url: '{{ route('pembelian.data') }}',
            },
            columns: [{
                    data: 'DT_RowIndex'
                },
                {
                    data: 'kode_masuk'
                },
                {
                    data: 'nama_pemasok'
                },
                {
                    data: 'nama_user'
                },
                {
                    data: 'tanggal_masuk'
                },
                {
                    data: 'total_barang'
                },
                {
                    data: 'total_bayar'
                },
                {
                    data: 'action',
                    searchable: false,
                    sortable: false
                },
            ]
        });

        tableDetailPembelian = $('#tableDetailPembelian').DataTable({
            paging: true,
            lengthChange: true,
            searching: true,
            ordering: true,
            columns: [{
                    data: 'DT_RowIndex',
                },
                {
                    data: 'kode_barang'
                },
                {
                    data: 'nama_barang'
                },
                {
                    data: 'jenis_produk'
                },
                {
                    data: 'harga_beli'
                },
                {
                    data: 'jumlah'
                },
                {
                    data: 'sub_total'
                }
            ]
        });
    });

    $('#tablePembelian').on('click', '.button-lihat-detail', function() {
        let id_pembelian = $(this).data('pembelian-id');
        let kode_pembelian = $(this).data('kode-pembelian');
        $('span.kode-pembelian').text(kode_pembelian);
        tableDetailPembelian.ajax.url(`/pembelian/detail/data/${id_pembelian}`).load();
    })

    const toaster = Swal.mixin({
        toast: true,
        position: 'top-right',
        showConfirmButton: false,
        timer: 2500,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    });
</script>

@endpush
