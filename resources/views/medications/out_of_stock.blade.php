@extends('layouts.app')  

@section('content')
<div class="out-of-stock-container">
    <div class="container py-5">
        <!-- En-tête de la page -->
        <div class="page-header text-center mb-5 animated-header">
            <div class="icon-wrapper mb-3">
                <i class="fas fa-box-open pulse-icon"></i>
            </div>
            <h2 class="fw-bold">Médicaments en rupture de stock</h2>
            <div class="header-underline"></div>
        </div>
        
        <!-- Carte principale -->
        <div class="card main-card border-0 shadow-lg animated-card">
            <div class="card-body p-0">
                <!-- Tableau des médicaments -->
                <div class="table-responsive">
                    <table class="table custom-table mb-0">
                        <thead>
                            <tr>
                                <th class="text-center" width="8%"><i class="fas fa-hashtag me-2"></i>N°</th>
                                <th class="text-start" width="30%"><i class="fas fa-pills me-2"></i>Nom du médicament</th>
                                <th class="text-center" width="20%"><i class="far fa-calendar-alt me-2"></i>Date d'expiration</th>
                                <th class="text-center" width="22%"><i class="fas fa-boxes me-2"></i>Quantité demandée</th>
                                <th class="text-center" width="20%"><i class="fas fa-paper-plane me-2"></i>Demande fournisseur</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($outOfStockMedications as $index => $medication)
                                <tr class="med-row">
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td class="med-name">{{ $medication->name }}</td>
                                    <td class="text-center">{{ $medication->expiry_date }}</td>
                                    <td class="text-center">
                                        <form action="{{ route('medications.notify-supplier', $medication->id) }}" method="POST" class="request-form">
                                            @csrf
                                            <div class="input-group quantity-input-group">
                                                <input type="number" 
                                                       name="quantity" 
                                                       min="1" 
                                                       value="1" 
                                                       class="form-control quantity-input" 
                                                       required>
                                                <span class="input-group-text">unités</span>
                                            </div>
                                    </td>
                                    <td class="text-center">
                                            <button type="submit" class="btn btn-supplier">
                                                <i class="fas fa-paper-plane me-2"></i>Envoyer la demande
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <!-- Message si aucun médicament n'est en rupture -->
        @if(count($outOfStockMedications) == 0)
            <div class="empty-state text-center mt-4">
                <div class="empty-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <h3 class="mt-3 text-muted">Tous les médicaments sont en stock</h3>
                <p class="text-muted">Aucun médicament n'est actuellement en rupture de stock.</p>
            </div>
        @endif
    </div>
</div>

