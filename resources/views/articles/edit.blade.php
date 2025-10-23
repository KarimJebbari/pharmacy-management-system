@extends('layouts.app')

@section('content')
<div class="add-article-container">
    <div class="container py-5">
        <div class="card main-card border-0 shadow-lg animated-card">
            <div class="card-header bg-gradient border-0 text-center py-4">
                <h2 class="mb-0 text-white">
                    <i class="fas fa-edit me-2"></i>Modifier l'article
                </h2>
            </div>
            
            <div class="card-body p-4 p-lg-5">
                <div class="d-flex justify-content-end mb-4">
                    <a href="{{ route('articles.index') }}" class="btn btn-outline-primary btn-articles">
                        <i class="fas fa-list-ul me-2"></i>Voir tous les articles
                    </a>
                </div>
                
                @if ($errors->any())
                    <div class="alert custom-alert-danger mb-4 animated-alert">
                        <div class="alert-icon">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <div class="alert-content">
                            <h6 class="alert-heading mb-1">Veuillez corriger les erreurs suivantes :</h6>
                            <ul class="mb-0 ps-3">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif
                
                <form action="{{ route('articles.update', $article->id) }}" method="POST" enctype="multipart/form-data" class="article-form">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <div class="col-12 mb-4">
                            <div class="form-floating form-group-icon">
                                <input type="text" name="title" class="form-control form-control-lg" id="title" 
                                       placeholder="Titre de l'article" value="{{ old('title', $article->title) }}" required>
                                <label for="title"><i class="fas fa-heading me-2"></i>Titre de l'article</label>
                            </div>
                        </div>
                        
                        <div class="col-12 mb-4">
                            <div class="form-group">
                                <label for="content" class="form-label mb-2">
                                    <i class="fas fa-paragraph me-2"></i>Contenu de l'article
                                </label>
                                <textarea name="content" id="content" class="form-control" rows="8" 
                                          placeholder="Rédigez votre article ici..." required>{{ old('content', $article->content) }}</textarea>
                            </div>
                        </div>
                        
                        <div class="col-12 mb-4">
                            <div class="image-upload-container">
                                <label for="image" class="form-label mb-2">
                                    <i class="fas fa-image me-2"></i>Image de l'article
                                </label>
                                <div class="custom-file-upload">
                                    <div class="file-preview" id="file-preview">
                                        @if($article->image)
                                            <img src="{{ asset('storage/' . $article->image) }}" alt="Image actuelle" style="max-width: 100%; max-height: 200px; border-radius: 8px;">
                                            <p class="mt-2 mb-0">Image actuelle</p>
                                        @else
                                            <i class="fas fa-cloud-upload-alt"></i>
                                            <p>Glissez une image ou cliquez pour sélectionner</p>
                                        @endif
                                    </div>
                                    <input type="file" name="image" id="image" class="form-control" accept="image/*">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-4 pt-2">
                        <button type="submit" class="btn btn-submit w-100 py-3">
                            <i class="fas fa-save me-2"></i>Sauvegarder les modifications
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .add-article-container {
        background: linear-gradient(135deg, rgba(245, 247, 250, 0.92), rgba(255, 255, 255, 0.95)), 
                    url('https://images.unsplash.com/photo-1499750310107-5fef28a66643?ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        min-height: 100vh;
        padding: 20px 0;
        font-family: 'Poppins', sans-serif;
    }
    
    .main-card {
        border-radius: 16px;
        overflow: hidden;
        animation: fadeInUp 0.8s ease-out forwards;
        background-color: #fff;
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
    
    .card-header.bg-gradient {
        background: linear-gradient(135deg, #4c75a3, #5b86e5);
    }
    
    .card-header h2 {
        font-weight: 600;
        letter-spacing: 0.5px;
    }
    
    .custom-alert-danger {
        background-color: rgba(255, 235, 238, 0.9);
        border-left: 5px solid #f44336;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(244, 67, 54, 0.2);
        display: flex;
        padding: 16px;
    }
    
    .alert-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        background-color: #f44336;
        border-radius: 50%;
        margin-right: 16px;
    }
    
    .alert-icon i {
        color: white;
        font-size: 18px;
    }
    
    .alert-content {
        flex: 1;
    }
    
    .animated-alert {
        animation: slideInRight 0.5s ease-out forwards;
    }
    
    @keyframes slideInRight {
        0% {
            opacity: 0;
            transform: translateX(30px);
        }
        100% {
            opacity: 1;
            transform: translateX(0);
        }
    }
    
    .btn-articles {
        border-radius: 30px;
        padding: 8px 20px;
        font-weight: 500;
        transition: all 0.3s ease;
        box-shadow: 0 2px 5px rgba(75, 102, 255, 0.1);
    }
    
    .btn-articles:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(75, 102, 255, 0.2);
    }
    
    .form-floating .form-control {
        border-radius: 10px;
        padding: 1.2rem 1rem;
        border: 1px solid #e0e0e0;
        background-color: #f9fafc;
        transition: all 0.3s ease;
    }
    
    .form-floating .form-control:focus {
        border-color: #5b86e5;
        box-shadow: 0 0 0 0.2rem rgba(91, 134, 229, 0.15);
        background-color: #fff;
    }
    
    .form-floating label {
        color: #6c757d;
        padding-left: 1rem;
    }
    
    textarea.form-control {
        border-radius: 10px;
        border: 1px solid #e0e0e0;
        background-color: #f9fafc;
        padding: 1rem;
        transition: all 0.3s ease;
        resize: vertical;
    }
    
    textarea.form-control:focus {
        border-color: #5b86e5;
        box-shadow: 0 0 0 0.2rem rgba(91, 134, 229, 0.15);
        background-color: #fff;
    }
    
    .custom-file-upload {
        position: relative;
        border-radius: 10px;
        overflow: hidden;
    }
    
    .file-preview {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 40px 20px;
        border: 2px dashed #c2cfe0;
        border-radius: 10px;
        background-color: #f9fafc;
        text-align: center;
        color: #7b8794;
        transition: all 0.3s ease;
        cursor: pointer;
    }
    
    .file-preview:hover {
        border-color: #5b86e5;
        background-color: rgba(91, 134, 229, 0.05);
    }
    
    .file-preview i {
        font-size: 2.5rem;
        margin-bottom: 15px;
        color: #5b86e5;
    }
    
    .file-preview p {
        margin-bottom: 0;
        font-size: 1rem;
    }
    
    .custom-file-upload input[type="file"] {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        cursor: pointer;
    }
    

    .btn-submit {
        background: linear-gradient(135deg, #4c75a3, #5b86e5);
        color: white;
        border: none;
        border-radius: 10px;
        font-weight: 600;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(76, 117, 163, 0.3);
    }
    
    .btn-submit:hover {
        background: linear-gradient(135deg, #3a5a80, #4a6fc6);
        transform: translateY(-2px);
        box-shadow: 0 6px 18px rgba(76, 117, 163, 0.4);
        color: white;
    }
    
    .btn-submit:active {
        transform: translateY(1px);
    }
    
    @media (max-width: 768px) {
        .card-body {
            padding: 2rem !important;
        }
        
        .btn-submit {
            padding: 0.75rem !important;
        }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const fileInput = document.getElementById('image');
    const filePreview = document.getElementById('file-preview');
    
    fileInput.addEventListener('change', function() {
        if (this.files && this.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                filePreview.innerHTML = `
                    <img src="${e.target.result}" alt="Aperçu" style="max-width: 100%; max-height: 200px; border-radius: 8px;">
                    <p class="mt-2 mb-0">${this.files[0].name}</p>
                `;
            }.bind(this);
            
            reader.readAsDataURL(this.files[0]);
        }
    });
});
</script>
@endsection