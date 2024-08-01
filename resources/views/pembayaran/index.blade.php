<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 pt-0">
        <div class="card card-warning">
            <div class="card-header">
                <h3 class="card-title">Barang Terjual</h3>
            </div>
        </div>
        <div class="max-w-full mx-auto sm:px-1 lg:px-1">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <table class="table table-stripped" id="tabelpembayaran" style="width: 100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nota</th>
                            <th>Harga</th>
                            <th>Diskon</th>
                            <th>Besaran Dibayar</th>
                            <th>Kembali</th>
                            <th>Jumlah Dibayarkan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                </table>
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
        $('#tabelpembayaran').DataTable({
            severside: true,
            processing: true,
            autoWidth: false,
            scrollX: true,
            language : {
                url: "{{ asset('adminlte/plugins/datatables/bahasa/id.json') }}"
                },
            ajax: {
                url : "{{ route('pembayaran.index') }}"
            },
            columnDefs: [
                {
                    targets: 7, 
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
                {data: 'nota', name: 'nota'},
                {data: 'totalharga', name: 'totalharga'},
                {data: 'totaldiskon', name: 'totaldiskon'},
                {data: 'jumlahdibayar', name: 'jumlahdibayar'},
                {data: 'kembali', name: 'kembali'},
                {data: 'harusbayar', name: 'harusbayar'},
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

   

    $(document).on('click', '.cetak', function() {
      
        let id = $(this).attr('id')
        $.ajax({
            url : "{{ route('pembayaran.cetak') }}",
            type: "post",
            data : {
                id : id,
                _token :  "{{ csrf_token() }}"
            },
            success : function (res) {
                console.log(res);
                toastr.success(res.text, 'Success'); 
                var newTab = window.open(res.url, '_blank');
                newTab.focus();
            },
            error: function(xhr){
                console.log(xhr);
                toastr.error(xhr.responseJSON.text, 'gagal!'); 
            }
        })
    });
    
   
</script>



