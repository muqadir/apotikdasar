<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-full mx-auto sm:px-1 lg:px-1">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <table class="table table-stripped" id="tablesupplier" style="width: 100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Telephon</th>
                            <th>Email</th>
                            <th>Rekening</th>
                            <th>Alamat</th>
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
                  <h4 class="modal-title">Info Modal</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">

                    <form action="{{ route('supplier.store') }}" method="post" id="forms">
                        @csrf
                   
                    <div class="form-group">
                        <label for="supplier">Nama Supplier</label>
                        <input type="hidden" class="form-control" id="id" name="id" placeholder="Nama Supplier">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Nama Supplier">
                    </div>
                    <div class="form-group"> 
                        <label for="telp">Telephone</label>
                        <input type="text" class="form-control" onkeypress="return number(event)" id="telp" name="telp" placeholder="Telephone" maxlength="12">
                    </div>
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label for="rekening">Nomor Rekening</label>
                        <input type="text" class="form-control" onkeypress="return number(event)" id="rekening" name="rekening" maxlength="12" placeholder="Nomor Rekening">
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea class="form-control" id="alamat"  name="alamat" placeholder="Alamat" cols="30" rows="10"></textarea>
                        
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
{{-- <script src="{{ asset('datatables/js/jquery.js') }}"></script>
<script src="{{ asset('datatables/js/jquery.dataTables.js') }}"></script> --}}
<script src="{{ asset('adminlte/plugins/jquery/jquery.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('sweetalert2/js/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/toastr/toastr.min.js') }}"></script>
<script>

    $(document).ready(function(){
        loaddata()
    });

    function loaddata(){
        $('#tablesupplier').DataTable({
            severside: true,
            processing: true,
            autoWidth: false,
            scrollX: true,
            ajax: {
                url : "{{ route('supplier.index') }}"
            },
            columnDefs: [
                {
                    targets: 6, // Mengarahkan ke kolom kedua (kolom 'aksi')
                    className: 'dt-body-nowrap' // Mencegah pematahan baris
                }
            ],
            columns: [
                {data: null,
                "sortable": false,
                        render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                        }
                },
                {data: 'name', name: 'name'},
                {data: 'telp', name: 'telp'},
                {data: 'email', name: 'email'},
                {data: 'rekening', name: 'rekening'},
                {data: 'alamat', name: 'alamat'},
                {data: 'aksi', name: 'aksi', orderable:false},
            ]
        })
    }

    
    function number(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    }

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
                $('#tablesupplier').DataTable().ajax.reload();
                $('#btn-tutup').click();
                toastr.success(res.text, 'Success'); // Menampilkan notifikasi toastr sukses
            },
            error: function(xhr){
                console.log(xhr);
                toastr.error(xhr.responseJSON.text, 'gagal!'); // Menampilkan notifikasi toastr error
            }
        });
    });
    

    $(document).on('click', '.edit', function() {
        $('#forms').attr('action', "{{ route('supplier.updates') }}")
        let id = $(this).attr('id')
        $.ajax({
            url : "{{ route('supplier.edits') }}",
            type: "post",
            data : {
                id : id,
                _token :  "{{ csrf_token() }}"
            },
            success : function(res) {
                console.log(res);
                $('#id').val(res.id)
                $('#name').val(res.name)
                $('#telp').val(res.telp)
                $('#email').val(res.email)
                $('#rekening').val(res.rekening)
                $('#alamat').val(res.alamat)
                $('#btn-tambah').click()
            },
            error: function(xhr){
                console.log(xhr); 
            }
        })
    })
    
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
                url: "{{ route('supplier.hapus') }}",
                type: "POST",
                data: {
                    id: id,
                    _token: "{{ csrf_token() }}"
                },
                success: function(res) {
                    console.log(res); // Tampilkan respon dari server di console (opsional)
                    $('#tablesupplier').DataTable().ajax.reload(); // Memuat ulang data tabel setelah penghapusan
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
</script>



