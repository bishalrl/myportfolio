<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bishal Aryal - Professional Portfolio</title>

    <!-- Google Fonts (Poppins) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- AOS (Animate on Scroll) CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        :root {
            --primary-color: #667eea;
            --secondary-color: #764ba2;
            --accent-color: #f093fb;
            --text-dark: #2d3748;
            --text-light: #718096;
            --bg-light: #f7fafc;
            --white: #ffffff;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--white);
            color: var(--text-dark);
            overflow-x: hidden;
            position: relative;
        }

        /* Loading Animation */
        .page-loader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            transition: opacity 0.5s ease, visibility 0.5s ease;
        }

        .page-loader.hidden {
            opacity: 0;
            visibility: hidden;
        }

        .loader-spinner {
            width: 50px;
            height: 50px;
            border: 5px solid rgba(255, 255, 255, 0.3);
            border-top-color: white;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Navbar Enhancements */
        .navbar {
            background-color: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(20px);
            box-shadow: 0 2px 30px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
            padding: 15px 0;
        }

        .navbar.scrolled {
            box-shadow: 0 4px 30px rgba(0,0,0,0.12);
            padding: 10px 0;
        }

        .navbar-brand {
            color: var(--text-dark) !important;
            font-weight: 700;
            font-size: 1.5rem;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            transition: all 0.3s ease;
        }

        .navbar-brand:hover {
            transform: scale(1.05);
        }

        .nav-link {
            color: var(--text-dark) !important;
            font-weight: 500;
            margin: 0 10px;
            position: relative;
            transition: all 0.3s ease;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 50%;
            transform: translateX(-50%) scaleX(0);
            width: 0;
            height: 2px;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            transition: all 0.3s ease;
        }

        .nav-link:hover::after {
            width: 100%;
            transform: translateX(-50%) scaleX(1);
        }

        .nav-link:hover {
            color: var(--primary-color) !important;
        }

        .section {
            padding: 120px 0;
            position: relative;
        }

        /* About Section Enhancements */
        #about {
            padding-top: 150px;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            border: none;
            font-weight: 600;
            padding: 15px 40px;
            border-radius: 50px;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
            position: relative;
            overflow: hidden;
        }

        .btn-primary::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }

        .btn-primary:hover::before {
            width: 300px;
            height: 300px;
        }

        .btn-primary:hover {
            transform: translateY(-5px) scale(1.05);
            box-shadow: 0 15px 40px rgba(102, 126, 234, 0.4);
        }

        .btn-sm {
            padding: 10px 25px;
            font-size: 0.9rem;
        }

        h2.section-title {
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 60px;
            text-align: center;
            font-size: 2.8rem;
            position: relative;
            display: inline-block;
            width: 100%;
        }

        h2.section-title::after {
            content: '';
            position: absolute;
            bottom: -15px;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 5px;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            border-radius: 3px;
            animation: expandLine 1s ease-out;
        }

        @keyframes expandLine {
            from {
                width: 0;
            }
            to {
                width: 100px;
            }
        }

        /* Expertise Section Enhancements */
        .expertise-section {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            padding: 120px 0;
            position: relative;
            overflow: hidden;
        }

        .expertise-section::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 100%;
            height: 200%;
            background: radial-gradient(circle, rgba(102, 126, 234, 0.1) 0%, transparent 70%);
            animation: float 20s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translate(0, 0) rotate(0deg); }
            50% { transform: translate(-30px, -30px) rotate(180deg); }
        }

        .expertise-card {
            background: white;
            border-radius: 25px;
            padding: 45px 35px;
            text-align: center;
            box-shadow: 0 10px 40px rgba(0,0,0,0.08);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            height: 100%;
            border: 2px solid transparent;
            position: relative;
            overflow: hidden;
        }

        .expertise-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(102, 126, 234, 0.1), transparent);
            transition: left 0.5s;
        }

        .expertise-card:hover::before {
            left: 100%;
        }

        .expertise-card:hover {
            transform: translateY(-15px) scale(1.02);
            box-shadow: 0 25px 60px rgba(102, 126, 234, 0.25);
            border-color: var(--primary-color);
        }

        .expertise-icon {
            font-size: 4rem;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 25px;
            display: inline-block;
            transition: all 0.3s ease;
        }

        .expertise-card:hover .expertise-icon {
            transform: scale(1.2) rotate(5deg);
        }

        .expertise-card h4 {
            color: var(--text-dark);
            font-weight: 600;
            margin-bottom: 18px;
            font-size: 1.3rem;
        }

        .expertise-card p {
            color: var(--text-light);
            line-height: 1.9;
            font-size: 0.95rem;
        }

        /* Timeline Enhancements */
        .timeline {
            position: relative;
            padding: 0;
            list-style: none;
        }
        .timeline:before {
            content: '';
            position: absolute;
            top: 0;
            bottom: 0;
            left: 50%;
            width: 4px;
            margin-left: -2px;
            background: linear-gradient(180deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            box-shadow: 0 0 20px rgba(102, 126, 234, 0.3);
        }
        .timeline-item {
            position: relative;
            margin-bottom: 60px;
        }
        .timeline-item .timeline-content {
            position: relative;
            width: 45%;
            padding: 35px;
            background: white;
            border-radius: 20px;
            box-shadow: 0 15px 40px rgba(0,0,0,0.1);
            transition: all 0.4s ease;
            border-left: 4px solid transparent;
        }
        .timeline-item .timeline-content:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 20px 50px rgba(102, 126, 234, 0.25);
            border-left-color: var(--primary-color);
        }
        .timeline-item:nth-child(odd) .timeline-content {
            left: 5%;
        }
        .timeline-item:nth-child(even) .timeline-content {
            left: 50%;
        }
        .timeline-item .timeline-icon {
            position: absolute;
            top: 35px;
            left: 50%;
            transform: translateX(-50%);
            width: 35px;
            height: 35px;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            border-radius: 50%;
            border: 6px solid white;
            box-shadow: 0 0 0 4px var(--primary-color), 0 0 20px rgba(102, 126, 234, 0.4);
            transition: all 0.3s ease;
        }
        .timeline-item:hover .timeline-icon {
            transform: translateX(-50%) scale(1.2);
            box-shadow: 0 0 0 4px var(--primary-color), 0 0 30px rgba(102, 126, 234, 0.6);
        }
        .timeline-item .timeline-period {
            position: absolute;
            top: 33px;
            width: 45%;
            text-align: right;
            font-weight: 600;
            color: var(--primary-color);
            font-size: 0.95rem;
        }
        .timeline-item:nth-child(odd) .timeline-period {
            left: 0;
            text-align: right;
            padding-right: 90px;
        }
        .timeline-item:nth-child(even) .timeline-period {
            left: 50%;
            text-align: left;
            padding-left: 90px;
        }
        .timeline-item h5 {
            color: var(--text-dark);
            font-weight: 600;
            font-size: 1.2rem;
            margin-bottom: 8px;
        }
        .timeline-item h6 {
            color: var(--primary-color);
            font-weight: 500;
            margin-bottom: 12px;
        }

        /* CV Download Section */
        .cv-download-section {
            background: linear-gradient(135deg, #f5f7fa 0%, #e2e8f0 100%);
            border-radius: 20px;
            padding: 30px;
            margin: 40px 0;
            text-align: center;
        }

        .cv-download-btn {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            padding: 15px 40px;
            border-radius: 50px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            font-weight: 600;
            transition: all 0.4s ease;
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
        }

        .cv-download-btn:hover {
            transform: translateY(-5px) scale(1.05);
            box-shadow: 0 15px 40px rgba(102, 126, 234, 0.4);
            color: white;
        }

        .cv-download-btn i {
            font-size: 1.2rem;
        }

        /* Project Card Enhancements - Mobile Mockup Style */
        .project-card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 15px;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            height: 100%;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            position: relative;
        }

        .project-card:hover {
            transform: translateY(-10px);
            border-color: var(--primary-color);
            box-shadow: 0 20px 50px rgba(102, 126, 234, 0.2);
        }

        .project-card .card-body {
            display: flex;
            flex-direction: column;
            padding: 25px;
            position: relative;
            z-index: 1;
        }

        .project-card .card-title {
            color: var(--text-dark);
            font-weight: 600;
            margin-bottom: 15px;
            font-size: 1.2rem;
            transition: color 0.3s ease;
        }

        .project-card:hover .card-title {
            color: var(--primary-color);
        }

        .project-card .card-text {
            flex-grow: 1;
            color: var(--text-light);
            line-height: 1.8;
            margin-bottom: 20px;
            font-size: 0.95rem;
        }

        .project-card .tech-stack {
            margin-bottom: 20px;
        }

        .project-card .tech-stack span {
            background: #f0f4f8;
            color: var(--text-dark);
            border-radius: 20px;
            padding: 5px 15px;
            font-size: 0.8em;
            font-weight: 500;
            margin: 3px;
            display: inline-block;
            transition: all 0.3s ease;
        }

        .project-card:hover .tech-stack span {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            transform: translateY(-2px);
        }

        .project-card .project-link {
            font-size: 1.5rem;
            color: var(--text-light);
            transition: all 0.3s ease;
            margin-left: 10px;
            display: inline-block;
        }

        .project-card .project-link:hover {
            color: var(--primary-color);
            transform: scale(1.3) rotate(10deg);
        }

        /* Mobile Phone Mockup Container */
        .phone-mockup-container {
            background: #f8f9fa;
            padding: 30px 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 15px;
            min-height: 350px;
            position: relative;
        }

        .phone-mockup {
            width: 120px;
            height: 240px;
            background: #1a1a1a;
            border-radius: 25px;
            padding: 8px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            position: relative;
            transition: all 0.4s ease;
        }

        .phone-mockup::before {
            content: '';
            position: absolute;
            top: 8px;
            left: 50%;
            transform: translateX(-50%);
            width: 50px;
            height: 6px;
            background: #333;
            border-radius: 3px;
        }

        .phone-mockup::after {
            content: '';
            position: absolute;
            bottom: 8px;
            left: 50%;
            transform: translateX(-50%);
            width: 40px;
            height: 40px;
            background: #333;
            border-radius: 50%;
        }

        .phone-mockup:hover {
            transform: translateY(-10px) scale(1.05);
            box-shadow: 0 15px 40px rgba(0,0,0,0.4);
        }

        .phone-screen {
            width: 100%;
            height: 100%;
            border-radius: 18px;
            overflow: hidden;
            background: white;
        }

        .phone-screen img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* If single image, make it larger */
        .phone-mockup-container.single-phone .phone-mockup {
            width: 150px;
            height: 300px;
        }

        .phone-mockup-container.double-phone .phone-mockup {
            width: 130px;
            height: 260px;
        }

        .phone-mockup-container.triple-phone .phone-mockup {
            width: 110px;
            height: 220px;
        }

        @media (max-width: 768px) {
            .phone-mockup-container {
                padding: 20px 10px;
                gap: 10px;
                min-height: 280px;
            }

            .phone-mockup-container.single-phone .phone-mockup {
                width: 120px;
                height: 240px;
            }

            .phone-mockup-container.double-phone .phone-mockup {
                width: 100px;
                height: 200px;
            }

            .phone-mockup-container.triple-phone .phone-mockup {
                width: 85px;
                height: 170px;
            }
        }

        /* Skills Enhancements */
        .skill-badge {
            background: white;
            border: 2px solid #e2e8f0;
            color: var(--text-dark);
            padding: 14px 28px;
            border-radius: 50px;
            font-weight: 500;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            display: inline-block;
            margin: 10px;
            position: relative;
            overflow: hidden;
        }

        .skill-badge::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            transform: translate(-50%, -50%);
            transition: width 0.4s, height 0.4s;
        }

        .skill-badge:hover::before {
            width: 300px;
            height: 300px;
        }

        .skill-badge span {
            position: relative;
            z-index: 1;
        }

        .skill-badge:hover {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            border-color: var(--primary-color);
            color: white;
            transform: translateY(-5px) scale(1.1);
            box-shadow: 0 15px 35px rgba(102, 126, 234, 0.4);
        }

        /* Contact Section Enhancements */
        .contact-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            position: relative;
            overflow: hidden;
        }

        .contact-section::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
            animation: rotate 20s linear infinite;
        }

        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        .contact-section .section-title {
            color: white !important;
        }

        .contact-section .section-title::after {
            background: white;
        }

        .contact-card {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            border-radius: 25px;
            padding: 40px;
            text-align: center;
            transition: all 0.4s ease;
            border: 2px solid rgba(255, 255, 255, 0.2);
            position: relative;
            z-index: 1;
            margin: 20px;
        }

        .contact-card:hover {
            transform: translateY(-10px) scale(1.05);
            background: rgba(255, 255, 255, 0.25);
            border-color: rgba(255, 255, 255, 0.4);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.2);
        }

        .contact-card-icon {
            font-size: 3.5rem;
            margin-bottom: 20px;
            display: inline-block;
            transition: all 0.3s ease;
        }

        .contact-card:hover .contact-card-icon {
            transform: scale(1.2) rotate(10deg);
        }

        .contact-card h5 {
            font-weight: 600;
            margin-bottom: 15px;
            font-size: 1.3rem;
        }

        .contact-card a {
            color: white;
            text-decoration: none;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            display: inline-block;
        }

        .contact-card a:hover {
            transform: scale(1.1);
            text-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
        }

        .contact-icon {
            font-size: 3.5rem;
            color: white;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            display: inline-block;
            margin: 0 20px;
        }
        .contact-icon:hover {
            color: white;
            transform: scale(1.3) rotate(15deg);
            filter: drop-shadow(0 0 15px rgba(255, 255, 255, 0.8));
        }
        
        footer {
            background: linear-gradient(135deg, #2d3748 0%, #1a202c 100%);
            padding: 40px 0;
            text-align: center;
            color: white;
            position: relative;
        }

        .section-bg {
            background: var(--bg-light);
            position: relative;
        }

        /* Smooth Scroll Indicator */
        .scroll-indicator {
            position: fixed;
            top: 0;
            left: 0;
            width: 0%;
            height: 4px;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            z-index: 10000;
            transition: width 0.1s ease;
        }

        /* Floating Animation */
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }

        .floating {
            animation: float 3s ease-in-out infinite;
        }

        @media (max-width: 768px) {
            .section {
                padding: 80px 0;
            }

            #about {
                padding-top: 120px;
            }

            h2.section-title {
                font-size: 2rem;
            }

            .timeline:before {
                left: 20px;
            }
            .timeline-item .timeline-content,
            .timeline-item:nth-child(odd) .timeline-content,
            .timeline-item:nth-child(even) .timeline-content {
                width: calc(100% - 60px);
                left: 60px !important;
            }
            .timeline-item .timeline-period {
                left: 0 !important;
                text-align: left !important;
                padding-left: 60px !important;
                padding-right: 0 !important;
            }
            .timeline-item .timeline-icon {
                left: 20px;
            }

            .contact-card {
                margin: 15px 0;
            }
        }
    </style>
