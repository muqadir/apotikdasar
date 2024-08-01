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
        <div class="card-header">
            {{-- <h3 class="card-title"> <i class="fas fa-shopping-cart"></i> Data Pembelian</h3> --}}
            </div>
        <div class="max-w-full mx-auto sm:px-1 lg:px-1">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

             
                    <div class="card card-danger">
                        <div class="card-header">
                        <h3 class="card-title"> <i class="fas fa-shopping-cart"></i> Data Penjualan</h3>
                        </div>
                    </div>
                <div class="row"> 
                    <div class="col-md-8">
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <label for="no" class="mr-sm-2">No Pembelian</label>
                                    <input type="text" onkeypress="return number(event)"  class="form-control rounded"  autocomplete="off" name="nota" id="nota" value="" readonly class="form-control">
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
                                <div class="form-group col-md-3">
                                    <label for="obat_id">Supplier</label>
                                    <select name="obat_id" id="obat_id" class="form-control rounded">
                                        <option value="">Pilih Supplier</option>
                                        {{-- @foreach ($obat as $item )
                                            <option value="{{ $item->obatid }}">{{ $item->namaObat }}</option>     
                                        @endforeach --}}
                                    </select>  
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="obat_id">Kode Barang</label>
                                    <select name="obat_id" id="obat_id" class="form-control rounded">
                                        <option value="">Pilih Barang</option>
                                        {{-- @foreach ($obat as $item )
                                            <option value="{{ $item->obatid }}">{{ $item->namaObat }}</option>     
                                        @endforeach --}}
                                    </select>  
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <label for="stock" class="mr-sm-2">Nama Barang</label>
                                    <input type="text" onkeypress="return number(event)"  class="form-control rounded" autocomplete="off" name="stock" id="stock"  value="0" class="form-control rounded">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="stock" class="mr-sm-2">Harga @ Satuan</label>
                                    <input type="text" onkeypress="return number(event)"  class="form-control rounded" autocomplete="off" name="stock" id="stock"  value="0" class="form-control rounded">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="stock" class="mr-sm-2">Jumlah Pembelian</label>
                                    <input type="text" onkeypress="return number(event)"  class="form-control rounded" readonly autocomplete="off" name="stock" id="stock"  value="0" class="form-control rounded">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="stock" class="mr-sm-2">Sub Total</label>
                                    <input type="text" onkeypress="return number(event)"  class="form-control rounded" readonly autocomplete="off" name="stock" id="stock"  value="0" class="form-control rounded">
                                </div>
                                
                               
                            </div>
                            <div class="row">
                                

                                <div class="form-group col-md-3">
                                    <label for="stocklama" class="mr-sm-2">Pajakl</label>
                                    <input type="text" onkeypress="return number(event)"  class="form-control rounded" readonly autocomplete="off" name="harga" id="harga"  value="0" class="form-control">
                                    
                                </div>

                                
                                <div class="form-group col-md-3">
                                    <label for="inlineForm" class="mr-sm-2">Diskon</label>
                                    <input type="text" onkeypress="return number(event)"  class="form-control rounded"  autocomplete="off" name="diskon" id="diskon" value="0" class="form-control">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="inlineForm" class="mr-sm-2">Keterangan</label>
                                    <input type="text" onkeypress="return number(event)"  class="form-control rounded"  autocomplete="off" name="total" id="total" value="0" class="form-control">
                                </div>
                            </div>
                            <hr class="w-auto h-1  bg-red-700 border-red-100 rounded mt-2">
                            <div class="modal-footer  d-flex justify-start  mt-1">
                                <div class="d-flex  w-80">
                                        <button type="submit" class="btn btn-block btn-outline-warning btn-md mx-1 my-1 rounded-md w-32"  id="tambah" name="tambah"><i class="far fa-save"></i> Save</button>
                                        <button type="button" id="buka"  name="buka"  class="btn btn-block btn-outline-success btn-md mx-1 my-1 rounded-md w-36"><i class="fas fa-plus"></i>Tambah Obat</button>
                                    
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
                                        {{-- <form action="{{ route('penjualan.cetak') }}" method="post"> --}}
                                            @csrf
                                            <input type="text" name="kwitansi" id="kwitansi" class="form-control rounded " hidden value="" onkeypress="return number(event)" maxlength="15">
                                            
                                            <button type="button" id="cetak" name="cetak" class="btn btn-danger float-left rounded"  target="_blank">
                                                <i class="fas fa-file-pdf mr-2"></i>Cetak Slip
                                            </button>
                                        {{-- </form> --}}
                                        
                                        <button type="button" id="btn-bayar" name="btn-bayar" class="btn btn-danger rounded" data-toggle="modal" data-target="#modal-success">
                                            <i class="fas fa-money-bill-wave"></i>Prosees
                                        </button>
                                        <button class="transaksiBaru btn btn-warning" id="transaksiBaru" name="transaksiBaru"> Transaksi Baru</button>
                                    
                                    </div>
                                    
                                    



                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card card-danger">
                            <div class="card-body">
                                {{-- <hr class="w-auto h-1  bg-red-700 border-red-100 rounded mb-4 pt-0"> --}}
                              
                                  
                                    <div class="form-group ">
                                        <label for="obat_id">Metode Bayar</label>
                                        <select name="obat_id" id="obat_id" class="form-control rounded">
                                            <option value="">Pilih Barang</option>
                                            {{-- @foreach ($obat as $item )
                                                <option value="{{ $item->obatid }}">{{ $item->namaObat }}</option>     
                                            @endforeach --}}
                                        </select>  
                                    </div>

                                    <div class="form-group">
                                        <label for="inlineForm" class="mr-sm-2">Total Kotor</label>
                                        <input type="text" onkeypress="return number(event)"  class="form-control rounded"  autocomplete="off" name="total" id="total" value="0" class="form-control">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="inlineForm" class="mr-sm-2">Besar Pajak</label>
                                        <input type="text" onkeypress="return number(event)"  class="form-control rounded"  autocomplete="off" name="total" id="total" value="0" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label for="inlineForm" class="mr-sm-2">Besar Diskon</label>
                                        <input type="text" onkeypress="return number(event)"  class="form-control rounded"  autocomplete="off" name="total" id="total" value="0" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label for="inlineForm" class="mr-sm-2">Total Kotor</label>
                                        <input type="text" onkeypress="return number(event)"  class="form-control rounded"  autocomplete="off" name="total" id="total" value="0" class="form-control">
                                    </div>
                                   
                            
                            
                                {{-- <hr class="w-auto h-1  bg-red-700 border-red-100 rounded mt-4"> --}}
                            
                            </div>
                        </div>
                    </div>
                        
                </div>

                <div class="modal fade" id="modal-success">
                    <div class="modal-dialog">
                        <div class="modal-content bg-emerald-100">
                            <div class="modal-header">
                            <h4 class="modal-title"><h2>Transaksi Pembayaran</h2></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
        
                                {{-- <form action="{{ route('pembayaran.store') }}" method="post" id="pembayaran"> --}}
                                        @csrf
                                    <div class="bg-transparent w-auto rounded  mx-2  my-0">FORM PERMBAYARAN
                                        <hr class="w-auto h-1 my-1 bg-red-700 border-0 rounded">
                                    </div>
        
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="note" class="mr-sm-2">Nota Pemjualan</label>
                                            <input type="text" onkeypress="return number(event)"  class="form-control rounded" readonly autocomplete="off" name="modalnota" id="modalnota" class="form-control" value="">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="kasir" class="mr-sm-2">Kasir : </label>
                                            <input type="text" onkeypress="return number(event)"  class=" rounded bg-transparent border-none  w-full focus:outline-none" readonly autocomplete="off"  value="{{ Auth::user()->name }}"> 
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="totalharga">Total Harga</label>
                                        <input type="text" onkeypress="return number(event)"  class="form-control rounded text-right" readonly autocomplete="off" name="totalharga" id="totalharga" class="form-control" value="0">
                                    </div>
                                    <div class="form-group">
                                        <label for="supplier">Diskon</label>
                                        <input type="text" onkeypress="return number(event)"  class="form-control rounded text-right" readonly autocomplete="off" name="modaldiskon" id="modaldiskon" class="form-control" value="0">
                                    </div>
                                    <div class="form-group">
                                        <label for="supplier">Jumlah Yang harus di bayar</label>
                                        <input type="text" onkeypress="return number(event)"  class="form-control rounded text-right" readonly autocomplete="off" name="harusbayar" id="harusbayar" class="form-control" value="0">
                                    </div>
                                    <div class="form-group">
                                        <label for="supplier">Jumlah Bayar</label>
                                        <input type="text" onkeypress="return number(event)"  class="form-control rounded text-right" autocomplete="off" name="jumlahdibayar" id="jumlahdibayar" class="form-control" value="0">
                                    </div>
                                    <div class="form-group">
                                        <label for="supplier">Uang Kembali</label>
                                        <input type="text" onkeypress="return number(event)"  class="form-control rounded text-right" readonly autocomplete="off" name="kembali" id="kembali" class="form-control" value="0">
                                    </div>
                                    
                                    
                                    
                                    <div class="modal-footer  d-flex justify-content-end ">
                                        <div class="d-flex justify-items-center  ">
                                                <button type="button" class="btn btn-block btn-outline-success btn-lg mx-1 my-1 rounded-md" data-dismiss="modal" id="btn-tutup">Close</button>
                                                
                                                <button type="submit" id="simpanbayar" class="btn btn-block btn-outline-success btn-lg mx-1 my-1 rounded-md">Bayar </button>
                                            
                                        </div>
                                    </div>
                                </form>
                            
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

