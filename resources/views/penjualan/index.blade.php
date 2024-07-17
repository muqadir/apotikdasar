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
        {{-- <div class="card card-warning">
            <div class="card-header">
                <h3 class="card-title">Penjualan</h3>
            </div>
        </div> --}}
        <div class="max-w-full mx-auto sm:px-1 lg:px-1">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="row">
                    <div class="col-md-4">
          
                        <div class="card card-danger">
                            <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-user-edit mr-1"></i> Data Pasien</h3>
                            </div>
                            <div class="card-body">
                               
                                <hr class="w-auto h-1  bg-red-700 border-red-100 rounded mb-4 pt-0">
                                <form action="{{ route('penjualan.store') }}" method="post" id="pasienform">
                                    @csrf
                                    <div class="form-group">
                                        <label for="name">Nama Pasien</label>
                                        <input type="text" class="form-control rounded" id="name" name="name" placeholder="Enter Nama" >
                                        <input type="text" class="form-control rounded" id="id" name="id" hidden >
                                    </div>
                                    <div class="form-group">
                                        <label for="telephone">Nomor Telephone</label>
                                        <input type="text" class="form-control rounded" onkeypress="return number(event)" id="telp"  name="telp" maxlength="12" placeholder="085314276781">
                                    </div>
                                    <div class="form-group">
                                        <label for="alamat">Alamat</label>
                                        <textarea class="form-control rounded" id="alamat"  name="alamat" placeholder="Alamat" cols="30"  rows="5"></textarea>
                                        
                                    </div>

                                    <hr class="w-auto h-1  bg-red-700 border-red-100 rounded mt-4">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="resep" class="mr-sm-2">No Resep</label>
                                            <input type="text"   class="form-control rounded"  autocomplete="off" name="resep" id="resep"  value="0" class="form-control rounded">
                                            
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="no" class="mr-sm-2">Pengirim</label>
                                            <input type="text"  class="form-control rounded"  autocomplete="off" name="pengirim" id="pengirim"   class="form-control" placeholder="Isi Jika Ada resepnya">
                                        </div>
                                    
                                    </div>
                               
                               
                                <hr class="w-auto h-1  bg-red-700 border-red-100 rounded mt-4">
                            
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-8">
                        <div class="card card-primary">
                            <div class="card-header">
                            <h3 class="card-title"> <i class="fas fa-shopping-cart"></i> Data Penjualan</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label for="obat_id">Obat</label>
                                        <select name="obat_id" id="obat_id" class="form-control rounded">
                                            <option value="">Pilih Obat</option>
                                            @foreach ($obat as $item )
                                                <option value="{{ $item->obatid }}">{{ $item->namaObat }}</option>     
                                            @endforeach
                                        </select>  
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="stock" class="mr-sm-2">Stock Tersedia</label>
                                        <input type="text" onkeypress="return number(event)"  class="form-control rounded" readonly autocomplete="off" name="stock" id="stock"  value="0" class="form-control rounded">
                                        
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="no" class="mr-sm-2">No Kwitansi</label>
                                        <input type="text" onkeypress="return number(event)"  class="form-control rounded"  autocomplete="off" name="nota" id="nota" value="{{ $nomor }}" readonly class="form-control">
                                    </div>
                                    <div class="form-group col-md-3">
                                       
                                            <label class="mr-sm-2">Tanggal</label>
                                              <div class="input-group date" id="tanggal" data-target-input="nearest">
                                                  <input type="text" class="form-control datetimepicker-input"  id="tanggal" name="tanggal" data-target="#tanggal" value="{{ $tanggals }}">
                                                  <div class="input-group-append" data-target="#tanggal" data-toggle="datetimepicker">
                                                      <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                  </div>
                                              </div>
                                          
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label for="qty">Jumlah Pembelian</label>
                                        <div class="btn-group col-md-10" role="group" aria-label="Basic mixed style example">
                                            <button type="button" id="decrement-btn" class="btn btn-danger btn-sm">-</button>
                                            <input type="text" name="qty" id="qty" class="form-control rounded" value="0">
                                            <button type="button" id="increment-btn" class="btn btn-success btn-sm">+</button>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="stocklama" class="mr-sm-2">Harga @Satuan</label>
                                        <input type="text" onkeypress="return number(event)"  class="form-control rounded" readonly autocomplete="off" name="harga" id="harga"  value="0" class="form-control">
                                        
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="inlineForm" class="mr-sm-2">Diskon</label>
                                        <input type="text" onkeypress="return number(event)"  class="form-control rounded"  autocomplete="off" name="diskon" id="diskon" value="0" class="form-control">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="inlineForm" class="mr-sm-2">Total Harga</label>
                                        <input type="text" onkeypress="return number(event)"  class="form-control rounded"  autocomplete="off" name="total" id="total" value="0" class="form-control">
                                    </div>
                                </div>
                                <hr class="w-auto h-1  bg-red-700 border-red-100 rounded mt-2">
                                <div class="modal-footer  d-flex justify-start  mt-1">
                                    <div class="d-flex  w-80">
                                            <button type="submit" class="btn btn-block btn-outline-warning btn-md mx-1 my-1 rounded-md w-32"  id="tambah" name="tambah"><i class="far fa-save"></i> Save</button>
                                        </form>
                                            <button type="submit" id="simpan" class="btn btn-block btn-outline-success btn-md mx-1 my-1 rounded-md w-36"><i class="fas fa-plus"></i>Tambah Obat</button>
                                        
                                    </div>
                                </div>
                                <div class="max-w-full mx-auto sm:px-1 lg:px-1">
                                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                                        <table class="table table-stripped" id="tabelpenjualan" style="width: 100%">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Obat</th>
                                                    <th>Qty</th>
                                                    <th>Harga</th>
                                                    <th>Total Harga</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                        
                                        </table>
                                    </div>
                                    <div class="row">
                                        <div class="col-3">

                                        </div>
                                        <div class="col-3">

                                        </div>
                                        <div class="col-3">
                                            {{-- <form action="" method="post">
                                                @csrf
                                                <input type="text" name="kwitansi" id="kwitansi" class=" form-control rounded " value="nomor" onkeypress="return number(event)" maxlength="12">
                                            </form> --}}
                                            <button type="submit" id="btn-bayar" name="btn-bayar" data-target="#modal-secondary" class="btn btn-danger"><i class="fas fa-money-bill-wave"></i>Prosees </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                          
                        </div>
                    </div>
                    
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
    $('#obat_id').select2();
    // tabelpenjualan
});
        //Date picker
     $('#tanggal').datetimepicker({
        format: 'YYYY-MM-DD',
       
    });

    
    
    // const $qtyInput = $('#qty');
    // let qty = parseInt($qtyInput.val());

    // $('#increment-btn').on('click', function() {
    //     qty++;
    //     $qtyInput.val(qty);
    // });

    // $('#decrement-btn').on('click', function() {
    //     if (qty > 0) {
    //         qty--;
    //         $qtyInput.val(qty);
    //     }
    // });
    function updateQuantity(increment) {
            const $qtyInput = $('#qty');
            let qty = parseInt($qtyInput.val(), 10);

            qty += increment;
            // Ensure qty does not go below 0
            if (qty < 0) qty = 0;

            $qtyInput.val(qty);
     }

        $('#increment-btn').on('click', function() {
            updateQuantity(1);
            let harga = parseInt($('#harga').val()) || 0; // Menggunakan || 0 untuk menangani nilai NaN
            let qty = parseInt($('#qty').val()) || 0;      // Menggunakan || 0 untuk menangani nilai NaN
            let stock = parseInt($('#stock').val()); 
            let stocks = stock - 1;
            $('#total').val(qty * harga);
            $('#stock').val(stocks);
        });

       
         
        $('#decrement-btn').on('click', function() {
        let harga = parseInt($('#harga').val()) || 0;
        let qty = parseInt($('#qty').val()) || 0;
        let stock = parseInt($('#stock').val()) || 0;

       
        let newQty = qty - 1;
        let newStock = stock + 1;

     
        if (newQty >= 0) {
            $('#total').val(newQty * harga);
            $('#stock').val(newStock);
            $('#qty').val(newQty);
        } else {
            console.log("Kuantitas tidak dapat kurang dari nol.");  // Debug: log pesan error
        }
    });

    
    function number(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    }

    $('#obat_id').change(function () {
        let id = $(this).val();
        $.ajax({
            url : "{{ route('stock.getdataobat') }}",
            type : 'post',
            data : {
                id : id,
                _token :  "{{ csrf_token() }}"
            },
            success : function(res) {
                console.log(res);
                $('#harga').val(res.jual);
                $('#stock').val(res.stock);
                $('#qty').val(0);
            }
        })
    });

    $(document).on('blur', '#qty', function() {
        let harga = parseInt($('#harga').val()) || 0; // Menggunakan || 0 untuk menangani nilai NaN
        let qty = parseInt($(this).val()) || 0;      // Menggunakan || 0 untuk menangani nilai NaN
        let stock = parseInt($('#stock').val()) - qty;
        $('#total').val(qty * harga);
        $('#stock').val(stock);
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

            success: function (res) {
                console.log(res.text);
                 
                // $('#btn-tutup').click();
                // $('#forms')[0].reset();
                toastr.success(res.text, 'Success'); // Menampilkan notifikasi toastr sukses
                $('#tabelpenjualan').DataTable().ajax.reload();
            },
            error: function(xhr){
                console.log(xhr);
                toastr.error(xhr.responseJSON.text, 'gagal!'); // Menampilkan notifikasi toastr error
            }
        });
    });


    $('#tabelpenjualan').DataTable({
        serverSide: true,
        processing: true,
        autoWidth: false,
        scrollX: true,
        language: {
            url: "{{ asset('adminlte/plugins/datatables/bahasa/id.json') }}"
        },
        ajax: {
            url: "{{ route('penjualan.datapenjualan') }}",
            data: function (d) {
                d.id = $('#nota').val(); // Add parameter for the request
            },
            error: function (xhr, error, thrown) {
                console.log(xhr.responseText); // Log any errors for debugging
            }
        },
        columns: [
            {
                data: null,
                sortable: false,
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            { data: 'namaobat', name: 'namaobat' },
            { data: 'qty', name: 'qty' },
            { 
                data: 'jual', name: 'jual',render: $.fn.dataTable.render.number(',', '.', 2, '')     
            },
            { 
                data: 'subtotal', name: 'subtotal',render: $.fn.dataTable.render.number(',', '.', 2, '')     
            },
            { data: 'aksi', name: 'aksi', orderable: false }
        ]
    });

    $(document).on('click', '.hapus', function(){
        let id = $(this).attr('id');
        $.ajax({
            url: "{{ route('penjualan.destroy') }}",
            type: 'post',
            data: {
                id : id,
                _token : "{{ csrf_token() }}"
            }, 
            success: function(res) {
                console.log(res);
                toastr.success(res.text, 'Success'); 
                $('#tabelpenjualan').DataTable().ajax.reload();
            }
        })
    });


    
            



    
</script>



