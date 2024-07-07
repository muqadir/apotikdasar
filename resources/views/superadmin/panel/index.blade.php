@push('css')
<link rel="stylesheet" href="{{ asset('select2/dist/css/select2.min.css') }}">
@endpush

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 ml-2">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="col-lg-12">
                        <div class="row border border-primary">
                            <div class="col-md-4">
                                <button class="btn btn-danger btn-block" id="btn_user">User</button>
                            </div>
                            <div class="col-md-4">
                                <button class="btn btn-danger btn-block" id="btn_pemission">Permissions</button>
                            </div>
                            <div class="col-md-4">
                                <button class="btn btn-danger btn-block" id="btn_role">Role</button>
                            </div>
                        </div>
                    </div>
                    <hr>

                    <h3><label for="" id="idTab">Halaman Management User</label></h3>
                     {{--  !!!!!!!!!!!!!!!!!!!!! user Punya !!!!!!!!!!!!!! --}}
                    <div class="row " id="userPages">
                        <div class="col-md-6">
                            <table>
                                <table class="table table-striped table-sm" id="tbluser">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>User Name</th>
                                            <th>E mail</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                </table>
                            </table>
                            <button class="btn btn-success" id="tambah">Tambah User</button>
                            <button class="btn btn-success" id="bataltambah">Batal</button>
                        </div>
                        <div class="col-md-6" id="tambahuser">
                            {{-- <form action="{{ route('management.store') }}" method="post"> --}}
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="username">Username</label>
                                            <input type="text" name="username" id="username" class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label for="email">E-Mail</label>
                                            <input type="text" name="email" id="email" class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password" name="password" id="password" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>Pilih Role</h5>
                                        <div class="form-select">
                                            <select name="role1" id="role1" class="custom-select mr-sm-2  form-control" required>
                                                <option value=""> Silakan Pilih</option>
                                                @foreach ($roles as $item)

                                                    <option value="{{ $item->id }}">{{ $item->display_name }}</option>

                                                @endforeach

                                            </select>

                                        </div>

                                        <div class="form-check">

                                            <button class="btn btn-success " id="simpanuser">Simpan</button>
                                        </div>
                                    </div>
                                </div>
                            {{-- </form> --}}
                        </div>
                    </div>


                     {{--  !!!!!!!!!!!!!!!!!!!!! Permission Punya !!!!!!!!!!!!!! --}}
                     <div class="row" id="permissionPages">
                        <div class="col-md-6">
                            <table>
                                <table class="table table-striped teble-sm display nowrap" style="width:100%" id="tblpermission">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>Display Name</th>
                                            <th>Description</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                </table>
                            </table>


                        </div>
                        <div class="col-md-6" >

                            <form action="#" id="formPermission">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Nama Permision </label>
                                            <input type="text" name="name" id="name" class="form-control" disabled>
                                        </div>

                                        <div class="form-group">
                                            <label for="display_name">Nama  Tampilan</label>
                                            <input type="text" name="display_name" id="display_name" class="form-control" disabled>
                                        </div>

                                        <div class="form-group">
                                            <label for="description">Deskription</label>
                                            <input type="text" name="description" id="description" class="form-control" disabled>
                                        </div>



                                    </div>
                                    <div class="col-md-6">
                                        <p>Permisi Untuk</p>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input hakAkses" name="hakAkses[]" value="read"  id="hakAkses[]">
                                            <label  class="form-check-label" for="">Read Data</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" name="hakAkses[]"  id="hakAkses[]" class="form-check-input hakAkses" value="create">
                                            <label  class="form-check-label" for="">Create Data</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" name="hakAkses[]"  id="hakAkses[]" class="form-check-input hakAkses" value="udpate">
                                            <label  class="form-check-label" for="">Update Data</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" name="hakAkses[]"  id="hakAkses[]" class="form-check-input hakAkses" value="delete">
                                            <label  class="form-check-label" for="">Delete Data</label>
                                        </div>

                                    </div>


                                </div>
                            </form>
                                    <button class="btn btn-primary" hidden id="SimpanPermission">Simpan</button>
                                    <button class="btn btn-success" hidden id="batalPermission">Batal</button>
                                    <button class="btn btn-success" id="tambahPermission">Tambah Permission</button>

                        </div>
                    </div>



                    {{--  !!!!!!!!!!!!!!!!!!!!! Role !!!!!!!!!!!!!! --}}
                     <div class="row" id="rolePages">
                        <div class="col-md-6">
                            <table>
                                <table class="table table-striped teble-sm display nowrap" style="width:100%" id="tblrole">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>Display Name</th>
                                            <th>Description</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                </table>
                            </table>


                        </div>
                        <div class="col-md-6" >

                            <form action="#" id="formRole">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Nama Role </label>
                                            <input type="text" name="idRole" id="idRole" class="form-control" hidden disabled>
                                            <input type="text" name="nameRole" id="nameRole" class="form-control" disabled>
                                        </div>

                                        <div class="form-group">
                                            <label for="display_name">Tampil  Tampilan</label>
                                            <input type="text" name="display_nameRole" id="display_nameRole" class="form-control" disabled>
                                        </div>

                                        <div class="form-group">
                                            <label for="description">Deskription</label>
                                            <input type="text" name="descriptionRole" id="descriptionRole" class="form-control" disabled>
                                        </div>



                                    </div>
                                    <div class="col-md-6">
                                        <p>Set Permission</p>
                                            {{-- <div class="col-md-12">
                                                <div class="row d-flex  align-items-start">
                                                    @foreach ($permission as $item )

                                                    <div class="form-check mb-2 mr-sm-2  flex-column justify-content-between" id="checkbox1">
                                                        <input type="checkbox" class="form-check-input roleAkses" name="roleAkses[]" value="{{ $item->id}}"  id="roleAkses[]">
                                                     <label  class="form-check-label" for="">{{ $item->name }}</label>

                                                    </div>
                                            @endforeach
                                                </div>
                                            </div> --}}

                                        <div class="col-md-12">
                                            <div class="row d-flex  align-items-start">
                                            <div class="form-check mb-5 mr-3 mr-sm-4" id="checkbox">
                                            </div>
                                            </div>
                                        </div>


                                    </div>


                                </div>
                            </form>
                                    <button class="btn btn-primary" hidden id="SimpanRole">Simpan</button>
                                    <button class="btn btn-success" hidden id="batalRole">Batal</button>
                                    <button class="btn btn-success" id="tambahRole">Tambah Role</button>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


