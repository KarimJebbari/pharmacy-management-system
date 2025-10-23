@extends('layouts.app')

@section('content')
    <div class="medications-dashboard animated-page">
        <div class="page-background"></div>
        
        <div class="content-container">
            <h1 class="dashboard-title text-center mb-4">Liste des médicaments</h1>

            <form method="GET" action="{{ route('medications.index') }}" class="search-form">
                <div class="input-group mb-4">
                    <input type="text" name="search" class="form-control search-input" placeholder="Rechercher un médicament ou un prix..." value="{{ request('search') }}">
                    <button class="btn search-button" type="submit"><i class="fas fa-search"></i> Rechercher</button>
                </div>
            </form>

            @if ($expiringSoon)
                <div class="alert custom-alert alert-warning text-center mb-4 animated-alert">
                    <i class="fas fa-exclamation-triangle fa-lg me-2"></i>
                    Attention ! Certains médicaments vont bientôt expirer
                </div>
            @endif



            @if ($medications->isEmpty())
                <div class="no-data-container">
                    <i class="fas fa-prescription-bottle-alt no-data-icon"></i>
                    <p class="text-center text-muted no-data-text">Aucun médicament disponible pour le moment</p>
                </div>
            @else
                <div class="table-responsive medication-table-container">
                    <table class="table table-hover text-center animated-table">
                        <thead>
                            <tr>
                                <th><i class="fas fa-pills me-2"></i>Nom du médicament</th>
                                <th><i class="far fa-image me-2"></i>Image</th>
                                <th><i class="far fa-calendar-alt me-2"></i>Date d'expiration</th>
                                <th><i class="fas fa-box me-2"></i>Quantité</th>
                                <th><i class="fas fa-tag me-2"></i>Prix (Dirham)</th>
                                <th><i class="fas fa-info-circle me-2"></i>Description</th>
                                <th><i class="fas fa-cogs me-2"></i>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($medications as $medication)
                                <tr class="medication-row {{ $medication->quantity == 0 ? 'out-of-stock' : ($medication->expiry_date <= now()->addDays(30) ? 'expiring-soon' : '') }}">
                                    <td class="{{ $medication->quantity == 0 ? 'text-danger text-decoration-line-through' : '' }} animated-item">
                                        {{ $medication->name }}
                                    </td>
                                    <td>
                                        @if ($medication->image)
                                            <img src="{{ asset('storage/' . $medication->image) }}" alt="Image du médicament" class="med-thumbnail">
                                        @else
                                            <span class="no-image"><i class="fas fa-camera-slash"></i></span>
                                        @endif
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($medication->expiry_date)->format('Y-m-d') }}</td>
                                    <td class="quantity-cell">{{ $medication->quantity }}</td>
                                    <td>
                                        @if($medication->price > 0)
                                            <span class="price-tag">{{ number_format($medication->price, 2) }} Dh</span>
                                        @else
                                            <span class="unavailable-price">Indisponible</span>
                                        @endif
                                    </td>
                                    <td class="description-cell">{{ $medication->description }}</td>
                                    <td class="actions-cell">
                                        <div class="action-buttons">
                                            <a href="{{ route('medications.edit', $medication->id) }}" class="btn edit-btn">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('medications.destroy', $medication) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn delete-btn">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                            @if ($medication->quantity == 0)
                                                <span class="stock-badge">En rupture</span>
                                                <a href="{{ route('medications.out-of-stock', ['id' => $medication->id]) }}" class="btn notify-btn">
    <i class="fas fa-paper-plane"></i>
