@extends('layouts.app')
@section('titulo')
  Inicio
@endsection
@section('contenedor')
  @include('admin.navegacion')
  <div class="container">
    <div class="row mt-5">
      <a href="{{url('equipos')}}" class="btn btn-info btn-lg p-5 col-6 ">Equipos</a>
      <a href="{{url('impresoras')}}" class="btn btn-secondary btn-lg p-5 col-6">Impresoras</a>
    </div>
  </div>
@endsection