// $(document).ready(function(){
//     $('#obat_id').select2();
//     // tabelpenjualan
//     $('tambah').hide();
//     $('#buka').hide();
//     $('#transaksiBaru').hide();
//     $('#cetak').hide();
//     $(document).on('click', '#transaksiBaru', function() {
//                 location.reload(); // Me-refresh halaman
//     });

//     // $('#btn-bayar').hide();
// });
//         //Date picker
//      $('#tanggal').datetimepicker({
//         format: 'YYYY-MM-DD',
       
//     });

//     function updateQuantity(increment) {
//             const $qtyInput = $('#qty');
//             let qty = parseInt($qtyInput.val(), 10);

//             qty += increment;
//             // Ensure qty does not go below 0
//             if (qty < 0) qty = 0;

//             $qtyInput.val(qty);
//      }

//         $('#increment-btn').on('click', function() {
//             updateQuantity(1);
//             let harga = parseInt($('#harga').val()) || 0; // Menggunakan || 0 untuk menangani nilai NaN
//             let qty = parseInt($('#qty').val()) || 0;      // Menggunakan || 0 untuk menangani nilai NaN
//             let stock = parseInt($('#stock').val()); 
//             let stocks = stock - 1;
//             $('#total').val(qty * harga);
//             $('#stock').val(stocks);
//         });

       
         
