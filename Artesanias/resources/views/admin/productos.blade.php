@extends('admin.layouts.main')

@section('contenido')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Productos</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <button class="btn btn-outline-primary btn-sm" 
                        data-toggle="modal" data-target="#modal-add">
                        <i class="fa fa-plus"> Agregar Productos</i> 
                        </button>
                    </li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<div class="content">
    <div class="cointaner-fluid">
        <div class="row">
            @if($message= Session::get('Listo'))
                <div class="alert alert-success alert-dismissable fade show col-12" role="alert">
                    <h5>Listo:</h5>
                    <p>{{$message}}</p>
                </div>
            @endif
            <table class="table">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Descripcion</th>
                        <th>Precio</th>
                        <th>Inventario</th>
                        <th>Tags</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($productos as $p)
                    <tr>
                        <td>
                            <img src="{{ asset('img/productos/'.$p->img_product)}}" alt="" width="70px">
                            {{$p->name}}
                        </td>
                        <td>{{$p->description}}</td>
                        <td>{{$p->price}}</td>
                        <td>{{$p->stock}}</td>
                        <td>{{$p->tags}}</td>
                        <td>
                            <button class="btn btn-primary btnEdit" data-id="{{ $p->id}}"
                            data-name="{{$p->name}}"
                            data-description="{{$p->description}}"
                            data-price="{{$p->price}}"
                            data-stock="{{$p->stock}}"
                            data-tags="{{$p->tags}}"
                            data-toggle="modal" data-target="#modal-edit"> 
                            <i class="fa fa-edit"></i>
                            </button>
                            <button class="btn btn-danger btnEliminar" data-id="{{ $p->id}}"
                            data-toggle="modal" data-target="#modal-delete"> 
                            <i class="fa fa-trash"></i>
                            </button>
                            <form class= "d-none" action="{{ url('/admin/productos', ['id'=>$p->id]) }}" 
                            method="POST" id="formEliminar_{{ $p->id}}">
                            @csrf
                            <input type="text" name="id" value="{{ $p->id}}">
                            <input type="text" name="_method" value="delete">
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Modal-Edit -->
<div class="modal fade" id="modal-edit" style="display: none;" 
    aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Editar Productos</h4>
                    <button type="button" class="close" data-dismiss="modal" 
                    aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="/admin/productos/edit" method="POST" enctype="multipart/form-data">
                    @if($message= Session::get('errorEdit'))
                        <div class="alert alert-danger aler-dismissable fade show col-12" role="alert">
                            <h5>ERROR:</h5>
                            <ul>
                                @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" id="idEdit" name="id">
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" class="form-control" id="nameEdit" name="name" value="{{ @old('name')}}">
                        </div>
                        <div class="form-group">
                            <label for="descripcion">Descripcion</label>
                            <input type="text" class="form-control" id="descriptionEdit" name="description" value="{{ @old('description')}}">
                        </div>
                        <div class="form-group">
                            <label for="inventario">Inventario</label>
                            <input type="number" class="form-control" id="stockEdit" min="1" name="stock" value="{{ @old('stock')}}">
                        </div>
                        <div class="form-group">
                            <label for="precio">Precio</label>
                            <input type="number" class="form-control" id="priceEdit" min="0" name="price" value="{{ @old('price')}}">
                        </div>
                        <div class="form-group">
                            <label for="tags">Tags</label>
                            <input type="text" class="form-control" id="tagsEdit" name="tags" value="{{ @old('tags')}}">
                        </div>
                        <div class="form-group">
                            <label for="imagen">Foto del Producto</label>
                        </div>
                        <div class="custom-file" >
                            <input type="file" class="custom-file-input" id="imgEdit" name="img_product" value="{{ @old('img_product')}}">
                            <label class="custom-file-label" for="customFile">Selecciona imagen</label>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" 
                        data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">
                            Guardar</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
</div>
<!-- /.modal-edit -->

<!-- Modal-add -->
<div class="modal fade" id="modal-add" style="display: none;" 
    aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Agregar Productos</h4>
                    <button type="button" class="close" data-dismiss="modal" 
                    aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="/admin/productos" method="POST" enctype="multipart/form-data">
                    @if($message= Session::get('errorInsert'))
                        <div class="alert alert-danger aler-dismissable fade show col-12" role="alert">
                            <h5>ERROR:</h5>
                            <ul>
                                @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ @old('name')}}">
                        </div>
                        <div class="form-group">
                            <label for="descripcion">Descripcion</label>
                            <input type="text" class="form-control" id="description" name="description" value="{{ @old('description')}}">
                        </div>
                        <div class="form-group">
                            <label for="inventario">Inventario</label>
                            <input type="number" class="form-control" id="stock" min="1" name="stock" value="{{ @old('stock')}}">
                        </div>
                        <div class="form-group">
                            <label for="precio">Precio</label>
                            <input type="number" class="form-control" id="price" min="0" name="price" value="{{ @old('price')}}">
                        </div>
                        <div class="form-group">
                            <label for="tags">Tags</label>
                            <input type="text" class="form-control" id="tags" name="tags" value="{{ @old('tags')}}">
                        </div>
                        <div class="form-group">
                            <label for="imagen">Foto del Producto</label>
                        </div>
                        <div class="custom-file" >
                            <input type="file" class="custom-file-input" id="img_producto" name="img_product" value="{{ @old('img_product')}}">
                            <label class="custom-file-label" for="customFile">Selecciona imagen</label>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" 
                        data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">
                            Guardar</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
</div>
<!-- /.modal-add -->


<!-- Modal-delete -->
<div class="modal fade" id="modal-delete" style="display: none;" 
    aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Eliminar Productos</h4>
                    <button type="button" class="close" data-dismiss="modal" 
                    aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                    <div class="modal-body">
                        <h2 class="h6">¿Desea eliminar el producto?</h2>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" 
                        data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-danger btnCloseEliminar">Eliminar</button>
                    </div>
            </div>
            <!-- /.modal-content -->
        </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal-delete -->

@endsection

@section('scripts')
    <script>
        var idEliminar=-1;
        $(document).ready(function(){
            @if($message= Session::get('errorInsert'))
                $("#modal-add").modal('show');
            @endif
            @if($message= Session::get('errorEdit'))
                $("#modal-edit").modal('show');
            @endif

            $(".btnEliminar").click(function(){
                var id=$(this).data('id');
                idEliminar=id;
            })

            $(".btnCloseEliminar").click(function(){
                $("#formEliminar_"+idEliminar).submit();
            });            
            $(".btnEdit").click(function(){
                var id=$(this).data('id');
                var name=$(this).data('name');
                var des=$(this).data('description');
                var price=$(this).data('price');
                var stock=$(this).data('stock');
                var tags=$(this).data('tags');
                $("#idEdit").val(id);
                $("#nameEdit").val(name);
                $("#descriptionEdit").val(des);
                $("#priceEdit").val(price);
                $("#stockEdit").val(stock);
                $("#tagsEdit").val(tags);
            });
        });

    </script>
@endsection 