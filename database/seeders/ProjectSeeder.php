<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = [
            [
                'title' => 'VoiceStamp – Intelligent Audio System',
                'description' => 'Developed a custom .vst file format for unified audio/image/drawing storage and integrated OpenAI Whisper API for transcription.',
                'long_description' => 'VoiceStamp is an innovative audio system that allows users to store audio, images, and drawings in a unified custom file format. The system integrates OpenAI Whisper API for intelligent transcription, making it easy to convert audio to text. Built with Flutter for cross-platform compatibility and AWS S3 for reliable cloud storage.',
                'tech_stack' => ['Flutter', 'Whisper API', 'AWS S3'],
                'apple_store_url' => 'https://apps.apple.com/us/app/voice-stamps/id6746640716',
                'google_play_url' => null,
                'website_url' => null,
                'github_url' => null,
                'is_featured' => true,
                'order' => 1,
            ],
            [
                'title' => 'eSawari – Ride Sharing Platform',
                'description' => 'A ride-booking and sharing application for the Nepali market with real-time location tracking and map integration.',
                'long_description' => 'eSawari is a comprehensive ride-sharing platform designed specifically for the Nepali market. The app features real-time location tracking, seamless map integration using Google Maps API, and a user-friendly interface for both drivers and passengers. Built with Flutter and powered by Firebase for real-time data synchronization.',
                'tech_stack' => ['Flutter', 'Firebase', 'Google Maps'],
                'apple_store_url' => null,
                'google_play_url' => 'https://play.google.com/store/apps/details?id=com.ridenp',
                'website_url' => null,
                'github_url' => null,
                'is_featured' => true,
                'order' => 2,
            ],
            [
                'title' => 'GuitarHub – Music Learning App',
                'description' => 'An independent project to help users learn guitar and connect with a community, featuring video lessons and tabs.',
                'long_description' => 'GuitarHub is an independent music learning application that helps users learn guitar through comprehensive video lessons, interactive tabs, and a vibrant community of musicians. The app provides a platform for guitar enthusiasts to share their progress, learn new techniques, and connect with fellow learners.',
                'tech_stack' => ['Flutter', 'Supabase'],
                'apple_store_url' => null,
                'google_play_url' => 'https://play.google.com/store/apps/details?id=com.guitarhub.guitarhub',
                'website_url' => null,
                'github_url' => null,
                'is_featured' => false,
                'order' => 3,
            ],
            [
                'title' => 'Emotion-Based Music Chatbot',
                'description' => 'An NLP chatbot that detects user emotions and recommends songs using cosine similarity with the Spotify Million Song Dataset.',
                'long_description' => 'This innovative chatbot uses natural language processing to detect user emotions from text input and recommends songs accordingly. The system uses cosine similarity algorithms to match user emotions with songs from the Spotify Million Song Dataset, providing personalized music recommendations. Built with Python, FastAPI, and GPT-2 for intelligent conversation handling.',
                'tech_stack' => ['Python', 'FastAPI', 'GPT-2'],
                'apple_store_url' => null,
                'google_play_url' => null,
                'website_url' => null,
                'github_url' => null,
                'is_featured' => false,
                'order' => 4,
            ],
            [
                'title' => 'WhyNew – Bidding Platform',
                'description' => 'A platform for buying/selling refurbished smartphones through bidding. Developed mobile frontend and backend integration.',
                'long_description' => 'WhyNew is a comprehensive bidding platform for refurbished smartphones. Users can buy and sell devices through an engaging bidding system. The platform features secure payment processing, real-time bidding updates, and a robust backend system. Developed with Flutter for the mobile frontend and Laravel for the backend API, integrated with Firebase for real-time notifications.',
                'tech_stack' => ['Flutter', 'Laravel', 'Firebase'],
                'apple_store_url' => null,
                'google_play_url' => 'https://play.google.com/store/apps/details?id=com.whynew.ms',
                'website_url' => null,
                'github_url' => null,
                'is_featured' => false,
                'order' => 5,
            ],
            [
                'title' => 'FitNep.org – Fitness & Wellness',
                'description' => 'A fitness platform focused on diet planning for Nepali users, including workout tracking and a BMI calculator.',
                'long_description' => 'FitNep.org is a comprehensive fitness and wellness platform designed specifically for Nepali users. The platform offers personalized diet planning, workout tracking, BMI calculator, and health tips tailored to the Nepali lifestyle. Built with Laravel, the platform provides a user-friendly interface for managing fitness goals and tracking progress.',
                'tech_stack' => ['Laravel'],
                'apple_store_url' => null,
                'google_play_url' => null,
                'website_url' => 'https://fitnep.org',
                'github_url' => null,
                'is_featured' => false,
                'order' => 6,
            ],
        ];

        foreach ($projects as $project) {
            Project::create($project);
        }
    }
}
