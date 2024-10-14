@extends('admin.app')
@section('main')

<div class="container-fluid">
    @if (session('brochurecreated'))
    <div class="alert alert-success fade-out mt-3" role="alert">
        <h4 class="alert-title">Realizado con éxito</h4>
        <div class="text-secondary">{{ session('brochurecreated') }}</div>
    </div>
    @endif
    @if (session('brochureupdate'))
    <div class="alert alert-success fade-out mt-3" role="alert">
        <h4 class="alert-title">Realizado con éxito</h4>
        <div class="text-secondary">{{ session('brochureupdate') }}</div>
    </div>
    @endif

    @if (session('brochuredisable'))
    <div class="alert alert-warning fade-out mt-3" role="alert">
        <h4 class="alert-title">Realizado con éxito</h4>
        <div class="text-secondary">{{ session('brochuredisable') }}</div>
    </div>
    @endif

    @if (session('brochureenable'))
    <div class="alert alert-success fade-out mt-3" role="alert">
        <h4 class="alert-title">Realizado con éxito</h4>
        <div class="text-secondary">{{ session('brochureenable') }}</div>
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
                <h2 class="card-title col">BROCHURE</h2>
                <button type="button" class="btn btn-primary col-auto ms-auto" data-bs-toggle="modal" data-bs-target="#newBrochure">
                    PUBLICAR BROCHURE
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="form-group row">
                <div class="col-md-6">
                    <form action="{{ route('brochures') }}" method="get" class="mb-3">
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
                        <th>Titulo</th>
                        <th>Descripción</th>
                        <th>Brochure</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($brochures as $brochure)
                    <tr>
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <button type="button" class="btn btn-ghost-warning btn-sm edit-button" onclick="selectedBrochure('{{$brochure->id}}')" data-id="{{ $brochure->id }}">
                                    <i class="fas fa-pencil-alt"></i>
                                </button>
                                <button type="button" class="btn btn-ghost-danger btn-sm" onclick="confirmDelete('{{ $brochure->id }}')">
                                    <i class="fas fa-trash"></i>
                                </button>

                                <form id="delete-form-{{ $brochure->id }}" action="{{ route('destroy-brochure', ['id' => $brochure->id]) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                        </td>
                        <td>{{ $brochure->title }}</td>
                        <td>{{ $brochure->description }}</td>
                        <td><a href="{{ asset('storage/brochure/' . $brochure->url_brochure) }}" target="_blank">file</a></td>

                        <td style="text-align: center; vertical-align: middle;">
                            @if($brochure->status)
                            <span class="">Activo</span>
                            @else
                            <span class="">Desactivado</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>
<div class="modal fade" id="newBrochure" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="newBrochureLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newBrochureLabel">Nuevo Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('create-brochure') }}" enctype="multipart/form-data" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="file_pdf" class="form-label">Adjunte PDF</label>
                        <input class="form-control" type="file" id="file_pdf" name="file_pdf" accept=".pdf,.docx">
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
<div class="modal fade" id="updateBrochureModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="updateBrochureModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateBrochureModalLabel">Actualizar Administrador</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('update-brochure') }}" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="brochure_id" name="id">
                    <div class="mb-3">
                        <label for="file_pdf" class="form-label">Adjunte PDF</label>
                        <input class="form-control" type="file" id="file_pdf" name="file_pdf" accept=".pdf,.docx">
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
    var selectedBrochure = function(id) {
        const urlBrochure = `/brochure/${id}`;
        $.ajax({
            url: urlBrochure,
            method: 'GET',
            success: function(response) {
                var brochure = response;
                $('#brochure_id').val(brochure.id);
                $('#file_pdf').val(brochure.file_pdf);
                $('#updateBrochureModal').modal('show');
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
<script>
    lightbox.option({
        'resizeDuration': 50,
        'wrapAround': true,
        'showImageNumberLabel':true
    })
</script> 
@stop