@extends('layouts.app')  

@section('content')
    <div class="medication-alerts-container">
        <div class="container py-5">
            <div class="card main-card shadow-lg border-0 rounded-4 animated-card">
                <div class="card-header bg-transparent border-0 py-4">
                    <h1 class="text-center mb-0 fw-bold">
                        <i class="fas fa-prescription-bottle-alt text-danger me-2"></i>
                        <span class="gradient-text">Alertes de validité des médicaments</span>
                    </h1>
                </div>
                
                <div class="card-body px-4 py-3">
                    @if ($alertMedications->isEmpty())
                        <div class="alert alert-success border-0 shadow-sm text-center p-4 rounded-3">
                            <div class="d-flex align-items-center justify-content-center">
                                <i class="fas fa-check-circle fa-2x text-success me-3 animated-icon"></i>
                                <p class="mb-0 fs-5">Tous vos médicaments sont à jour</p>
                            </div>
                        </div>
                    @else
                        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                            @foreach ($alertMedications as $medication)
                                <div class="col">
                                    <div class="card medication-card h-100 border-0 shadow-sm hover-effect">
                                        <div class="card-body p-4">
                                            <div class="d-flex justify-content-between align-items-start mb-3">
                                                <h5 class="card-title fw-bold text-primary">{{ $medication->name }}</h5>
                                                <span class="badge badge-warning expiry-badge">⚠️ Expiration proche</span>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <i class="far fa-calendar-alt text-muted me-2"></i>
                                                <p class="card-text text-muted mb-0">Expire le: {{ $medication->expiry_date->format('d/m/Y') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
                
                <div class="card-footer bg-transparent border-0 p-4">
                    <!-- <a href="{{ route('medications.index') }}" class="btn btn-return w-100 py-3 shadow-sm">
                        <i class="fas fa-arrow-left me-2"></i> Retour à la liste des médicaments
                    </a> -->
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Image d'arrière-plan et configuration de base */
        .medication-alerts-container {
            background: linear-gradient(rgba(255, 255, 255, 0.95), rgba(255, 255, 255, 0.95)), 
                        url('https://images.unsplash.com/photo-1584308074685-ad3b5a8945a0?ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            min-height: 100vh;
            padding: 20px 0;
        }

        /* Carte principale */
        .main-card {
            border-radius: 20px !important;
            overflow: hidden;
            background-color: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            box-shadow: 0 15px 35px rgba(50, 50, 93, 0.1), 0 5px 15px rgba(0, 0, 0, 0.07) !important;
        }

        /* Animation d'entrée */
        .animated-card {
            opacity: 0;
            transform: translateY(-20px);
            animation: fadeInUp 0.8s ease-out forwards;
        }

        @keyframes fadeInUp {
            0% {
                opacity: 0;
                transform: translateY(30px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Titre avec dégradé */
        .gradient-text {
            background: linear-gradient(45deg, #e52d27, #b31217);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            display: inline-block;
        }

        /* Icône animée */
        .animated-icon {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }

        /* Cartes des médicaments */
        .medication-card {
            border-radius: 15px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            background: linear-gradient(145deg, #ffffff, #f5f5f5);
        }

        .medication-card:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 6px;
            height: 100%;
            background: linear-gradient(to bottom, #007bff, #00c6ff);
            opacity: 0.8;
        }

        .hover-effect:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1) !important;
        }

        /* Badge d'expiration */
        .expiry-badge {
            background: linear-gradient(45deg, #ff9a00, #ff6d00);
            color: white;
            padding: 8px 12px;
            font-size: 12px;
            font-weight: 600;
            border-radius: 30px;
            box-shadow: 0 4px 10px rgba(255, 109, 0, 0.3);
            animation: blink 2s infinite;
        }

        @keyframes blink {
            0% { opacity: 1; }
            50% { opacity: 0.6; }
            100% { opacity: 1; }
        }

        /* Bouton de retour */
        .btn-return {
            background: linear-gradient(45deg, #dc3545, #ff6b6b);
            color: white;
            border: none;
            border-radius: 12px;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(220, 53, 69, 0.3);
        }

        .btn-return:hover {
            background: linear-gradient(45deg, #c82333, #e53935);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 7px 20px rgba(220, 53, 69, 0.4);
        }

        /* Optimisations pour mobile */
        @media (max-width: 768px) {
            .medication-alerts-container {
                padding: 10px;
            }
            
            .main-card {
                margin: 0 10px;
            }
        }
    </style>
@endsection