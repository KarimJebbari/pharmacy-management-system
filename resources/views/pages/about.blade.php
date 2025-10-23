@extends('layouts.app')

@section('content')
<div class="about-container">
    <div class="container my-5">
        <!-- Hero Section -->
        <div class="about-hero text-center mb-5">
            <h1 class="display-4 fw-bold text-primary mb-3">
                <i class="fas fa-hospital me-2"></i>Qui sommes-nous ?
            </h1>
            <div class="hero-divider">
                <div class="divider-line"></div>
                <i class="fas fa-heartbeat divider-icon"></i>
                <div class="divider-line"></div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="about-card card shadow-lg p-4 p-md-5">
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="about-mission p-4 h-100">
                        <div class="icon-container mb-4">
                            <i class="fas fa-bullseye fa-3x text-primary"></i>
                        </div>
                        <h3 class="fw-bold mb-3">Notre Mission</h3>
                        <p class="lead">Fournir des solutions pharmaceutiques fiables avec simplicité et rapidité.</p>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="about-vision p-4 h-100">
                        <div class="icon-container mb-4">
                            <i class="fas fa-eye fa-3x text-info"></i>
                        </div>
                        <h3 class="fw-bold mb-3">Notre Vision</h3>
                        <p class="lead">Devenir la première pharmacie en ligne de confiance pour tous.</p>
                    </div>
                </div>
            </div>

            <div class="values-section mt-5">
                <h3 class="text-center fw-bold mb-4">
                    <i class="fas fa-star me-2 text-warning"></i>Nos Valeurs
                </h3>
                <div class="row g-4">
                    <div class="col-md-3 col-6">
                        <div class="value-card p-3 text-center">
                            <i class="fas fa-award fa-2x text-success mb-3"></i>
                            <h5>Qualité</h5>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="value-card p-3 text-center">
                            <i class="fas fa-handshake fa-2x text-primary mb-3"></i>
                            <h5>Confiance</h5>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="value-card p-3 text-center">
                            <i class="fas fa-couch fa-2x text-info mb-3"></i>
                            <h5>Confort</h5>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="value-card p-3 text-center">
                            <i class="fas fa-glasses fa-2x text-danger mb-3"></i>
                            <h5>Transparence</h5>
                        </div>
                    </div>
                </div>
            </div>

            <div class="contact-section mt-5 text-center">
                <h3 class="fw-bold mb-4">
                    <i class="fas fa-phone-alt me-2 text-secondary"></i>Contactez-nous
                </h3>
                <div class="d-flex justify-content-center gap-4">
                    <a href="mailto:contact@pharmacielavie.com" class="btn btn-outline-primary btn-lg rounded-pill">
                        <i class="fas fa-envelope me-2"></i>Email
                    </a>
                    <a href="tel:+212600000000" class="btn btn-outline-success btn-lg rounded-pill">
                        <i class="fas fa-phone me-2"></i>Appel
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Base Styles */
    .about-container {
        padding-bottom: 5rem;
    }
    
    /* Hero Section */
    .about-hero {
        position: relative;
        padding-top: 2rem;
    }
    
    .hero-divider {
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 1.5rem auto;
        max-width: 500px;
    }
    
    .divider-line {
        height: 2px;
        background: linear-gradient(90deg, transparent, #0d6efd, transparent);
        flex: 1;
    }
    
    .divider-icon {
        margin: 0 1.5rem;
        color: #0d6efd;
        font-size: 1.5rem;
    }
    
    /* Main Card */
    .about-card {
        border-radius: 20px;
        border: none;
        overflow: hidden;
        transition: all 0.3s ease;
    }
    
    .about-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
    }
    
    /* Sections */
    .about-mission, .about-vision {
        background-color: rgba(13, 110, 253, 0.05);
        border-radius: 15px;
        transition: all 0.3s ease;
    }
    
    .about-mission:hover, .about-vision:hover {
        background-color: rgba(13, 110, 253, 0.1);
        transform: translateY(-3px);
    }
    
    .icon-container {
        width: 80px;
        height: 80px;
        margin: 0 auto;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: white;
        border-radius: 50%;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }
    
    /* Values Section */
    .value-card {
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
    }
    
    .value-card:hover {
        transform: scale(1.05);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    }
    
    /* Contact Section */
    .contact-section .btn {
        transition: all 0.3s ease;
        min-width: 150px;
    }
    
    .contact-section .btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }
    
    /* Hide Sidebar */
    #sidebar {
        display: none;
    }
    
    #main-content {
        margin-left: 0;
        width: 100%;
        min-height: 80vh;
    }
    
    /* Responsive Design */
    @media (max-width: 768px) {
        .hero-divider {
            margin: 1rem auto;
        }
        
        .divider-icon {
            margin: 0 1rem;
        }
        
        .about-mission, .about-vision {
            margin-bottom: 1.5rem;
        }
        
        .contact-section .d-flex {
            flex-direction: column;
            gap: 1rem;
        }
        
        .contact-section .btn {
            width: 100%;
        }
    }
</style>
@endsection