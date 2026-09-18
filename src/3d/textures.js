import * as THREE from 'three';

const BASE = import.meta.env.BASE_URL;

function roundRect(ctx, x, y, w, h, r) {
  const radius = Math.min(r, w / 2, h / 2);
  ctx.beginPath();
  ctx.moveTo(x + radius, y);
  ctx.arcTo(x + w, y, x + w, y + h, radius);
  ctx.arcTo(x + w, y + h, x, y + h, radius);
  ctx.arcTo(x, y + h, x, y, radius);
  ctx.arcTo(x, y, x + w, y, radius);
  ctx.closePath();
}

function loadImage(url) {
  return new Promise((resolve) => {
    const img = new Image();
    img.crossOrigin = 'anonymous';
    const finish = (value) => {
      window.clearTimeout(timer);
      resolve(value);
    };
    const timer = window.setTimeout(() => finish(null), 4000);
    img.onload = () => finish(img);
    img.onerror = () => finish(null);
    img.src = url;
  });
}

function toTexture(canvas, anisotropy = 8) {
  const texture = new THREE.CanvasTexture(canvas);
  texture.colorSpace = THREE.SRGBColorSpace;
  texture.anisotropy = anisotropy;
  texture.needsUpdate = true;
  return texture;
}

export function createAppScreenTexture({
  image,
  title,
  subtitle = '',
  accent = '#3b82f6',
}) {
  const canvas = document.createElement('canvas');
  canvas.width = 768;
  canvas.height = 1664;
  const ctx = canvas.getContext('2d');

  const gradient = ctx.createLinearGradient(0, 0, 0, canvas.height);
  gradient.addColorStop(0, '#070b14');
  gradient.addColorStop(0.45, '#0f172a');
  gradient.addColorStop(1, '#020617');
  ctx.fillStyle = gradient;
  ctx.fillRect(0, 0, canvas.width, canvas.height);

  ctx.fillStyle = accent;
  ctx.globalAlpha = 0.28;
  ctx.beginPath();
  ctx.arc(384, 560, 280, 0, Math.PI * 2);
  ctx.fill();
  ctx.beginPath();
  ctx.arc(160, 1240, 180, 0, Math.PI * 2);
  ctx.fill();
  ctx.globalAlpha = 1;

  ctx.fillStyle = '#ffffff';
  ctx.font = '600 34px Inter, system-ui, sans-serif';
  ctx.textAlign = 'left';
  ctx.fillText('9:41', 48, 70);
  ctx.strokeStyle = 'rgba(255,255,255,0.9)';
  ctx.lineWidth = 3;
  roundRect(ctx, 640, 46, 78, 28, 6);
  ctx.stroke();
  ctx.fillStyle = '#22c55e';
  roundRect(ctx, 646, 51, 54, 18, 4);
  ctx.fill();

  if (image) {
    const size = 420;
    const x = 384 - size / 2;
    const y = 360;
    ctx.save();
    roundRect(ctx, x, y, size, size, 92);
    ctx.clip();
    const scale = Math.max(size / image.width, size / image.height);
    const dw = image.width * scale;
    const dh = image.height * scale;
    ctx.drawImage(image, x + (size - dw) / 2, y + (size - dh) / 2, dw, dh);
    ctx.restore();
    ctx.strokeStyle = 'rgba(255,255,255,0.18)';
    ctx.lineWidth = 4;
    roundRect(ctx, x, y, size, size, 92);
    ctx.stroke();
  } else {
    ctx.fillStyle = accent;
    roundRect(ctx, 234, 430, 300, 300, 72);
    ctx.fill();
    ctx.fillStyle = '#fff';
    ctx.font = '700 96px Inter, system-ui, sans-serif';
    ctx.textAlign = 'center';
    ctx.fillText(title.slice(0, 1), 384, 610);
  }

  ctx.textAlign = 'center';
  ctx.fillStyle = '#ffffff';
  ctx.font = '700 52px Inter, system-ui, sans-serif';
  ctx.fillText(title, 384, 920);

  ctx.fillStyle = 'rgba(255,255,255,0.68)';
  ctx.font = '400 30px Inter, system-ui, sans-serif';
  ctx.fillText(subtitle, 384, 980);

  ctx.fillStyle = 'rgba(255,255,255,0.08)';
  roundRect(ctx, 64, 1080, 640, 88, 24);
  ctx.fill();
  ctx.fillStyle = '#fff';
  ctx.font = '600 28px Inter, system-ui, sans-serif';
  ctx.fillText('Open app', 384, 1136);

  ctx.fillStyle = 'rgba(255,255,255,0.22)';
  roundRect(ctx, 284, 1578, 200, 12, 6);
  ctx.fill();

  return toTexture(canvas);
}