//         $('#decrement-btn').on('click', function() {
//         let harga = parseInt($('#harga').val()) || 0;
//         let qty = parseInt($('#qty').val()) || 0;
//         let stock = parseInt($('#stock').val()) || 0;

       
//         let newQty = qty - 1;
//         let newStock = stock + 1;

     
//         if (newQty >= 0) {
//             $('#total').val(newQty * harga);
//             $('#stock').val(newStock);
//             $('#qty').val(newQty);
//         } else {
//             console.log("Kuantitas tidak dapat kurang dari nol.");  // Debug: log pesan error
//         }
//     });

    
//     function number(evt) {
//         var charCode = (evt.which) ? evt.which : event.keyCode
//         if (charCode > 31 && (charCode < 48 || charCode > 57))
//             return false;
//         return true;
//     }

//     $(document).on('click', '#buka', function() {
//         $('#buka').hide();
//     });
    
//     $('#obat_id').change(function () {
//         let id = $(this).val();
//         $.ajax({
//             url : "{{ route('stock.getdataobat') }}",
//             type : 'post',
//             data : {
//                 id : id,
//                 _token :  "{{ csrf_token() }}"
//             },
//             success : function(res) {
//                 console.log(res);
//                 $('#harga').val(res.jual);
//                 $('#stock').val(res.stock);
//                 $('#qty').val(0);
//             }
//         })
//     });

