@extends('layouts.app')

@section('title', 'Clients - Bankati Pro')

@section('breadcrumb')
    <a href="{{ route('dashboard') }}">Dashboard</a>
    <span class="breadcrumb-separator">/</span>
    <span>Clients</span>
@endsection

@section('content')
    <!-- PAGE HEADER -->
    <div class="page-header">
        <h1 class="page-title">
            <i class="fas fa-users"></i>
            Gestion des Clients
        </h1>
        <p class="page-subtitle">Liste de tous vos clients enregistrés</p>
    </div>

    <!-- ALERTS -->
    @if (session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            <i class="fas fa-exclamation-circle"></i>
            <span>{{ session('error') }}</span>
        </div>
    @endif

    <!-- CLIENTS CARD -->
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Clients</h2>
            <a href="{{ route('clients.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i>
                Ajouter Client
            </a>
        </div>
        <div class="card-body">
            @if ($clients->count())
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Email</th>
                            <th>Téléphone</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($clients as $client)
                            <tr>
                                <td>#{{ $client->id }}</td>
                                <td>{{ $client->nom ?? 'N/A' }}</td>
                                <td>{{ $client->email ?? 'N/A' }}</td>
                                <td>{{ $client->telephone ?? 'N/A' }}</td>
                                <td>
                                    <div class="table-actions">
                                        <a href="{{ route('clients.show', $client->id) }}" class="btn btn-ghost btn-sm">
                                            <i class="fas fa-eye"></i> Voir
                                        </a>
                                        <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-ghost btn-sm">
                                            <i class="fas fa-edit"></i> Éditer
                                        </a>
                                        <form action="{{ route('clients.destroy', $client->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr ?')">
                                                <i class="fas fa-trash"></i> Supprimer
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p style="text-align: center; color: #6B7280; padding: 40px 0;">
                    Aucun client trouvé. <a href="{{ route('clients.create') }}">Créer un client</a>
                </p>
            @endif
        </div>
    </div>
@endsection
