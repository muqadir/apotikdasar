<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 pt-0">
        <div class="card card-warning ">
            <div class="card-header">
                <h3 class="card-title">Katalog Obat</h3>
            </div>
        </div>
        <div class="max-w-full mx-auto sm:px-1 lg:px-1">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <table class="table table-stripped" id="tableobat" style="width: 100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Kode</th>
                            <th>Dosis</th>
                            <th>Indikasi</th>
                            <th>Kategori</th>
                            <th>Satuan</th>
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
                  <h4 class="modal-title"><h2>Input Obat</h2></h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">

                    <form action="{{ route('obat.store') }}" method="post" id="forms">
                        @csrf
                   
                    <div class="form-group">
                        <label for="supplier">Nama Obat</label>
                        <input type="hidden" class="form-control" id="id" name="id"  autocomplete="off">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Nama Obat" autocomplete="off">
                    </div>
                    <div class="form-group"> 
                        <label for="kode">Kode</label>
                        <input type="text" class="form-control" id="kode" name="kode" placeholder="Kode Obat"  maxlength="8" autocomplete="off" >
                    </div>
                    <div class="form-group">
                        <label for="dosis">Dosis</label>
                        <input type="text" class="form-control" id="dosis" name="dosis" placeholder="Enter dosis" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="indikasi">Indikasi</label>
                        <input type="text" class="form-control"  id="indikasi" name="indikasi"  placeholder="Indikasi Obat" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="kategori">Kategori</label>
                        <select name="kategori_id" id="kategori_id" class="form-control">
                            <option value="">Pilih Kategori</option>
                            @foreach ($kategori as $item )
                            <option value="{{ $item->id }}">{{ $item->kategori }}</option>
                                
                            @endforeach

                        </select>  
                    </div>
                    <div class="form-group">
                        <label for="satuan">Satuan</label>
                        <select name="satuan_id" id="satuan_id" class="form-control">
                            <option value="">Pilih Satuan</option>
                            @foreach ( $satuan as $item  )
                                <option value="{{ $item->id }}">{{ $item->satuan }}</option>    
                            @endforeach
                        </select>  
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
        $('#tableobat').DataTable({
            severside: true,
            processing: true,
            autoWidth: false,
            scrollX: true,
            ajax: {
                url : "{{ route('obat.index') }}"
            },
            // columnDefs: [
            //     {
            //         targets: 7, // Mengarahkan ke kolom kedua (kolom 'aksi')
            //         className: 'dt-body-nowrap' // Mencegah pematahan baris
            //     }
            // ],
            columns: [
                {data: null,
                "sortable": false,
                        render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                        }
                },
                {data: 'name', name: 'name'},
                {data: 'kode', name: 'kode'},
                {data: 'dosis', name: 'dosis'},
                {data: 'indikasi', name: 'indikasi'},
                {data: 'kategoris', name: 'kategoris'},
                {data: 'satuans', name: 'satuans'},
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
                $('#tableobat').DataTable().ajax.reload();
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
        $('#forms').attr('action', "{{ route('obat.updates') }}")
        let id = $(this).attr('id')
        $.ajax({
            url : "{{ route('obat.edits') }}",
            type: "post",
            data : {
                id : id,
                _token :  "{{ csrf_token() }}"
            },
            success : function(res) {
                console.log(res);
                $('#id').val(res.id)
                $('#name').val(res.name)
                $('#kode').val(res.kode)
                $('#dosis').val(res.dosis)
                $('#indikasi').val(res.indikasi)
                $('#kategori_id').val(res.kategori_id)
                $('#satuan_id').val(res.satuan_id)
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
                url: "{{ route('obat.hapus') }}",
                type: "POST",
                data: {
                    id: id,
                    _token: "{{ csrf_token() }}"
                },
                success: function(res) {
                    console.log(res); // Tampilkan respon dari server di console (opsional)
                    $('#tableobat').DataTable().ajax.reload(); // Memuat ulang data tabel setelah penghapusan
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