//     $(document).on('blur', '#qty', function() {
//         let harga = parseInt($('#harga').val()) || 0; // Menggunakan || 0 untuk menangani nilai NaN
//         let qty = parseInt($(this).val()) || 0;      // Menggunakan || 0 untuk menangani nilai NaN
//         let stock = parseInt($('#stock').val()) - qty;
//         $('#total').val(qty * harga);
//         $('#stock').val(stock);
//     });


//     $(document).on('submit', 'form', function(event){
//         event.preventDefault();          
//         $.ajax({
//             url: $(this).attr('action'),
//             type: $(this).attr('method'),
//             dataType: "json",
//             data: new FormData(this),
//             processData: false,
//             contentType: false,

//             success: function (res) {
//                 console.log(res.text);
//                  $('#obat_id').prop('disabled', true);
//                  $('#qty').attr('disabled', true);
//                  $('#diskon').attr('disabled', true);
//                  $('#decrement-btn').attr('disabled', true);
//                 $('#increment-btn').attr('disabled', true);
//                 toastr.success(res.text, 'Success'); // Menampilkan notifikasi toastr sukses
//                 $('#tabelpenjualan').DataTable().ajax.reload();
//                 // $('#btn-bayar').show();
//                 $('#buka').hide();
//             },
//             error: function(xhr){
//                 console.log(xhr);
//                 toastr.error(xhr.responseJSON.text, 'gagal!'); // Menampilkan notifikasi toastr error
//             }
//         });
//     });


//     $('#tabelpenjualan').DataTable({
//         serverSide: true,
//         processing: true,
//         autoWidth: false,
//         scrollX: true,
//         language: {
//             url: "{{ asset('adminlte/plugins/datatables/bahasa/id.json') }}"
//         },
//         ajax: {
//             url: "{{ route('penjualan.datapenjualan') }}",
//             data: function (d) {
//                 d.id = $('#nota').val(); 
//             },
//             error: function (xhr, error, thrown) {
//                 console.log(xhr.responseText); 
//             }
//         },
//         columns: [
//             {
//                 data: null,
//                 sortable: false,
//                 render: function (data, type, row, meta) 
//                 {
//                     return meta.row + meta.settings._iDisplayStart + 1;
//                 }
//             },
//             { 
//                 data: 'namaobat', 
//                 name: 'namaobat' 
//             },
//             { 
//                 data: 'qty', 
//                 name: 'qty' 
//             },
//             { 
//                 data: 'jual', 
//                 name: 'jual',
//                 render: $.fn.dataTable.render.number(',', '.', 2, '')     
//             },
//             { 
//                 data: 'subtotal', 
//                 name: 'subtotal',
//                 render: $.fn.dataTable.render.number(',', '.', 2, '')     
//             },
//             { 
//                 data: 'aksi', 
//                 name: 'aksi', 
//                 orderable: false 
//             }
//         ]
//     });

//     // Menggunakan event draw.dt DataTable
//         $('#tabelpenjualan').on('draw.dt', function () {
//             // Periksa apakah DataTable memiliki data atau tidak
//             if ($(this).DataTable().data().count() === 0) {
//                 $('#btn-bayar').hide(); // Sembunyikan tombol jika tidak ada data
//             } else {
//                 $('#btn-bayar').show(); // Tampilkan tombol jika ada data
//             }
//         });