<div class="modal fade" id="modal-info">
    <div class="modal-dialog">
        <div class="modal-content bg-info">
            <div class="model-header">
                <div class="row">
                    <div class="col-md-8">
                        <h4 class="modal-title ml-2">Role : <label for="" id="labelRole"></label></h4>
                    </div>
                    <div class="col-md-4">
                        <button type="button" class="close btn btn-danger mr-2" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                    </div>
                </div>

            </div>
            <div class="modal-body">
                @csrf
                <div class="row">
                    <div>
                        <div class="form-group">
                            <label for="usernames">Username</label>
                            <input type="text" readonly name="usernames" id="usernames" class="form-control" autocomplete="off">
                            <input type="text" name="id" id="id" class="form-control" autocomplete="off" hidden>
                        </div>
                        <div class="form-group">
                            <label for="emails">E-Mail</label>
                            <input type="text" readonly name="emails" id="emails" class="form-control"  autocomplete="off">
                        </div>

                        <div id="formRoleUser" hidden>

                            <h5>Pilih Role</h5>


                            <div  class="form-select">
                                <select name="role" id="role" class="role mr-sm-2  form-control" required>
                                    <option value=""> Silakan Pilih</option>
                                    @foreach ($roles as $item)

                                        <option value="{{ $item->id }}">{{ $item->display_name }}</option>

                                    @endforeach

                                </select>
                            </div>
                        </div>

                        <button  class="btn btn-sm btn-danger" id="editUser">Edit</button>
                    <button class="btn btn-sm btn-warning" disabled id="simpanEdit">Update</button>
                    <button type="button" name="batal" data-dismiss="modal" class="btn btn-outline-light" id="btn-tutup">Close</button>

                    </div>
                    <div >
                        <h4>Permission</h4>
                        <ul>
                            <div id="permit">

                            </div>
                        </ul>
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
<script src="{{ asset('select2/dist/js/select2.min.js') }}"></script>
<script src="{{ asset('sweetalert2/js/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/toastr/toastr.min.js') }}"></script>

