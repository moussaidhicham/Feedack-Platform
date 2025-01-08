<head>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

</head>
@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center mb-5">Gestion des Cours</h1>

    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Succès !</strong> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    {{-- <a href="{{ route('courses.create') }}" class="btn btn-primary mb-3">Ajouter un cours</a> --}}
    <a href="{{ route('courses.create') }}" class="btn btn-primary mb-3">
        <i class="fas fa-plus-circle"></i> Ajouter un cours
    </a>
    
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Description</th>
                    <th>Formateur</th>
                    <th>Catégorie</th>
                    <th>Miniature</th>
                    <th>PDF</th>
                    <th>Date de création</th>
                    <th>Date de mise à jour</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($courses as $course)
                <tr>
                    <td>{{ $course->title }}</td>
                    <td>{{ $course->description ?? 'Non spécifiée' }}</td>
                    <td>{{ $course->instructor ?? 'Instructeur non renseigné' }}</td>
                    <td>{{ $course->category ?? 'Aucune catégorie' }}</td>
                    <td>
                        @if ($course->thumbnail)
                        <img src="{{ asset('storage/' . $course->thumbnail) }}" class="img-thumbnail" alt="Course Thumbnail" style="max-width: 100px;">
                        @else
                            Pas de miniature
                        @endif
                    </td>
                    <td>
                        @if ($course->pdf)
                        <a href="{{ asset('storage/' . $course->pdf) }}" target="_blank" class="btn btn-primary btn-sm">Voir le PDF</a>
                        @else
                            Pas de PDF
                        @endif
                    </td>
                    <td>{{ $course->created_at->format('d/m/Y') }}</td>
                    <td>{{ $course->updated_at->format('d/m/Y') }}</td>
                    <td class="action-buttons text-center">
                        <!-- Bouton Modifier -->
                        <a href="{{ route('courses.edit', $course->id) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Modifier
                        </a>
                        
                        <!-- Bouton Supprimer -->
                        <form action="{{ route('courses.destroy', $course->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="margin-top: 8px" class="btn btn-danger btn-sm" onclick="return confirm('Confirmer la suppression ?')">
                                <i class="fas fa-trash"></i> Supprimer
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
        /* General Styling */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }

        /* Table Styling */
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

        .table th, .table td {
            text-align: center;
            padding: 15px;
            vertical-align: middle;
        }

        /* Table Row Styling */
        .table tbody tr {
            background-color: #fff;
        }

        .table tbody tr:hover {
            background-color: #f1f1f1;
        }

        /* Action Buttons Styling */
        .action-buttons a,
.action-buttons button {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 5px; /* Espace entre l'icône et le texte */
    font-weight: 600;
}

.action-buttons i {
    font-size: 1rem; /* Taille des icônes */
}


        /* Button for Modifier */
        .btn-warning {
            background-color: #ffc107;
            border-radius: 50px;
            font-size: 0.875rem;
            font-weight: 600;
            color: white;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .btn-warning:hover {
            background-color: #e0a800;
            transform: translateY(-4px);
        }

        /* Button for Supprimer */
        .btn-danger {
            background-color: #dc3545;
            border-radius: 50px;
            font-size: 0.875rem;
            font-weight: 600;
            color: white;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .btn-danger:hover {
            background-color: #c82333;
            transform: translateY(-4px);
        }

        /* Button Size */
        .btn-sm {
            font-size: 0.875rem;
        }

        /* Table Responsive */
        .table-responsive {
            overflow-x: auto;
        }

        /* Alert Styling */
        .alert {
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
    </style>
@endsection
