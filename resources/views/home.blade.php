<head>
    <!-- Meta Tags for Responsiveness and SEO -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Explore our wide range of courses taught by experienced instructors.">
    <title>Courses</title>

    <!-- Include Bootstrap CSS for better styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <!-- Include Custom CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Internal Custom Styles -->
    <style>
        /* Import Google Fonts */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap');

        /* Body Styles */
        .about-image {
            height: 100%; /* Adapte l'image à la hauteur disponible */
            max-height: 300px; /* Définir une hauteur maximale pour éviter les débordements */
            object-fit: cover; /* Maintient le ratio tout en remplissant l'espace */
            width: 100%; /* Garantit que l'image s'étire sur toute la largeur */
            }

        .row.align-items-center {
            align-items: center; /* Aligne le texte et l'image verticalement */
            }

            @media (max-width: 768px) {
        .about-image {
            max-height: none; /* Permet à l'image de s'adapter sur les petits écrans */
                }
            }
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(120deg, #f0f4ff, #ffffff);
            color: #333;
            margin: 0;
            padding: 0;
        }

        /* Container Styles */
        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        /* Card Styles */
        .card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            transition: transform 0.4s ease, box-shadow 0.4s ease;
            background: #ffffff;
            position: relative;
        }

        .card:hover {
            transform: translateY(-12px);
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.2);
        }

        /* Card Header */
        .card-img-top {
            height: 200px;
            object-fit: cover;
            border-bottom: 3px solid #007bff;
        }

        /* Badge Styles */
        .card .badge {
            position: absolute;
            top: 15px;
            left: 15px;
            background: #007bff;
            color: #fff;
            padding: 5px 10px;
            font-size: 0.8rem;
            border-radius: 30px;
            font-weight: 600;
        }

        /* Card Body Styles */
        .card-body {
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .card-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: #0056b3;
            margin-bottom: 10px;
        }

        .card-text {
            font-size: 0.95rem;
            line-height: 1.6;
            color: #666;
            margin-bottom: 15px;
        }

        .card-text strong {
            color: #333;
        }

        /* Button Styles */
        .btn-primary {
            background: linear-gradient(120deg, #0056b3, #007bff);
            color: #fff;
            border: none;
            border-radius: 30px;
            padding: 10px 20px;
            font-size: 1rem;
            font-weight: 600;
            text-align: center;
            transition: background 0.4s, box-shadow 0.4s ease;
        }

        .btn-primary:hover {
            background: linear-gradient(120deg, #003d80, #0056b3);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
        }

        /* Empty State */
        .alert {
            background: #f0f4ff;
            color: #333;
            border: 2px dashed #007bff;
            border-radius: 15px;
            font-size: 1.2rem;
            text-align: center;
            padding: 25px;
            margin-top: 20px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            h1 {
                font-size: 2rem;
            }

            .card-img-top {
                height: 150px;
            }

            .btn-primary {
                font-size: 0.9rem;
                padding: 8px 16px;
            }
        }
        .pagination {
                display: flex;
                justify-content: center;
                align-items: center;
                margin-top: 20px;
                list-style: none;
                padding: 0;
        }

        .pagination li {
            margin: 0 5px;
        }

        .pagination a, .pagination span {
            display: inline-block;
            padding: 8px 12px;
            font-size: 1rem;
            font-weight: 500;
            color: #007bff;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 5px;
            text-decoration: none;
            transition: all 0.3s;
        }

        .pagination a:hover {
            background-color: #007bff;
            color: #fff;
        }

        .pagination .active span {
            background-color: #007bff;
            color: #fff;
            border-color: #007bff;
        }

        .pagination .disabled span {
            color: #ccc;
            background-color: #f9f9f9;
            border-color: #ddd;
            cursor: not-allowed;
        }

    </style>
</head>
@extends('layouts.app')

@section('content')

    <!-- Main Content Section -->
    <div class="container py-4">
        <h1 class="text-center mb-4">Cours Disponibles</h1>
        <div class="d-flex justify-content-end mb-4">
            <form method="GET" action="{{ route('courses.index') }}">
                <div class="input-group">
                    <select name="category" class="form-select">
                        <option value="">toutes les catégories</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->category }}" 
                                {{ request('category') == $cat->category ? 'selected' : '' }}>
                                {{ $cat->category }}
                            </option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-primary">filtrer</button>
                </div>
            </form>
        </div>
        
        <div class="row justify-content-center">
            <!-- Loop through available courses -->
            @forelse ($courses as $course)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <!-- Display "New" badge if course was created recently -->
                        @if($course->created_at > now()->subDays(10)) 
                            <span class="badge">New</span>
                        @endif
                        <!-- Improved image handling -->
                        <img src="{{ asset('storage/' . $course->thumbnail) }}" class="card-img-top" alt="{{ $course->title }} Thumbnail">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $course->title }}</h5>
                            <p class="card-text"><strong>Category:</strong> {{ $course->category }}</p>
                            <p class="card-text"><small class="text-muted"><strong>Created At:</strong> {{ $course->created_at->format('d M Y') }}</small></p>
                            <p class="card-text"><small class="text-muted"><strong>Updated At:</strong> {{ $course->updated_at->format('d M Y') }}</small></p>

                            <!-- Button to view the course details -->
                            <a href="{{ route('course.show', $course->id) }}" class="btn btn-primary mt-auto">View Course</a>
                        </div>
                    </div>
                </div>
            @empty
                <!-- Message for empty courses list -->
                <div class="col-12">
                    <div class="alert alert-info text-center">No courses available at the moment.</div>
                </div>
            @endforelse
        </div>

        <!-- Pagination links -->
        <div class="d-flex justify-content-center mt-4">
            {{ $courses->links('pagination::bootstrap-4') }}
        </div>
        
    </div>
    <div id="propos">
    <div class="container py-5">
        <h1 class="text-center mb-4">À propos de nous</h1>
        <div class="row align-items">
            <div class="col-md-6 mb-4">
                <img src="{{ asset('storage/images/image.png') }}" alt="About Us" class="img-fluid rounded shadow-sm about-image">
            </div>
            <div class="col-md-6">
                <p>
                    Bienvenue sur notre plateforme !
                    Nous sommes une équipe passionnée, déterminée à offrir des cours de haute qualité, soigneusement conçus pour répondre aux besoins uniques de chaque apprenant. Nos formateurs expérimentés sont pleinement engagés à vous fournir les outils et les connaissances nécessaires pour réussir dans vos domaines d'expertise.                    
                    
                </p>
                <p>
                    Que vous soyez débutant ou expert, vous trouverez des ressources adaptées à votre niveau. Parcourez notre catalogue de cours et commencez votre parcours d'apprentissage dès aujourd'hui !
                </p>
                <p>
                    <strong>Notre mission :</strong>Rendre l'éducation accessible à tous, partout dans le monde, en offrant des opportunités d'apprentissage adaptées à chacun.

                </p>
            </div>
        </div>
    </div>
</div>
@endsection
