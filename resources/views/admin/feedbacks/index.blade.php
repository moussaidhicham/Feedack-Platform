<head>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

</head>
@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center mb-5">Liste des Feedbacks</h1>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Succès !</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Utilisateur</th>
                    <th>Contenu</th>
                    <th>Créé le</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($feedbacks as $feedback)
                <tr>
                    <td>{{ $feedback->user->name ?? 'Anonyme' }}</td>
                    <td>{{ $feedback->content }}</td>
                    <td>{{ $feedback->created_at->format('d/m/Y H:i') }}</td>
                    <td class="action-buttons text-center">
                        <!-- Button Voir -->
                        <a href="{{ route('feedbacks.show', $feedback->id) }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-eye"></i> Voir
                        </a>

                        <!-- Button Supprimer -->
                        <form action="{{ route('feedbacks.destroy', $feedback->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="margin-top: 8px" class="btn btn-danger btn-sm" onclick="return confirm('Confirmer la suppression ?')">
                                <i class="fas fa-trash-alt"></i> Supprimer
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('styles')
    <style>
        /* Ajout des styles inchangés */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }
        .table {
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            background-color: white;
            margin-top: 20px;
        }
        .table thead {
            background-color: #007bff;
            color: white;
        }
        .action-buttons {
            display: flex;
            justify-content: center;
            gap: 10px;
        }
        .btn-primary {
            background-color: #007bff;
            color: white;
            transition: transform 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            transform: translateY(-4px);
        }
        .btn-danger {
            background-color: #dc3545;
            color: white;
            transition: transform 0.3s ease;
        }
        .btn-danger:hover {
            background-color: #c82333;
            transform: translateY(-4px);
        }
        .btn-sm {
            font-size: 0.875rem;
        }
    </style>
@endsection

@section('scripts')
<!-- Font Awesome pour les icônes -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
@endsection
