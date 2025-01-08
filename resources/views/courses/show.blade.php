<head>
    <style>
        .course-header {
            margin-bottom: 30px;
        }

        .course-details {
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            border-radius: 8px;
        }

        .course-feedback {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            margin-top: 30px;
        }

        .feedback-item {
            background-color: #f7f7f7;
            margin-bottom: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .feedback-item:hover {
            background-color: #f0f0f0;
        }

        .feedback-item p {
            margin: 0;
        }

        .course-pdf {
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 8px;
            margin-top: 30px;
        }

        .course-pdf iframe {
            border-radius: 8px;
            border: 1px solid #ccc;
            width: 100%;
            height: 600px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-top: 15px;
        }

        .course-pdf .btn-info {
            background-color: #17a2b8;
            border-color: #17a2b8;
            color: white;
            transition: background-color 0.3s ease, border-color 0.3s ease;
            margin-top: 10px;
        }

        .course-pdf .btn-info:hover {
            background-color: #138496;
            border-color: #138496;
        }

        .course-feedback .badge {
            margin-left: 5px;
        }

        .course-feedback .btn-sm {
            margin-top: 5px;
        }

        .add-feedback textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .add-feedback button {
            margin-top: 10px;
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .add-feedback button:hover {
            background-color: #218838;
        }
        .feedback-date {
    font-size: 0.85rem; /* Taille de la police */
    color: #6c757d; /* Couleur grise */
    margin-left: auto; /* Pousse la date à droite */
    display: flex;
    align-items: center;
    gap: 5px; /* Espace entre l'icône et le texte */
}


    </style>
</head>

@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<div class="container">
    <div class="course-header">
        <h1 class="text-center mb-4">{{ $course->title }}</h1>
    </div>

    <div class="row">
        <!-- Informations du cours -->
        <div class="col-md-8 col-sm-12">
            <div class="course-details p-3 bg-light rounded">
                <p><strong>Instructeur:</strong> <span class="badge bg-primary text-white">{{ $course->instructor ?? 'Non renseigné' }}</span></p>
                <p><strong>Catégorie:</strong> <span class="badge bg-secondary">{{ $course->category ?? 'Non renseignée' }}</span></p>
                <p><strong>Description:</strong> {{ $course->description ?? 'Aucune description disponible' }}</p>
                <p><strong>Date de création:</strong> {{ $course->created_at->format('d/m/Y H:i') }}</p>
                <p><strong>Date de mise à jour:</strong> {{ $course->updated_at->format('d/m/Y H:i') }}</p>
            </div>
        </div>

        <!-- Image du cours -->
        <div class="col-md-4 col-sm-12 text-center">
            @if($course->thumbnail)
            <img src="{{ asset('storage/' . $course->thumbnail) }}" class="card-img-top" alt="Course Thumbnail">
            @else
                <p class="text-muted">Aucune image disponible</p>
            @endif
        </div>
    </div>

    <!-- Affichage du fichier PDF -->
    <div class="course-pdf mt-5">
        <h3>Document PDF</h3>
        @if($course->pdf)
            <p>
                <a href="{{ asset('storage/' . $course->pdf) }}" target="_blank" class="btn btn-info">
                    <i class="fas fa-file-pdf"></i> Voir le PDF
                </a>
            </p>
            <!-- Intégrer le PDF dans une iframe -->
            <iframe src="{{ asset('storage/' . $course->pdf) }}" width="100%" height="600px" frameborder="0"></iframe>
        @else
            <p class="text-muted">Aucun fichier PDF disponible pour ce cours.</p>
        @endif
    </div>

    <!-- Feedbacks -->
    <div class="course-feedback mt-5">
        <h3>Feedbacks</h3>
        @foreach($course->feedbacks as $feedback)
        <div class="feedback-item p-3 mb-3 border rounded">
            <div class="d-flex align-items-center mb-2">
                <!-- Avatar avec initiales -->
                <div class="me-2">
                    <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center text-white" 
                        style="width: 40px; height: 40px; font-size: 14px;">
                        @if($feedback->user)
                            @php
                                $nameParts = explode(' ', trim($feedback->user->name));
                                $initials = '';
                                if(count($nameParts) >= 2) {
                                    $initials = strtoupper(substr($nameParts[0], 0, 1) . substr($nameParts[1], 0, 1));
                                } else {
                                    $initials = strtoupper(substr($feedback->user->name, 0, 2));
                                }
                            @endphp
                            {{ $initials }}
                        @else
                            AN
                        @endif
                    </div>
                </div>
                <!-- Nom de l'utilisateur -->
                <div>
                    <strong>
                        <i ></i> {{ $feedback->user ? $feedback->user->name : 'Anonyme' }}
                    </strong>
                </div>
            
                <!-- Date de création -->
                <div class="feedback-date">
                    <i class="fas fa-calendar-alt"></i> Posté le {{ $feedback->created_at->format('d/m/Y H:i') }}
                </div>
            </div>
            <p>{{ $feedback->content }}</p>
            
            <!-- Ajout de la date de création -->
            
            
            <!-- Formulaire pour voter avec compteurs intégrés -->
            <form action="{{ route('votes.store', $feedback->id) }}" method="POST" class="d-flex gap-2">
                @csrf
                <!-- Bouton "Like" -->
                <button type="submit" name="type" value="like" 
                    class="btn btn-sm d-flex align-items-center gap-1 {{ $feedback->votes->where('user_id', auth()->id())->where('type', 'like')->isNotEmpty() ? 'btn-success' : 'btn-outline-success' }}">
                    <i class="fas fa-thumbs-up"></i>
                    <span>{{ $feedback->likes }}</span>
                </button>
            
                <!-- Bouton "Dislike" -->
                <button type="submit" name="type" value="dislike" 
                    class="btn btn-sm d-flex align-items-center gap-1 {{ $feedback->votes->where('user_id', auth()->id())->where('type', 'dislike')->isNotEmpty() ? 'btn-danger' : 'btn-outline-danger' }}">
                    <i class="fas fa-thumbs-down"></i>
                    <span>{{ $feedback->dislikes }}</span>
                </button>
            </form>
            
        </div>
        @endforeach
        
    </div>

    <!-- Ajouter un feedback -->
    @auth
        <div class="add-feedback mt-4">
            <h4>Ajouter un Feedback</h4>
            <form action="{{ route('feedbacks.store', $course->id) }}" method="POST">
                @csrf
                <textarea name="content" rows="4" class="form-control mb-3" placeholder="Votre feedback..." required></textarea>
                <button type="submit" class="btn btn-primary">Soumettre le feedback</button>
            </form>
        </div>
    @else
        <p class="mt-4"><a href="{{ route('login') }}">Connectez-vous</a> pour ajouter un feedback.</p>
    @endauth
</div>
@endsection
