# Portfolio Website - Bishal A.

A modern, professional portfolio website built with pure HTML and CSS. Designed to be deployed on GitHub Pages without any framework dependencies.

## Features

- ✅ Pure HTML/CSS - No React or JavaScript frameworks required
- ✅ Responsive design - Works on all devices
- ✅ Modern, clean UI matching professional portfolio standards
- ✅ GitHub Pages ready - Works directly with static hosting
- ✅ Top 1% design quality with attention to detail

## Structure

```
portfolio-website/
├── index.html          # Main HTML file (root level for GitHub Pages)
├── public/
│   ├── index.html      # Alternative HTML file location
│   ├── style.css       # Main stylesheet
│   └── assets/         # Images and assets
└── README.md
```

## Deployment to GitHub Pages

1. Push your code to a GitHub repository
2. Go to repository Settings → Pages
3. Select the branch (usually `main` or `master`)
4. Select the folder:
   - If `index.html` is in root: Select `/ (root)`
   - If `index.html` is in `public`: Select `/public`
5. Your site will be live at `https://yourusername.github.io/repository-name`

## Customization

### Update Profile Information
Edit `index.html` and modify:
- Profile name and location
- Professional title and hourly rate
- About section content
- Portfolio projects
- Skills list

### Update Images
Replace placeholder images:
- Profile picture: Update the `src` attribute in the profile header
- Portfolio images: Replace placeholder URLs with your actual project screenshots

### Styling
All styles are in `public/style.css`. Key variables at the top:
- `--primary-green`: Main accent color
- `--text-primary`: Main text color
- `--bg-white`: Background color

## Browser Support

- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)

## License

This portfolio template is free to use and modify for personal and commercial projects.
