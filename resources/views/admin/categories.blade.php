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
                <h2 class="card-title col">CATEGORÍAS</h2>
                <button type="button" class="btn btn-primary col-auto ms-auto" data-bs-toggle="modal" data-bs-target="#new_user">
                    CREAR NUEVA CATEGORÍA
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="form-group row">
                <div class="col-md-6">
                    <form action="{{ route('categories') }}" method="get" class="mb-3">
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
                        <th>Categoría</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $item)
                    <tr>
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <button type="button" class="btn btn-ghost-warning btn-sm edit-button" onclick="getDataUser('{{$item->id}}')" data-id="{{ $item->id }}">
                                    <i class="fas fa-pencil-alt"></i>
                                </button>
                                @if($item->status)
                                    <form action="{{ route('disable-category', ['id' => $item->id]) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-ghost-danger btn-sm">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('enable-category', ['id' => $item->id]) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-ghost-info btn-sm">
                                            <i class="fas fa-check"></i> 
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </td>
                        <td>{{ $item->category }}</td>
                       
                        <td style="text-align: center; vertical-align: middle;">
                            @if($item->status)
                                <span class="badge bg-success-lt">Activo</span>
                            @else
                                <span class="badge bg-danger-lt">Desactivado</span>
                            @endif
                        </td>
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
            <form action="{{ route('create-category') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group mb-3">
                    <label for="category">Nombre de la categoría:</label>
                    <input type="text" class="form-control" id="category" name="category" required>
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
@stop