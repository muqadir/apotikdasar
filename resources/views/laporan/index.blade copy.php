@push('css')
<link rel="stylesheet" href="{{ asset('select2/dist/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('adminlte/plugins/daterangepicker/daterangepicker.css') }}">
<link rel="stylesheet" href="{{ asset('adminlte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
@endpush

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

{{-- <div class="row">
    <div class="col-12">
      <h4>Nav Tabs inside Card Header <small>card-tabs / card-outline-tabs</small></h4>
    </div>
</div> --}}
  <!-- ./row -->
<div class="row">
<div class="col-12 col-sm-12">
    <div class="card card-primary card-tabs">
    <div class="card-header p-0 pt-1">
        <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-penjualan" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Laporan Penjualan</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-pembelian" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Laporan Belanja</a>
            </li>
        </ul>
    </div>
    
    <div class="card-body">
        <div class="tab-content" id="custom-tabs-one-tabContent">
            <div class="tab-pane fade show active" id="custom-tabs-penjualan" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                <table class="table table-stripped" id="tabelpenjualan" style="width: 100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nota</th>
                            <th>Tanggal</th>
                            <th>Diskon</th>
                            <th>Total</th>
                            <th>Kasir</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>

                </table>
            </div>

            <button type="button" id="btn-jualdetail" class="btn btn-info" data-toggle="modal" data-target="#modal-penjualan">
                Tambah
            </button>
            <div class="modal fade" id="modal-penjualan">
                <div class="modal-dialog modal-xl">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title"><h2>Detail Penjualan</h2></h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-stripped" style="width: 100%" id="DetailPenjualan">
                            <thead>
                                <tr>
                                    <th style="width: 2%">No</th>
                                    <th>No Nota</th>
                                    <th>Nama OBat</th>
                                    <th style="text-align: center">Qty</th>
                                    <th>Harga Obat</th>
                                    <th>Total</th>
                                    <th>Harga Jual</th>
                                    <th>Custumer</th>
                                    <th style="text-align: center">Kasir</th>
                                </tr>
                            </thead>
                            <tbody>
        
                            </tbody>
        
                        </table>
    
                        
                    </div>
                    
                </div>
                   
            </div>
            {{-- <div class="tab-pane fade" id="custom-tabs-pembelian" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                <table class="table table-stripped" id="tabelpembelian" style="width: 100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Faktur</th>
                            <th>Tanggal</th>
                            <th>Supplier</th>
                            <th>Item</th> 
                            <th>Total Harga</th>
                            <th>Kasir</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>

                </table>
            </div> --}}
        </div>
    </div>
    </div>
</div>
</x-app-layout>
@push('js')
{{-- <script src="{{ asset('datatables/js/jquery.js') }}"></script>
<script src="{{ asset('datatables/js/jquery.dataTables.js') }}"></script> --}}
<script src="{{ asset('adminlte/plugins/jquery/jquery.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('adminlte/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('adminlte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<script src="{{ asset('select2/dist/js/select2.min.js') }}"></script>
<script src="{{ asset('sweetalert2/js/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/toastr/toastr.min.js') }}"></script>
<script>
    $(document).ready(function(){
        loadPenjualan();
        // loadBelanja()

    });
</script>
<script>
     
    function loadPenjualan() {
        var table = $("#tabelpenjualan").DataTable({
            rowReorder: true,
            columnDefs: [{
                orderable: true,
                className: 'reorder',
                targets: 0
            },
            {
                orderable: true,
                className: 'reorder',
                targets: 0
            }
        ],

        responsive: true,
        processing: true,
        serverSive: false,
        ajax: {
            url: "{{ route('laporan.penjualan') }}"
        },
        columns: [
                {data: null,
                "sortable": false,
                        render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                        }
                },
                { 
                data: 'nota', 
                name: 'nota' 
                },
                { 
                data: 'tanggal', 
                name: 'tanggal' 
                },
                
                { 
                    data: 'diskons', 
                    name: 'diskons',
                    render: $.fn.dataTable.render.number(',', '.', 2, '')     
                },
                { 
                    data: 'totals', 
                    name: 'totals',
                    render: $.fn.dataTable.render.number(',', '.', 2, '')     
                },
                { 
                    data: 'name', 
                    name: 'name' 
                },
                { 
                data: 'aksi', 
                name: 'aksi', 
                orderable: false 
            }
            ]
        })
    }
    function loadBelanja() {
        $("#tabelpembelian").DataTable({
            rowReorder: true,
            columnDefs: [{
                orderable: true,
                className: 'reorder',
                targets: 0
            },
            {
                orderable: true,
                className: 'reorder',
                targets: 0
            }
        ],

        responsive: true,
        processing: true,
        serverSive: false,
        ajax: {
            url: "{{ route('laporan.belanja') }}"
        },
        columns: [
                {data: null,
                "sortable": false,
                        render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                        }
                },
                { 
                data: 'faktur', 
                name: 'faktur' 
                },
                { 
                data: 'tanggal', 
                name: 'tanggal' 
                },
                { 
                data: 'supplier', 
                name: 'supplier' 
                },
                { 
                    data: 'item', 
                    name: 'item' 
                },
                { 
                    data: 'totals', 
                    name: 'totals',
                    render: $.fn.dataTable.render.number(',', '.', 2, '')     
                },
                { 
                    data: 'kasir', 
                    name: 'kasir' 
                },
                
                { 
                data: 'aksi', 
                name: 'aksi', 
                orderable: false 
            }
            ]
        })
    }


    function DetailPenjualan(id) {
        var table = $("#DetailPenjualan").DataTable({
            rowReorder: true,
            columnDefs: [{
                orderable: true,
                className: 'reorder',
                targets: 0
            },
            {
                orderable: true,
                className: 'reorder',
                targets: '_all'
            }
        ],

        responsive: true,
        processing: true,
        serverSive: false,
        ajax: {
            url: "{{ route('detailsjual') }}",
            type : 'post',
            data : {
                nota : id,
                  _token :  "{{ csrf_token() }}"
            },
        },
        columns: [
                {data: null,
                "sortable": false,
                        render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                        }
                },
                { data: 'nota', name: 'nota' },
                { data: 'namaobat', name: 'namaobat' },
                { data: 'qty', name: 'qty' },
                
                { 
                    data: 'jual',name: 'jual',
                    render: $.fn.dataTable.render.number(',', '.', 2, '')     
                },
                { 
                    data: 'diskon', name: 'diskon',
                    render: $.fn.dataTable.render.number(',', '.', 2, '')     
                },
                { 
                    data: 'subtotal', name: 'subtotal',
                    render: $.fn.dataTable.render.number(',', '.', 2, '')     
                },
                { data: 'costumer', name: 'costumer' },
                { data: 'name', name: 'name' }
            ]
        });
    };

    $(document).on('click', '.detailsjual', function() {
        let nota = $(this).attr('id');
        DetailPenjualan(nota);
        $('#btn-jualdetail').click();
    });
</script>