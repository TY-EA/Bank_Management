<?php
@extends('layouts.app')

@section('title', 'Éditer Compte - Bankati Pro')

@section('breadcrumb')
    <a href="{{ route('dashboard') }}">Dashboard</a>
    <span class="breadcrumb-separator">/</span>
    <a href="{{ route('comptes.index') }}">Comptes</a>
    <span class="breadcrumb-separator">/</span>
    <span>Éditer</span>
@endsection

@section('content')
    <!-- PAGE HEADER -->
    <div class="page-header">
        <h1 class="page-title">
            <i class="fas fa-wallet"></i>
            Éditer Compte
        </h1>
        <p class="page-subtitle">Modifiez les informations du compte</p>
    </div>

    <!-- FORM CARD -->
    <div class="card">
        <div class="card-body">
            <form action="{{ route('comptes.update', $compte->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Client -->
                <div style="margin-bottom: 24px;">
                    <label style="display: block; margin-bottom: 8px; font-weight: 600; color: var(--dark);">
                        Client
                    </label>
                    <select name="client_id" required style="width: 100%; padding: 12px; border: 1px solid var(--border); border-radius: 8px; font-size: 14px;">
                        <option value="">-- Sélectionner un client --</option>
                        @foreach ($clients as $client)
                            <option value="{{ $client->id }}" @if($compte->client_id == $client->id) selected @endif>
                                {{ $client->nom }} - {{ $client->email }}
                            </option>
                        @endforeach
                    </select>
                    @error('client_id')
                        <span style="color: var(--danger); font-size: 13px; margin-top: 6px; display: block;">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Numéro de Compte -->
                <div style="margin-bottom: 24px;">
                    <label style="display: block; margin-bottom: 8px; font-weight: 600; color: var(--dark);">
                        Numéro de Compte
                    </label>
                    <input type="text" name="numero_compte" value="{{ old('numero_compte', $compte->numero_compte) }}" required 
                        style="width: 100%; padding: 12px; border: 1px solid var(--border); border-radius: 8px; font-size: 14px;">
                    @error('numero_compte')
                        <span style="color: var(--danger); font-size: 13px; margin-top: 6px; display: block;">{{ $message }}</span>
                    @enderror
                </div>

                <!-- RIB -->
                <div style="margin-bottom: 24px;">
                    <label style="display: block; margin-bottom: 8px; font-weight: 600; color: var(--dark);">
                        RIB (Relevé d'Identité Bancaire)
                    </label>
                    <input type="text" name="rib" value="{{ old('rib', $compte->rib) }}" required 
                        style="width: 100%; padding: 12px; border: 1px solid var(--border); border-radius: 8px; font-size: 14px;">
                    @error('rib')
                        <span style="color: var(--danger); font-size: 13px; margin-top: 6px; display: block;">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Solde -->
                <div style="margin-bottom: 24px;">
                    <label style="display: block; margin-bottom: 8px; font-weight: 600; color: var(--dark);">
                        Solde (DA)
                    </label>
                    <input type="number" name="solde" step="0.01" min="0" value="{{ old('solde', $compte->solde) }}" required 
                        style="width: 100%; padding: 12px; border: 1px solid var(--border); border-radius: 8px; font-size: 14px;">
                    @error('solde')
                        <span style="color: var(--danger); font-size: 13px; margin-top: 6px; display: block;">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Actions -->
                <div style="display: flex; gap: 12px;">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-check"></i>
                        Mettre à Jour
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
