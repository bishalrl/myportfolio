import './style.css';
import 'lenis/dist/lenis.css';
import Lenis from 'lenis';
import gsap from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';
import WebGL from 'three/addons/capabilities/WebGL.js';
import { loadAssets } from './3d/textures.js';
import { detectCapabilities, Experience } from './3d/Experience.js';
import { setupNav } from './ui/nav.js';

gsap.registerPlugin(ScrollTrigger);

const loader = document.querySelector('.loader');
const loaderBar = document.querySelector('.loader-bar span');
const canvas = document.querySelector('#webgl');

function webglAvailable() {
  return WebGL.isWebGLAvailable();
}

function hideLoader() {
  document.body.classList.add('is-ready');
  loader?.classList.add('is-hidden');
}

function setupScroll(experience, reducedMotion) {
  let lenis = null;
  if (!reducedMotion) {
    lenis = new Lenis({ autoRaf: false, smoothWheel: true });
    lenis.on('scroll', ScrollTrigger.update);
    gsap.ticker.add((time) => {
      lenis.raf(time * 1000);
    });
    gsap.ticker.lagSmoothing(0);
  }

  const syncProgress = () => {
    if (lenis) {
      experience?.setProgress(lenis.progress);
      return;
    }
    const max = document.documentElement.scrollHeight - window.innerHeight;
    experience?.setProgress(max > 0 ? window.scrollY / max : 0);
  };

  if (lenis) lenis.on('scroll', syncProgress);
  else window.addEventListener('scroll', syncProgress, { passive: true });
  window.addEventListener('resize', () => {
    experience?.path.refresh();
    ScrollTrigger.refresh();
    syncProgress();
  });

  document.querySelectorAll('.panel').forEach((panel) => {
    gsap.from(panel, {
      opacity: 0,
      y: reducedMotion ? 0 : 36,
      duration: reducedMotion ? 0.01 : 0.8,
      ease: 'power2.out',
      scrollTrigger: {
        trigger: panel,
        start: 'top 85%',
        toggleActions: 'play none none reverse',
      },
    });
  });

  setupNav(lenis);
  syncProgress();
  return lenis;
}

async function boot() {
  const capabilities = detectCapabilities();
  document.documentElement.classList.toggle('reduced-motion', capabilities.reducedMotion);
  window.setTimeout(() => {
    if (!document.body.classList.contains('is-ready')) hideLoader();
  }, 5000);

  if (!webglAvailable()) {
    document.body.classList.add('no-webgl');
    hideLoader();
    setupScroll(null, true);
    return;
  }

  try {
    const assets = await loadAssets((ratio) => {
      if (loaderBar) loaderBar.style.width = `${Math.round(ratio * 100)}%`;
    });
    const experience = new Experience(canvas, assets, capabilities);
    setupScroll(experience, capabilities.reducedMotion);
    hideLoader();
  } catch (error) {
    console.error(error);
    document.body.classList.add('no-webgl');
    hideLoader();
    setupScroll(null, true);
  }
}

boot();
