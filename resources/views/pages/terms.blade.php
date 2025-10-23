@extends('layouts.app')

@section('content')
<div class="terms-conditions-container">
    <div class="terms-header text-center mb-5">
        <h1 class="display-4 text-primary fw-bold">
            <i class="fas fa-file-contract me-2"></i> Conditions Générales
        </h1>
        <p class="lead text-muted">Vos droits et obligations en tant qu'utilisateur</p>
    </div>

    <div class="terms-content">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card terms-card shadow-lg">
                    <div class="card-body p-4 p-md-5">
                        <ul class="terms-list list-group list-group-flush">
                            <li class="terms-item list-group-item">
                                <h4 class="text-info fw-bold">
                                    <i class="fas fa-user-check me-2"></i> Utilisation du Site
                                </h4>
                                <p>Vous devez avoir 18 ans ou plus pour acheter des médicaments sur le site.</p>
                            </li>
                            
                            <li class="terms-item list-group-item">
                                <h4 class="text-info fw-bold">
                                    <i class="fas fa-info-circle me-2"></i> Informations Médicales
                                </h4>
                                <p>Les informations fournies ne remplacent pas une consultation avec un médecin spécialisé.</p>
                            </li>
                            
                            <li class="terms-item list-group-item">
                                <h4 class="text-info fw-bold">
                                    <i class="fas fa-shopping-basket me-2"></i> Commandes
                                </h4>
                                <p>Toutes les commandes sont soumises à disponibilité, la pharmacie peut annuler toute commande si le produit n'est pas disponible.</p>
                            </li>
                            
                            <li class="terms-item list-group-item">
                                <h4 class="text-info fw-bold">
                                    <i class="fas fa-exchange-alt me-2"></i> Retours et Échanges
                                </h4>
                                <p>Les médicaments ne peuvent être retournés que s'il y a une erreur de la pharmacie.</p>
                            </li>
                            
                            <li class="terms-item list-group-item">
                                <h4 class="text-info fw-bold">
                                    <i class="fas fa-money-bill-wave me-2"></i> Politique de Paiement
                                </h4>
                                <p>Le paiement s'effectue à la livraison, le client doit vérifier les détails de sa commande avant soumission.</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Styles de base */
    .terms-conditions-container {
        padding: 5rem 0 3rem 0;
        background-color: #f8f9fa;
        min-height: calc(100vh - 120px);
        margin-top: 70px;
    }

    /* Carte principale */
    .terms-card {
        border-radius: 20px;
        border: none;
        transition: all 0.3s ease;
        background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
    }

    .terms-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    /* En-tête */
    .terms-header h1 {
        font-size: 2.5rem;
        background: linear-gradient(to right, #0d6efd, #0dcaf0);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin-bottom: 0.5rem;
    }

    /* Éléments de liste */
    .terms-item {
        padding: 1.5rem;
        border-radius: 12px;
        background-color: rgba(255, 255, 255, 0.7);
        margin-bottom: 1.5rem;
        transition: all 0.3s ease;
        border-left: 4px solid #0d6efd;
        border: none !important;
    }

    .terms-item:hover {
        background-color: white;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    }

    .terms-item h4 {
        font-size: 1.3rem;
        margin-bottom: 0.8rem;
    }

    /* Masquer la sidebar */
    #sidebar {
        display: none !important;
    }

    /* Ajustement du contenu principal */
    #main-content {
        margin-left: 0 !important;
        width: 100% !important;
        padding: 0 !important;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .terms-conditions-container {
            margin-top: 60px;
            padding: 4rem 0 2rem 0;
        }
        
        .terms-header h1 {
            font-size: 2rem;
        }
        
        .terms-item {
            padding: 1rem;
        }
        
        .terms-item h4 {
            font-size: 1.1rem;
        }
    }
</style>
@endsection