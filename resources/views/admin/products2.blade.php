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
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($products as $item)
                    <tr>
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <button type="button" class="btn btn-ghost-warning btn-sm edit-button" onclick="selected_product('{{$item->id}}')" data-id="{{ $item->id }}">
                                    <i class="fas fa-pencil-alt"></i>
                                </button>
                                @if($item->status)
                                    <form action="{{ route('disable-product', ['id' => $item->id]) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-ghost-danger btn-sm">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('enable-product', ['id' => $item->id]) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-ghost-info btn-sm">
                                            <i class="fas fa-check"></i> 
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </td>
                        <td>{{ $item->category->category }}</td>
                        <td>{{ $item->product }}</td>
                        <td>{{ $item->tour }}</td>
                        <td><a href="{{ asset('storage/product/images/'.$item->main_image) }}" target="_blank" class="btn btn-primary"> <i class="fa-solid fa-images"></i></a></td>
                        <td><a href="{{ asset('storage/product/videos/'.$item->main_video) }}" target="_blank" class="btn btn-primary"><i class="fa-solid fa-film"></i></a></td>
                        <td class="text-center">
                            <button type="button" class="btn btn-ghost-primary btn-sm" 
                            {{-- data-bs-toggle="modal" data-bs-target="#upload_image"  --}}
                            data-id="{{ $item->id }}"
                                onclick="open_modal_upload_image('{{ $item->id }}')">
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
            <form  method="post" enctype="multipart/form-data" id="form-subir-imagen" name="form-subir-imagen">
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
                    <button type="submit" class="btn btn-primary" onclick="guardarImagen(event)" >Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal para crear un nuevo usuario -->
<div class="modal fade" id="nuevoproducto" >
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
                            <label for="product">Nombre Producto:</label>
                            <input type="text" class="form-control" id="product" name="name">
                        </div>
                        <div class="form-group mb-3">
                            <label for="category_id">Categoria:</label>
                            <select class="form-select" id="category_id" name="category_id">
                                    @foreach ( $categories as $item)
                                        <option value="{{ $item->id }}">{{$item->name }}</option>
                                    @endforeach    
                            </select>   
                        </div>
                         <div class="form-group mb-3">
                            <label for="" >Descripción:</label>
                            <input type="text" class="form-control" name="description">
                        </div>
                        <div class="form-group mb-3">
                            <label for="archivo_inmueble" >Agregar Imagen:</label>
                            <input type="file" name="image" id="archivo_inmueble" class="form-control-file form-control" accept="image/*">
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
<div class="modal fade" id="actualizarProductModal" data-bs-backdrop="static" data-bs-keyboard="false"aria-labelledby="actualizarProductModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="actualizarProductModalLabel">Actualizar Producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('update-product') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <input type="hidden" id="idproduct" name="id">
                    <div class="form-group mb-3">
                        <label for="product">Nombre Producto:</label>
                        <input type="text" class="form-control" id="updatename" name="name">
                    </div>
                    <div class="form-group mb-3">
                        <label for="updatecategoryid">Categoria:</label>
                        <select class="form-select" id="updatecategoryid" name="category_id">
                                @foreach ( $categories as $item)
                                    <option value="{{ $item->id }}">{{$item->name }}</option>
                                @endforeach    
                        </select>   
                    </div>
                    
                    <div class="form-group mb-3">
                        <label for="rooms" >Habitaciones:</label>
                        <input type="number" class="form-control" name="rooms" id="updaterooms">
                    </div>
                    <div class="form-group mb-3">
                        <label for="garage" >Garage:</label>
                        <input type="number" class="form-control" name="garage" id="updategarage"> 
                    </div>
                    <div class="form-group mb-3">
                        <label for="square_meters" >Metros Cuadrados:</label>
                        <input type="number" class="form-control" name="square_meters" id="updatesquaremeters">
                    </div>
                    <div class="form-group mb-3">
                        <label for="bathrooms" >Baños:</label>
                        <input type="number" class="form-control" name="bathrooms" id="updatebathrooms">
                    </div>
                    <div class="form-group mb-3">
                        <label for="" >Precio:</label>
                        <input type="number" class="form-control" name="price" id="updateprice">
                    </div>
                    <div class="form-group mb-3">
                        <label for="" >Descripción:</label>
                        <input type="text" class="form-control" name="description" id="updatedescription">
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
<script>
    var traerDataCategoria = function(id){
        const data=`product/${id}`;
        $.ajax({
            url: data,
            method: 'GET',
            success: function(response) {
                    var product = response;
                    $('#idproduct').val(product.id);
                    $('#updatename').val(product.name);
                    $('#updatecategoryid').val(product.category_id);
                    $('#updatestatuspropertyid').val(product.status_property_id);
                    $('#updatedistrictid').val(product.district_id);
                    $('#updaterooms').val(product.rooms);
                    $('#updategarage').val(product.garage);
                    $('#updatesquaremeters').val(product.square_meters);
                    $('#updatebathrooms').val(product.bathrooms);
                    $('#updateprice').val(product.price);
                    $('#updatedescription').val(product.description);
                    $('#actualizarProductModal').modal('show');
            },
            error: function() {
                // Manejo de errores en caso de que la petición AJAX falle
                alert('Error en la solicitud AJAX.');
            }

        });
    };
</script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    function open_modal_upload_image(codigo){
        const data=`/selected/product/image/${codigo}`;
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
                        '<td class="text-center"><button type="button" value="' + image.id + '" class="btn btn-ghost-danger btn-sm delete-btn" onclick="disableImage(' + image.id + ',' + image.product_id + ')"><i class="fas fa-trash"></i></button></td>' +
                        '</tr>';
                    $('#tabla-imagenes tbody').append(newRow);
                });

                $('#subirimagen').modal('show');
            })
            .catch(function(error) {
                alert('Error en la solicitud AJAX.');
            });
    }
    function disableImage(imageId,product_id) {
        axios.post('/image/disable', {
                id: imageId
            })
            .then(function(response) {
                if (response.data.success) {
                    open_modal_upload_image(product_id);
                } else {
                    alert('Error al deshabilitar la imagen.');
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
    axios.post('/subir_imagen', formData)
        .then(function (response) {
            if (response.data.success) {
                open_modal_upload_image(response.data.data.product_id);
                console.log(response.data.message);
            } else {
                alert(response.data.message);
            }
        })
        .catch(function (error) {
            console.error('Error al subir la imagen:', error);
        });
    }
</script>
<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });
</script>
<script>
    lightbox.option({
        'resizeDuration': 50,
        'wrapAround': true,
        'showImageNumberLabel':true
    })
</script>
@endsection