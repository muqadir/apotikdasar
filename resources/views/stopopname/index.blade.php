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

    <div class="py-12 pt-0">
      
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                        <h3 class="card-title"> <i class="fas fa-shopping-cart"></i> Sock Opename</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('opname.store') }}" method="post">
                                @csrf
                                <div class="col-md-4">
                                    <div class="form-group md-2">
                                        <label for="obat_id">Obat</label>
                                        <select name="obat_id" id="obat_id" class="form-control rounded">
                                            <option value="">Pilih Obat</option>
                                            @foreach ($obat as $item )
                                                <option value="{{ $item->obatid }}">{{ $item->namaObat }}</option>     
                                            @endforeach
                                        </select>  
                                    </div>
                
                                    <div class="form-group md-2">
                                        <label for="stock" class="mr-sm-2">Stock Tersedia di sistem</label>
                                        <input type="text" onkeypress="return number(event)"  class="form-control rounded" readonly autocomplete="off" name="stock" id="stock"  value="0" >
                                    </div>
                                    <div class="form-group md-2">
                                        <label for="stock" class="mr-sm-2">Stock Real</label>
                                        <input type="text" onkeypress="return number(event)"  class="form-control rounded"  autocomplete="off" name="real" id="real"  value="0" >
                                    </div>
                                    <div class="form-group md-2">
                                        <label for="stock" class="mr-sm-2">Keterangan</label>
                                        <textarea class="form-control rounded" name="keterangan" id="keterangan" placeholder="masukan atasan kurang/lebihnya item" cols="30" rows="5"></textarea>
                                    </div>
                                </div>
                               
                                <button type="submit" class="btn btn-warning"><i class="far fa-save"></i> Save</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="row mt-6">
                    {{-- <div class="col-6 sm-6 md-6 lg-6">  --}}
                        <div class="card card-primary col-6">
                            <div class="card-header">
                              <h3 class="card-title">Daftar Belanja</h3>
                            </div>
                            
                            <div class="card-body">

                                <table class="table table-border table-striped table-sm" id="tableBelanja">
                           
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>No Faktur</th>
                                            <th>Tanggal</th>
                                            <th>Jumlah</th>
                                            <th>Admin</th>
                                        </tr>
                                    </thead>
                                </table>
                              
                            </div>
                        </div> 
                    {{-- </div> --}}

                    {{-- <div class="col-6 sm-6 md-6 lg-6"> --}}
                        <div class="card card-primary col-6">
                            <div class="card-header">
                              <h3 class="card-title">Daftar Penjualan</h3>
                            </div>
                            
                            <div class="card-body">
                                <table class="table table-border table-striped table-sm" id="tableJual">
                           
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>No Nota</th>
                                            <th>Tanggal</th>
                                            <th>Jumlah</th>
                                            <th>Admin</th>
                                        </tr>
                                    </thead>
                                </table>
                              
                            </div>
                        </div>
                       
                        
                    {{-- </div> --}}



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
        $('#obat_id').select2();
    });

    function number(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    }

    function LoadBeli(id){
        $('#tableBelanja').DataTable({
            serverSide: true,
            processing: true,
            autoWidth: false,
            
            language: {
                url: "{{ asset('adminlte/plugins/datatables/bahasa/id.json') }}"
            },
            ajax: {
                url: "{{ route('databeli') }}",
                data: {
                    id : id
                }
            },
            columns: [ 
                {
                    data: null,
                    sortable: false,
                    render: function (data, type, row, meta) 
                    {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                { data: 'nota', name: 'nota' },
                { data: 'updated_at', name: 'updated_at' },
                { data: 'qty', name: 'qty' },
                { data: 'name', name: 'name' },
                ]
            })
    };
    function LoadJual(id){
        $('#tableJual').DataTable({
            serverSide: true,
            processing: true,
            autoWidth: false,
            
            language: {
                url: "{{ asset('adminlte/plugins/datatables/bahasa/id.json') }}"
            },
            ajax: {
                url: "{{ route('datajual') }}",
                data: {
                    id : id
                }
            },
            columns: [ 
                {
                    data: null,
                    sortable: false,
                    render: function (data, type, row, meta) 
                    {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                { data: 'nota', name: 'nota' },
                { data: 'updated_at', name: 'updated_at' },
                { data: 'qty', name: 'item' },
                { data: 'name', name: 'name' },
                ]
            })
    };


    function getStock(id) {
        $.ajax({
            url : "{{ route('cekstock') }}", //yang diubah
            type : 'post',
            data : {
                id : id,
                _token :  "{{ csrf_token() }}"
            },
            success : function(res) {
                console.log(res);
                $('#stock').val(res.stock[0].stock);
            }
        })
    };

    $('#obat_id').change(function () {
            let id = $(this).val();
            $('#stock').val(null);
            $('#real').val(null);
            $('#keterangan').val(null);
            $('#tableBelanja').DataTable().destroy();
            LoadBeli(id);
            $('#tableJual').DataTable().destroy();
            LoadJual(id);
            getStock(id);
    });


    $(document).on('submit', 'form', function(event){
        event.preventDefault();          
        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            dataType: "json",
            data: new FormData(this),
            processData: false,
            contentType: false,
            success: function (res, status, error) {
                console.log(res.text);
                toastr.success(res.text, 'Success');
                  
            },
            error: function(xhr){
                console.log(xhr);
                toastr.error(xhr.responseJSON.text, 'gagal!'); 
            }
        });
    });
</script>