</a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="pagination-container">
                    {{ $medications->links() }}
                </div>
            @endif
        </div>
    </div>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <style>
        .medications-dashboard {
            position: relative;
            padding: 2rem;
            margin-top: 20px;
            min-height: 90vh;
        }

        .page-background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url("{{ asset('storage/images/pexels-readymade-3850674.jpg') }}");
            background-size: cover;
            background-position: center;
            opacity: 0.08;
            z-index: -1;
        }

        .content-container {
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            box-shadow: 0 8px 30px rgba(0, 0, 123, 0.15);
            padding: 2rem;
            position: relative;
            z-index: 1;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .dashboard-title {
            font-family: 'Montserrat', sans-serif;
            color: #2c3e50;
            font-weight: 700;
            font-size: 2.5rem;
            margin-bottom: 1.5rem;
            border-bottom: 3px solid #3498db;
            padding-bottom: 0.8rem;
            display: inline-block;
            position: relative;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
        }

        .dashboard-title:after {
            /* content: '💊'; */
            position: absolute;
            right: -30px;
            top: 0;
        }

        .search-form {
            margin-bottom: 2rem;
        }

        .search-input {
            border-radius: 30px 0 0 30px;
            border: 2px solid #3498db;
            padding: 12px 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            font-size: 16px;
        }

        .search-input:focus {
            box-shadow: 0 4px 15px rgba(52, 152, 219, 0.3);
            border-color: #2980b9;
            outline: none;
        }

        .search-button {
            border-radius: 0 30px 30px 0;
            background-color: #3498db;
            color: white;
            padding: 10px 25px;
            transition: all 0.3s ease;
            border: 2px solid #3498db;
            font-weight: 600;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .search-button:hover {
            background-color: #2980b9;
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }

        .custom-alert {
            border-radius: 10px;
            padding: 15px 20px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            border-left: 6px solid #f39c12;
            background-color: rgba(243, 156, 18, 0.15);
            font-weight: 600;
            transition: all 0.4s ease;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(243, 156, 18, 0.5);
            }
            70% {
                box-shadow: 0 0 0 10px rgba(243, 156, 18, 0);
            }
            100% {
                box-shadow: 0 0 0 0 rgba(243, 156, 18, 0);
            }
        }

        .no-data-container {
            text-align: center;
            padding: 3rem;
            background-color: rgba(255, 255, 255, 0.7);
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .no-data-icon {
            font-size: 5rem;
            color: #bdc3c7;
            margin-bottom: 1rem;
        }

        .no-data-text {
            font-size: 1.2rem;
            color: #7f8c8d;
            font-weight: 500;
        }

        .medication-table-container {
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
        }

        .table {
            margin-bottom: 0;
            background-color: white;
            border-collapse: separate;
            border-spacing: 0;
        }

        .table thead tr {
            background: linear-gradient(135deg, #2c3e50, #3498db);
            color: white;
        }

        .table th {
            padding: 15px 10px;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.9rem;
            letter-spacing: 1px;
            border: none;
            vertical-align: middle;
        }

        .table td {
            padding: 15px 10px;
            vertical-align: middle;
            border-top: 1px solid #ecf0f1;
            font-size: 0.95rem;
            transition: all 0.2s ease;
        }

        .medication-row {
            transition: all 0.3s ease;
        }

        .medication-row:hover {
            background-color: rgba(52, 152, 219, 0.05);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .out-of-stock {
            background-color: rgba(231, 76, 60, 0.1);
        }

        .expiring-soon {
            background-color: rgba(243, 156, 18, 0.1);
        }

        .med-thumbnail {
            width: 70px;
            height: 70px;
            object-fit: cover;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .med-thumbnail:hover {
            transform: scale(1.1);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
        }

        .no-image {
            display: inline-block;
            width: 70px;
            height: 70px;
            line-height: 70px;
            background-color: #ecf0f1;
            color: #95a5a6;
            border-radius: 10px;
            font-size: 1.5rem;
        }

        .price-tag {
            display: inline-block;
            background-color: rgba(46, 204, 113, 0.15);
            color: #27ae60;
            padding: 5px 10px;
            border-radius: 20px;
            font-weight: 600;
            border: 1px solid rgba(46, 204, 113, 0.3);
        }

        .unavailable-price {
            display: inline-block;
            background-color: rgba(231, 76, 60, 0.15);
            color: #c0392b;
            padding: 5px 10px;
            border-radius: 20px;
            font-weight: 600;
            border: 1px solid rgba(231, 76, 60, 0.3);
        }

        .quantity-cell {
            font-weight: 600;
            font-size: 1.1rem;
        }

        .actions-cell {
            width: 180px;
        }

        .action-buttons {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .action-buttons .btn {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .edit-btn {
            background-color: #f39c12;
            color: white;
            border: none;
        }

        .edit-btn:hover {
            background-color: #e67e22;
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 6px 10px rgba(243, 156, 18, 0.3);
        }

        .delete-btn {
            background-color: #e74c3c;
            color: white;
            border: none;
        }

        .delete-btn:hover {
            background-color: #c0392b;
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 6px 10px rgba(231, 76, 60, 0.3);
        }

        .notify-btn {
            background-color: #3498db;
            color: white;
            border: none;
        }

        .notify-btn:hover {
            background-color: #2980b9;
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 6px 10px rgba(52, 152, 219, 0.3);
        }

        .stock-badge {
            display: inline-block;
            background-color: #e74c3c;
            color: white;
            padding: 4px 8px;
            border-radius: 15px;
            font-size: 0.75rem;
            font-weight: 600;
            margin-top: 5px;
        }

        .pagination-container {
            margin-top: 1.5rem;
            display: flex;
            justify-content: center;
        }

        .pagination-container nav ul {
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            border-radius: 30px;
            overflow: hidden;
            display: inline-flex;
            background-color: white;
        }

        .pagination-container nav ul li {
            display: inline-block;
        }

        .pagination-container nav ul li a,
        .pagination-container nav ul li span {
            padding: 10px 18px;
            display: inline-block;
            color: #2c3e50;
            font-weight: 600;
            border: none;
            transition: all 0.3s ease;
        }

        .pagination-container nav ul li.active span {
            background-color: #3498db;
            color: white;
        }

        .pagination-container nav ul li a:hover {
            background-color: #ecf0f1;
        }

        .animated-page {
            opacity: 0;
            animation: fadeInUp 0.8s ease forwards;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animated-table {
            opacity: 0;
            animation: fadeIn 1s ease forwards 0.3s;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        .animated-item {
            animation: fadeInItem 0.5s ease forwards;
        }

        @keyframes fadeInItem {
            from {
                opacity: 0;
                transform: translateX(-10px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @media (max-width: 768px) {
            .medications-dashboard {
                padding: 1rem;
            }

            .dashboard-title {
                font-size: 1.8rem;
            }

            .content-container {
                padding: 1rem;
            }

            .table td, .table th {
                padding: 10px 5px;
                font-size: 0.85rem;
            }

            .description-cell {
                max-width: 100px;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
            }
        }

        ::selection {
            background-color: #3498db;
            color: white;
        }

        .description-cell {
            max-width: 200px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
    </style>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let sidebar = document.getElementById("sidebar");
            let mainContent = document.getElementById("main-content");
            let toggleButton = document.getElementById("toggle-sidebar");

            toggleButton.addEventListener("click", function () {
                sidebar.classList.toggle("d-none"); 
                mainContent.classList.toggle("w-100"); 
            });
        });
    </script>
@endsection