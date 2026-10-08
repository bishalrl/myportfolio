import './style.css';
import 'lenis/dist/lenis.css';
import Lenis from 'lenis';
import { setupNav } from './ui/nav.js';

const words = ['shipped', 'native', 'reliable', 'polished', 'scalable'];
const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

function startClock() {
  const clock = document.querySelector('#clock');
  if (!clock) return;
  const format = new Intl.DateTimeFormat('en-GB', {
    hour: '2-digit',
    minute: '2-digit',
    second: '2-digit',
    hour12: false,
    timeZone: 'Asia/Kathmandu',
  });
  const paint = () => {
    clock.textContent = format.format(new Date());
    clock.dateTime = new Date().toISOString();
  };
  paint();
  window.setInterval(paint, 1000);
}

function startWords() {
  const el = document.querySelector('#word');
  if (!el || reducedMotion) return;
  let index = 0;
  window.setInterval(() => {
    el.classList.add('is-out');
    window.setTimeout(() => {
      index = (index + 1) % words.length;
      el.textContent = words[index];
      el.classList.remove('is-out');
    }, 280);
  }, 2400);
}

function boot() {
  let lenis = null;
  if (!reducedMotion) {
    lenis = new Lenis({ autoRaf: true, smoothWheel: true });
  }
  setupNav(lenis);
  startClock();
  startWords();
}

boot();
