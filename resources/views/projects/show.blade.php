<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $project->title }} - Portfolio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #667eea;
            --secondary-color: #764ba2;
        }
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            color: #333;
        }
        .navbar {
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .navbar-brand, .nav-link {
            color: #333 !important;
        }
        .project-header {
            background: white;
            border-radius: 20px;
            padding: 60px;
            margin-top: 100px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
        }
        .project-image {
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            max-height: 500px;
            object-fit: cover;
        }
        .tech-badge {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            padding: 8px 20px;
            border-radius: 25px;
            display: inline-block;
            margin: 5px;
        }
        .link-btn {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            padding: 12px 30px;
            border-radius: 50px;
            text-decoration: none;
            display: inline-block;
            margin: 5px;
            transition: transform 0.3s;
        }
        .link-btn:hover {
            transform: translateY(-3px);
            color: white;
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
        }
        .related-projects {
            margin-top: 80px;
        }
        .related-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            transition: transform 0.3s;
            height: 100%;
        }
        .related-card:hover {
            transform: translateY(-10px);
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('home') }}">Bishal Aryal</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}#about">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}#experience">Experience</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}#projects">Projects</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}#skills">Skills</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}#contact">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="project-header" data-aos="fade-up">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="display-4 fw-bold mb-4">{{ $project->title }}</h1>
                    <p class="lead mb-4">{{ $project->description }}</p>
                    @if($project->long_description)
                        <div class="mb-4">
                            {!! nl2br(e($project->long_description)) !!}
                        </div>
                    @endif
                    @if($project->tech_stack && count($project->tech_stack) > 0)
                        <div class="mb-4">
                            <h5 class="mb-3">Tech Stack:</h5>
                            @foreach($project->tech_stack as $tech)
                                <span class="tech-badge">{{ $tech }}</span>
                            @endforeach
                        </div>
                    @endif
                    <div class="mt-4">
                        @if($project->apple_store_url)
                            <a href="{{ $project->apple_store_url }}" target="_blank" class="link-btn">
                                <i class="bi bi-apple"></i> App Store
                            </a>
                        @endif
                        @if($project->google_play_url)
                            <a href="{{ $project->google_play_url }}" target="_blank" class="link-btn">
                                <i class="bi bi-google-play"></i> Google Play
                            </a>
                        @endif
                        @if($project->website_url)
                            <a href="{{ $project->website_url }}" target="_blank" class="link-btn">
                                <i class="bi bi-globe"></i> Website
                            </a>
                        @endif
                        @if($project->github_url)
                            <a href="{{ $project->github_url }}" target="_blank" class="link-btn">
                                <i class="bi bi-github"></i> GitHub
                            </a>
                        @endif
                    </div>
                </div>
                @if($project->image)
                    <div class="col-lg-6 text-center">
                        <img src="{{ Storage::url($project->image) }}" alt="{{ $project->title }}" class="img-fluid project-image">
                    </div>
                @endif
            </div>
        </div>

        @if($relatedProjects->count() > 0)
            <div class="related-projects">
                <h2 class="text-center mb-5 fw-bold">Related Projects</h2>
                <div class="row">
                    @foreach($relatedProjects as $related)
                        <div class="col-md-4 mb-4" data-aos="fade-up">
                            <div class="related-card">
                                @if($related->image)
                                    <img src="{{ Storage::url($related->image) }}" class="card-img-top" alt="{{ $related->title }}" style="height: 200px; object-fit: cover;">
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title">{{ $related->title }}</h5>
                                    <p class="card-text">{{ Str::limit($related->description, 100) }}</p>
                                    <a href="{{ route('projects.show', $related->id) }}" class="btn btn-primary">View Details</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>

    <footer class="text-center py-4 mt-5" style="background: white; margin-top: 80px;">
        <div class="container">
            <p class="text-muted mb-0">&copy; 2025 Bishal Aryal. All Rights Reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({ duration: 800, once: true });
    </script>
</body>
</html>


