@extends('layouts.app')

@section('title', 'Détails Virement - Bankati Pro')

@section('breadcrumb')
    <a href="{{ route('dashboard') }}">Dashboard</a>
    <span class="breadcrumb-separator">/</span>
    <a href="{{ route('virements.index') }}">Virements</a>
    <span class="breadcrumb-separator">/</span>
    <span>#{{ $virement->id }}</span>
@endsection

@section('content')
    <!-- PAGE HEADER -->
    <div class="page-header">
        <h1 class="page-title">
            <i class="fas fa-receipt"></i>
            Détails du Virement #{{ $virement->id }}
        </h1>
        <p class="page-subtitle">Informations complètes de la transaction</p>
    </div>

    <div class="card">
        <div class="card-body">
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 30px;">
                <!-- Section: Compte Source -->
                <div style="padding: 20px; background: var(--light); border-radius: 12px; border-left: 4px solid var(--primary);">
                    <h3 style="font-size: 14px; font-weight: 600; color: var(--text); text-transform: uppercase; margin-bottom: 16px; opacity: 0.7;">
                        <i class="fas fa-arrow-up" style="color: var(--danger); margin-right: 8px;"></i>
                        Compte Source
                    </h3>
                    <p style="font-size: 16px; font-weight: 600; color: var(--dark); margin-bottom: 8px;">
                        {{ $virement->rib_source }}
                    </p>
                    @if ($virement->compteSource)
                        <p style="font-size: 13px; color: var(--text); margin-bottom: 4px;">
                            <strong>Titulaire:</strong> {{ $virement->compteSource->client->nom ?? 'N/A' }}
                        </p>

                    @endif
                </div>

                <!-- Section: Compte Destination -->
                <div style="padding: 20px; background: var(--light); border-radius: 12px; border-left: 4px solid var(--success);">
                    <h3 style="font-size: 14px; font-weight: 600; color: var(--text); text-transform: uppercase; margin-bottom: 16px; opacity: 0.7;">
                        <i class="fas fa-arrow-down" style="color: var(--success); margin-right: 8px;"></i>
                        Compte Destination
                    </h3>
                    <p style="font-size: 16px; font-weight: 600; color: var(--dark); margin-bottom: 8px;">
                        {{ $virement->rib_target }}
                    </p>
                    @if ($virement->compteDestination)
                        <p style="font-size: 13px; color: var(--text); margin-bottom: 4px;">
                            <strong>Titulaire:</strong> {{ $virement->compteDestination->client->nom ?? 'N/A' }}
                        </p>
                    @endif
                </div>

                <!-- Section: Montant -->
                <div style="padding: 20px; background: var(--light); border-radius: 12px; border-left: 4px solid var(--warning);">
                    <h3 style="font-size: 14px; font-weight: 600; color: var(--text); text-transform: uppercase; margin-bottom: 16px; opacity: 0.7;">
                        <i class="fas fa-coins" style="color: var(--warning); margin-right: 8px;"></i>
                        Montant
                    </h3>
                    <p style="font-size: 28px; font-weight: 700; color: var(--warning);">
                        {{ number_format($virement->montant, 2, ',', ' ') }} DA
                    </p>
                </div>

                <!-- Section: Date & Statut -->
                <div style="padding: 20px; background: var(--light); border-radius: 12px; border-left: 4px solid var(--secondary);">
                    <h3 style="font-size: 14px; font-weight: 600; color: var(--text); text-transform: uppercase; margin-bottom: 16px; opacity: 0.7;">
                        <i class="fas fa-calendar-alt" style="color: var(--secondary); margin-right: 8px;"></i>
                        Date de Transaction
                    </h3>
                    <p style="font-size: 16px; font-weight: 600; color: var(--dark);">
                        {{ $virement->date_virement->format('d/m/Y à H:i:s') }}
                    </p>
                </div>

                <!-- Section: Statut -->
                <div style="padding: 20px; background: var(--light); border-radius: 12px; border-left: 4px solid var(--success);">
                    <h3 style="font-size: 14px; font-weight: 600; color: var(--text); text-transform: uppercase; margin-bottom: 16px; opacity: 0.7;">
                        <i class="fas fa-info-circle" style="color: var(--success); margin-right: 8px;"></i>
                        Statut
                    </h3>
                    <span style="display: inline-block; padding: 8px 16px; background: #10B98110; color: var(--success); border-radius: 8px; font-weight: 600; font-size: 14px;">
                        <i class="fas fa-check-circle"></i>
                        {{ ucfirst($virement->statut) }}
                    </span>
                </div>
            </div>

            <!-- Description -->
            @if ($virement->description)
                <div style="margin-top: 30px; padding: 20px; background: var(--light); border-radius: 12px;">
                    <h3 style="font-size: 14px; font-weight: 600; color: var(--text); text-transform: uppercase; margin-bottom: 12px; opacity: 0.7;">
                        <i class="fas fa-sticky-note" style="margin-right: 8px;"></i>
                        Description
                    </h3>
                    <p style="color: var(--text); line-height: 1.6;">
                        {{ $virement->description }}
                    </p>
                </div>
            @endif

            <!-- Actions -->
            <div style="margin-top: 30px; display: flex; gap: 12px;">
                <a href="{{ route('virements.index') }}" class="btn btn-ghost">
                    <i class="fas fa-arrow-left"></i>
                    Retour
                </a>
                <a href="{{ route('virements.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i>
                    Nouveau Virement
                </a>
            </div>
        </div>
    </div>
@endsection
