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

    <div class="row">
        <div class="col-12 col-sm-12">
            

            <div class="d-flex justify-content-center">
                <div class="form-inline">
                    <div class="form-group mb-2 mr-3">
                       
                        <div class="input-group date" id="tanggal" data-target-input="nearest">
                            <div class="input-group-prepend">
                                <label for="min" class="col-sm-2 col-form-label">Min</label>
                              </div>
                            <input type="text" class="form-control datetimepicker-input"  id="min" name="min" data-target="#min" >
                            <div class="input-group-append" data-target="#min" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                      
                    </div>
                    <div class="form-group mb-2">
                      
                       <div class="input-group date" id="tanggal" data-target-input="nearest">
                        <div class="input-group-prepend">
                            <label for="max" class="col-sm-2 col-form-label">Max</label>
                          </div>
                        <input type="text" class="form-control datetimepicker-input"  id="max" name="max" data-target="#max" >
                        <div class="input-group-append" data-target="#max" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div> 
                    </div>
                    <button id="btn-seleksi" class="btn btn-success">Filter</button>
                    <button id="btn-refresh" class="btn btn-success">Refresh</button>
                </div>
            </div>
            <div class="card card-primary card-tabs">
                <div class="card-header p-0 pt-1">
                    <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="tabs-jual" data-toggle="pill" href="#penjualan" role="tab" aria-controls="penjualan" aria-selected="true">Penjualan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="tabs-beli" data-toggle="pill" href="#belanja" role="tab" aria-controls="belanja" aria-selected="false">Belanja</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="custom-tabs-one-tabContent">
                        <div class="tab-pane fade show active" id="penjualan" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                            <table class="table table-striped" id="tabelpenjualan" style="width: 100%">
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
                                    <!-- Data here -->
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="belanja" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                            <table class="table table-striped" id="tabelpembelian" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Faktur</th>
                                        <th>Tanggal</th>
                                        <th>Diskon</th>
                                        <th>Total</th>
                                        <th>Kasir</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Data here -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
            </div>

            <button type="button" id="btn-jualdetail" class="btn btn-info" hidden data-toggle="modal" data-target="#modal-penjualan">
                Tambah
            </button>

            <div class="modal fade" id="modal-penjualan" tabindex="-1" role="dialog" aria-labelledby="modal-penjualan-title" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="modal-penjualan-title">Detail Penjualan</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <table class="table table-striped" style="width: 100%" id="DetailPenjualan">
                                <thead>
                                    <tr>
                                        <th style="width: 2%">No</th>
                                        <th>No Nota</th>
                                        <th>Nama Obat</th>
                                        <th style="text-align: center">Qty</th>
                                        <th>Harga Obat</th>
                                        <th>Total</th>
                                        <th>Harga Jual</th>
                                        <th>Customer</th>
                                        <th style="text-align: center">Kasir</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Data here -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <button type="button" id="btn-belidetail" class="btn btn-info" hidden data-toggle="modal" data-target="#modal-beli">
                Tambah
            </button>

            <div class="d-flex justify-content-space-around">
                <div class="row form-inline">
                    <div class="from-group col-6">
                        <form action="{{ route('laporan.exportpembayaran') }}" method="get">
                            <input type="text" id="minp" name="minp" hidden >
                            <input type="text" id="maxp" name="maxp" hidden >
                            <input type="text" id="pilih" name="pilih"  value="jual" hidden>
                            <button class="btn btn-warning" id="lapjual">Penjualan</button>
                        </form>
                            
                    </div>
                    <div class="col-6 from-group">
                        <form action="{{ route('laporan.exportpembayaran') }}" method="get">
                            <input type="text" id="minb" name="minb" class="md-2" hidden>
                            <input type="text" id="maxb" name="maxb" class="md-2" hidden>
                            <input type="text" id="pilih" name="pilih"  value="beli" hidden>
                            <button class="btn btn-warning" id="labbeli">Pembelian</button>
                        </form>
                    </div>
                </div>
            </div>
            {{-- <a href="{{ route('laporan.exportpembayaran') }}" class="btn btn-primary" target="_blank" rel="noopener noreferrer">Export ke Exel</a> --}}

            <div class="modal fade" id="modal-beli" tabindex="-1" role="dialog" aria-labelledby="modal-beli-title" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="modal-beli-title">Detail Belanja</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <table class="table table-striped" style="width: 100%" id="DetailPembelian">
                                <thead>
                                    <tr>
                                        <th style="width: 2%">No</th>
                                        <th>No Faktur</th>
                                        <th>Tanggal</th>
                                        <th>Nama Obat</th>
                                        <th>Harga @Obat</th>
                                        <th style="text-align: center">Qty</th>
                                        <th>Pajak</th>
                                        <th>Diskon</th>
                                        <th>Total</th>
                                        <th style="text-align: center">Kasir</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Data here -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

