@extends('layouts.app')

@section('title', 'Nouveau Compte - Bankati Pro')

@section('breadcrumb')
    <a href="{{ route('dashboard') }}">Dashboard</a>
    <span class="breadcrumb-separator">/</span>
    <a href="{{ route('comptes.index') }}">Comptes</a>
    <span class="breadcrumb-separator">/</span>
    <span>Nouveau</span>
@endsection

@section('content')
    <!-- PAGE HEADER -->
    <div class="page-header">
        <h1 class="page-title">
            <i class="fas fa-wallet"></i>
            Nouveau Compte
        </h1>
        <p class="page-subtitle">Créez un nouveau compte bancaire</p>
    </div>

    <!-- FORM CARD -->
    <div class="card">
        <div class="card-body">
            <form action="{{ route('comptes.store') }}" method="POST">
                @csrf

                <!-- Client -->
                <div style="margin-bottom: 24px;">
                    <label style="display: block; margin-bottom: 8px; font-weight: 600; color: var(--dark);">
                        Client
                    </label>
                    <select name="client_id" required style="width: 100%; padding: 12px; border: 1px solid var(--border); border-radius: 8px; font-size: 14px;">
                        <option value="">-- Sélectionner un client --</option>
                        @foreach ($clients as $client)
                            <option value="{{ $client->id }}" @if(old('client_id') == $client->id) selected @endif>
                                {{ $client->nom }} - {{ $client->email }}
                            </option>
                        @endforeach
                    </select>
                    @error('client_id')
                        <span style="color: var(--danger); font-size: 13px; margin-top: 6px; display: block;">{{ $message }}</span>
                    @enderror
                </div>

               

                <!-- RIB (Relevé d'Identité Bancaire) -->
                <div style="margin-bottom: 24px;">
                    <label style="display: block; margin-bottom: 8px; font-weight: 600; color: var(--dark);">
                        RIB (Relevé d'Identité Bancaire)
                    </label>
                    <input type="text" name="rib" value="{{ old('rib') }}" required 
                        placeholder="Ex: 00680001011000061111111111" 
                        style="width: 100%; padding: 12px; border: 1px solid var(--border); border-radius: 8px; font-size: 14px;">
                    <p style="font-size: 12px; color: #6B7280; margin-top: 6px;">
                        Le RIB doit être unique pour chaque compte
                    </p>
                    @error('rib')
                        <span style="color: var(--danger); font-size: 13px; margin-top: 6px; display: block;">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Solde Initial -->
                <div style="margin-bottom: 24px;">
                    <label style="display: block; margin-bottom: 8px; font-weight: 600; color: var(--dark);">
                        Solde Initial (DA)
                    </label>
                    <input type="number" name="solde" step="0.01" min="0" value="{{ old('solde') }}" required 
                        placeholder="0.00"
                        style="width: 100%; padding: 12px; border: 1px solid var(--border); border-radius: 8px; font-size: 14px;">
                    @error('solde')
                        <span style="color: var(--danger); font-size: 13px; margin-top: 6px; display: block;">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Actions -->
                <div style="display: flex; gap: 12px;">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-check"></i>
                        Créer le Compte
                    </button>
                    <a href="{{ route('comptes.index') }}" class="btn btn-ghost">
                        <i class="fas fa-times"></i>
                        Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
