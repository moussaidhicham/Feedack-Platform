<head>
    <style>
        /* General Styling */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }

        /* Card Styling */
        .card {
            border-radius: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            background-color: white;
            border: none;
        }

        .card-body {
            padding: 30px;
        }

        .form-label {
            font-weight: 600;
            color: #333;
        }

        /* Input Fields */
        .form-control {
            border-radius: 10px;
            border: 1px solid #ddd;
            padding: 12px 20px;
            font-size: 1rem;
            margin-bottom: 20px;
            transition: border-color 0.3s ease;
        }

        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 10px rgba(0, 123, 255, 0.5);
        }

        /* File Inputs */
        .form-control-file {
            border: 1px solid #ddd;
            padding: 8px;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        /* Button Styling */
        .btn-primary {
            background: linear-gradient(120deg, #007bff, #0056b3);
            border: none;
            padding: 12px 25px;
            border-radius: 30px;
            color: white;
            font-size: 1.2rem;
            font-weight: 600;
            text-transform: uppercase;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .btn-primary:hover {
            background: linear-gradient(120deg, #0056b3, #003d80);
            transform: translateY(-4px);
        }

        .btn-block {
            width: 100%;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .col-md-6 {
                width: 100%;
            }

            .btn-primary {
                font-size: 1rem;
                padding: 10px 20px;
            }
        }
    </style>
</head>

@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center mb-5">Ajouter un Cours</h1>
    <div class="card shadow-lg border-0 rounded-3">
        <div class="card-body">
            <form action="{{ route('courses.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row g-4">
                    <!-- Left Column: 3 Inputs -->
                    <div class="col-md-6">
                        <!-- Title -->
                        <div class="form-group">
                            <label for="title" class="form-label">Titre</label>
                            <input type="text" name="title" id="title" class="form-control" placeholder="Entrez le titre du cours" required>
                        </div>

                        <!-- Instructor -->
                        <div class="form-group">
                            <label for="instructor" class="form-label">Instructeur</label>
                            <input type="text" name="instructor" id="instructor" class="form-control" placeholder="Nom de l'instructeur" required>
                        </div>

                        <!-- Category -->
                        <div class="form-group">
                            <label for="category" class="form-label">Catégorie</label>
                            <input type="text" name="category" id="category" class="form-control" placeholder="Catégorie du cours" required>
                        </div>
                    </div>

                    <!-- Right Column: 3 Inputs -->
                    <div class="col-md-6">
                        <!-- Description -->
                        <div class="form-group">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" id="description" class="form-control" rows="4" placeholder="Décrivez le contenu du cours"></textarea>
                        </div>

                        <!-- Thumbnail -->
                        <div class="form-group">
                            <label for="thumbnail" class="form-label">Miniature</label>
                            <input type="file" name="thumbnail" id="thumbnail" class="form-control-file">
                        </div>

                        <!-- PDF File -->
                        <div class="form-group">
                            <label for="pdf" class="form-label">Fichier PDF</label>
                            <input type="file" name="pdf" id="pdf" class="form-control-file">
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary btn-block mt-4">Ajouter le Cours</button>
            </form>
        </div>
    </div>
</div>
@endsection
