@extends('layouts.app')

@section('title', 'Comptes - Bankati Pro')

@section('breadcrumb')
    <a href="{{ route('dashboard') }}">Dashboard</a>
    <span class="breadcrumb-separator">/</span>
    <span>Comptes</span>
@endsection

@section('content')
    <!-- PAGE HEADER -->
    <div class="page-header">
        <h1 class="page-title">
            <i class="fas fa-wallet"></i>
            Gestion des Comptes
        </h1>
        <p class="page-subtitle">Gérez tous les comptes bancaires</p>
    </div>

    <!-- ALERTS -->
    @if (session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <!-- COMPTES CARD -->
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Comptes</h2>
            <a href="{{ route('comptes.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i>
                Ajouter Compte
            </a>
        </div>
        <div class="card-body">
            @if ($comptes->count())
                <table>
                    <thead>
                        <tr>
                            <th>Numéro</th>
                            <th>RIB</th>
                            <th>Titulaire</th>
                            <th>Solde</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($comptes as $compte)
                            <tr>
                                <td><strong>{{ $compte->numero_compte ?? 'N/A' }}</strong></td>
                                <td><code style="background: var(--light); padding: 4px 8px; border-radius: 4px; font-size: 12px;">{{ $compte->rib ?? 'N/A' }}</code></td>
                                <td>{{ $compte->client->nom ?? 'N/A' }}</td>
                                <td><strong style="color: var(--success);">{{ number_format($compte->solde ?? 0, 2, ',', ' ') }} DA</strong></td>
                                <td>
                                    <span style="display: inline-block; padding: 6px 12px; border-radius: 6px; font-size: 12px; font-weight: 600; background: #10B98110; color: #10B981;">
                                        <i class="fas fa-check-circle"></i>
                                        Actif
                                    </span>
                                </td>
                                <td>
                                    <div class="table-actions">
                                        <a href="{{ route('comptes.show', $compte->id) }}" class="btn btn-ghost btn-sm">
                                            <i class="fas fa-eye"></i> Voir
                                        </a>
                                        <a href="{{ route('comptes.edit', $compte->id) }}" class="btn btn-ghost btn-sm">
                                            <i class="fas fa-edit"></i> Éditer
                                        </a>
                                        <form action="{{ route('comptes.destroy', $compte->id) }}" method="POST" style="display: inline;">
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
                    <i class="fas fa-inbox" style="font-size: 32px; margin-bottom: 12px; display: block; opacity: 0.5;"></i>
                    Aucun compte trouvé.
                </p>
            @endif
        </div>
    </div>
@endsection
