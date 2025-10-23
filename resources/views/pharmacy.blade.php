@extends('layouts.app')

@section('content')
<!-- Menu de Navigation Moderne -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="{{ url('/pharmacy') }}">
            <i class="fas fa-mortar-pestle text-primary me-2"></i>
            <span class="fw-bold">Pharmacie Aya sofia</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" href="{{ url('/pharmacy') }}">
                        <i class="fas fa-home"></i> Accueil
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#articles-section">
                        <i class="fas fa-newspaper"></i> Articles
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#contact-section">
                        <i class="fas fa-phone-alt"></i> Contactez-nous
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-primary text-white px-3 ms-2" href="{{ url('/purchase') }}">
                        <i class="fas fa-shopping-cart"></i> Achetez maintenant
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Section Hero avec Image de Fond -->
<div class="hero-section position-relative">
    <div class="hero-overlay"></div>
    <div class="container py-5">
        <div class="row align-items-center py-5">
            <div class="col-lg-6 text-white">
                <h1 class="display-4 fw-bold mb-3">Bienvenue à la Pharmacie Aya sofia</h1>
                <p class="fs-5 mb-4">Nous sommes là pour vous servir avec les meilleurs conseils médicaux et médicaments de haute qualité</p>
                <div class="d-flex gap-2">
                    <a href="{{ url('/purchase') }}" class="btn btn-primary btn-lg">
                        <i class="fas fa-shopping-cart me-2"></i> Achetez maintenant
                    </a>
                    <a href="#contact-section" class="btn btn-outline-light btn-lg">
                        <i class="fas fa-headset me-2"></i> Contactez-nous
                    </a>
                </div>
            </div>
            <div class="col-lg-6 d-none d-lg-block">
                <!-- Espace réservé pour une image de pharmacie -->
            </div>
        </div>
    </div>
</div>

<!-- Icônes de Services Rapides -->
<div class="container my-5">
    <div class="row g-4 text-center">
        <div class="col-md-3">
            <div class="service-card p-4 h-100 rounded shadow-sm">
                <i class="fas fa-pills fa-3x text-primary mb-3"></i>
                <h5>Médicaments de qualité</h5>
                <p class="mb-0">Nous fournissons les meilleurs médicaments de sources fiables</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="service-card p-4 h-100 rounded shadow-sm">
                <i class="fas fa-truck fa-3x text-primary mb-3"></i>
                <h5>Livraison rapide</h5>
                <p class="mb-0">Nous livrons les médicaments à votre porte rapidement</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="service-card p-4 h-100 rounded shadow-sm">
                <i class="fas fa-user-md fa-3x text-primary mb-3"></i>
                <h5>Conseils pharmaceutiques</h5>
                <p class="mb-0">Une équipe de pharmaciens professionnels pour vous aider</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="service-card p-4 h-100 rounded shadow-sm">
                <i class="fas fa-headset fa-3x text-primary mb-3"></i>
                <h5>Support 24/7</h5>
                <p class="mb-0">Disponible pour répondre à vos questions à tout moment</p>
            </div>
        </div>
    </div>
</div>

<!-- Barre de Recherche -->
<div class="container my-5">
    <div class="search-container bg-light p-4 rounded shadow-sm">
        <h4 class="text-center mb-3"><i class="fas fa-search"></i> Recherchez dans les articles et médicaments</h4>
        <div class="input-group">
            <input type="text" id="searchInput" class="form-control" placeholder="🔍 Rechercher un article ou un médicament...">
            <button class="btn btn-primary" id="searchBtn"><i class="fas fa-search"></i> Rechercher</button>
        </div>
    </div>
</div>

<!-- Section Articles -->
<div class="container my-5" id="articles-section">
    <div class="section-heading d-flex align-items-center mb-4">
        <div class="section-line me-3"></div>
        <h2 class="mb-0">📝 Derniers articles de santé</h2>
    </div>
    <p class="text-muted mb-4">Nous vous proposons des articles contenant les meilleures méthodes de prévention contre certaines maladies ainsi que les médicaments appropriés</p>
    
    <div class="row row-cols-1 row-cols-md-3 g-4" id="articlesContainer">
        @foreach($articles as $article)
        <div class="col article-card">
            <div class="card h-100 border-0 shadow-sm">
                @if($article->image)
                    <img src="{{ asset('storage/' . $article->image) }}" class="card-img-top" alt="Image de l'article">
                @endif
                <div class="card-body">
                    <span class="badge bg-primary mb-2">Article santé</span>
                    <h5 class="card-title">{{ $article->title }}</h5>
                    <p class="card-text text-muted">{{ Str::limit($article->content, 100) }}</p>
                </div>
                <div class="card-footer bg-white border-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <small class="text-muted"><i class="far fa-calendar-alt"></i> {{ $article->created_at->format('Y-m-d') }}</small>
                        <a href="{{ route('articles.show', $article->id) }}" class="btn btn-sm btn-outline-primary">Lire plus <i class="fas fa-arrow-right ms-1"></i></a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<!-- Section Achat de Médicaments -->
