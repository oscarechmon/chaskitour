@extends('admin.app')
@section('main')

<div class="container-fluid">
    @if (session('created'))
    <div class="alert alert-success fade-out mt-3" role="alert">
        <h4 class="alert-product">Realizado con éxito</h4>
        <div class="text-secondary">{{ session('created') }}</div>
    </div>
    @endif
    @if (session('update'))
    <div class="alert alert-success fade-out mt-3" role="alert">
        <h4 class="alert-product">Realizado con éxito</h4>
        <div class="text-secondary">{{ session('update') }}</div>
    </div>
    @endif
    @if (session('disable'))
    <div class="alert alert-warning fade-out mt-3" role="alert">
        <h4 class="alert-product">Realizado con éxito</h4>
        <div class="text-secondary">{{ session('disable') }}</div>
    </div>
    @endif
    @if (session('enable'))
    <div class="alert alert-success fade-out mt-3" role="alert">
        <h4 class="alert-product">Realizado con éxito</h4>
        <div class="text-secondary">{{ session('enable') }}</div>
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
    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-center w-100">
                <h2 class="card-title col">Mis Productos</h2>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#nuevoproducto">
                    Nuevo producto
                </button>
            </div>
        </div>
        <div class="card-body">

        </div>
        <table class="table table-bordered table-striped table-sm">
            <thead>
                <tr>
                    <th>Opciones</th>
                    <th>Categoría</th>
                    <th>Título</th>
                    <th>Subtitulo</th>
                    <th>Imagen Principal</th>
                    <th>Video Principal</th>
                    <th>Imagenes</th>
                    <th>Precio por Persona</th>
                    <th>daily_departures</th>
                    <th>Itinerario</th>
                    <th>Incluye</th>
                    <th>Recomendaciones</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $item)
                <tr>
                    <td>
                        <div class="d-flex justify-content-center gap-2">
                        <button type="button" class="btn btn-ghost-warning btn-sm edit-button" onclick="selected_product('{{ $item->id }}')" data-id="{{ $item->id }}">
                            <i class="fas fa-pencil-alt"></i>
                        </button>
                        
                        <button type="button" class="btn btn-ghost-danger btn-sm" onclick="confirmDelete('{{ $item->id }}')">
                            <i class="fas fa-trash"></i>
                        </button>
                        
                        <form id="delete-form-{{ $item->id }}" action="{{ route('destroy-product', ['id' => $item->id]) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                        </div>
                    </td>
                    <td>{{ $item->category->category }}</td>
                    <td>{{ $item->product }}</td>
                    <td>{{ $item->tour }}</td>
                    <td><a href="{{ asset('storage/product/images/'.$item->main_image) }}" data-lightbox="gallery" class="btn btn-primary"> <i class="fa-solid fa-images"></i></a></td>
                    <td><a href="{{ asset('storage/product/videos/'.$item->main_video) }}" target="_blank" class="btn btn-primary"><i class="fa-solid fa-film"></i></a></td>
                    <td class="text-center">
                        <button type="button" class="btn btn-ghost-primary btn-sm"
                            {{-- data-bs-toggle="modal" data-bs-target="#upload_image"  --}}
                            data-id="{{ $item->id }}"
                            onclick="open_modal_upload_image('{{ $item->id }}')">
                            <i class="fa-solid fa-images"></i>
                        </button>
                    </td>
                    <td>{{ $item->price_per_person }}</td>
                    <td>{{ $item->daily_departures }}</td>
                    <td>{{ \Illuminate\Support\Str::limit($item->itinerary,50,'...')}}</td>
                    <td class="text-center">
                        <button type="button" class="btn btn-ghost-primary btn-sm"
                            {{-- data-bs-toggle="modal" data-bs-target="#includes"  --}}
                            data-id="{{ $item->id }}"
                            onclick="open_modal_includes('{{ $item->id }}')">
                            <i class="fa-solid fa-images"></i>
                        </button>
                    </td>
                    <td class="text-center">
                        <button type="button" class="btn btn-ghost-primary btn-sm"
                            {{-- data-bs-toggle="modal" data-bs-target="#recommendations"  --}}
                            data-id="{{ $item->id }}"
                            onclick="open_modal_recommendations('{{ $item->id }}')">
                            <i class="fa-solid fa-images"></i>
                        </button>
                    </td>
                    <td style="text-align: center; vertical-align: middle;">
                        @if($item->status)
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
<!-- Fin ejemplo de tabla Listado -->
</div>
<div class="modal fade" id="subirimagen">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="subirimagenLabel">Agregar nuevo Producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" enctype="multipart/form-data" id="form-subir-imagen" name="form-subir-imagen">
                @csrf
                <input type="hidden" name="product_id" id="codigo_producto" value="">
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="">Subir imagen</label>
                        <input type="file" name="image" id="image" class="form-control-file form-control" accept="image/*">
                    </div>
                    <div class="table-responsive table-sm" style="overflow-y: auto; max-height: 300px;">
                        <table class="table table-sm table-hover" id="tabla-imagenes">
                            <thead class="bg-orange2 text-white">
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Imagen</th>
                                    <th class="text-center">Fecha y Hora</th>
                                    <th class="text-center">Ver</th>
                                    <th class="text-center"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Los datos de las imágenes se cargarán aquí dinámicamente -->
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" onclick="guardarImagen(event)">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="includes">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="includesLabel">Agregar servicios</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="form-servicio" name="form-servicio">
                @csrf
                <input type="hidden" name="product_id" id="product_id_servicio" value="">
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="includes">Servicios</label>
                        <input type="text" name="includes" id="includes" class="form-control">
                    </div>
                    <div class="form-group mb-3">
                        <label for="estado">Estado</label>
                        <select name="estado" id="estado" class="form-control">
                            <option value="1">Incluye</option>
                            <option value="0">No incluye</option>
                        </select>
                    </div>
                    <div class="table-responsive table-sm" style="overflow-y: auto; max-height: 300px;">
                        <table class="table table-sm table-hover" id="tabla-includes">
                            <thead class="bg-orange2 text-white">
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Servicio</th>
                                    <th class="text-center">Fecha y Hora</th>
                                    <th class="text-center">Incluye</th>
                                    <th class="text-center"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Los datos de las imágenes se cargarán aquí dinámicamente -->
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" onclick="guardarServicio(event)">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="recommendations">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="recommendationsLabel">Agregar nuevo Producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="form-recommendation" name="form-recommendation">
                @csrf
                <input type="hidden" name="product_id" id="product_id_recommendation" value="">
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="recommendation">AGREGAR RECOMENDACIÓN</label>
                        <input type="text" name="recommendation" id="recommendation" class="form-control">
                    </div>
                    <div class="table-responsive table-sm" style="overflow-y: auto; max-height: 300px;">
                        <table class="table table-sm table-hover" id="tabla-recommendations">
                            <thead class="bg-orange2 text-white">
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">RECOMENDACIÓN</th>
                                    <th class="text-center">FECGA HORA</th>
                                    <th class="text-center"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Los datos de las imágenes se cargarán aquí dinámicamente -->
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" onclick="saveRecommendation(event)">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal para crear un nuevo producto -->
<div class="modal fade" id="nuevoproducto">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="nuevoproductoLabel">Agregar nuevo Producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('create-product') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="product">Título:</label>
                        <input type="text" class="form-control" id="product" name="product">
                    </div>
                    <div class="form-group mb-3">
                        <label for="tour">Tour:</label>
                        <input type="text" class="form-control" id="tour" name="tour">
                    </div>
                    <div class="form-group mb-3">
                        <label for="daily_departures">daily_departures:</label>
                        <input type="text" class="form-control" id="daily_departures" name="daily_departures">
                    </div>
                    <div class="form-group mb-3">
                        <label for="category_id">Categoria:</label>
                        <select class="form-select" id="category_id" name="category_id">
                            @foreach ( $categories as $item)
                            <option value="{{ $item->id }}">{{$item->category }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="itinerary">Itinerario:</label>
                        <input type="text" class="form-control" name="itinerary">
                    </div>
                    <div class="form-group mb-3">
                        <label for="price_per_person">Precio por persona:</label>
                        <input type="number" class="form-control" name="price_per_person">
                    </div>
                    <div class="form-group mb-3">
                        <label for="main_image">Agregar Imagen Pricipal:</label>
                        <input type="file" name="main_image" id="main_image" class="form-control-file form-control" accept="image/*">
                    </div>
                    <div class="form-group mb-3">
                        <label for="main_video">Agregar Video Pricipal:</label>
                        <input type="file" name="main_video" id="main_video" class="form-control-file form-control" accept="video/*">
                    </div>

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
<!--Fin del modal-->
<!-- modal actualizar usuario-->
<div class="modal fade" id="updateProductModal" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="updateProductModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateProductModalLabel">Actualizar Producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('update-product') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <input type="hidden" id="productId" name="id">

                    <!-- Categoría -->
                    <div class="form-group mb-3">
                        <label for="updateCategoryId">Categoría:</label>
                        <select class="form-select" id="updateCategoryId" name="category_id">
                            @foreach ($categories as $item)
                            <option value="{{ $item->id }}">{{ $item->category }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Nombre Producto -->
                    <div class="form-group mb-3">
                        <label for="updateProduct">Nombre Producto:</label>
                        <input type="text" class="form-control" id="updateProduct" name="product">
                    </div>

                    <!-- Tour -->
                    <div class="form-group mb-3">
                        <label for="updateTour">Tour:</label>
                        <input type="text" class="form-control" id="updateTour" name="tour" >
                    </div>

                    <!-- Precio por Persona -->
                    <div class="form-group mb-3">
                        <label for="updatePricePerPerson">Precio por Persona:</label>
                        <input type="number" class="form-control" name="price_per_person" id="updatePricePerPerson">
                    </div>

                    <!-- Imagen Principal -->
                    <div class="form-group mb-3">
                        <label for="updateMainImage">Imagen Principal:</label>
                        <input type="file" class="form-control" name="main_image" id="updateMainImage">
                    </div>

                    <!-- Video Principal -->
                    <div class="form-group mb-3">
                        <label for="updateMainVideo">Video Principal:</label>
                        <input type="file" class="form-control" name="main_video" id="updateMainVideo">
                    </div>

                    <!-- Itinerario -->
                    <div class="form-group mb-3">
                        <label for="updateItinerary">Itinerario:</label>
                        <textarea class="form-control" name="itinerary" id="updateItinerary"></textarea>
                    </div>

                    <!-- Daily Departures -->
                    <div class="form-group mb-3">
                        <label for="updateDailyDeparture">Daily Departures:</label>
                        <input type="text" class="form-control" name="daily_departures" id="updateDailyDeparture">
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


<!--Fin del modal-->
</main>
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
    var selected_product = function(id) {
        const data = `/product/${id}`;
        $.ajax({
            url: data,
            method: 'GET',
            success: function(response) {
                var product = response;
                $('#productId').val(product.id);
                $('#updateCategoryId').val(product.category_id);
                $('#updateProduct').val(product.product);
                $('#updateTour').val(product.tour);
                $('#updatePricePerPerson').val(product.price_per_person);
                $('#updateItinerary').val(product.itinerary);
                $('#updateDailyDeparture').val(product.daily_departures);
                // Mostrar el modal
                $('#updateProductModal').modal('show');
            },
            error: function() {
                alert('Error en la solicitud AJAX.');
            }
        });
    };
</script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    function open_modal_upload_image(codigo) {
        const data = `/selected/product/image/${codigo}`;
        axios.get(data)
            .then(function(response) {
                $('#codigo_producto').val(codigo);
                var image = response.data;
                $('#tabla-imagenes tbody').empty();

                // Iteramos sobre los datos de las imágenes y los agregamos a la tabla
                image.forEach(function(image, index) {
                    var newRow = '<tr>' +
                        '<td class="text-center">' + (index + 1) + '</td>' +
                        '<td class="text-center">' + image.url_image + '</td>' +
                        '<td class="text-center">' + image.updated_at + '</td>' +
                        '<td class="text-center"><a href="' + '{{ asset("/storage/product/") }}' + '/' + image.url_image + '" data-lightbox="roadtrip">Ver</a></td>' +
                        '<td class="text-center"><button type="button" value="' + image.id + '" class="btn btn-ghost-danger btn-sm delete-btn" onclick="deleteImage(' + image.id + ',' + image.product_id + ')"><i class="fas fa-trash"></i></button></td>' +
                        '</tr>';
                    $('#tabla-imagenes tbody').append(newRow);
                });

                $('#subirimagen').modal('show');
            })
            .catch(function(error) {
                alert('Error en la solicitud AJAX.');
            });
    }

    function open_modal_includes(codigo) {
        const data = `/selected/include/${codigo}`;
        axios.get(data)
            .then(function(response) {
                $('#product_id_servicio').val(codigo);
                var include = response.data;
                $('#tabla-includes tbody').empty();

                // Iteramos sobre los datos de los servicios y los agregamos a la tabla
                include.forEach(function(include, index) {
                    var newRow = '<tr>' +
                        '<td class="text-center">' + (index + 1) + '</td>' + // Número de fila
                        '<td class="text-center">' + include.includes + '</td>' + // Nombre del servicio
                        '<td class="text-center">' + include.updated_at + '</td>' + // Fecha
                        '<td class="text-center">' + (include.estado == 1 ? 'Incluye' : 'No incluye') + '</td>' + // Estado del servicio
                        '<td class="text-center"><button type="button" value="' + include.id + '" class="btn btn-danger btn-sm delete-btn" onclick="eliminarServicio(' + include.id + ')"><i class="fas fa-trash"></i></button></td>' +
                        '</tr>';
                    $('#tabla-includes tbody').append(newRow);
                });
                $('#includes').modal('show');
            })
            .catch(function(error) {
                alert('Error en la solicitud AJAX.');
            });
    }

    function open_modal_recommendations(codigo) {
        const data = `/selected/recommendation/${codigo}`;
        axios.get(data)
            .then(function(response) {
                $('#product_id_recommendation').val(codigo);
                var recommendation = response.data;
                $('#tabla-recommendations tbody').empty();
                recommendation.forEach(function(recommendation, index) {
                    var newRow = '<tr>' +
                        '<td class="text-center">' + (index + 1) + '</td>' +
                        '<td class="text-center">' + recommendation.recommendation + '</td>' +
                        '<td class="text-center">' + recommendation.updated_at + '</td>' +
                        '<td class="text-center"><button type="button" value="' + recommendation.id + '" class="btn btn-danger btn-sm delete-btn" onclick="deleteRecommendation(' + recommendation.id + ',' + recommendation.product_id + ')"><i class="fas fa-trash"></i></button></td>' +
                        '</tr>';
                    $('#tabla-recommendations tbody').append(newRow);
                });

                // Mostramos el modal
                $('#recommendations').modal('show');
            })
            .catch(function(error) {
                alert('Error en la solicitud AJAX.');
            });
    }

    function eliminarServicio(serviceId, product_id) {
        axios.delete(`/service/${serviceId}`)
            .then(function(response) {
                if (response.data.success) {
                    open_modal_includes(product_id);
                } else {
                    alert('Error al eliminar la recomendación.');
                }
            })
            .catch(function(error) {
                alert('Error en la solicitud AJAX.');
            });
    }

    function deleteRecommendation(recommendation_id, product_id) {
        axios.delete(`/recommendation/${recommendation_id}`)
            .then(function(response) {
                if (response.data.success) {
                    open_modal_recommendations(product_id);
                } else {
                    alert('Error al eliminar la recomendación.');
                }
            })
            .catch(function(error) {
                alert('Error en la solicitud AJAX.');
            });

    }

    function deleteImage(imageId, product_id) {
        axios.delete(`/image/${imageId}`)
            .then(function(response) {
                if (response.data.success) {
                    open_modal_upload_image(product_id);
                } else {
                    alert('Error al eliminar la imagen.');
                }
            })
            .catch(function(error) {
                alert('Error en la solicitud AJAX.');
            });
    }
</script>

<script>
    function guardarImagen(event) {
        event.preventDefault();
        var formData = new FormData(document.getElementById('form-subir-imagen'));
        axios.post('/upload/image/product', formData)
            .then(function(response) {
                if (response.data.success) {
                    open_modal_upload_image(response.data.data.product_id);
                    console.log(response.data.message);
                } else {
                    alert(response.data.message);
                }
            })
            .catch(function(error) {
                console.error('Error al subir la imagen:', error);
            });
    }

    function guardarServicio(event) {
        event.preventDefault();

        var formData = new FormData(document.getElementById('form-servicio'));

        axios.post('/upload/service/product', formData)
            .then(function(response) {
                if (response.data.success) {
                    open_modal_includes(response.data.data.product_id);

                    console.log(response.data.message);
                    alert('Servicio guardado correctamente');

                    // Cerrar el modal
                    $('#includes').modal('hide');
                } else {
                    alert(response.data.message);
                }
            })
            .catch(function(error) {
                console.error('Error al guardar el servicio:', error);
            });
    }

    function saveRecommendation(event) {
        event.preventDefault();

        var formData = new FormData(document.getElementById('form-recommendation'));

        axios.post('/upload/recommendation/product', formData)
            .then(function(response) {
                if (response.data.success) {
                    open_modal_recommendations(response.data.data.product_id);

                    console.log(response.data.message);
                    alert('Servicio guardado correctamente');

                    // Cerrar el modal
                    $('#recommendation').modal('hide');
                } else {
                    alert(response.data.message);
                }
            })
            .catch(function(error) {
                console.error('Error al guardar el servicio:', error);
            });
    }
</script>

@stop