<script>
$(document).ready(function(){
    loadData()

    $('#userPages').show()
    $('#permissionPages').hide()
     $('#rolePages').hide()
})


$(document).on('click', '#btn_user', function(){
    $('#userPages').show()
    $('#permissionPages').hide()
    $('#rolePages').hide()
    $('#idTab').text('Halaman Management User')
})

$(document).on('click', '#btn_pemission', function(){
    $('#tblpermission').DataTable().destroy()
    loadDataPermission()
    $('#permissionPages').show()
    $('#userPages').hide()
    $('#rolePages').hide()
    $('#idTab').text('Halaman Management Permission')
})
$(document).on('click', '#btn_role', function(){
    $('#tblrole').DataTable().destroy()
    loadDataRole()
    $('#rolePages').show()
    $('#permissionPages').hide()
    $('#userPages').hide()
    $('#idTab').text('Halaman Management Role')
})
// untuk menjalankan page user
function loadData(){
    $('#tbluser').DataTable({
        serverside: true,
        processing: true,
        // language : {
        //         url: "{{ asset('js/bahasa/id.json') }}"
        // },
        ajax: {
            url : "{{ route('management.index')}}"
        },
        columns: [
            {data: null,
            "sortable": false,
                    render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },

            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'   },
            {data: 'aksi', name: 'aksi', ordering: false},
        ]


    });
}


$(document).on('click', '#simpanuser', function(){
    if (validasiEmail($('#email').val())) {
        $.ajax({
            url: "{{ route('management.store') }}",
            type: 'post',
            data: {
                username: $('#username').val(),
                email: $('#email').val(),
                password: $('#password').val(),
                role: $('#role1').val(),
                _token: "{{ csrf_token() }}"

            }, success: function (res) {
                console.log(res);
                // $('#tbluser').DataTable().ajax.reload()
                $('#tbluser').DataTable().destroy()
                loadData()
                toastr.success(res.text, 'Success')
            }, error: function(xhr){
                console.log(xhr);
                toastr.error(xhr.responseJSON.text, 'gagal!')
            }
        })

    } else {
        toastr.danger('error', 'Format Email Salah')
    }
})


validasiEmail = function(email) {
    var re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}


$(document).on('click', '.info', function() {
    $.ajax({
        url: "{{ route('management.getrole') }}",
        type: 'post',
        data: {
            id: $(this).attr('id'),
            _token: "{{ csrf_token() }}"
        },
        success: function(res) {
            console.log(res.user);
            $('#id').val(res.user.id)
            $('#usernames').val(res.user.name)
            $('#emails').val(res.user.email)
            $('#labelRole').text(res.roles)
            $('#permit').empty()
            $.each(res.permit, function(i,nama){
                $('#permit').append("<li>" + nama.display_name +"</li>")
                console.log(nama);
            })
            toastr.success(res.text, 'Info')
        }, error: function(xhr) {
            console.log(xhr);
        }
    })
})

$(document).on('click', '#editUser', function(){
    $('#simpanEdit').attr('disabled', false)
    $('#usernames').attr('readonly', false)
    $('#emails').attr('readonly', false)
    $('#formRoleUser').attr('hidden', false)

})

