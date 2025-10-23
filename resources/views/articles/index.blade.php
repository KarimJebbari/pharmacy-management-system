@extends('layouts.app')  

@section('content')
<div class="articles-list-container">
    <div class="container py-5">
        <div class="page-header text-center mb-4 animated-header">
            <div class="header-icon mb-3">
                <i class="fas fa-newspaper"></i>
            </div>
            <h2 class="fw-bold">Liste des articles</h2>
            <div class="header-underline"></div>
        </div>
        
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show custom-alert mb-4" role="alert">
                <div class="alert-content">
                    <i class="fas fa-check-circle me-2"></i>
                    <span>{{ session('success') }}</span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
                </div>
            </div>
        @endif
        
        <div class="card main-card border-0 shadow-lg animated-card">
            <div class="card-body p-4">
                <div class="action-bar d-flex flex-column flex-md-row justify-content-between align-items-center mb-4">
                    <a href="{{ route('articles.create') }}" class="btn btn-create mb-3 mb-md-0">
                        <i class="fas fa-plus-circle me-2"></i>Nouvel article
                    </a>
                    
                    <div class="search-container">
                        <div class="input-group">
                            <span class="input-group-text search-icon">
                                <i class="fas fa-search"></i>
                            </span>
                            <input type="text" id="searchInput" class="form-control search-input" placeholder="Rechercher des articles..." aria-label="Rechercher">
                        </div>
                    </div>
                </div>
                
                @if ($articles->count())
                    <div class="table-responsive articles-table">
                        <table class="table table-hover custom-table">
                            <thead>
                                <tr>
                                    <th width="25%">Titre</th>
                                    <th width="35%">Contenu</th>
                                    <th width="15%">Image</th>
                                    <th width="25%">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="articlesTable">
                                @foreach ($articles as $article)
                                    <tr class="article-row">
                                        <td class="article-title fw-semibold text-primary">{{ $article->title }}</td>
                                        <td class="article-content text-muted">{{ Str::limit($article->content, 50) }}</td>
                                        <td>
                                            @if($article->image)
                                                <div class="article-image">
                                                    <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}" class="img-thumbnail">
                                                </div>
                                            @else
                                                <span class="no-image"><i class="fas fa-image me-2"></i>Aucune image</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column flex-md-row gap-2">
                                                <a href="{{ route('articles.edit', $article->id) }}" class="btn btn-edit">
                                                    <i class="fas fa-edit me-md-2"></i><span class="d-none d-md-inline">Modifier</span>
                                                </a>
                                                <form action="{{ route('articles.destroy', $article->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-delete w-100" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet article ?')">
                                                        <i class="fas fa-trash-alt me-md-2"></i><span class="d-none d-md-inline">Supprimer</span>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="pagination-container mt-4">
                        {{ $articles->links() }}
                    </div>
                @else
                    <div class="empty-state text-center py-5">
                        <div class="empty-icon mb-3">
                            <i class="fas fa-newspaper"></i>
                        </div>
                        <h4 class="text-muted mb-2">Aucun article disponible</h4>
                        <p class="text-muted mb-4">Commencez par créer votre premier article</p>
                        <a href="{{ route('articles.create') }}" class="btn btn-primary px-4 py-2">
                            <i class="fas fa-plus-circle me-2"></i>Créer un article
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchInput');
        if (searchInput) {
            searchInput.addEventListener('keyup', function() {
                let filter = this.value.toLowerCase();
                let rows = document.querySelectorAll('#articlesTable tr');
                
                rows.forEach(row => {
                    let title = row.querySelector('.article-title')?.textContent.toLowerCase() || '';
                    let content = row.querySelector('.article-content')?.textContent.toLowerCase() || '';
                    
                    if (title.includes(filter) || content.includes(filter)) {
                        row.style.display = '';
                        // Animation subtile pour les résultats correspondants
                        row.style.backgroundColor = '#f0f7ff';
                        setTimeout(() => {
                            row.style.backgroundColor = '';
                        }, 300);
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        }
    });
</script>

<style>
    .articles-list-container {
        background: linear-gradient(135deg, rgba(245, 247, 250, 0.95), rgba(255, 255, 255, 0.95)), 
                    url('https://images.unsplash.com/photo-1471107340929-a87cd0f5b5f3?ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        min-height: 100vh;
        padding: 20px 0;
        font-family: 'Poppins', sans-serif;
    }
    
    .animated-header {
        animation: fadeInDown 0.8s ease-out forwards;
    }
    
    .header-icon {
        height: 70px;
        width: 70px;
        background: linear-gradient(135deg, #4e73df, #224abe);
        color: white;
        font-size: 2rem;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        margin: 0 auto;
        box-shadow: 0 10px 25px rgba(78, 115, 223, 0.3);
    }
    
    .page-header h2 {
        color: #2c3e50;
        font-size: 2.2rem;
        letter-spacing: 0.5px;
    }
    
    .header-underline {
        height: 4px;
        width: 60px;
        background: linear-gradient(90deg, #4e73df, #224abe);
        margin: 15px auto 0;
        border-radius: 2px;
    }
    
    @keyframes fadeInDown {
        0% {
            opacity: 0;
            transform: translateY(-30px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .main-card {
        border-radius: 16px;
        overflow: hidden;
        animation: fadeInUp 0.8s ease-out forwards;
        background-color: rgba(255, 255, 255, 0.98);
        backdrop-filter: blur(10px);
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
    
    .custom-alert {
        border: none;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        padding: 15px 20px;
        animation: slideInDown 0.5s ease-out forwards;
    }
    
    .alert-success.custom-alert {
        background-color: #eafaf1;
        border-left: 4px solid #2ecc71;
        color: #27ae60;
    }
    
    .alert-content {
        display: flex;
        align-items: center;
    }
    
    .alert-content i {
        font-size: 1.25rem;
        margin-right: 10px;
    }
    
    @keyframes slideInDown {
        0% {
            opacity: 0;
            transform: translateY(-20px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .action-bar {
        padding-bottom: 15px;
        border-bottom: 1px solid #edf2f7;
    }
    
    .btn-create {
        background: linear-gradient(45deg, #4e73df, #36b9cc);
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 8px;
        font-weight: 500;
        box-shadow: 0 4px 10px rgba(78, 115, 223, 0.2);
        transition: all 0.3s ease;
    }
    
    .btn-create:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(78, 115, 223, 0.3);
        background: linear-gradient(45deg, #4262c5, #2da7b9);
        color: white;
    }
    
    .search-container {
        width: 100%;
        max-width: 400px;
    }
    
    .search-input {
        border-radius: 0 30px 30px 0;
        padding-right: 20px;
        border: 1px solid #e2e8f0;
        border-left: none;
        background-color: #f8fafc;
        transition: all 0.3s ease;
    }
    
    .search-input:focus {
        background-color: #fff;
        box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.15);
        border-color: #cad5f1;
    }
    
    .search-icon {
        background-color: #4e73df;
        color: white;
        border: none;
        border-radius: 30px 0 0 30px;
        padding-left: 15px;
    }
    
    .custom-table {
        border-collapse: separate;
        border-spacing: 0;
    }
    
    .custom-table thead {
        background: linear-gradient(45deg, #f8f9fc, #eaecf4);
    }
    
    .custom-table thead th {
        border: none;
        padding: 15px 20px;
        color:rgb(220, 221, 231);
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 1px;
    }
    
    .custom-table tbody tr {
        transition: all 0.3s ease;
        border-bottom: 1px solid #edf2f7;
    }
    
    .custom-table tbody tr:last-child {
        border-bottom: none;
    }
    
    .custom-table td {
        padding: 15px 20px;
        vertical-align: middle;
        border: none;
    }
    
    .article-row {
        transition: all 0.3s ease;
    }
    
    .article-row:hover {
        background-color: #f8fafc;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.02);
    }
    
    /* Style des images */
    .article-image {
        width: 100px;
        height: 70px;
        overflow: hidden;
        border-radius: 6px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }
    
    .article-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: all 0.3s ease;
    }
    
    .article-image img:hover {
        transform: scale(1.1);
    }
    
    .no-image {
        color: #a0aec0;
        font-size: 0.9rem;
        display: flex;
        align-items: center;
    }
    
    /* Boutons d'action */
    .btn-edit {
        background: linear-gradient(45deg, #ffc107, #ffab00);
        color: #212529;
        border: none;
        border-radius: 6px;
        font-weight: 500;
        padding: 8px 12px;
        transition: all 0.3s ease;
    }
    
    .btn-edit:hover {
        background: linear-gradient(45deg, #ffb100, #ff9800);
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(255, 193, 7, 0.3);
        color: #212529;
    }
    
    .btn-delete {
        background: linear-gradient(45deg, #e74a3b, #c72a1c);
        color: white;
        border: none;
        border-radius: 6px;
        font-weight: 500;
        padding: 8px 12px;
        transition: all 0.3s ease;
    }
    
    .btn-delete:hover {
        background: linear-gradient(45deg, #d52a1a, #b71c1c);
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(231, 74, 59, 0.3);
        color: white;
    }
    
    /* État vide */
    .empty-state {
        padding: 40px 0;
    }
    
    .empty-icon {
        height: 80px;
        width: 80px;
        background: linear-gradient(135deg, #f1f5f9, #e2e8f0);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto;
        color: #94a3b8;
        font-size: 2rem;
    }
    
    /* Personnalisation de la pagination (dépend de votre système de pagination) */
    .pagination-container ul {
        display: flex;
        justify-content: center;
        list-style: none;
        padding: 0;
        margin: 0;
    }
    
    .pagination-container li {
        margin: 0 3px;
    }
    
    .pagination-container .page-link {
        border-radius: 8px;
        padding: 10px 15px;
        color: #4e73df;
        transition: all 0.3s ease;
    }
    
    .pagination-container .page-link:hover {
        background-color: #eaecf4;
        color: #224abe;
    }
    
    .pagination-container .page-item.active .page-link {
        background-color: #4e73df;
        border-color: #4e73df;
    }
    
    /* Responsive design */
    @media (max-width: 768px) {
        .page-header h2 {
            font-size: 1.8rem;
        }
        
        .card-body {
            padding: 1.5rem !important;
        }
        
        .custom-table td, .custom-table th {
            padding: 12px 10px;
        }
        
        .btn-edit, .btn-delete {
            padding: 8px;
            width: 100%;
            margin-bottom: 5px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
    }
    
    @media (max-width: 576px) {
        .header-icon {
            height: 60px;
            width: 60px;
            font-size: 1.5rem;
        }
        
        .action-bar {
            padding-bottom: 10px;
        }
        
        .search-container {
            max-width: 100%;
        }
    }
</style>

<!-- Ajout des scripts FontAwesome -->
<script defer>
    // Ce script sera exécuté après le chargement de la page
    if (typeof window !== 'undefined' && !document.querySelector('[data-fa-i2svg]')) {
        const fontAwesomeScript = document.createElement('script');
        fontAwesomeScript.src = 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js';
        fontAwesomeScript.integrity = 'sha512-Tn2m0TIpgVyTzzvmxLNuqbSJH3JP8jm+Cy3hvHrW7ndTDcJ1w5mBiksqDBb8GpE2ksktFvDB/ykZ0mDpsZj20w==';
        fontAwesomeScript.crossOrigin = 'anonymous';
        document.head.appendChild(fontAwesomeScript);
    }
</script>
@endsection