@extends('layouts.app')

@section('content')
    <div class="orders-dashboard animated-page">
        <!-- صورة خلفية للصفحة -->
        <div class="page-background"></div>
        
        <div class="content-container">
            <h1 class="dashboard-title text-center">Gestion des commandes</h1>

            <!-- حقل البحث -->
            <form method="GET" action="{{ route('orders.index') }}" class="search-form mb-4">
                <div class="input-group">
                    <input type="text" name="search" class="form-control search-input" placeholder="Rechercher par nom de client, numéro de téléphone ou statut" value="{{ request('search') }}">
                    <button type="submit" class="btn search-button">
                        <i class="fas fa-search"></i> Rechercher
                    </button>
                </div>
            </form>

            <!-- جدول الطلبات -->
            <div class="orders-table-container">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th><i class="fas fa-user me-2"></i>Nom du client</th>
                            <th><i class="fas fa-map-marker-alt me-2"></i>Adresse</th>
                            <th><i class="fas fa-phone me-2"></i>Numéro de téléphone</th>
                            <th><i class="fas fa-file-prescription me-2"></i>Ordonnance</th>
                            <th><i class="fas fa-pills me-2"></i>Médicaments</th>
                            <th><i class="fas fa-info-circle me-2"></i>Statut</th>
                            <th><i class="fas fa-cogs me-2"></i>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                            <tr class="order-row animated-item">
                                <td class="customer-name">{{ $order->customer_name }}</td>
                                <td class="address-cell" data-toggle="tooltip" data-placement="top" title="{{ $order->address }}">
    {{ Str::limit($order->address, 30) }}
