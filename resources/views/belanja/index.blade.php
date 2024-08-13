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
                        <h3 class="card-title"> <i class="fas fa-shopping-cart"></i> Data Pembelian</h3>
                        </div>
                    </div>
                <div class="row"> 
                    <div class="col-md-9">
                            <form action="{{ route('belanja.store') }}" method="post" id="form-beli">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-3">
                                            <label for="faktur" class="mr-sm-2">No Pembelian</label>
                                            <input type="text" onkeypress="return number(event)"  class="form-control rounded "  autocomplete="off" name="faktur" id="faktur" value="{{ $nomor }}" readonly class="form-control">
                                        </div>
                                        <div class="form-group col-md-3">
                                        
                                            <label class="mr-sm-2">Tanggal</label>
                                            <div class="input-group date" id="tanggal" data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input"  id="tanggal" name="tanggal" data-target="#tanggal" value="{{ $times }}">
                                                <div class="input-group-append" data-target="#tanggal" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                        
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="supplier_id">Nama Supplier</label>
                                            <select name="supplier_id" id="supplier_id" class="custom-select m2-sm-2 js-example-basic-single form-control rounded">
                                                <option value="">Pilih Supplier</option>
                                                @foreach ($supplier as $item )
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>     
                                                @endforeach
                                            </select>  
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="obat_id">Kode Barang</label>
                                            <select name="kode" id="kode" class="form-control rounded">
                                                <option value="">Pilih Barang</option>
                                                @foreach ($obat as $item )
                                                    <option value="{{ $item->id }}">{{ $item->kode }}</option>     
                                                @endforeach
                                            </select>  
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-3">
                                            <label for="item" class="mr-sm-2">Nama Barang</label>
                                            <input type="text" class="form-control rounded " autocomplete="off" name="item" id="item" class="form-control rounded">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="harga" class="mr-sm-2">Harga @ Satuan</label>
                                            <input type="text" onkeypress="return number(event)"  class="form-control rounded text-right number-format" autocomplete="off" name="harga" id="harga"  value="0" class="form-control rounded">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="qty" class="mr-sm-2">Jumlah Pembelian</label>
                                            <input type="text" onkeypress="return number(event)"  class="form-control rounded text-right number-format" autocomplete="off" name="qty" id="qty"  value="0" class="form-control rounded">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="subtotal" class="mr-sm-2">Sub Total</label>
                                            <input type="text" onkeypress="return number(event)"  class="form-control rounded text-right number-format" readonly autocomplete="off" name="subtotal" id="subtotal"  value="0" class="form-control rounded">
                                        </div>
                                        
                                    
                                    </div>
                                    <div class="row">
                                        

                                        <div class="form-group col-md-3">
                                            <label for="pajak" class="mr-sm-2">Pajak</label>
                                            <input type="text" onkeypress="return number(event)"  class="form-control rounded text-right number-format" autocomplete="off" name="pajak" id="pajak"  value="0" class="form-control">
                                            
                                        </div>

                                        
                                        <div class="form-group col-md-3">
                                            <label for="inlineForm" class="mr-sm-2">Diskon</label>
                                            <input type="text" onkeypress="return number(event)"  class="form-control rounded text-right number-format"  autocomplete="off" name="diskon" id="diskon" value="0" class="form-control">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="keterangan" class="mr-sm-2">Keterangan</label>
                                            <input type="text"  class="form-control rounded"  autocomplete="off" name="keterangan" id="keterangan" >
                                        </div>
                                    </div>
                                    <hr class="w-auto h-1  bg-red-700 border-red-100 rounded mt-2">
                                    <div class="modal-footer  d-flex justify-start  mt-1">
                                        <div class="d-flex  w-80">
                                                <button type="submit" class="btn btn-block btn-outline-warning btn-md mx-1 my-1 rounded-md w-32"  id="tambahsimpan" name="tambahsimpan"><i class="far fa-save"></i> Save</button>
                            </form>    
                                                <button type="button" id="buka"  name="buka"  class="btn btn-block btn-outline-danger btn-md mx-1 my-1 rounded-md w-36"><i class="fas fa-plus"></i>Tambah Item</button>
                                            
                                        </div>

                                    </div>
                            </div>
                            <div class="max-w-full mx-auto sm:px-1 lg:px-1">
                                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                                    <div class="card card-danger table-responsive">
                                        <div class="card-header">
                                            <h3 class="card-title"><i class="fas fa-shopping-cart">Keranjang</i></h3>
                                        </div>
                                        <table class="table table-stripped" id="tabelpembelian" style="width: 100%">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Supplier</th>
                                                    <th>Nama Obat</th>
                                                    <th>Harga</th>
                                                    <th>Qty</th>
                                                    <th>Pajak</th>
                                                    <th>Diskon</th>
                                                    <th>Total Harga</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                        
                                        </table>
                                    </div>
                                </div>
                                <button type="button" id="prosess" name="prosess" class="btn btn-danger"> <i class="nav-icon far fa-save"></i> ACC / Prosess</button>
                                <div class="row">
                                    <div class="col-3">

                                    </div>
                                    <div class="col-3">

                                    </div>
                                    <div class="col-3">
                                        
                                    </div>                                  
                                </div>
                            {{-- </div> --}}
                    </div>
                </div>

                    <div class="col-md-3" id="prosessHitung">
                        <div class="card card-danger">
                            <div class="card-body">
                                {{-- <hr class="w-auto h-1  bg-red-700 border-red-100 rounded mb-4 pt-0"> --}}
                              
                                  
                                    <div class="form-group ">
                                        <label for="metode">Metode Bayar</label>
                                        <select name="metode" id="metode" class="form-control rounded">
                                            <option value="">Pilih Metode</option>
                                            <option value="Cash">Cash</option>
                                            <option value="Hutang">Hutang</option>
                                           
                                        </select>  
                                    </div>

                                    <div class="form-group">
                                        <label for="ttltotal" class="mr-sm-2">Total Kotor</label>
                                        <input type="text" onkeypress="return number(event)"  class="form-control rounded number-format text-right"  autocomplete="off" name="ttltotal" id="ttltotal" value="0" class="form-control">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="ttlpajak" class="mr-sm-2">Besar Pajak</label>
                                        <input type="text" onkeypress="return number(event)"  class="form-control rounded number-format text-right"  autocomplete="off" name="ttlpajak" id="ttlpajak" value="0" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label for="ttldiskon" class="mr-sm-2">Besar Diskon</label>
                                        <input type="text" onkeypress="return number(event)"  class="form-control rounded number-format text-right"  autocomplete="off" name="ttldiskon" id="ttldiskon" value="0" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label for="grand" class="mr-sm-2">Total Bersih/ yang harus dibayar</label>
                                        <input type="text" onkeypress="return number(event)"  class="form-control rounded number-format text-right"  autocomplete="off" name="grand" id="grand" value="0" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="dibayar" class="mr-sm-2">Pembayaran Sebesar</label>
                                        <input type="text" onkeypress="return number(event)"  class="form-control rounded number-format text-right"  autocomplete="off" name="dibayar" id="dibayar" value="0" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="inlineForm" class="mr-sm-2">Keterangan</label>
                                        <input type="text" class="form-control rounded"  autocomplete="off" name="keteranganbeli" id="keteranganbeli">
                                    </div>
                                   
                                    <button type="button" id="simpanBeli" name="simpanBeli" class="btn btn-danger"><i class="nav-icon far fa-save"></i> Simpan</button>
                                    {{-- <form action="{{ route('beli.cetak') }}" method="post"> --}}
                                            {{-- @csrf
                                            <input type="text" name="faktur" id="faktur" class="form-control rounded " hidden value="" onkeypress="return number(event)" maxlength="15">
                                            
                                            <button type="button" id="cetak" name="cetak" class="btn btn-danger float-left rounded"  target="_blank">
                                                <i class="fas fa-file-pdf mr-2"></i>Cetak Faktur
                                            </button> --}}
                                        {{-- </form> --}}
                                        
                
                                        <button class="transaksiBaru btn btn-warning" id="transaksiBaru" name="transaksiBaru"> Pembelian Baru</button>
                                    
                                {{-- <hr class="w-auto h-1  bg-red-700 border-red-100 rounded mt-4"> --}}
                            
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
    $('#kode').select2();
    $('#supplier_id').select2();
    // $('#prosessHitung').hide();
    $('#buka').hide();
    $('#metode').attr('disabled', true);
    $('#ttltotal').attr('disabled', true);
    $('#ttlpajak').attr('disabled', true);
    $('#ttldiskon').attr('disabled', true);
    $('#ttldiskon').attr('disabled', true);
    $('#grand').attr('disabled', true);
    $('#dibayar').attr('disabled', true);
    $('#keteranganbeli').attr('disabled', true);
    $('#simpanBeli').attr('disabled', true);
    $('#prosess').attr('disabled', true);
   // buatCinta();

    // // tabelpenjualan
    // $('tambah').hide();
    // $('#buka').hide();
    $('#transaksiBaru').hide();
    // $('#cetak').hide();
    $(document).on('click', '#transaksiBaru', function() {
                location.reload(); // Me-refresh halaman
    });

    // $('#btn-bayar').hide();

    
});

 // Fungsi untuk memformat angka
 function formatNumber(value) {
            return value.replace(/\D/g, '') // Menghapus semua karakter non-digit
                        .replace(/\B(?=(\d{3})+(?!\d))/g, ','); // Menambahkan koma sebagai pemisah ribuan
}

// Fungsi untuk menangani perubahan input dan memformat angka
function onInputChange(event) {
    let input = event.target;
    let formattedValue = formatNumber(input.value);
    input.value = formattedValue;
}

// Menambahkan event listener ke semua input dengan kelas 'number-format'
document.addEventListener('DOMContentLoaded', function() {
    let inputs = document.querySelectorAll('.number-format');
    inputs.forEach(function(input) {
        input.addEventListener('input', onInputChange);
    });
});

function number(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    }
        //Date picker
     $('#tanggal').datetimepicker({
        format: 'YYYY-MM-DD',
       
    });

    function cariKode(kode){
        $.ajax({
            url : "{{ route('cariKode') }}",
            type: 'post',
            data : {
                kode : kode,
                 _token :  "{{ csrf_token() }}"
            }, success : function(res){
                if (res.length > 0){
                    $('#item').val(res[0].name);
                } else {
                    $('#item').val(null);  
                }
                console.log(res);
            }, error : function(xhr){
                console.log(xhr);
            }
        })
    };

    $(document).on('change', '#kode', function(){
        cariKode($(this).val())
    })
    $(document).on('click', '#buka', function(){
        $('#supplier_id').prop('disabled', false);
        $('#kode').prop('disabled', false);
        $('#item').attr('disabled', false);
        $('#harga').attr('disabled', false);
        $('#qty').attr('disabled', false);
        $('#subtotal').attr('disabled', false);
        $('#tambahsimpan').show();
        $('#buka').hide();
        
    })

    // function buatCinta() {
    //     let n = 30;
    //     let str = "";

    //     for (let i = n/2; i<n; i += 2) {
    //         for (let j=1; j<n-i; j+=2) {
    //             str += " ";
    //         }
    //         for (let j=1; j<i +1; j++) {
    //             str += "*";
    //         }
    //         for (let j=1; j<n-i +1; j++) {
    //             str += " ";
    //         }
    //         for (let j=1; j<i +1 ; j++) {
    //             str += "*";
    //         }
    //         str += "\n";
    //     }
    //     for (let i = n; i>0; i--){
    //         for (let j=0; j<n -i; j++){
    //             str += " ";
    //         }
    //         for (let j=1; j<i*2; j++){
    //             str += "*";
    //         }
    //         str += "\n";
    //     }
    //     console.log(str);
    // }

    $(document).on('blur', '#harga', function() {
        let harga = parseFloat($(this).val()); // Menggunakan || 0 untuk menangani nilai NaN
        let qty = parseInt($('#qty').val());      // Menggunakan || 0 untuk menangani nilai NaN
        $('#subtotal').val(qty * harga);
    
    });
    $(document).on('blur', '#qty', function() {
        let harga = parseInt($('#harga').val()); // Menggunakan || 0 untuk menangani nilai NaN
        let qty = parseInt($(this).val());      // Menggunakan || 0 untuk menangani nilai NaN
        $('#subtotal').val(qty * harga);
    
    });

    $(document).on('submit', 'form', function(event){
        let faktur = $('#faktur').val();
        event.preventDefault();          
        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            dataType: "json",
            data: new FormData(this),
            processData: false,
            contentType: false,
            success: function (res, status, error) {
                $('#supplier_id').prop('disabled', true);
                $('#kode').prop('disabled', true);
                $('#item').attr('disabled', true);
                $('#harga').attr('disabled', true);
                $('#qty').attr('disabled', true);
                $('#subtotal').attr('disabled', true);
                $('#tambahsimpan').hide();
                $('#buka').show();

                console.log(res.text);
                toastr.success(res.text, 'Success');
                $('#tabelpembelian').DataTable().destroy();
                isi(faktur);     
            },
            error: function(xhr){
                console.log(xhr);
                toastr.error(xhr.responseJSON.text, 'gagal!'); // Menampilkan notifikasi toastr error
            }
        });
        $('#prosess').attr('disabled', false);
    });

//
function isi(faktur) {
    $('#tabelpembelian').DataTable({
        serverSide: true,
        processing: true,
        autoWidth: false,
        scrollX: true,
        language: {
            url: "{{ asset('adminlte/plugins/datatables/bahasa/id.json') }}"
        },
        ajax: {
            url: "{{ route('datapembelian') }}",
            data: {
                faktur: faktur
            },
            error: function(xhr, error, thrown) {
                console.log(xhr.responseText);
            }
        },
        columns: [
            {
                data: null,
                sortable: false,
                render: function(data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            { data: 'supplier', name: 'supplier' },
            { data: 'item', name: 'item' },
            { data: 'harga', name: 'harga', render: $.fn.dataTable.render.number(',', '.', 2, '') },
            { data: 'qty', name: 'qty' },
            { data: 'pajak', name: 'pajak', render: $.fn.dataTable.render.number(',', '.', 2, '') },
            { data: 'diskon', name: 'diskon', render: $.fn.dataTable.render.number(',', '.', 2, '') },
            { data: 'totalbersih', name: 'totalbersih', render: $.fn.dataTable.render.number(',', '.', 2, '') },
            { data: 'aksi', name: 'aksi', orderable: false }
        ]
    });
}


$(document).on('click', '.hapus', function() {
    let id = $(this).attr('id');
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "{{ route('belanja.hapus') }}",
                type: "POST",
                data: {
                    id: id,
                    _token: "{{ csrf_token() }}"
                },
                success: function(res) {
                    // Update DataTable after deletion
                    $('#tabelpembelian').DataTable().ajax.reload();  // Reload the table data
                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: "Data Berhasil Dihapus",
                        showConfirmButton: false,
                        timer: 1500,
                        text: res.text 
                    });
                },
                error: function(xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Failed to delete data'
                    });
                }
            });
        }
    });
});

