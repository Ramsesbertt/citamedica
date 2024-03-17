<?php
    use Illuminate\Support\Str;
?>


@extends('layouts.panel')

@section('content')

      <div class="card shadow">
        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0">Nuevo Paciente</h3>
            </div>
            <div class="col text-right">
              <a href="{{ url('/pacientes')}}" class="btn btn-sm btn-success">
              <i clas="fas fa-chevron-left"></i>
              Regresar</a>
            </div>
          </div>
        </div>

      <div class="card-body">

            @if ($errors->any())
                @foreach ($errors->all() as $error)
                  <div class="alert alert-danger" role="alert">
                    <i class="fas fa-exclamation-triangle"></i>
                    <strong>Por favor!!</strong> {{ $error }}
                  </div>
                @endforeach
            @endif

            <form action="{{ url('/pacientes')}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Nombre del paciente</label>
                    <input type="tex" name="name" class="form-control" value="{{ old('name') }}" required>
                </div>

                <div class="form-group">
                    <label for="email">Correo electrónico</label>
                    <input type="tex" name="email" class="form-control" value="{{ old('email') }}">
                </div>
                <div class="form-group">
                    <label for="cedula">Cédula</label>
                    <input type="tex" name="cedula" class="form-control" value="{{ old('cedula') }}">
                </div>
                <div class="form-group">
                    <label for="address">Dirección</label>
                    <input type="tex" name="address" class="form-control" value="{{ old('address') }}">
                </div>
                <div class="form-group">
                    <label for="phone">Teléfono Móvil</label>
                    <input type="tex" name="phone" class="form-control" value="{{ old('phone') }}">
                </div>
                <div class="form-group">
                  <label for="password">Contraseña</label>
                  <input type="tex" name="password" class="form-control" value="{{ old('password', Str::random(8)) }}">
              </div>

                <button type="submit" class="btn btn-sm btn-primary">Crear paciente</button>
            </form>
      </div>

@endsection