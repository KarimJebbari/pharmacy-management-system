@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="card shadow-lg p-4 border-0 rounded-4">
            <h1 class="text-center text-success mb-4">
                <i class="fas fa-pills"></i>  Modifier le médicament
            </h1>

            <form action="{{ route('medications.update', $medication->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <div class="col-12">
                        <label for="image" class="form-label fw-bold text-primary">Image du médicament</label>
                        <div class="input-group shadow-sm">
                            <span class="input-group-text bg-success text-white"><i class="fas fa-image"></i></span>
                            <input type="file" class="form-control custom-input" name="image" id="image" accept="image/*">
                        </div>
                        
                        @if($medication->image)
                            <div class="mt-3 text-center">
                                <img src="{{ asset('storage/' . $medication->image) }}" alt="Image actuelle du médicament" class="img-thumbnail" style="max-height: 150px;">
                                <p class="text-muted mt-2"> Image actuelle</p>
                            </div>
                            <div class="mt-2 text-center">
                                <!-- <button type="button" class="btn btn-sm btn-outline-danger" onclick="document.getElementById('delete-image').value = '1'">
                                    <i class="fas fa-trash-alt"></i> Supprimer l'image
                                </button> -->
                                <input type="hidden" name="delete_image" id="delete-image" value="0">
                            </div>
                        @endif
                    </div>

                    <div class="col-md-6">
                        <label for="name" class="form-label fw-bold text-primary">Nom du médicament</label>
                        <div class="input-group shadow-sm">
                            <span class="input-group-text bg-success text-white"><i class="fas fa-capsules"></i></span>
                            <input type="text" class="form-control custom-input" name="name" id="name" value="{{ $medication->name }}" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="expiry_date" class="form-label fw-bold text-primary"> Date d'expiration</label>
                        <div class="input-group shadow-sm">
                            <span class="input-group-text bg-success text-white"><i class="fas fa-calendar-alt"></i></span>
                            <input type="date" class="form-control custom-input" name="expiry_date" id="expiry_date" value="{{ $medication->expiry_date }}" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="supplier" class="form-label fw-bold text-primary">Fournisseur</label>
                        <div class="input-group shadow-sm">

                            <span class="input-group-text bg-success text-white"><i class="fas fa-truck"></i></span>
                            <input type="text" class="form-control custom-input" name="supplier" id="supplier" value="{{ $medication->supplier }}" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="quantity" class="form-label fw-bold text-primary">Quantité</label>
                        <div class="input-group shadow-sm">
                            <span class="input-group-text bg-success text-white"><i class="fas fa-box"></i></span>
                            <input type="number" class="form-control custom-input" name="quantity" id="quantity" value="{{ $medication->quantity }}" min="0" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="price" class="form-label fw-bold text-primary">prix (Dirham)</label>
                        <div class="input-group shadow-sm">
                            <span class="input-group-text bg-success text-white"><i class="fas fa-dollar-sign"></i></span>
                            <input type="number" class="form-control custom-input" name="price" id="price" value="{{ $medication->price }}" step="0.01" min="0" required>
                        </div>
                    </div>

                    <div class="col-12">
                        <label for="description" class="form-label fw-bold text-primary">Description</label>
                        <textarea class="form-control custom-input" name="description" id="description" rows="3" required>{{ $medication->description }}</textarea>
                    </div>
                </div>

                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-success w-100 py-2 shadow-sm custom-btn">
                        <i class="fas fa-check-circle"></i> Mettre à jour
                    </button>
                                        <a href="{{ route('medications.index') }}" class="btn btn-outline-success w-100 mt-2 py-2 shadow-sm custom-btn">
                        <i class="fas fa-arrow-left"></i>  Retour à la liste des médicaments
                    </a>
                </div>
            </form>
        </div>
    </div>

    <style>
        .container {
            padding-right: 15px;
            padding-left: 15px;
        }
        
        .custom-input {
            transition: all 0.3s ease-in-out;
            border: 2px solid #dee2e6;
            background-color: #f8f9fa;
            border-radius: 8px;
            width: 100%;
        }
        
        .custom-input:focus {
            border-color: #198754 !important;
            box-shadow: 0 0 10px rgba(25, 135, 84, 0.5);
            background-color: #ffffff;
        }

        .custom-btn {
            transition: all 0.3s ease-in-out;
            border-radius: 8px;
            width: 100%;
        }

        .custom-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 15px rgba(25, 135, 84, 0.3);
        }

        .card {
            border-radius: 15px;
            background-color: #ffffff;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            margin: 0 auto;
            width: 100%;
        }

        .img-thumbnail {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            max-width: 100%;
        }

        @media (max-width: 768px) {
            .container {
                padding-left: 10px;
                padding-right: 10px;
            }
            
            .col-md-6, .col-12 {
                padding-left: 8px;
                padding-right: 8px;
            }
        }
    </style>
@endsection