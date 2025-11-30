@extends('clients.layout')

@section('title', 'Ajouter un client')

@section('content')
<h1>Ajouter un client</h1>

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('clients.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label>Nom :</label>
        <input type="text" name="nom" class="form-control" value="{{ old('nom') }}" required>
    </div>
    <div class="mb-3">
        <label>Prénom :</label>
        <input type="text" name="prenom" class="form-control" value="{{ old('prenom') }}" required>
    </div>
    <div class="mb-3">
        <label>Email :</label>
        <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
    </div>
    <button type="submit" class="btn btn-success">Enregistrer</button>
</form>
@endsection