export function createCodeScreenTexture() {
  const canvas = document.createElement('canvas');
  canvas.width = 1024;
  canvas.height = 640;
  const ctx = canvas.getContext('2d');

  ctx.fillStyle = '#0b1220';
  ctx.fillRect(0, 0, canvas.width, canvas.height);
  ctx.fillStyle = '#111827';
  ctx.fillRect(0, 0, canvas.width, 46);
  ['#f87171', '#fbbf24', '#34d399'].forEach((color, i) => {
    ctx.fillStyle = color;
    ctx.beginPath();
    ctx.arc(22 + i * 22, 23, 7, 0, Math.PI * 2);
    ctx.fill();
  });
  ctx.fillStyle = 'rgba(255,255,255,0.55)';
  ctx.font = '500 18px ui-monospace, SFMono-Regular, Consolas, monospace';
  ctx.fillText('lib/main.dart — VoiceStamp', 96, 30);

  const lines = [
    ['keyword', 'class ', 'plain', 'VoiceStampApp ', 'keyword', 'extends ', 'plain', 'StatelessWidget {'],
    ['plain', '  @override'],
    ['keyword', '  Widget ', 'plain', 'build(BuildContext context) {'],
    ['keyword', '    return ', 'plain', 'MaterialApp('],
    ['plain', '      title: ', 'string', "'VoiceStamp'", 'plain', ','],
    ['plain', '      theme: AppTheme.dark(),'],
    ['plain', '      home: ', 'keyword', 'const ', 'plain', 'RecorderScreen(),'],
    ['plain', '    );'],
    ['plain', '  }'],
    ['plain', '}'],
    ['plain', ''],
    ['comment', '// Production Flutter · iOS & Android'],
  ];

  const palette = {
    keyword: '#7dd3fc',
    plain: '#e5e7eb',
    string: '#86efac',
    comment: '#64748b',
  };

  ctx.font = '500 22px ui-monospace, SFMono-Regular, Consolas, monospace';
  lines.forEach((parts, i) => {
    let x = 36;
    const y = 92 + i * 42;
    for (let p = 0; p < parts.length; p += 2) {
      ctx.fillStyle = palette[parts[p]] || palette.plain;
      const text = parts[p + 1];
      ctx.fillText(text, x, y);
      x += ctx.measureText(text).width;
    }
  });

  return toTexture(canvas);
}

export function createTerminalTexture() {
  const canvas = document.createElement('canvas');
  canvas.width = 1024;
  canvas.height = 640;
  const ctx = canvas.getContext('2d');
  ctx.fillStyle = '#020617';
  ctx.fillRect(0, 0, canvas.width, canvas.height);
  ctx.fillStyle = '#0f172a';
  ctx.fillRect(0, 0, canvas.width, 48);
  ctx.fillStyle = '#38bdf8';
  ctx.font = '600 20px ui-monospace, Consolas, monospace';
  ctx.fillText('contact@bishal — zsh', 24, 32);

  const rows = [
    ['#94a3b8', '$ ./connect --to bishal'],
    ['#34d399', 'email    aryalbishal9876@gmail.com'],
    ['#34d399', 'phone    +977 9864434255'],
    ['#34d399', 'location Syangja, Nepal'],
    ['#7dd3fc', 'status   open for production Flutter work'],
    ['#e2e8f0', '$ _'],
  ];
  ctx.font = '500 28px ui-monospace, Consolas, monospace';
  rows.forEach(([color, text], i) => {
    ctx.fillStyle = color;
    ctx.fillText(text, 36, 120 + i * 72);
  });

  return toTexture(canvas);
}

