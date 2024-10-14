@extends('admin.app')
@section('main')

<div class="container-fluid">
    @if (session('leadcreated'))
        <div class="alert alert-success fade-out mt-3" role="alert">
            <h4 class="alert-title">Realizado con éxito</h4>
            <div class="text-secondary">{{ session('leadcreated') }}</div>
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
                <h2 class="card-title col">LEAD</h2>
                <button type="button" class="btn btn-primary col-auto ms-auto" data-bs-toggle="modal" data-bs-target="#new_lead">
                    CREAR NUEVO LEAD
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
                        <th>Nombre</th>
                        <th>E-mail</th>
                        <th>phone</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($leads as $item)
                    <tr>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->email }}</td>
                        <td><a href="https://wa.me/51{{ $item->phone }}">{{ $item->phone }}</a></td>
                    </tr>
                    @endforeach
                  
                </tbody>
            </table>

        </div>
    </div>
</div>
<div class="modal fade" id="new_lead" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="new_leadLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="new_leadLabel">Nuevo Usuario</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <form action="{{ route('create-lead') }}" method="POST">
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
                    <label for="phone">Celular:</label>
                    <input type="tel" class="form-control" id="phone" name="phone" required>
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
</main>
@stop