</head>
<body>

    <!-- Page Loader -->
    <div class="page-loader" id="pageLoader">
        <div class="loader-spinner"></div>
    </div>

    <!-- Scroll Indicator -->
    <div class="scroll-indicator" id="scrollIndicator"></div>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="navbar">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#about">Bishal Aryal</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="#expertise">Expertise</a></li>
                    <li class="nav-item"><a class="nav-link" href="#experience">Experience</a></li>
                    <li class="nav-item"><a class="nav-link" href="#projects">Projects</a></li>
                    <li class="nav-item"><a class="nav-link" href="#skills">Skills</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- About Section -->
    <section id="about" class="section">
        <div class="container">
            <h2 class="section-title" data-aos="fade-up">Professional Summary</h2>
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center" data-aos="fade-up" data-aos-delay="100">
                    <p class="lead" style="color: var(--text-light); line-height: 1.9; font-size: 1.1rem;">
                        Experienced Mobile App Developer and AI Engineer specializing in designing, developing, and deploying high-performance applications across Android, iOS, and web platforms. Proven ability to contribute to startups and international projects, delivering innovative and intelligent solutions.
                    </p>
                    <!-- CV Download Section -->
                    <div class="cv-download-section" data-aos="fade-up" data-aos-delay="200">
                        <h4 style="color: var(--text-dark); margin-bottom: 20px; font-weight: 600;">Download My Resume</h4>
                        <a href="/cv/Bishal_Aryal_CV.pdf" download class="cv-download-btn">
                            <i class="bi bi-download"></i>
                            Download CV
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Expertise Section -->
    <section id="expertise" class="expertise-section">
        <div class="container">
            <h2 class="section-title" data-aos="fade-up" style="color: var(--text-dark);">What I Offer</h2>
            <p class="text-center mb-5" style="color: var(--text-light); font-size: 1.15rem;" data-aos="fade-up" data-aos-delay="100">
                My expertise spans across multiple domains, enabling me to deliver comprehensive solutions
            </p>
            <div class="row g-4">
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="expertise-card">
                        <div class="expertise-icon">
                            <i class="bi bi-phone"></i>
                        </div>
                        <h4>Mobile Development</h4>
                        <p>Cross-platform mobile app development using Flutter, creating native-like experiences for both iOS and Android platforms.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="expertise-card">
                        <div class="expertise-icon">
                            <i class="bi bi-code-slash"></i>
                        </div>
                        <h4>Web Development</h4>
                        <p>Full-stack web development with Laravel, building scalable and robust web applications with modern frameworks.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="expertise-card">
                        <div class="expertise-icon">
                            <i class="bi bi-cpu"></i>
                        </div>
                        <h4>AI Integration</h4>
                        <p>AI-powered solutions using OpenAI APIs, machine learning models, and intelligent automation for enhanced user experiences.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="expertise-card">
                        <div class="expertise-icon">
                            <i class="bi bi-cloud"></i>
                        </div>
                        <h4>Cloud Services</h4>
                        <p>Cloud infrastructure management with AWS, Firebase, and Supabase for scalable and reliable backend solutions.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="500">
                    <div class="expertise-card">
                        <div class="expertise-icon">
                            <i class="bi bi-database"></i>
                        </div>
                        <h4>Database Design</h4>
                        <p>Database architecture and optimization using PostgreSQL, MySQL, and NoSQL solutions for efficient data management.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="600">
                    <div class="expertise-card">
                        <div class="expertise-icon">
                            <i class="bi bi-tools"></i>
                        </div>
                        <h4>API Integration</h4>
                        <p>RESTful API development and third-party integrations including payment gateways, maps, and various service APIs.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Experience Section -->
    <section id="experience" class="section section-bg">
        <div class="container">
            <h2 class="section-title" data-aos="fade-up">Professional Experience</h2>
            <ul class="timeline">
                <!-- Experience Item 1 -->
                <li class="timeline-item" data-aos="fade-right">
                    <div class="timeline-icon"></div>
                    <div class="timeline-period">Jan 2025 - Present</div>
                    <div class="timeline-content">
                        <h5>Software Engineer (AI & Integration)</h5>
                        <h6>CayCapital (England)</h6>
                        <p>Integrated AI-based transcription and file management systems, implemented secure payment gateways, and collaborated with UK-based teams on international products.</p>
                    </div>
                </li>
                <!-- Experience Item 2 -->
                <li class="timeline-item" data-aos="fade-left">
                    <div class="timeline-icon"></div>
                    <div class="timeline-period">Sep 2023 – Dec 2024</div>
                    <div class="timeline-content">
                        <h5>Software Developer (Mobile)</h5>
                        <h6>Matinsoftech Pvt. Ltd. (Nepal)</h6>
                        <p>Developed and maintained production-level mobile applications using Flutter, REST APIs, and Firebase for ride-sharing, e-commerce, and bidding platforms.</p>
                    </div>
                </li>
            </ul>
        </div>
    </section>

    <!-- Projects Section -->
    <section id="projects" class="section">
        <div class="container">
            <h2 class="section-title" data-aos="fade-up">Portfolio</h2>
            <div class="row gy-4">
                @forelse($projects as $project)
                    <div class="col-lg-6 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                        <div class="card project-card">
                            <!-- Mobile Phone Mockup Container -->
                            @if($project->image)
                                <div class="phone-mockup-container {{ count($project->tech_stack ?? []) > 3 ? 'triple-phone' : (count($project->tech_stack ?? []) > 1 ? 'double-phone' : 'single-phone') }}">
                                    @php
                                        // For now, show the same image multiple times to simulate multiple screens
                                        // In production, you'd want to store multiple images per project
                                        $imageCount = min(3, max(1, count($project->tech_stack ?? [1])));
                                    @endphp
                                    @for($i = 0; $i < $imageCount; $i++)
                                        <div class="phone-mockup">
                                            <div class="phone-screen">
                                                <img src="{{ Storage::url($project->image) }}" alt="{{ $project->title }} - Screen {{ $i + 1 }}">
                                            </div>
                                        </div>
                                    @endfor
                                </div>
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ $project->title }}</h5>
                                <p class="card-text">{{ Str::limit($project->description, 150) }}</p>
                                @if($project->tech_stack && count($project->tech_stack) > 0)
                                    <div class="tech-stack mb-3">
                                        @foreach($project->tech_stack as $tech)
                                            <span>{{ $tech }}</span>
                                        @endforeach
                                    </div>
                                @endif
                                <div class="mt-auto d-flex justify-content-between align-items-center flex-wrap gap-2">
                                    <a href="{{ route('projects.show', $project->id) }}" class="btn btn-sm btn-primary">View Details</a>
                                    <div>
                                        @if($project->apple_store_url)
                                            <a href="{{ $project->apple_store_url }}" target="_blank" class="project-link" title="App Store"><i class="bi bi-apple"></i></a>
                                        @endif
                                        @if($project->google_play_url)
                                            <a href="{{ $project->google_play_url }}" target="_blank" class="project-link" title="Google Play"><i class="bi bi-google-play"></i></a>
                                        @endif
                                        @if($project->website_url)
                                            <a href="{{ $project->website_url }}" target="_blank" class="project-link" title="Website"><i class="bi bi-globe"></i></a>
                                        @endif
                                        @if($project->github_url)
                                            <a href="{{ $project->github_url }}" target="_blank" class="project-link" title="GitHub"><i class="bi bi-github"></i></a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p class="lead" style="color: var(--text-light);">No projects available yet. Check back soon!</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Skills Section -->
    <section id="skills" class="section section-bg">
        <div class="container">
            <h2 class="section-title" data-aos="fade-up">Technical Expertise</h2>
            <div class="text-center" data-aos="fade-up" data-aos-delay="100">
                <span class="badge rounded-pill skill-badge"><span>Flutter</span></span>
                <span class="badge rounded-pill skill-badge"><span>Laravel</span></span>
                <span class="badge rounded-pill skill-badge"><span>Firebase</span></span>
                <span class="badge rounded-pill skill-badge"><span>Supabase</span></span>
                <span class="badge rounded-pill skill-badge"><span>PostgreSQL</span></span>
                <span class="badge rounded-pill skill-badge"><span>MySQL</span></span>
                <span class="badge rounded-pill skill-badge"><span>Whisper API</span></span>
                <span class="badge rounded-pill skill-badge"><span>TensorFlow</span></span>
                <span class="badge rounded-pill skill-badge"><span>PyTorch</span></span>
                <span class="badge rounded-pill skill-badge"><span>AWS S3</span></span>
                <span class="badge rounded-pill skill-badge"><span>Stripe API</span></span>
                <span class="badge rounded-pill skill-badge"><span>Google Maps API</span></span>
                <span class="badge rounded-pill skill-badge"><span>Git & GitHub</span></span>
                <span class="badge rounded-pill skill-badge"><span>Figma</span></span>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="section contact-section">
        <div class="container text-center">
            <h2 class="section-title" data-aos="fade-up">Get In Touch</h2>
            <p class="lead mb-5" style="font-size: 1.2rem; opacity: 0.95;" data-aos="fade-up" data-aos-delay="100">
                I'm currently available for freelance work and new opportunities.
            </p>
            <div class="row justify-content-center mb-5">
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="contact-card">
                        <div class="contact-card-icon">
                            <i class="bi bi-envelope-fill"></i>
                        </div>
                        <h5>Email</h5>
                        <a href="mailto:aryalbishal9876@gmail.com">aryalbishal9876@gmail.com</a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="contact-card">
                        <div class="contact-card-icon">
                            <i class="bi bi-telephone-fill"></i>
                        </div>
                        <h5>Phone</h5>
                        <a href="tel:+9779864434255">+977-9864434255</a>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center mt-4" data-aos="fade-up" data-aos-delay="400">
                <div class="col-auto">
                    <a href="https://github.com/bishalrl" target="_blank" class="contact-icon"><i class="bi bi-github"></i></a>
                </div>
                <div class="col-auto">
                    <a href="https://www.linkedin.com/in/bishal-aryal-8570671aa/" target="_blank" class="contact-icon"><i class="bi bi-linkedin"></i></a>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Footer -->
    <footer>
        <div class="container">
            <p>&copy; 2025 Bishal Aryal. All Rights Reserved.</p>
        </div>
    </footer>

    <!-- Bootstrap 5.3 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- AOS (Animate on Scroll) JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    
    <script>
        // Page Loader
        window.addEventListener('load', function() {
            const loader = document.getElementById('pageLoader');
            setTimeout(() => {
                loader.classList.add('hidden');
            }, 500);
        });

        // Initialize AOS
        AOS.init({
            duration: 1000,
            once: true,
            offset: 100,
            easing: 'ease-out-cubic'
        });

        // Navbar scroll effect
        const navbar = document.getElementById('navbar');
        window.addEventListener('scroll', function() {
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Scroll Indicator
        const scrollIndicator = document.getElementById('scrollIndicator');
        window.addEventListener('scroll', function() {
            const windowHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
            const scrolled = (window.scrollY / windowHeight) * 100;
            scrollIndicator.style.width = scrolled + '%';
        });

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Add floating animation to expertise icons
        const expertiseIcons = document.querySelectorAll('.expertise-icon');
        expertiseIcons.forEach((icon, index) => {
            icon.style.animationDelay = `${index * 0.2}s`;
        });
    </script>

</body>
</html>
