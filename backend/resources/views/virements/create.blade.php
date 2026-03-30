@extends('virements.layout')

@section('title', 'Nouveau Virement')

@section('content')
<h2>Ajouter un Virement</h2>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('virements.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label>Compte Source (RIB)</label>
        <input type="text" name="rib_source" class="form-control" value="{{ old('rib_source') }}" required>
    </div>
    <div class="mb-3">
        <label>Compte Destination (RIB)</label>
        <input type="text" name="rib_target" class="form-control" value="{{ old('rib_target') }}" required>
    </div>
    <div class="mb-3">
        <label>Montant</label>
        <input type="number" step="0.01" name="montant" class="form-control" value="{{ old('montant') }}" required>
    </div>
    
    <button type="submit" class="btn btn-success">Ajouter</button>
</form>
@endsection