<div class="bg-light py-5 my-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <h2 class="mb-3">💊 Achetez des médicaments en toute simplicité</h2>
                <p class="mb-4">Vous pouvez consulter les médicaments disponibles et les commander facilement via notre site. Nous proposons une large gamme de médicaments à des prix compétitifs et de haute qualité.</p>
                <a href="{{ url('/purchase') }}" class="btn btn-primary">
                    <i class="fas fa-shopping-cart me-2"></i> Parcourir les médicaments
                </a>
            </div>
            <div class="col-lg-6">
                <div class="card-group">
                    <div class="card m-2 border-0 shadow-sm">
                        <div class="card-body text-center">
                            <i class="fas fa-capsules fa-3x text-primary mb-3"></i>
                            <h5>Médicaments généraux</h5>
                        </div>
                    </div>
                    <div class="card m-2 border-0 shadow-sm">
                        <div class="card-body text-center">
                            <i class="fas fa-prescription-bottle-alt fa-3x text-primary mb-3"></i>
                            <h5>Médicaments sur ordonnance</h5>
                        </div>
                    </div>
                </div>
                <div class="card-group mt-3">
                    <div class="card m-2 border-0 shadow-sm">
                        <div class="card-body text-center">
                            <i class="fas fa-heartbeat fa-3x text-primary mb-3"></i>
                            <h5>Fournitures médicales</h5>
                        </div>
                    </div>
                    <div class="card m-2 border-0 shadow-sm">
                        <div class="card-body text-center">
                            <i class="fas fa-baby fa-3x text-primary mb-3"></i>
                            <h5>Produits pour bébés</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Section Contact -->
<div class="container my-5" id="contact-section">
    <div class="row">
        <div class="col-lg-5 mb-4 mb-lg-0">
            <div class="contact-info p-4 bg-white shadow-sm rounded h-100">
                <h2 class="mb-4">📞 Contactez-nous</h2>
                <p>Vous avez des questions ? N'hésitez pas à nous contacter. Notre équipe est prête à répondre à toutes vos questions.</p>
                
                <div class="d-flex mb-3">
                    <div class="contact-icon me-3">
                        <i class="fas fa-map-marker-alt fa-fw text-primary"></i>
                    </div>
                    <div>
                        <h6 class="mb-1">Adresse</h6>
                        <p class="mb-0 text-muted">242 Repeat, 17ème allée, quartier Sidi Al-Hadi - Zouagha Al-Ulya, près de l'école Imam Ali bin Abi Talib, Fès.</p>
                    </div>
                </div>
                
                <div class="d-flex mb-3">
                    <div class="contact-icon me-3">
                        <i class="fas fa-phone-alt fa-fw text-primary"></i>
                    </div>
                    <div>
                        <h6 class="mb-1">Téléphone</h6>
                        <p class="mb-0 text-muted">05 3560 3314</p>
                    </div>
                </div>
                
                <div class="d-flex mb-3">
                    <div class="contact-icon me-3">
                        <i class="fas fa-envelope fa-fw text-primary"></i>
                    </div>
                    <div>
                        <h6 class="mb-1">Email</h6>
                        <p class="mb-0 text-muted">pharmacie@example.com</p>
                    </div>
                </div>
                
                <div class="d-flex mb-3">
                    <div class="contact-icon me-3">
                        <i class="fas fa-clock fa-fw text-primary"></i>
                    </div>
                    <div>
                        <h6 class="mb-1">Heures d'ouverture</h6>
                        <p class="mb-0 text-muted">Tous les jours - 24 heures</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-7">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="fas fa-paper-plane me-2"></i> Envoyez votre demande</h4>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('inquiries.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label"><i class="fas fa-user text-primary me-1"></i> Nom complet</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="phone" class="form-label"><i class="fas fa-phone text-primary me-1"></i> Numéro de téléphone</label>
                                <input type="text" class="form-control" id="phone" name="phone" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label"><i class="fas fa-envelope text-primary me-1"></i> Email (optionnel)</label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label"><i class="fas fa-comment text-primary me-1"></i> Demande</label>
                            <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-paper-plane me-2"></i> Envoyer la demande
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center mt-5">
        {{ $articles->links() }}
    </div>
</div>

<style>
    /* Support RTL pour l'arabe */
    body {
        direction: ltr;
        text-align: left;
        margin-top: 45px;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        scroll-behavior: smooth; /* Ajout pour le défilement doux */
    }
    
    /* Couleurs personnalisées */
    :root {
        --primary-color: #0d6efd;
        --secondary-color: #6c757d;
        --light-color: #f8f9fa;
        --dark-color: #212529;
    }
    
    /* Section Hero */
    .hero-section {
        background: url('{{ asset('storage/images/pexels-hoinommm-16453354.jpg') }}') center/cover no-repeat;
        padding: 100px 0;
        position: relative;
        animation: fadeIn 1s ease-in-out;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    
    .hero-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(218, 221, 226, 0.8) 0%, rgba(0, 0, 0, 0.6) 100%);
    }
    
    /* En-têtes de section */
    .section-heading {
        position: relative;
    }
    
    .section-line {
        height: 30px;
        width: 6px;
        background-color: var(--primary-color);
        border-radius: 3px;
    }
    
    /* Style des cartes */
    .card {
        border-radius: 12px;
        overflow: hidden;
        transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        border: none;
    }
    
    .card:hover {
        transform: translateY(-8px);
        box-shadow: 0 14px 28px rgba(0, 0, 0, 0.1), 0 10px 10px rgba(0, 0, 0, 0.08);
    }
    
    .card-img-top {
        height: 200px;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    
    .card:hover .card-img-top {
        transform: scale(1.05);
    }
    
    /* Cartes de service */
    .service-card {
        background-color: white;
        transition: all 0.3s ease;
        border: 1px solid rgba(0, 0, 0, 0.05);
    }
    
    .service-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        border-color: var(--primary-color);
    }
    
    /* Icônes de contact */
    .contact-icon {
        width: 36px;
        height: 36px;
        background-color: rgba(13, 110, 253, 0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    /* Navigation */
    .navbar {
        padding: 15px 0;
        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.05);
    }
    
    .nav-link {
        padding: 10px 18px;
        margin: 0 4px;
        border-radius: 6px;
        transition: all 0.3s;
        font-weight: 500;
    }
    
    .nav-link:hover {
        background-color: rgba(13, 110, 253, 0.15);
        transform: translateY(-2px);
    }
    
    .nav-link.active {
        color: var(--primary-color);
        font-weight: 600;
        background-color: rgba(13, 110, 253, 0.1);
    }
    
    /* Éléments de recherche */
    #searchInput {
        border-radius: 5px 0 0 5px;
        border: 1px solid #ced4da;
        padding: 12px 18px;
        transition: all 0.3s;
    }
    
    #searchInput:focus {
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.15);
    }
    
    #searchBtn {
        border-radius: 0 5px 5px 0;
        padding: 12px 24px;
    }
    
    /* Formulaires */
    .form-control {
        padding: 12px 16px;
        border-radius: 8px;
        border: 1px solid #e0e0e0;
    }
    
    .form-control:focus {
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.15);
        border-color: var(--primary-color);
    }
    
    .btn {
        padding: 10px 20px;
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.3s;
    }
    
    .btn-lg {
        padding: 14px 28px;
    }
    
    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }
    
    /* Pagination */
    .pagination {
        justify-content: center;
        margin-top: 40px;
    }
    
    .page-item.active .page-link {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
    }
    
    .page-link {
        color: var(--primary-color);
        padding: 8px 16px;
        margin: 0 4px;
        border-radius: 6px;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .hero-section {
            padding: 60px 0;
        }
        
        .display-4 {
            font-size: 2.5rem;
        }
    }
    
    /* Animation des icônes */
    .service-card i {
        transition: transform 0.3s;
    }
    
    .service-card:hover i {
        transform: scale(1.1);
    }
    
    /* Sidebar cachée */
    #sidebar {
        display: none;
    }
    
    #main-content {
        margin-left: 0;
        width: 100%;
    }
</style>

<script>
    // Recherche en direct pour les articles
    document.getElementById('searchInput').addEventListener('input', function () {
        let query = this.value.toLowerCase();
        let articles = document.querySelectorAll('.article-card');
        
        articles.forEach(article => {
            let title = article.querySelector('.card-title').textContent.toLowerCase();
            let content = article.querySelector('.card-text').textContent.toLowerCase();
            
            if (title.includes(query) || content.includes(query)) {
                article.style.display = "block";
            } else {
                article.style.display = "none";
            }
        });
    });
    
    // Ajout de la classe active à l'élément de navigation actuel
    document.addEventListener('DOMContentLoaded', function() {
        const currentLocation = window.location.pathname;
        const navLinks = document.querySelectorAll('.nav-link');
        
        navLinks.forEach(link => {
            if (link.getAttribute('href') === currentLocation || 
                (link.getAttribute('href').startsWith('#') && 
                 window.location.hash === link.getAttribute('href'))) {
                link.classList.add('active');
            }
        });
        
        // Animation au défilement
        const animateOnScroll = function() {
            const elements = document.querySelectorAll('.service-card, .card');
            
            elements.forEach(element => {
                const elementPosition = element.getBoundingClientRect().top;
                const screenPosition = window.innerHeight / 1.2;
                
                if (elementPosition < screenPosition) {
                    element.style.opacity = '1';
                    element.style.transform = 'translateY(0)';
                }
            });
        };
        
        // Initialiser les éléments comme invisibles
        document.querySelectorAll('.service-card, .card').forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(20px)';
            el.style.transition = 'all 0.6s ease';
        });
        
        window.addEventListener('scroll', animateOnScroll);
        animateOnScroll(); // Exécuter une fois au chargement
        
        // Gestion du défilement doux pour les ancres
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                
                const targetId = this.getAttribute('href');
                if (targetId === '#') return;
                
                const targetElement = document.querySelector(targetId);
                if (targetElement) {
                    window.scrollTo({
                        top: targetElement.offsetTop - 80,
                        behavior: 'smooth'
                    });
                    
                    // Mettre à jour l'URL sans recharger la page
                    history.pushState(null, null, targetId);
                }
            });
        });
    });
</script>
@endsection