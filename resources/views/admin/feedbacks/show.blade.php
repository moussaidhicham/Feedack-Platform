@extends('layouts.app')

@section('content')
<div class="container" style="margin-bottom: 109px;">
    <h1 class="text-center mb-5">Détails du Feedback</h1>
    
    <div class="card shadow-sm">
        <div class="card-body">
            <p><strong>Utilisateur :</strong> {{ $feedback->user->name ?? 'Anonyme' }}</p>
            <p><strong>Contenu :</strong> {{ $feedback->content }}</p>
            <p><strong>Créé le :</strong> {{ $feedback->created_at->format('d/m/Y H:i') }}</p>
            <a href="{{ route('feedbacks.index') }}" class="btn btn-secondary mt-3">Retour</a>
        </div>
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

        .container {
            max-width: 900px;
            margin-top: 30px;
        }

        /* Header Styling */
        h1 {
            font-size: 2rem;
            color: #007bff;
        }

        /* Card Styling */
        .card {
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            background-color: white;
        }

        .card-body {
            padding: 30px;
        }

        /* Button Styling */
        .btn-secondary {
            background-color: #6c757d;
            border: none;
            padding: 12px 25px;
            border-radius: 30px;
            color: white;
            font-size: 1rem;
            font-weight: 600;
            text-transform: uppercase;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
            transform: translateY(-4px);
        }

        /* Paragraph Styling */
        p {
            font-size: 1.1rem;
            margin-bottom: 15px;
        }

        p strong {
            color: #333;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                padding: 15px;
            }
        }
    </style>
@endsection
