@extends('admin.layouts.main')

@section('contenido')
    <h2>Productos</h2>
    <form action="/admin/productos" method="POST">
        @csrf
        <button type="submit" class="btn btn-primary">Aceptar</button>
    </form>
@endsection