//         // Untuk memastikan kondisi awal saat halaman dimuat, cek secara langsung
//         if ($('#tabelpenjualan').DataTable().data().count() === 0) {
//             $('#btn-bayar').hide(); // Sembunyikan tombol jika tidak ada data saat halaman dimuat
//         } else {
//             $('#btn-bayar').show(); // Tampilkan tombol jika ada data saat halaman dimuat
//         }

//     $(document).on('click', '.hapus', function(){
//         let id = $(this).attr('id');
//         $.ajax({
//             url: "{{ route('penjualan.destroy') }}",
//             type: 'post',
//             data: {
//                 id : id,
//                 _token : "{{ csrf_token() }}"
//             }, 
//             success: function(res) {
//                 console.log(res);
//                 toastr.success(res.text, 'Success'); 
//                 $('#tabelpenjualan').DataTable().ajax.reload();
//             },
//             error: function(xhr){
//                 console.log(xhr);
//                 toastr.error(xhr.responseJSON.text, 'gagal!'); 
//             }

//         })
//     });

//     $('#buka').click(function(){
//         $('#tambah').show();
//         $('#obat_id').prop('disabled', false);
//         $('#qty').attr('disabled', false);
//         $('#decrement-btn').attr('disabled', false);
//         $('#increment-btn').attr('disabled', false);
//         $('#diskon').attr('disabled', false);
//         // $('#qty').val(null);
//         // $('#diskon')val(null);
//     });

//     $('#btn-bayar').click(function() {
//         let id = $('#nota').val();
//         $.ajax({
//             url: "{{ route('penjualan.gethitung') }}",
//             type: 'post',
//             data: {
//                 id : id,
//                 _token : "{{ csrf_token() }}"
//             },
//             success : function (res) {
//                 console.log(res);
//                 $('#modalnota').val(res.data[0].nota);
//                 $('#modaldiskon').val(res.diskon);
//                 $('#totalharga').val(res.data[0].totalHarga);
//                 $('#harusbayar').val(parseInt(res.data[0].totalHarga) - parseInt(res.diskon));
//             }

//         })
//     }); 
    
   
//     $(document).on('blur', '#jumlahdibayar', function() {
//         let a = $('#harusbayar').val();
//         let b = $(this).val();
//         let c =  b - a;

//         if (c < 0) {
//             toastr.info('Periksa Inputan', 'Info'); 
//             $('#simpanbayar').hide();
//         } else {
//             $('#kembali').val(c);
//             $('#simpanbayar').show();
//         }
//     });

//     $(document).on('click', '#simpanbayar', function() {
//         $.ajax({
//             url: "{{ route('pembayaran.store') }}",
//             type: 'post',
//             data: {
//                 nota : $('#modalnota').val(),
//                 totalharga : $('#totalharga').val(),
//                 totaldiskon : $('#modaldiskon').val(),
//                 harusbayar : $('#harusbayar').val(),
//                 jumlahdibayar : $('#jumlahdibayar').val(),
//                 kembali : $('#kembali').val(),
//                 _token : "{{ csrf_token() }}"
//             },
//             success : function (res) {
//                 console.log(res);
//                 toastr.success(res.text, 'Success'); 
//                 $('#btn-tutup').click();
//                 $('#transaksiBaru').show();
//                 $('#cetak').show();
//                 $('#buka').hide();
                
//             }

//         })

//     });
//     $(document).on('click', '#cetak', function() {
//         $.ajax({
//             url: "{{ route('penjualan.cetak') }}",
//             type: 'post',
//             data: {
               
//                kwitansi : $('#kwitansi').val(),
//                 _token : "{{ csrf_token() }}"
//             },
//             success : function (res) {
//                 $('#transaksiBaru').show();
//                 console.log(res);
//                 toastr.success(res.text, 'Success'); 
//                 var newTab = window.open(res.url, '_blank');
//                 newTab.focus();
//             },
//             error: function(xhr){
//                 console.log(xhr);
//                 toastr.error(xhr.responseJSON.text, 'gagal!'); 
//             }

//         })

//     });

    
</script>



