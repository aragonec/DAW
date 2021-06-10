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
                            Agregar Producto
                        </button>
                    </li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
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
            <form action="/admin/productos" method="POST">
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
@endsection

@section('scripts')
    <script>
        $(document).ready(function(){
            @if($message= Session::get('errorInsert'))
                $("#modal-add").modal('show');
            @endif
        });
    </script>
@endsection