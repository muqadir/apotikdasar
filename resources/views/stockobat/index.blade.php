<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 pt-0">
        <div class="card card-warning">
            <div class="card-header">
                <h3 class="card-title">Stock Obat</h3>
            </div>
        </div>
        <div class="max-w-full mx-auto sm:px-1 lg:px-1">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <table class="table table-stripped" id="tabelstock" style="width: 100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>obat id</th>
                            <th>Masuk</th>
                            <th>Keluar</th>
                            <th>Jual</th>
                            <th>Beli</th>
                            <th>Expired</th>
                            <th>Stock</th>
                            <th>Keterangan</th>
                            <th>user id</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                </table>
            </div>
        </div>
        <button type="button" id="btn-tambah" class="btn btn-info" data-toggle="modal" data-target="#modal-info">
            Tambah
        </button>
        <div class="modal fade" id="modal-info">
            <div class="modal-dialog">
              <div class="modal-content bg-emerald-100">
                <div class="modal-header">
                  <h4 class="modal-title"><h2>Input Stoc</h2></h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">

                    <form action="{{ route('stock.store') }}" method="post" id="forms">
                        @csrf
                    

                    <div class="form-group">
                        <label for="obat">Nama</label>
                        <select name="obat_id" id="obat_id" class="form-control rounded">
                            <option value="">Pilih Obat</option>
                            @foreach ($obat as $item )
                            <option value="{{ $item->id }}">{{ $item->name }}</option>     
                            @endforeach
                        </select>  
                    </div>

                    <div class="bg-transparent w-auto rounded  mx-2  my-0">STOCK
                        <hr class="w-auto h-1 my-1 bg-red-700 border-0 rounded">
                    </div>

                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="stocklama" class="mr-sm-2">Stock Awal</label>
                            <input type="text" onkeypress="return number(event)"  class="form-control rounded" readonly autocomplete="off" name="stocklama" id="stocklama"  value="0" class="form-control">
                            <input type="text" class="form-control rounded" hidden autocomplete="off" name="id" id="id" class="form-control">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inlineForm" class="mr-sm-2">Masuk</label>
                            <input type="text" onkeypress="return number(event)"  class="form-control rounded"  autocomplete="off" name="masuk" id="masuk" value="0" class="form-control">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inlineForm" class="mr-sm-2">Keluar</label>
                            <input type="text" onkeypress="return number(event)"  class="form-control rounded"  autocomplete="off" name="keluar" id="keluar" value="0" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="supplier">Stock Akhir</label>
                        <input type="text" class="form-control rounded" id="stock" name="stock"  value="0" autocomplete="off">
                    </div>
                    <div class="bg-transparent w-auto rounded  mx-2  my-0">STOCK OBAT
                        <hr class="w-auto h-1 my-1 bg-red-700 border-0 rounded">
                    </div>
                    <div class="form-group"> 
                        <label for="kode">Harga Beli</label>
                        <input type="text" class="form-control rounded" id="beli" name="beli" onkeypress="return number(event)" placeholder="harga beli"  maxlength="8" autocomplete="off" >
                    </div>
                    <div class="form-group"> 
                        <label for="kode">Harga Jual</label>
                        <input type="text" class="form-control rounded" id="jual" name="jual" onkeypress="return number(event)" placeholder="harga jual"  maxlength="8" autocomplete="off" >
                    </div>
                    <div class="form-group">
                        <label for="dosis">Tanggal Expired</label>
                        <input type="date" class="form-control rounded" id="expired" name="expired"  autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="indikasi">Keterangan</label>
                        <input type="text" class="form-control rounded"  id="keterangan" name="keterangan"  placeholder="Keterangan" autocomplete="off">
                    </div>
                    
                    <div class="modal-footer  d-flex justify-content-end ">
                        <div class="d-flex justify-items-center  ">
                                <button type="button" class="btn btn-block btn-outline-success btn-lg mx-1 my-1 rounded-md" data-dismiss="modal" id="btn-tutup">Close</button>
                                
                                <button type="submit" id="simpan" class="btn btn-block btn-outline-success btn-lg mx-1 my-1 rounded-md">Save </button>
                            
                        </div>
                    </div>
                </form>
                  
                </div>
                <!-- /.card-body -->

               
                </div>
               
              </div>
    </div>