$(document).on('click', '#simpanEdit', function(){


        $.ajax({
            url: "{{ route('management.update') }}",
            type: 'post',
            data: {
                id: $('#id').val(),
                username: $('#usernames').val(),
                email: $('#emails').val(),
                // role: $('.role:selected').val(),
                role: $('#role').val(),
                _token: "{{ csrf_token() }}"

            }, success: function (res) {
                console.log(res);
                $('#btn-tutup').click()
                $('#tbluser').DataTable().destroy()
                loadData()
                $('#usernames').attr('readonly', true)
                $('#emails').attr('readonly', true)
                $('#formRoleUser').attr('hidden', true)
                toastr.success(res.text, 'Success')
            }, error: function(xhr){
                console.log(xhr);
                toastr.error(xhr.responseJSON.text, 'gagal!')
            }
        })

})


$(document).on('click', '.hapusUser', function () {

let id = $(this).attr('id')

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
            url : "{{ route('management.hapususer') }}",
            type: 'post',
            data: {
                id : id,
                _token : "{{csrf_token()}}"
            },
            success: function(res, status) {
                if (status = '200'){
                    setTimeout(() => {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Data Berhasil Dihapus',
                            showConfirmButton: false,
                            timer: 1500
                        }).then((res) => {
                            $('#tbluser').DataTable().destroy()
                             loadData()
                        })
                    });
                }


            },
            error: function (xhr){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'gagal menghapus',

                })
            }
        })
    }
})





})



// untuk menjalankan page permissions
function loadDataPermission(){
    $('#tblpermission').DataTable({
        serverside: true,
        processing: true,
        // language : {
        //         url: "{{ asset('js/bahasa/id.json') }}"
        // },
        ajax: {
            url : "{{ route('management.loadpermission')}}"
        },
        columns: [
            {data: null,
            "sortable": false,
                    render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },

            {data: 'name', name: 'name'},
            {data: 'display_name', name: 'display_name'   },
            {data: 'description', name: 'description'   },
            {data: 'aksi', name: 'aksi', ordering: false},
        ]


    });
}

$(document).on('click', '#tambahPermission', function(){
    $('#name').attr('disabled', false)
    $('#display_name').attr('disabled', false)
    $('#description').attr('disabled', false)
    $('#batalPermission').attr('hidden', false)
    $('#SimpanPermission').attr('hidden', false)
    $(this).hide()
})

$(document).on('click', '#batalPermission', function(){
    $('#name').attr('disabled', true).val('')
    $('#display_name').attr('disabled', true).val('')
    $('#description').attr('disabled', true).val('')
    // $('#hakAkses').attr('checked', false)
    $('#tambahPermission').show()
    $('#SimpanPermission').attr('hidden', true)
    $(this).attr('hidden', true)
})

$(document).on('click', '#SimpanPermission', function(){
    $.ajax({
        url : "{{ route('management.simpanpermission') }}",
        type : 'post',
        data : $('#formPermission').serialize(),

        success: function(res) {
            console.log(res);
                $('#tblpermission').DataTable().destroy()
                loadDataPermission()
                toastr.success(res.text, 'Success')
        }, error: function(xhr){
            console.log(xhr);
            toastr.error(xhr.responseJSON.text, 'gagal!')
        }
    })
})

// untuk menjalankan page permissions
function loadDataRole(){
    $('#tblrole').DataTable({
        serverside: true,
        processing: true,
        // language : {
        //         url: "{{ asset('js/bahasa/id.json') }}"
        // },
        ajax: {
            url : "{{ route('management.loadrole')}}"
        },
        columns: [
            {data: null,
            "sortable": false,
                    render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },

            {data: 'name', name: 'name'},
            {data: 'display_name', name: 'display_name'   },
            {data: 'description', name: 'description'   },
            {data: 'aksi', name: 'aksi', ordering: false},
        ]


    });
}

$(document).on('click', '#tambahRole', function(){
    $('#nameRole').attr('disabled', false)
    $('#display_nameRole').attr('disabled', false)
    $('#descriptionRole').attr('disabled', false)
    $('#batalRole').attr('hidden', false)
    $('#SimpanRole').attr('hidden', false)
    $(this).hide()
    $('#SimpanRole').text('Simpan')
})

$(document).on('click', '#batalRole', function(){
    $('#nameRole').attr('disabled', true).val('')
    $('#display_nameRole').attr('disabled', true).val('')
    $('#descriptionRole').attr('disabled', true).val('')
    $('#tambahRole').show()
    $('#SimpanRole').attr('hidden', true)
    $(this).attr('hidden', true)
    $('#SimpanRole').text('Simpan')
})

$(document).on('click', '#SimpanRole', function(){
    if ( $('#SimpanRole').text() == 'Simpan'){
        console.log('ke kontroller tambah');
        var url = "{{ route('management.simpanrole') }}"

    }else{
        console.log('ke kontroller edit');
        var url = "{{ route('management.roleedit') }}"
    }

    var roleAkases = [];
    var tandai = $('input[name="roleAkses[]"]')
        .map(
            function() {
                if ($(this).is(":checked")){
                    roleAkases.push($(this).val())
                }
            }
        )
        .get();

    $.ajax({
        url : url, // url kita ubah menjadi fariable
        type : 'post',
        // data : $('#formRole').serialize(),
        data: {
            idRole:  $("#idRole").val(),
            nameRole:  $("#nameRole").val(),
            display_nameRole:  $("#display_nameRole").val(),
            descriptionRole:  $("#descriptionRole").val(),
            roleAkses : roleAkases,
            "_token" :  "{{ csrf_token() }}"
        },

        success: function(res) {
            console.log(res);

                $('#tblrole').DataTable().destroy()
                loadDataRole()
                toastr.success(res.text, 'Success')
        }, error: function(xhr){
            console.log(xhr);
            toastr.error(xhr.responseJSON.text, 'gagal!')
        }
    })
})


$(document).on('click', '.infoRole', function(){
    $('#SimpanRole').attr('hidden', false)
    $('#SimpanRole').text('Simpan Edit')
    $('#idRole').attr('disabled', false)
    $('#nameRole').attr('disabled', false)
    $('#display_nameRole').attr('disabled', false)
    $('#descriptionRole').attr('disabled', false)
    $('#batalRole').attr('hidden', false)
    $.ajax({
        url : "{{ route('management.roleinfo') }}",
        type : 'post',
        data : {
                id : $(this).attr('id'),
                '_token' : '{{ csrf_token() }}'
                },
        success: function(res) {
            $('#checkbox').empty()
            $.each(res.cek, function(i, ceks) {
                var html = '<div class="form-check form-check-inline">'
                    html += '<input type="checkbox" class="form-check-input roleAkses" name="roleAkses[]" value="'+ ceks.id +'"  id="roleAkses[]">'
                    html += '<label  class="form-check-label" for="">' +ceks.name + '</label>'
                    html += '</div'
                $('#checkbox').append(html)
            })
            $('#formRole').append()


            $('#idRole').val(res.role.id)
            $('#nameRole').val(res.role.name)
            $('#display_nameRole').val(res.role.display_name)
            $('#descriptionRole').val(res.role.description)

            var reset = $('input[name="roleAkses[]"]').prop('checked', false)
            var tandai = $('input[name="roleAkses[]"]')
            .map(
                function() {

                        for (let index = 0; index < res.permission.length; index++){
                            if ($(this).val() == res.permission[index].id) {
                            return $(this).prop('checked', true)
                    }
                }
            }).get();
            console.log(res);
        }, error: function(xhr){
            console.log(xhr);
        }
    })

})

</script>
