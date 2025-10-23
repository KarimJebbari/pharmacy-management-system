@extends('layouts.app')

@section('content')
<div class="checkout-container">
    <!-- Hero Section -->
    <div class="checkout-hero bg-primary-gradient text-white text-center py-5 mb-5">
        <div class="container">
            <h1 class="display-4 fw-bold mb-3">
                <i class="fas fa-shopping-bag me-2"></i>Finalisation de Commande
            </h1>
            <p class="lead mb-0">Remplissez vos informations pour compléter votre achat</p>
        </div>
    </div>

    <div class="container">
        <!-- Success Notification -->
        @if(session('success'))
        <div class="checkout-notification alert alert-success shadow-lg fade-in">
            <div class="d-flex align-items-center">
                <i class="fas fa-check-circle me-3 fs-4"></i>
                <div>
                    <h5 class="mb-1">Commande confirmée!</h5>
                    <p class="mb-0">{{ session('message') }}</p>
                </div>
            </div>
        </div>
        @endif

        @if(session('cart') && count(session('cart')) > 0)
        @php
            $total = 0;
            foreach(session('cart') as $item) {
                $total += $item['price'] * $item['quantity'];
            }
        @endphp

        <div class="row g-5">
            <!-- Checkout Form -->
            <div class="col-lg-7">
                <div class="checkout-card card border-0 shadow-lg rounded-4 overflow-hidden">
                    <div class="card-header bg-primary text-white py-3">
                        <h3 class="mb-0">
                            <i class="fas fa-user-circle me-2"></i>Informations personnelles
                        </h3>
                    </div>
                    <div class="card-body p-4">
                        <form id="checkout-form" action="{{ url('/checkout') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-4">
                                <label for="name" class="form-label fw-bold">
                                    <i class="fas fa-user me-2 text-primary"></i>Nom complet
                                </label>
                                <input type="text" name="name" class="form-control form-control-lg" required>
                            </div>

                            <div class="mb-4">
                                <label for="phone" class="form-label fw-bold">
                                    <i class="fas fa-phone me-2 text-primary"></i>Téléphone
                                </label>
                                <input type="text" name="phone" class="form-control form-control-lg" required>
                            </div>

                            <div class="mb-4">
                                <label for="address" class="form-label fw-bold">
                                    <i class="fas fa-map-marker-alt me-2 text-primary"></i>Adresse
                                </label>
                                <input type="text" name="address" class="form-control form-control-lg" required>
                            </div>

                            <div class="mb-4">
                                <label for="prescription" class="form-label fw-bold">
                                    <i class="fas fa-file-prescription me-2 text-primary"></i>Ordonnance médicale
                                </label>
                                <div class="file-upload-container">
                                    <input type="file" name="prescription" id="prescription" class="form-control form-control-lg d-none" accept="image/*" required>
                                    <label for="prescription" class="file-upload-label">
                                        <div class="file-upload-content">
                                            <i class="fas fa-cloud-upload-alt fs-1 text-primary mb-2"></i>
                                            <p class="mb-1">Cliquez pour télécharger</p>
                                            <small class="text-muted">Formats acceptés: JPG, PNG</small>
                                        </div>
                                    </label>
                                </div>
                            </div>

                            <input type="hidden" name="cart_data" id="cart_data" value="{{ json_encode(session('cart', [])) }}">

                            <button type="submit" class="btn btn-success btn-lg w-100 py-3 checkout-btn">
                                <i class="fas fa-lock me-2"></i>Confirmer la commande
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="col-lg-5">
                <div class="order-summary-card card border-0 shadow-lg rounded-4 overflow-hidden">
                    <div class="card-header bg-primary text-white py-3">
                        <h3 class="mb-0">
                            <i class="fas fa-receipt me-2"></i>Récapitulatif
                        </h3>
                    </div>
                    <div class="card-body p-0">
                        <div class="order-items">
                            @foreach (session('cart') as $item)
                            <div class="order-item d-flex justify-content-between align-items-center p-4 border-bottom">
                                <div class="d-flex align-items-center">
                                    <div class="me-3">
                                        <i class="fas fa-pills fs-4 text-primary"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-1">{{ $item['name'] }}</h6>
                                        <small class="text-muted">{{ $item['quantity'] }} × {{ $item['price'] }} DH</small>
                                    </div>
                                </div>
                                <div class="fw-bold">{{ $item['price'] * $item['quantity'] }} DH</div>
                            </div>
                            @endforeach
                        </div>

                        <div class="order-total p-4">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span>Sous-total:</span>
                                <span>{{ $total }} DH</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span>Livraison:</span>
                                <span>Gratuite</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center total-price">
                                <span class="fw-bold">Total:</span>
                                <span class="fw-bold fs-5">{{ $total }} DH</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Back Button -->
                <div class="text-center mt-4">
                    <a href="{{ url('/purchase') }}" class="btn btn-outline-primary btn-lg rounded-pill back-btn">
                        <i class="fas fa-arrow-left me-2"></i>Retour à la pharmacie
                    </a>
                </div>
            </div>
        </div>

        @else
        <!-- Empty Cart -->
        <div class="empty-cart text-center py-5">
            <div class="empty-cart-icon mb-4">
                <i class="fas fa-shopping-cart fs-1 text-muted"></i>
            </div>
            <h3 class="mb-3">Votre panier est vide</h3>
            <p class="text-muted mb-4">Vous n'avez aucun article dans votre panier</p>
            <a href="{{ url('/purchase') }}" class="btn btn-primary btn-lg rounded-pill">
                <i class="fas fa-arrow-left me-2"></i>Retour à la pharmacie
            </a>
        </div>
        @endif
    </div>