@push('js')
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
        $('#lapjual').attr('disabled', true);
        $('#labbeli').attr('disabled', true);
        $('#lapjual').hide();
        $('#labbeli').hide();
        loadPenjualan();
        loadBelanja();
        $('#min').datetimepicker({
        format: 'YYYY-MM-DD',
       
        });
        $('#max').datetimepicker({
        format: 'YYYY-MM-DD',
       
        });
    });
</script>
<script>
     
    function loadPenjualan(min, max) {
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
        serverSide: false,
        ajax: {
            url: "{{ route('laporan.penjualan') }}",
            data : {
                min: min,
                max : max
            }
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
                    data: 'totaldiskon', 
                    name: 'totaldiskon',
                    render: $.fn.dataTable.render.number(',', '.', 2, '')     
                },
                { 
                    data: 'totalharga', 
                    name: 'totalharga',
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
    function loadBelanja(min, max) {
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
        serverSide: false,
        ajax: {
            url: "{{ route('laporan.belanja') }}",
            data : {
                min: min,
                max : max
            }
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
                    data: 'totaldiskon', 
                    name: 'totaldiskon',
                    render: $.fn.dataTable.render.number(',', '.', 2, '')     
                },
                { 
                    data: 'totalharga', 
                    name: 'totalharga',
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
        serverSide: false,
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
        $('#DetailPenjualan').DataTable().destroy();
        DetailPenjualan(nota);
        $('#btn-jualdetail').click();
    });

    function Detailbeli(id) {
        var table = $("#DetailPembelian").DataTable({
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
        serverSide: false,
        ajax: {
            url: "{{ route('detailsbeli') }}",
            type : 'post',
            data : {
                faktur : id,
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
                { data: 'faktur', name: 'faktur' },
                { data: 'tanggal', name: 'tanggal' },
                { data: 'item', name: 'item' },
                
                { 
                    data: 'harga',name: 'harga',
                    render: $.fn.dataTable.render.number(',', '.', 2, '')     
                },
                { data: 'qty', name: 'qty' },
                { 
                    data: 'pajak', name: 'pajak',
                    render: $.fn.dataTable.render.number(',', '.', 2, '')     
                },
                { 
                    data: 'diskon', name: 'diskon',
                    render: $.fn.dataTable.render.number(',', '.', 2, '')     
                },
                { 
                    data: 'totalbersih', name: 'totalbersih',
                    render: $.fn.dataTable.render.number(',', '.', 2, '')     
                },
                // { data: 'costumer', name: 'costumer' },
                { data: 'kasir', name: 'kasir' }
            ]
        });
    };

    $(document).on('click', '.detailsbeli', function() {
        let faktur = $(this).attr('id');
        $('#DetailPembelian').DataTable().destroy();
        Detailbeli(faktur);
        $('#btn-belidetail').click();
        $('#modal-penjualan').modal('hide')
    });

    $(document).on('click', '#btn-seleksi', function() {
        let min = $('#min').val();
        let max = $('#max').val();
        $('#tabelpenjualan').DataTable().destroy();
        loadPenjualan(min, max);
        $('#tabelpembelian').DataTable().destroy();
        loadBelanja(min, max);
        $('#minp').val(min);
        $('#maxp').val(max);
        $('#minb').val(min);
        $('#maxb').val(max);

        if ($('#minp').val().trim() !== ''  &&  $('#maxp').val().trim() !== '') {
            $('#lapjual').attr('disabled', false);
        } else {
            console.log('Nilai belum terisi.');
        }

        if ($('#minb').val().trim() !== ''  &&  $('#maxb').val().trim() !== '') {
            $('#labbeli').attr('disabled', false);
        } else {
            console.log('Nilai belum terisi.');
        }
    });


    $(document).on('click', '#btn-refresh', function() {
        $('#min').val('');
        $('#max').val('');
        $('#minp').val('');
        $('#maxp').val('');
        $('#minb').val('');
        $('#maxb').val('');
        $('#tabelpenjualan').DataTable().destroy();
        loadPenjualan();
        $('#tabelpembelian').DataTable().destroy();
        loadBelanja();
        if ($('#minp').val().trim() == ''  &&  $('#maxp').val().trim() == '') {
            $('#lapjual').attr('disabled', true);
        } else {
            console.log('Nilai belum terisi.');
        }

        if ($('#minb').val().trim() == ''  &&  $('#maxb').val().trim() == '') {
            $('#labbeli').attr('disabled', true);
        } else {
            console.log('Nilai belum terisi.');
        }

    });

    $(document).on('click', '#tabs-jual', function() {
        $('#lapjual').show();
        $('#labbeli').hide();
       
    });
    $(document).on('click', '#tabs-beli', function() {
        $('#lapjual').hide();
        $('#labbeli').show();
    });


</script>