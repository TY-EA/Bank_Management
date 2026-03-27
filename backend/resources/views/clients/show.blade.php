@extends('layouts.app')

@section('title', 'Détails Client - Bankati Pro')

@section('breadcrumb')
    <a href="{{ route('dashboard') }}">Dashboard</a>
    <span class="breadcrumb-separator">/</span>
    <a href="{{ route('clients.index') }}">Clients</a>
    <span class="breadcrumb-separator">/</span>
    <span>Détails Client</span>
@endsection

@section('content')
    <!-- PAGE HEADER -->
    <div class="page-header">
        <h1 class="page-title">
            <i class="fas fa-user"></i>
            Détails du Client: {{ $client->nom }}
        </h1>
        <p class="page-subtitle">Informations complètes sur le client</p>
    </div>

    <div class="card">
        <div class="card-body">
            <h3>Informations du Client</h3>
            <p><strong>ID:</strong> {{ $client->id }}</p>
            <p><strong>Nom:</strong> {{ $client->nom }}</p>
            <p><strong>Email:</strong> {{ $client->email }}</p>

            <h3>Comptes Associés</h3>
            @if ($client->comptes->count())
                <table>
                    <thead>
                        <tr>
                            <th>Numéro de Compte</th>
                            <th>RIB</th>
                            <th>Solde</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($client->comptes as $compte)
                            <tr>
                                {{-- <td>{{ $compte->numero_compte }}</td> --}}
                                <td>{{ $compte->rib }}</td>
                                <td>{{ number_format($compte->solde, 2, ',', ' ') }} DA</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>Aucun compte associé à ce client.</p>
            @endif

            <div style="margin-top: 20px;">
                <a href="{{ route('clients.index') }}" class="btn btn-ghost">
                    <i class="fas fa-arrow-left"></i>
                    Retour à la liste des clients
                </a>
            </div>
        </div>
    </div>
@endsection