</div>

<style>
    /* Base Styles */
    .checkout-container {
        padding-bottom: 5rem;
        margin-top: 85px;
    }

    /* Hero Section */
    .checkout-hero {
        background: linear-gradient(135deg, #0d6efd 0%, #0b5ed7 100%);
        margin-top: -1rem;
        padding-top: 6rem;
        position: relative;
        overflow: hidden;
    }

    .checkout-hero::before {
        content: "";
        position: absolute;
        bottom: -50px;
        left: 0;
        right: 0;
        height: 100px;
        background: white;
        transform: skewY(-3deg);
        z-index: 1;
    }

    /* Cards */
    .checkout-card, .order-summary-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: none;
    }

    .checkout-card:hover, .order-summary-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15) !important;
    }

    .card-header {
        border-radius: 0 !important;
    }

    /* Form Elements */
    .form-control-lg {
        padding: 1rem 1.25rem;
        border-radius: 0.5rem;
        border: 1px solid #e0e0e0;
    }

    .form-control-lg:focus {
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.15);
        border-color: #0d6efd;
    }

    /* File Upload */
    .file-upload-container {
        position: relative;
    }

    .file-upload-label {
        display: block;
        border: 2px dashed #dee2e6;
        border-radius: 0.5rem;
        padding: 2rem;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .file-upload-label:hover {
        border-color: #0d6efd;
        background-color: rgba(13, 110, 253, 0.05);
    }

    .file-upload-content i {
        transition: transform 0.3s ease;
    }

    .file-upload-label:hover .file-upload-content i {
        transform: translateY(-5px);
    }

    /* Buttons */
    .checkout-btn {
        border-radius: 0.5rem;
        font-weight: 600;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .checkout-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(25, 135, 84, 0.3);
    }

    .checkout-btn::after {
        content: "";
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: 0.5s;
    }

    .checkout-btn:hover::after {
        left: 100%;
    }

    .back-btn {
        transition: all 0.3s ease;
        padding: 0.5rem 2rem;
    }

    .back-btn:hover {
        background-color: #0d6efd !important;
        color: white !important;
        transform: translateY(-2px);
    }

    /* Order Summary */
    .order-item {
        transition: background-color 0.3s ease;
    }

    .order-item:hover {
        background-color: #f8f9fa;
    }

    .total-price {
        padding-top: 1rem;
        border-top: 1px solid #e9ecef;
    }

    /* Empty Cart */
    .empty-cart {
        max-width: 500px;
        margin: 0 auto;
        background-color: white;
        border-radius: 1rem;
        padding: 3rem;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
    }

    .empty-cart-icon {
        width: 100px;
        height: 100px;
        margin: 0 auto;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #f8f9fa;
        border-radius: 50%;
    }

    /* Notification */
    .checkout-notification {
        position: fixed;
        top: 100px;
        right: 30px;
        z-index: 9999;
        min-width: 350px;
        border-radius: 0.5rem;
        animation: slideIn 0.3s ease-out;
        border-left: 5px solid #198754;
    }

    .fade-in {
        animation: fadeIn 0.3s ease-out;
    }

    /* Animations */
    @keyframes slideIn {
        from { transform: translateY(-20px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    /* Responsive */
    @media (max-width: 992px) {
        .checkout-hero {
            padding-top: 5rem;
        }
        
        .checkout-hero h1 {
            font-size: 2.5rem;
        }
    }

    @media (max-width: 768px) {
        .checkout-container {
            padding-top: 1rem;
        }
        
        .checkout-notification {
            top: 80px;
            right: 15px;
            left: 15px;
            min-width: auto;
        }
        
        .file-upload-label {
            padding: 1.5rem;
        }
    }
    #sidebar {
        display: none;
    }
    #main-content {
        margin-left: 0;
        width: 100%;
    }
    .table-striped tbody tr:last-child {
        border-top: 2px solid #dee2e6;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Handle file upload label
        const fileInput = document.getElementById('prescription');
        if (fileInput) {
            fileInput.addEventListener('change', function(e) {
                const fileName = e.target.files[0]?.name || 'Aucun fichier sélectionné';
                const label = document.querySelector('.file-upload-content');
                if (label) {
                    label.innerHTML = `
                        <i class="fas fa-check-circle fs-1 text-success mb-2"></i>
                        <p class="mb-1">${fileName}</p>
                        <small class="text-muted">Cliquez pour changer</small>
                    `;
                }
            });
        }

        // Handle form submission
        const form = document.getElementById('checkout-form');
        if (form) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const formData = new FormData(form);
                const submitBtn = form.querySelector('.checkout-btn');
                const originalBtnText = submitBtn.innerHTML;
                
                // Show loading state
                submitBtn.innerHTML = `
                    <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                    Traitement en cours...
                `;
                submitBtn.disabled = true;
                
                // Submit form via AJAX
                fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                })
                .then(response => {
                    if (!response.ok) throw new Error('Erreur réseau');
                    return response.json().catch(() => ({ success: true }));
                })
                .then(data => {
                    // Clear cart from localStorage
                    localStorage.removeItem('pharmacy_cart');
                    
                    // Show beautiful success message
                    const successHTML = `
                        <div class="checkout-notification alert alert-success fade-in">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-check-circle me-3 fs-4"></i>
                                <div>
                                    <h5 class="mb-1">Commande confirmée avec succès!</h5>
                                    <p class="mb-0">Votre commande #${Math.floor(Math.random() * 10000)} a été enregistrée.</p>
                                    <p class="mb-0">Notre équipe vous contactera sous 24h.</p>
                                </div>
                            </div>
                        </div>
                    `;
                    
                    document.body.insertAdjacentHTML('afterbegin', successHTML);
                    
                    // Reset form and disable inputs
                    form.reset();
                    form.querySelectorAll('input, button').forEach(el => el.disabled = true);
                    
                    // Reset file upload label
                    if (document.querySelector('.file-upload-content')) {
                        document.querySelector('.file-upload-content').innerHTML = `
                            <i class="fas fa-cloud-upload-alt fs-1 text-primary mb-2"></i>
                            <p class="mb-1">Cliquez pour télécharger</p>
                            <small class="text-muted">Formats acceptés: JPG, PNG</small>
                        `;
                    }
                    
                    // Change back button and show success state
                    const backBtn = document.querySelector('.back-btn');
                    if (backBtn) {
                        backBtn.innerHTML = '<i class="fas fa-basket-shopping me-2"></i>Nouvelle commande';
                        backBtn.classList.replace('btn-outline-primary', 'btn-primary');
                    }
                    
                    // Hide order summary
                    const orderSummary = document.querySelector('.order-summary-card');
                    if (orderSummary) {
                        orderSummary.innerHTML = `
                            <div class="card-header bg-primary text-white py-3">
                                <h3 class="mb-0">
                                    <i class="fas fa-receipt me-2"></i>Commande validée
                                </h3>
                            </div>
                            <div class="card-body text-center py-5">
                                <i class="fas fa-check-circle text-success mb-3" style="font-size: 3rem;"></i>
                                <h4>Merci pour votre commande!</h4>
                                <p class="text-muted">Un email de confirmation vous a été envoyé.</p>
                            </div>
                        `;
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    // Show error notification
                    const errorHTML = `
                        <div class="checkout-notification alert alert-danger fade-in">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-exclamation-circle me-3 fs-4"></i>
                                <div>
                                    <h5 class="mb-1">Erreur lors de la commande</h5>
                                    <p class="mb-0">Veuillez réessayer ou nous contacter.</p>
                                </div>
                            </div>
                        </div>
                    `;
                    document.body.insertAdjacentHTML('afterbegin', errorHTML);
                })
                .finally(() => {
                    submitBtn.innerHTML = originalBtnText;
                    submitBtn.disabled = false;
                    
                    // Remove notifications after 5 seconds
                    setTimeout(() => {
                        const notifications = document.querySelectorAll('.checkout-notification');
                        notifications.forEach(notif => notif.remove());
                    }, 5000);
                });
            });
        }

        // Clear cart when page is loaded from cache
        window.addEventListener('pageshow', function(event) {
            if (event.persisted) {
                localStorage.removeItem('pharmacy_cart');
            }
        });
    });
</script>
@endsection