export function createLabelTexture(title, subtitle = '', accent = '#3b82f6') {
  const canvas = document.createElement('canvas');
  canvas.width = 512;
  canvas.height = 256;
  const ctx = canvas.getContext('2d');
  const gradient = ctx.createLinearGradient(0, 0, 512, 256);
  gradient.addColorStop(0, '#0b1220');
  gradient.addColorStop(1, '#111827');
  ctx.fillStyle = gradient;
  roundRect(ctx, 0, 0, 512, 256, 28);
  ctx.fill();
  ctx.strokeStyle = accent;
  ctx.globalAlpha = 0.55;
  ctx.lineWidth = 8;
  roundRect(ctx, 8, 8, 496, 240, 24);
  ctx.stroke();
  ctx.globalAlpha = 1;
  ctx.fillStyle = '#fff';
  ctx.font = '700 44px Inter, system-ui, sans-serif';
  ctx.textAlign = 'center';
  ctx.fillText(title, 256, 120);
  ctx.fillStyle = 'rgba(255,255,255,0.65)';
  ctx.font = '500 26px Inter, system-ui, sans-serif';
  ctx.fillText(subtitle, 256, 168);
  return toTexture(canvas, 4);
}

export function createStatTexture(value, label) {
  const canvas = document.createElement('canvas');
  canvas.width = 512;
  canvas.height = 512;
  const ctx = canvas.getContext('2d');
  ctx.fillStyle = '#0b1220';
  roundRect(ctx, 0, 0, 512, 512, 48);
  ctx.fill();
  ctx.fillStyle = '#3b82f6';
  ctx.font = '800 140px Inter, system-ui, sans-serif';
  ctx.textAlign = 'center';
  ctx.fillText(value, 256, 250);
  ctx.fillStyle = '#e5e7eb';
  ctx.font = '600 36px Inter, system-ui, sans-serif';
  wrapText(ctx, label, 256, 340, 420, 42);
  return toTexture(canvas, 4);
}

function wrapText(ctx, text, x, y, maxWidth, lineHeight) {
  const words = text.split(' ');
  let line = '';
  let yy = y;
  for (const word of words) {
    const test = `${line}${word} `;
    if (ctx.measureText(test).width > maxWidth && line) {
      ctx.fillText(line.trim(), x, yy);
      line = `${word} `;
      yy += lineHeight;
    } else {
      line = test;
    }
  }
  ctx.fillText(line.trim(), x, yy);
}

export async function loadAssets(onProgress) {
  const files = {
    portrait: `${BASE}assets/portrait.png`,
    voicestamp: `${BASE}assets/logos/voicestamp.png`,
    whynew: `${BASE}assets/logos/whynew.png`,
    esawari: `${BASE}assets/logos/e-sawari.png`,
    tejbi: `${BASE}assets/logos/tejbi.png`,
    guitarhub: `${BASE}assets/logos/guitarhub.png`,
  };

  const keys = Object.keys(files);
  const images = {};
  let loaded = 0;
  await Promise.all(
    keys.map(async (key) => {
      images[key] = await loadImage(files[key]);
      loaded += 1;
      onProgress?.(loaded / keys.length);
    })
  );

  const threeLoader = new THREE.TextureLoader();
  const portraitMap = images.portrait
    ? await new Promise((resolve) => {
        threeLoader.load(
          files.portrait,
          (texture) => {
            texture.colorSpace = THREE.SRGBColorSpace;
            texture.anisotropy = 8;
            resolve(texture);
          },
          undefined,
          () => resolve(null)
        );
      })
    : null;

  const projects = [
    { id: 'voicestamp', title: 'VoiceStamp', subtitle: 'AI voice notes · iOS', accent: '#38bdf8', image: images.voicestamp },
    { id: 'whynew', title: 'WhyNew', subtitle: 'Bidding marketplace', accent: '#f59e0b', image: images.whynew },
    { id: 'esawari', title: 'eSawari', subtitle: 'Ride sharing', accent: '#22c55e', image: images.esawari },
    { id: 'tejbi', title: 'Tejbi', subtitle: 'Bus & hotel booking', accent: '#2563eb', image: images.tejbi },
    { id: 'guitarhub', title: 'GuitarHub', subtitle: 'Music learning', accent: '#f43f5e', image: images.guitarhub },
  ];

  return {
    portraitMap,
    portraitImage: images.portrait,
    codeScreen: createCodeScreenTexture(),
    terminal: createTerminalTexture(),
    projectScreens: Object.fromEntries(
      projects.map((project) => [project.id, createAppScreenTexture(project)])
    ),
    projects,
  };
}
