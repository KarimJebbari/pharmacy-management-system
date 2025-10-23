@extends('layouts.app')

@section('content')
<div class="privacy-policy-container">
    <div class="policy-header text-center mb-5">
        <h1 class="display-4 text-success fw-bold">
            <i class="fas fa-lock me-2"></i> Politique de Confidentialité
        </h1>
        <p class="lead text-muted">La protection de vos données est notre priorité absolue</p>
    </div>

    <div class="policy-content">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card policy-card shadow-lg">
                    <div class="card-body p-4 p-md-5">
                        <div class="policy-item mb-4">
                            <h3 class="text-primary fw-bold">
                                <i class="fas fa-info-circle me-2"></i> Collecte d'Informations
                            </h3>
                            <p class="fs-5">Nous collectons des informations telles que le nom, le numéro de téléphone et l'adresse de livraison pour fournir le service.</p>
                        </div>

                        <div class="policy-item mb-4">
                            <h3 class="text-primary fw-bold">
                                <i class="fas fa-shield-alt me-2"></i> Protection des Données
                            </h3>
                            <p class="fs-5">Nous ne partageons pas vos données avec des tiers sauf en cas de nécessité (comme pour la livraison).</p>
                        </div>

                        <div class="policy-item mb-4">
                            <h3 class="text-primary fw-bold">
                                <i class="fas fa-cookie-bite me-2"></i> Cookies
                            </h3>
                            <p class="fs-5">Le site utilise des cookies pour améliorer l'expérience utilisateur.</p>
                        </div>

                        <div class="policy-item">
                            <h3 class="text-primary fw-bold">
                                <i class="fas fa-user-shield me-2"></i> Droits de l'Utilisateur
                            </h3>
                            <p class="fs-5">Vous pouvez demander à modifier ou supprimer vos données personnelles à tout moment en nous contactant.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .privacy-policy-container {
        padding: 5rem 0 3rem 0;
        background-color: #f8f9fa;
        min-height: calc(100vh - 120px);
        margin-top: 70px; /* يتناسب مع ارتفاع شريط التنقل */
    }

    .policy-card {
        border-radius: 20px;
        border: none;
        transition: all 0.3s ease;
        background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
    }

    .policy-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    .policy-header h1 {
        font-size: 2.5rem;
        background: linear-gradient(to right, #28a745, #20c997);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin-bottom: 0.5rem;
    }

    .policy-item {
        padding: 1.5rem;
        border-radius: 12px;
        background-color: rgba(255, 255, 255, 0.7);
        margin-bottom: 1.5rem;
        transition: all 0.3s ease;
        border-left: 4px solid #28a745;
    }

    .policy-item:hover {
        background-color: white;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    }

    .policy-item h3 {
        font-size: 1.5rem;
        margin-bottom: 1rem;
    }

    /* إخفاء الشريط الجانبي */
    #sidebar {
        display: none !important;
    }

    /* توسيع المحتوى الرئيسي */
    #main-content {
        margin-left: 0 !important;
        width: 100% !important;
        padding: 0 !important;
    }

    @media (max-width: 768px) {
        .privacy-policy-container {
            margin-top: 60px;
            padding: 4rem 0 2rem 0;
        }
        
        .policy-header h1 {
            font-size: 2rem;
        }
        
        .policy-item {
            padding: 1rem;
        }
        
        .policy-item h3 {
            font-size: 1.3rem;
        }
    }

</style>
@endsection