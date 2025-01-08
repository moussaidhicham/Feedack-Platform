@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center mb-5">Mon Profil</h1>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Succès !</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nom</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Nouveau mot de passe (facultatif)</label>
                    <input type="password" name="password" id="password" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirmer le nouveau mot de passe</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                </div>

                <button type="submit" class="btn btn-primary mt-3">Mettre à jour</button>
            </form>
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

        /* Form Elements Styling */
        .form-label {
            font-weight: 600;
            color: #333;
        }

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

        /* Alert Styling */
        .alert {
            font-size: 1rem;
            padding: 20px;
            margin-bottom: 20px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                padding: 15px;
            }

            .btn-primary {
                font-size: 1rem;
                padding: 10px 20px;
            }
        }
    </style>
@endsection
