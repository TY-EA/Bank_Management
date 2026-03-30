@extends('clients.layout')

@section('title', 'Modifier le client')

@section('content')
<h1>Modifier le client</h1>

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('clients.update', $client->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label>Nom :</label>
        <input type="text" name="nom" class="form-control" value="{{ old('nom', $client->nom) }}" required>
    </div>
    <div class="mb-3">
        <label>Prénom :</label>
        <input type="text" name="prenom" class="form-control" value="{{ old('prenom', $client->prenom) }}" required>
    </div>
    <div class="mb-3">
        <label>Email :</label>
        <input type="email" name="email" class="form-control" value="{{ old('email', $client->email) }}" required>
    </div>
    <button type="submit" class="btn btn-primary">Mettre à jour</button>
</form>
@endsection
