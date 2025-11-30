@extends('layouts.app')

@section('title', 'Virements - Bankati Pro')

@section('breadcrumb')
    <a href="{{ route('dashboard') }}">Dashboard</a>
    <span class="breadcrumb-separator">/</span>
    <span>Virements</span>
@endsection

@section('content')
    <!-- PAGE HEADER -->
    <div class="page-header">
        <h1 class="page-title">
            <i class="fas fa-exchange-alt"></i>
            Gestion des Virements
        </h1>
        <p class="page-subtitle">Suivi et gestion des transactions</p>
    </div>

    <!-- ALERTS -->
    @if (session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <!-- VIREMENTS CARD -->
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Virements</h2>
            <a href="{{ route('virements.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i>
                Nouveau Virement
            </a>
        </div>
        <div class="card-body">
            @if ($virements->count())
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Compte Source</th>
                            <th>Compte Destination</th>
                            <th>Montant</th>
                            <th>Date</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($virements as $virement)
                            <tr>
                                <td>#{{ $virement->id }}</td>
                                <td>{{ $virement->rib_source?? 'N/A' }}</td>
                                <td>{{ $virement->rib_target?? 'N/A' }}</td>
                                <td><strong>{{ number_format($virement->montant ?? 0, 2, '.', ' ') }} DA</strong></td>
                                <td>{{ $virement->created_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    <span style="display: inline-block; padding: 6px 12px; border-radius: 6px; font-size: 12px; font-weight: 600; background: #10B98110; color: #10B981;">
                                        Complété
                                    </span>
                                </td>
                                <td>
                                    <div class="table-actions">
                                        <a href="{{ route('virements.show', $virement->id) }}" class="btn btn-ghost btn-sm">
                                            <i class="fas fa-eye"></i> Voir
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p style="text-align: center; color: #6B7280; padding: 40px 0;">
                    Aucun virement trouvé.
                </p>
            @endif
        </div>
    </div>
@endsection