$(document).on('click', '#prosess', function() 
{
    // $('#prosessHitung').show();
    $('#metode').attr('disabled', false);
$('#ttltotal').attr('disabled', false);
$('#ttlpajak').attr('disabled', false);
$('#ttldiskon').attr('disabled', false);
$('#ttldiskon').attr('disabled', false);
$('#grand').attr('disabled', false);
$('#dibayar').attr('disabled', false);
$('#keteranganbeli').attr('disabled', false);
$('#simpanBeli').attr('disabled', false);
    let id = $('#faktur').val();
    $.ajax({
        url: "{{ route('prosessbayar') }}",
        type: 'POST',
        data: {
            id: id,
            _token: "{{ csrf_token() }}"
        },
        success: function(res) {
            console.log(res);
            $('#ttltotal').val(res.data[0].totalKotor);
            $('#ttlpajak').val(res.data[0].totalPajak);
            $('#ttldiskon').val(res.data[0].totalDiskon);
            $('#grand').val(res.data[0].totalBersih);
            
        },
        error: function(xhr) {
            
            console.log(xhr);
        }
    })
});

$(document).on('click', '#simpanBeli', function() {
    $.ajax({
        url: "{{ route('pembayaran.store') }}",
        type: 'POST',
        data: {
            nota : $('#faktur').val(),
            totalharga : $('#ttltotal').val(),
            totalpajak : $('#ttlpajak').val(),
            totaldiskon : $('#ttldiskon').val(),
            harusbayar :  $('#grand').val(),
            jumlahdibayar : $('#dibayar').val(),
            kembali :  $('#keteranganbeli').val(),
            status :  $('#metode').val(),
            _token: "{{ csrf_token() }}"
        },
        success: function (res) {
            console.log(res.text);
            toastr.success(res.text, 'Success');
            $('#transaksiBaru').show();
        },
        error: function(xhr){
            console.log(xhr);
            toastr.error(xhr.responseJSON.text, 'gagal!'); 
        }
    })

});

$(document).on('blur', '#dibayar', function() {
        let a = $('#grand').val();
        let b = $(this).val();
        let c =  b - a;

        if (c < 0) {
            toastr.info('Periksa Inputan', 'Info'); 
            $('#simpanbayar').hide();
        } else {
            $('#keteranganbeli').val(c);
            // $('#simpanbayar').show();
        }
    });

 </script>