</td>
                                <td class="phone-cell">{{ $order->phone }}</td>
                                <td class="prescription-cell">
                                    @if($order->prescription)
                                        <a href="{{ asset('storage/' . $order->prescription) }}" target="_blank" class="btn prescription-btn">
                                            <i class="fas fa-file-medical me-1"></i> Voir
                                        </a>
                                    @else
                                        <span class="no-prescription">
                                            <i class="fas fa-times-circle me-1"></i> Non disponible
                                        </span>
                                    @endif
                                </td>
                                <td class="medications-cell">
                                    @php
                                        $medications = json_decode($order->medications, true);
                                    @endphp
                                    <div class="medications-list">
                                        @foreach($medications as $medication)
                                            <div class="medication-item">
                                                <span class="medication-dot"></span>
                                                <span class="medication-name">{{ $medication['name'] }}</span>
                                                <span class="medication-qty">x{{ $medication['quantity'] }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                </td>
                                <td class="status-cell">
                                    <span class="status-badge 
                                        @if($order->status == 'En attente') badge-waiting 
                                        @elseif($order->status == 'Validé') badge-approved 
                                        @elseif($order->status == 'Refusé') badge-rejected 
                                        @endif">
                                        @if($order->status == 'En attente')
                                            <i class="fas fa-clock me-1"></i>
                                        @elseif($order->status == 'Validé')
                                            <i class="fas fa-check-circle me-1"></i>
                                        @elseif($order->status == 'Refusé')
                                            <i class="fas fa-times-circle me-1"></i>
                                        @endif
                                        {{ $order->status }}
                                    </span>
                                </td>
                                <td class="actions-cell">
                                    <!-- تحديث حالة الطلب -->
                                    <form action="{{ route('orders.updateStatus', $order->id) }}" method="POST" class="status-update-form">
                                        @csrf
                                        <div class="form-group">
                                            <select name="status" class="form-select status-select">
                                                <option value="En attente" @if($order->status == 'En attente') selected @endif>En attente</option>
                                                <option value="Validé" @if($order->status == 'Validé') selected @endif>Validé</option>
                                                <option value="Refusé" @if($order->status == 'Refusé') selected @endif>Refusé</option>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn update-btn">
                                            <i class="fas fa-sync-alt me-1"></i> Mettre à jour
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="no-orders">
                                    <div class="no-data-container">
                                        <i class="fas fa-clipboard-list no-data-icon"></i>
                                        <p class="no-data-text">Aucune commande pour le moment</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="pagination-container">
                {{ $orders->links() }}
            </div>
        </div>
    </div>

    <!-- إضافة Font Awesome للأيقونات -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* ======= تنسيقات أساسية ======= */
        .orders-dashboard {
            position: relative;
            padding: 2rem;
            margin-top: 20px;
            min-height: 90vh;
        }

        /* صورة الخلفية */
        .page-background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('{{ asset('storage/images/pexels-readymade-3850674.jpg') }}');
            background-size: cover;
            background-position: center;
            opacity: 0.08;
            z-index: -1;
        }

        .content-container {
            background-color: rgba(255, 255, 255, 0.92);
            border-radius: 15px;
            box-shadow: 0 8px 30px rgba(0, 0, 123, 0.15);
            padding: 2rem;
            position: relative;
            z-index: 1;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        /* ======= عنوان الصفحة ======= */
        .dashboard-title {
            font-family: 'Montserrat', sans-serif;
            color: #2c3e50;
            font-weight: 700;
            font-size: 2.5rem;
            margin-bottom: 1.8rem;
            border-bottom: 3px solid #3498db;
            padding-bottom: 0.8rem;
            display: inline-block;
            position: relative;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
        }

        .dashboard-title:after {
            position: absolute;
            right: -35px;
            top: 0;
        }

        /* ======= تنسيق شريط البحث ======= */
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

        /* ======= تنسيق الجدول ======= */
        .orders-table-container {
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

        .order-row {
            transition: all 0.3s ease;
        }

        .order-row:hover {
            background-color: rgba(52, 152, 219, 0.05);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        /* تنسيق خلايا محددة */
        .customer-name {
            font-weight: 600;
            color: #2c3e50;
        }

        .address-cell {
            max-width: 150px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .phone-cell {
            font-family: 'Courier New', monospace;
            font-weight: 600;
        }

        /* تنسيق الوصفة الطبية */
        .prescription-btn {
            background-color: #3498db;
            color: white;
            border-radius: 20px;
            font-size: 0.9rem;
            padding: 6px 15px;
            transition: all 0.3s ease;
            border: none;
            box-shadow: 0 4px 8px rgba(52, 152, 219, 0.2);
        }

        .prescription-btn:hover {
            background-color: #2980b9;
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(52, 152, 219, 0.3);
            color: white;
        }

        .no-prescription {
            color: #e74c3c;
            font-size: 0.9rem;
            display: inline-block;
            padding: 5px 10px;
            background-color: rgba(231, 76, 60, 0.1);
            border-radius: 15px;
        }

        /* تنسيق قائمة الأدوية */
        .medications-cell {
            padding: 10px 15px;
        }

        .medications-list {
            max-height: 120px;
            overflow-y: auto;
            padding-right: 5px;
        }

        .medication-item {
            display: flex;
            align-items: center;
            margin-bottom: 8px;
            padding: 5px 0;
            border-bottom: 1px dashed #ecf0f1;
        }

        .medication-dot {
            width: 10px;
            height: 10px;
            background-color: #2ecc71;
            border-radius: 50%;
            margin-right: 8px;
            display: inline-block;
        }

        .medication-name {
            flex-grow: 1;
            color: #34495e;
            font-weight: 500;
        }

        .medication-qty {
            background-color: rgba(52, 152, 219, 0.1);
            padding: 2px 8px;
            border-radius: 10px;
            color: #3498db;
            font-weight: 600;
            font-size: 0.8rem;
        }

        /* تنسيق حالة الطلب */
        .status-badge {
            display: inline-block;
            padding: 8px 15px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.85rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .badge-waiting {
            background-color: #f39c12;
            color: white;
        }

        .badge-approved {
            background-color: #2ecc71;
            color: white;
        }

        .badge-rejected {
            background-color: #e74c3c;
            color: white;
        }

        /* تنسيق تحديث الحالة */
        .status-update-form {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .status-select {
            border-radius: 10px;
            border: 1px solid #dfe6e9;
            padding: 8px;
            font-size: 0.9rem;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .status-select:focus {
            border-color: #3498db;
            box-shadow: 0 2px 8px rgba(52, 152, 219, 0.2);
            outline: none;
        }

        .update-btn {
            background-color: #9b59b6;
            color: white;
            border: none;
            border-radius: 10px;
            padding: 8px 15px;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 8px rgba(155, 89, 182, 0.2);
        }

        .update-btn:hover {
            background-color: #8e44ad;
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(155, 89, 182, 0.3);
            color: white;
        }

        /* ======= حالة عدم وجود طلبات ======= */
        .no-orders {
            padding: 3rem !important;
        }

        .no-data-container {
            text-align: center;
            padding: 2rem;
        }

        .no-data-icon {
            font-size: 4rem;
            color: #bdc3c7;
            margin-bottom: 1rem;
        }

        .no-data-text {
            font-size: 1.2rem;
            color: #7f8c8d;
            font-weight: 500;
        }

        /* ======= تنسيق الترقيم ======= */
        .pagination-container {
            margin-top: 1.5rem;
            display: flex;
            justify-content: center;
        }

        .pagination {
            display: flex;
            padding-left: 0;
            list-style: none;
            border-radius: 0.25rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            border-radius: 30px;
            overflow: hidden;
            background-color: white;
        }

        .page-item:first-child .page-link {
            border-top-left-radius: 30px;
            border-bottom-left-radius: 30px;
        }

        .page-item:last-child .page-link {
            border-top-right-radius: 30px;
            border-bottom-right-radius: 30px;
        }

        .page-link {
            position: relative;
            display: block;
            padding: 0.7rem 1rem;
            margin-left: -1px;
            line-height: 1.25;
            color: #2c3e50;
            background-color: #fff;
            border: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .page-item.active .page-link {
            z-index: 3;
            color: #fff;
            background-color: #3498db;
            border-color: #3498db;
        }
        /* تثبيت الشريط العلوي */
.navbar-custom {
    position: fixed;
    top: 0;
    width: 100%;
    z-index: 1030;
    height: 80px; /* تأكد من أنه فوق كل العناصر */
}

/* تعديل الهوامش لتعويض الشريط الثابت */
.orders-dashboard {
    padding-top: 70px; /* يتناسب مع ارتفاع الشريط العلوي */
    margin-top: 0;
}
        .page-link:hover {
            z-index: 2;
            color: #3498db;
            text-decoration: none;
            background-color: #ecf0f1;
        }

        /* ======= تأثيرات الحركة ======= */
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

        /* تخصيص scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            background: #3498db;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #2980b9;
        }

        /* ======= تحسينات للأجهزة المحمولة ======= */
        @media (max-width: 992px) {
            .orders-dashboard {
                padding: 1rem;
            }

            .dashboard-title {
                font-size: 2rem;
            }

            .table-responsive {
                border-radius: 15px;
                overflow: hidden;
            }
            
            .content-container {
                padding: 1.5rem;
            }
        }

        @media (max-width: 768px) {
            .dashboard-title {
                font-size: 1.8rem;
            }
            
            .table th, .table td {
                padding: 10px 8px;
                font-size: 0.85rem;
            }
            
            .prescription-btn, .update-btn {
                padding: 5px 10px;
                font-size: 0.8rem;
            }
            
            .status-badge {
                padding: 5px 10px;
                font-size: 0.8rem;
            }
        }

        /* تحسينات أخرى */
        ::selection {
            background-color: #3498db;
            color: white;
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection