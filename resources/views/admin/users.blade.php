@extends('admin.app')
@section('main')

<div class="container-fluid">
    @if (session('usercreated'))
        <div class="alert alert-success fade-out mt-3" role="alert">
            <h4 class="alert-title">Realizado con éxito</h4>
            <div class="text-secondary">{{ session('usercreated') }}</div>
        </div>
    @endif
    @if (session('userupdate'))
        <div class="alert alert-success fade-out mt-3" role="alert">
            <h4 class="alert-title">Realizado con éxito</h4>
            <div class="text-secondary">{{ session('userupdate') }}</div>
        </div>
    @endif

    @if (session('userdisable'))
        <div class="alert alert-warning fade-out mt-3" role="alert">
            <h4 class="alert-title">Realizado con éxito</h4>
            <div class="text-secondary">{{ session('userdisable') }}</div>
        </div>
    @endif

    @if (session('userenable'))
        <div class="alert alert-success fade-out mt-3" role="alert">
            <h4 class="alert-title">Realizado con éxito</h4>
            <div class="text-secondary">{{ session('userenable') }}</div>
        </div>
    @endif
    @if ($errors->any())
<div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
    <strong>Error:</strong> Por favor, corrige los siguientes errores.
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
    <button type="button" class="close" data-dismiss="alert" aria-label="Cerrar">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
    <div class="card mt-3">
        <div class="card-header">
            <div class="d-flex align-items-center w-100">
                <h2 class="card-title col">USUARIOS</h2>
                <button type="button" class="btn btn-primary col-auto ms-auto" data-bs-toggle="modal" data-bs-target="#new_user">
                    CREAR NUEVO USUARIO
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="form-group row">
                <div class="col-md-6">
                    <form action="{{ route('users') }}" method="get" class="mb-3">
                        <div class="input-group">
                            <select class="form-select col-md-3" name="criterio">
                            <option value="nombre" @if(request()->get('criterio') == 'nombre') selected @endif>Nombre</option>
                            </select>
                            <input type="text" name="search" class="form-control" placeholder="Texto a buscar" value="{{ request()->get('search') }}">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                        </div>
                    </form>
                </div>
            </div>
            <table class="table table-hover table-bordered">
                <thead class="text-center">
                    <tr>
                        <th>Opciones</th>
                        <th>Nombre</th>
                        <th>E-mail</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    
                    <tr>
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <button type="button" class="btn btn-ghost-warning btn-sm edit-button" onclick="getDataUser('{{$user->id}}')" data-id="{{ $user->id }}">
                                    <i class="fas fa-pencil-alt"></i>
                                </button>
                              
                                <button type="button" class="btn btn-ghost-danger btn-sm" onclick="confirmDelete('{{ $user->id }}')">
                                    <i class="fas fa-trash"></i>
                                </button>
                                
                                <form id="delete-form-{{ $user->id }}" action="{{ route('destroy-user', ['id' => $user->id]) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                        </td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                       
                    </tr>
                    @endforeach
                  
                </tbody>
            </table>

        </div>
    </div>
</div>
<div class="modal fade" id="new_user" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="new_userLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="new_userLabel">Nuevo Usuario</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <form action="{{ route('create-user') }}" method="POST">
                @csrf
                <div class="form-group mb-3">
                    <label for="name">Nombres:</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
              
                <div class="form-group mb-3">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                
                <div class="form-group mb-3">
                    <label for="password">Contraseña:</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>              
                </div>
    
            </form>
        </div>
   
    </div>
  </div>
</div>
<div class="modal fade" id="update_user_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="update_user_modalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="update_user_modalLabel">Actualizar Administrador</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="" method="PUT">
        <div class="modal-body">
            @csrf
            @method('PUT')
            <input type="hidden" id="id_user" name="id">
            <div class="form-group mb-3">
                <label for="name">Nombres:</label>
                <input type="text" class="form-control" id="update_name" name="name">
            </div>
            <div class="form-group mb-3">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="update_email" name="email">
            </div>
            <div class="form-group mb-3">
                <label for="password">Constraseña:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </div>
        </form>
    </div>
  </div>
</div>
</main>
<script>
    var getDataUser = function(id){
        const urlUser=`selected/user/${id}`;
        $.ajax({
            url: urlUser,
            method: 'GET',
            success: function(response) {
                    var user = response;
                    $('#id_user').val(user.id);
                    $('#update_name').val(user.name);
                    $('#update_email').val(user.email);
                    $('#update_user_modal').modal('show'); 
            },
            error: function() {
                alert('Error en la solicitud AJAX.');
            }

        });
    };
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function confirmDelete(id) {
    Swal.fire({
        title: '¿Estás seguro?',
        text: "No podrás revertir esta acción.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, eliminarlo!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            // Envía el formulario de eliminación
            document.getElementById(`delete-form-${id}`).submit();
        }
    })
}
</script>
@stop