<style>
    /* Configuration globale */
    .quantity-input-group {
        max-width: 150px;
        margin: 0 auto;
    }
    
    .quantity-input {
        text-align: center;
    }
    
    .btn-supplier {
        background-color: #4e73df;
        color: white;
        transition: all 0.3s;
    }
    
    .btn-supplier:hover {
        background-color: #2e59d9;
        transform: translateY(-2px);
    }
    
    .med-row:hover {
        background-color: #f8f9fa;
    }
    
    .pulse-icon {
        animation: pulse 2s infinite;
    }
    
    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.1); }
        100% { transform: scale(1); }
    }
    .out-of-stock-container {
        background: linear-gradient(135deg, rgba(240, 244, 248, 0.95), rgba(255, 255, 255, 0.95)), 
                    url('https://images.unsplash.com/photo-1573883430697-4c3615835b70?ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        min-height: 100vh;
        padding: 20px 0;
        font-family: 'Cairo', sans-serif;
    }
    
    /* Animation d'entrée pour l'en-tête */
    .animated-header {
        animation: fadeInDown 0.8s ease-out forwards;
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
    
    /* En-tête de la page */
    .page-header h2 {
        color: #2c3e50;
        font-size: 2.2rem;
        letter-spacing: 1px;
        text-transform: uppercase;
        position: relative;
    }
    
    .header-underline {
        height: 4px;
        width: 80px;
        background: linear-gradient(90deg, #3498db, #2980b9);
        margin: 15px auto 0;
        border-radius: 2px;
    }
    
    .icon-wrapper {
        height: 80px;
        width: 80px;
        background: linear-gradient(135deg, #3498db, #2980b9);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto;
        box-shadow: 0 10px 20px rgba(41, 128, 185, 0.3);
    }
    
    .icon-wrapper i {
        font-size: 2.5rem;
        color: white;
    }
    
    .pulse-icon {
        animation: pulse 2s infinite;
    }
    
    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.15); }
        100% { transform: scale(1); }
    }
    
    /* Carte principale avec animation */
    .main-card {
        border-radius: 16px;
        overflow: hidden;
        animation: fadeInUp 0.8s ease-out forwards;
        background-color: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        box-shadow: 0 15px 35px rgba(50, 50, 93, 0.1), 0 5px 15px rgba(0, 0, 0, 0.07) !important;
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
    
    /* Tableau custom */
    .custom-table {
        margin-bottom: 0;
        border-collapse: separate;
        border-spacing: 0;
    }
    
    .custom-table thead tr {
        background: linear-gradient(135deg, #3498db, #2980b9);
        color: white;
        border: none;
    }
    
    .custom-table thead th {
        border: none;
        padding: 16px 20px;
        font-weight: 600;
        font-size: 1rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .custom-table tbody tr {
        transition: all 0.3s ease;
        border-bottom: 1px solid #e9ecef;
    }
    
    .custom-table tbody tr:last-child {
        border-bottom: none;
    }
    
    .custom-table td {
        padding: 18px 20px;
        vertical-align: middle;
        border: none;
    }
    
    /* Ligne de médicament avec hover effect */
    .med-row {
        transition: all 0.3s ease;
    }
    
    .med-row:hover {
        background-color: #f8fafc;
        transform: translateY(-2px) scale(1.005);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        z-index: 10;
    }
    
    .med-name {
        font-weight: 600;
        color: #3498db;
    }
    
    /* Bouton de demande fournisseur */
    .btn-supplier {
        background: linear-gradient(45deg, #f39c12, #f1c40f);
        border: none;
        color: white;
        padding: 10px 20px;
        border-radius: 30px;
        font-weight: 600;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 10px rgba(243, 156, 18, 0.3);
    }
    
    .btn-supplier:hover, .btn-supplier:focus {
        background: linear-gradient(45deg, #e67e22, #f39c12);
        transform: translateY(-3px);
        box-shadow: 0 6px 15px rgba(243, 156, 18, 0.4);
        color: white;
    }
    
    .btn-supplier:active {
        transform: translateY(1px);
    }
    
    /* État vide - pas de médicaments en rupture */
    .empty-state {
        padding: 40px 0;
    }
    
    .empty-icon {
        height: 100px;
        width: 100px;
        background: linear-gradient(135deg, #2ecc71, #27ae60);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto;
        box-shadow: 0 10px 20px rgba(46, 204, 113, 0.3);
    }
    
    .empty-icon i {
        font-size: 3rem;
        color: white;
    }
    
    /* Responsive */
    @media (max-width: 992px) {
        .page-header h2 {
            font-size: 1.8rem;
        }
        
        .icon-wrapper {
            height: 70px;
            width: 70px;
        }
        
        .custom-table thead th {
            padding: 12px 15px;
            font-size: 0.9rem;
        }
        
        .custom-table td {
            padding: 15px;
        }
        
        .btn-supplier {
            padding: 8px 15px;
            font-size: 0.9rem;
        }
    }
    
    @media (max-width: 767.98px) {
        .page-header h2 {
            font-size: 1.5rem;
        }
        
        .custom-table {
            min-width: 650px;
        }
        
        .out-of-stock-container {
            padding: 10px;
        }
    }
</style>
@endsection