</x-app-layout>
@push('js')
<script src="{{ asset('datatables/js/jquery.js') }}"></script>
<script src="{{ asset('datatables/js/jquery.dataTables.js') }}"></script>
{{-- <script src="{{ asset('adminlte/plugins/jquery/jquery.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables/jquery.dataTables.js') }}"></script> --}}
<script src="{{ asset('sweetalert2/js/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/toastr/toastr.min.js') }}"></script>
<script>

    $(document).ready(function(){
        loaddata()
    });

    function loaddata(){
        $('#tabelstock').DataTable({
            severside: true,
            processing: true,
            autoWidth: false,
            scrollX: true,
            language : {
                url: "{{ asset('adminlte/plugins/datatables/bahasa/id.json') }}"
                },
            ajax: {
                url : "{{ route('stock.index') }}"
            },
            columnDefs: [
                {
                    targets: 10, 
                    className: 'dt-body-nowrap' 
                }
            ],

            columns: [
                {data: null,
                "sortable": false,
                        render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                        }
                },
                {data: 'namaobat', name: 'namaobat'},
                {data: 'masuk', name: 'masuk'},
                {data: 'keluar', name: 'keluar'},
                {data: 'jual', name: 'jual'},
                {data: 'beli', name: 'beli'},
                {data: 'expired', name: 'expired'},
                {data: 'stock', name: 'stock'},
                {data: 'keterangan', name: 'keterangan'},
                {data: 'admin', name: 'admin'},
                {data: 'aksi', name: 'aksi', orderable: false}
            ]
        })
    };

    
    function number(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    };

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
                $('#tabelstock').DataTable().ajax.reload();
                $('#btn-tutup').click();
                $('#forms')[0].reset();
                toastr.success(res.text, 'Success'); // Menampilkan notifikasi toastr sukses
            },
            error: function(xhr){
                console.log(xhr);
                toastr.error(xhr.responseJSON.text, 'gagal!'); // Menampilkan notifikasi toastr error
            }
        });
    });
    

    $(document).on('click', '.edit', function() {
        $('#forms').attr('action', "{{ route('stock.updates') }}")
        let id = $(this).attr('id')
        $.ajax({
            url : "{{ route('stock.edits') }}",
            type: "post",
            data : {
                id : id,
                _token :  "{{ csrf_token() }}"
            },
            success : function(res) {
                console.log(res);
                $('#id').val(res.id)
                $('#obat_id').val(res.id)
                 $('#namaobat').val(res.namaobat)
                 $('#masuk').val(res.masuk)
                 $('#keluar').val(res.keluar)
                 $('#jual').val(res.jual)
                 $('#beli').val(res.beli)
                 $('#expired').val(res.expired)
                 $('#stock').val(res.stock)
                 $('#keterangan').val(res.keterangan)
                 $('#admin').val(res.admin)
                $('#btn-tambah').click()
            },
            error: function(xhr){
                console.log(xhr); 
            }
        })
    });
    
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
                url: "{{ route('stock.hapus') }}",
                type: "POST",
                data: {
                    id: id,
                    _token: "{{ csrf_token() }}"
                },
                success: function(res) {
                    console.log(res); // Tampilkan respon dari server di console (opsional)
                    $('#tabelstock').DataTable().ajax.reload(); // Memuat ulang data tabel setelah penghapusan
                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: "User Berhasil Menghapus",
                        showConfirmButton: false,
                        timer: 1500,
                        text: res.text 
                    });
                },
                error: function(xhr) {
                    console.log(xhr); // Tampilkan error di console (opsional)
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Failed to delete data' // Pesan kesalahan default
                    });
                }
            });
        }
    });
});

$(document).on('change', '#obat', function() {
    let id = $(this).val();  // Get the selected value of the dropdown
    console.log(id);  // Log the selected id to the console

    // AJAX request using jQuery
    $.ajax({
        url: "{{ route('stock.getobat') }}",  // URL to send the request
        type: 'post',  // HTTP method (POST)
        data: {
            id: id,  // Data to send in the request (selected id)
            _token: "{{ csrf_token() }}"  // CSRF token for Laravel
        },
        success: function(res) {  // Success callback function
            $('#stocklama').val(res.data.data.stock);  // Set value to #stocklama element
            console.log(res);  // Log the response to the console
        },
        error: function(xhr) {  // Error callback function
            console.log(xhr);  // Log the error response to the console
        }
    });
});

$(document).on('blur', '#masuk', function () {
    let awal = parseInt($('#stocklama').val());
    let masuk = parseInt($('#masuk').val());
    let keluar = parseInt($('#keluar').val());
    let akhir = (awal + masuk) - keluar;
    $('#stock').val(akhir);
});

$(document).on('blur', '#keluar', function(){
    let awal = parseInt($('#stocklama').val());
    let masuk = parseInt($('#masuk').val());
    let keluar = parseInt($('#keluar').val());
    let akhir = (awal + masuk) - keluar;
    $('#stock').val(akhir); 
});
</script>



