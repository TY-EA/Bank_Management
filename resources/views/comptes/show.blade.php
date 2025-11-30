@extends('layouts.app')

@section('title', 'Détails Compte - Bankati Pro')

@section('breadcrumb')
    <a href="{{ route('dashboard') }}">Dashboard</a>
    <span class="breadcrumb-separator">/</span>
    <a href="{{ route('comptes.index') }}">Comptes</a>
    <span class="breadcrumb-separator">/</span>
    <span>#{{ $compte->id ?? '' }}</span>
@endsection

@section('content')
    <!-- PAGE HEADER -->
    <div class="page-header">
        <h1 class="page-title">
            <i class="fas fa-wallet"></i>
            Détails du Compte
        </h1>
        <p class="page-subtitle">Informations du compte et historique des transactions</p>
    </div>

    <!-- ACCOUNT DETAILS CARD -->
    <div class="card">
        <div class="card-body">
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 20px;">
                <!-- SECTION: BASIC INFO -->
                <div style="padding: 20px; background: var(--light); border-radius: 12px;">
                    <h3 style="font-size: 14px; font-weight: 600; color: var(--text); margin-bottom: 12px; opacity: .85;">
                        <i class="fas fa-info-circle" style="margin-right: 8px;"></i> Information
                    </h3>
                    <p style="font-size: 16px; font-weight: 700; color: var(--dark)">
                        {{ $compte->numero_compte ?? 'N/A' }}
                    </p>
                    <p style="font-size: 13px; color: var(--text); margin-top: 6px;">
                        <strong>RIB:</strong>
                        <span
                            style="display:inline-block; background: var(--light); padding: 4px 8px; border-radius: 4px;">{{ $compte->rib ?? 'N/A' }}</span>
                    </p>
                    <p style="font-size: 13px; color: var(--text); margin-top: 6px;">
                        <strong>Créé le:</strong>
                        {{ $compte->created_at ? $compte->created_at->format('d/m/Y H:i') : 'N/A' }}
                    </p>
                </div>

                <!-- SECTION: CLIENT -->
                <div style="padding: 20px; background: var(--light); border-radius: 12px;">
                    <h3 style="font-size: 14px; font-weight: 600; color: var(--text); margin-bottom: 12px; opacity: .85;">
                        <i class="fas fa-user" style="margin-right: 8px;"></i> Titulaire
                    </h3>
                    <p style="font-size: 16px; font-weight: 700; color: var(--dark);">
                        {{ $compte->client->nom ?? 'N/A' }}
                    </p>
                    <p style="font-size: 13px; color: var(--text); margin-top: 6px;">
                        {{ $compte->client->email ?? '' }}
                    </p>
                </div>

                <!-- SECTION: BALANCE -->
                <div style="padding: 20px; background: var(--light); border-radius: 12px;">
                    <h3 style="font-size: 14px; font-weight: 600; color: var(--text); margin-bottom: 12px; opacity: .85;">
                        <i class="fas fa-coins" style="margin-right: 8px;"></i> Solde
                    </h3>
                    <p style="font-size: 28px; font-weight: 700; color: var(--success);">
                        {{ number_format($compte->solde ?? 0, 2, ',', ' ') }} DA</p>
                </div>
            </div>

            <!-- ACTIONS -->
            <div style="margin-top: 20px; display:flex; gap:12px;">
                <a href="{{ route('comptes.index') }}" class="btn btn-ghost">
                    <i class="fas fa-arrow-left"></i>
                    Retour
                </a>
                <a href="{{ route('comptes.edit', $compte->id) }}" class="btn btn-primary">
                    <i class="fas fa-edit"></i>
                    Éditer
                </a>
                <a href="{{ route('virements.create') }}" class="btn btn-secondary">
                    <i class="fas fa-exchange-alt"></i>
                    Nouveau Virement
                </a>
            </div>
        </div>
    </div>

    <!-- VIREMENTS / TRANSACTIONS -->
    <div class="card" style="margin-top: 20px;">
        <div class="card-header">
            <h2 class="card-title">Historique des Transactions</h2>
        </div>
        <div class="card-body">
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px;">
                <!-- Virements envoyés -->
                <div style="padding: 20px; background: var(--light); border-radius: 12px;">
                    <h3 style="font-size: 14px; font-weight: 600; color: var(--text); margin-bottom: 12px; opacity: .85;">
                        <i class="fas fa-arrow-up" style="color: var(--danger); margin-right: 8px;"></i> Envoyés
                    </h3>

                    @if ($compte->virementsEnvoyes && $compte->virementsEnvoyes->count())
                        <ul style="padding: 0; list-style: none;">
                            @foreach ($compte->virementsEnvoyes->sortByDesc('created_at')->take(5) as $v)
                                <li style="margin-bottom: 10px;">
                                    <a href="{{ route('virements.show', $v->id) }}"
                                        style="text-decoration: none; color: inherit;">
                                        <strong>#{{ $v->id }}</strong> - 
                                        {{ number_format($v->montant, 2, ',', ' ') }} DA
                                        <span
                                            style="color: var(--text); font-size: 12px;">({{ $v->created_at->format('d/m/Y H:i') }})</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p>Aucun virement envoyé.</p>
                    @endif
                </div>

                <!-- Virements reçus -->
                <div style="padding: 20px; background: var(--light); border-radius: 12px;">
                    <h3 style="font-size: 14px; font-weight: 600; color: var(--text); margin-bottom: 12px; opacity: .85;">
                        <i class="fas fa-arrow-down" style="color: var(--success); margin-right: 8px;"></i> Reçus
                    </h3>

                    @if ($compte->virementsRecus && $compte->virementsRecus->count())
                        <ul style="padding: 0; list-style: none;">
                            @foreach ($compte->virementsRecus->sortByDesc('created_at')->take(5) as $v)
                                <li style="margin-bottom: 10px;">
                                    <a href="{{ route('virements.show', $v->id) }}"
                                        style="text-decoration: none; color: inherit;">
                                        <strong>#{{ $v->id }}</strong> +
                                        {{ number_format($v->montant, 2, ',', ' ') }} DA
                                        <span
                                            style="color: var(--text); font-size: 12px;">({{ $v->created_at->format('d/m/Y H:i') }})</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p>Aucun virement reçu.</p>
                    @endif
                </div>
            </div>

            <!-- LINK: Voir tous les virements -->
            <div style="margin-top: 16px;">
                <a href="{{ route('virements.index') }}" class="btn btn-ghost">
                    <i class="fas fa-list"></i>
                    Voir Tous les Virements
                </a>
            </div>
        </div>
    </div>
@endsection
