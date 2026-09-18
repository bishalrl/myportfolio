import * as THREE from 'three';
import { EffectComposer } from 'three/addons/postprocessing/EffectComposer.js';
import { RenderPass } from 'three/addons/postprocessing/RenderPass.js';
import { UnrealBloomPass } from 'three/addons/postprocessing/UnrealBloomPass.js';
import { OutputPass } from 'three/addons/postprocessing/OutputPass.js';
import { CameraPath } from './CameraPath.js';
import { createStudio } from './Studio.js';
import { World } from './World.js';

export function detectCapabilities() {
  const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  const isMobile = window.matchMedia('(max-width: 768px)').matches;
  const memory = navigator.deviceMemory || 8;
  const lowPower = isMobile || memory <= 2;
  return {
    reducedMotion,
    isMobile,
    lowPower,
    maxDpr: isMobile ? 1.5 : 2,
    useBloom: !lowPower && !reducedMotion,
  };
}

export class Experience {
  constructor(canvas, assets, capabilities) {
    this.canvas = canvas;
    this.assets = assets;
    this.capabilities = capabilities;
    this.clock = new THREE.Clock();
    this.progress = 0;
    this.targetProgress = 0;
    this.mouse = new THREE.Vector2();
    this.running = true;
    this.look = new THREE.Vector3();

    this.renderer = new THREE.WebGLRenderer({
      canvas,
      antialias: !capabilities.lowPower,
      powerPreference: 'high-performance',
      stencil: false,
      depth: true,
    });
    this.renderer.setClearColor(0x07080c, 1);
    this.renderer.outputColorSpace = THREE.SRGBColorSpace;
    this.renderer.toneMapping = THREE.ACESFilmicToneMapping;
    this.renderer.toneMappingExposure = 1.08;
    this.renderer.shadowMap.enabled = !capabilities.lowPower;
    this.renderer.shadowMap.type = THREE.PCFSoftShadowMap;
    this.renderer.setPixelRatio(Math.min(window.devicePixelRatio, capabilities.maxDpr));
    this.renderer.setSize(window.innerWidth, window.innerHeight);

    this.scene = new THREE.Scene();
    this.camera = new THREE.PerspectiveCamera(42, window.innerWidth / window.innerHeight, 0.1, 80);
    this.camera.position.set(0.12, 1.58, 4.35);

    const studio = createStudio(this.scene, this.renderer, capabilities);
    this.keyLight = studio.key;
    this.blueLight = studio.blue;
    this.greenLight = studio.green;

    this.world = new World(this.scene, assets, capabilities);
    this.path = new CameraPath(this.camera);

    if (capabilities.useBloom) {
      this.composer = new EffectComposer(this.renderer);
      this.composer.addPass(new RenderPass(this.scene, this.camera));
      const bloom = new UnrealBloomPass(
        new THREE.Vector2(window.innerWidth, window.innerHeight),
        0.28,
        0.42,
        0.86
      );
      this.composer.addPass(bloom);
      this.composer.addPass(new OutputPass());
    }

    this.onResize = this.resize.bind(this);
    this.onVisibility = () => {
      this.running = document.visibilityState === 'visible';
      if (this.running) this.clock.getDelta();
    };
    this.onMouse = (event) => {
      this.mouse.x = (event.clientX / window.innerWidth) * 2 - 1;
      this.mouse.y = -(event.clientY / window.innerHeight) * 2 + 1;
    };

    window.addEventListener('resize', this.onResize);
    document.addEventListener('visibilitychange', this.onVisibility);
    window.addEventListener('pointermove', this.onMouse, { passive: true });
    this.resize();
    this.loop();
  }

  setProgress(value) {
    this.targetProgress = THREE.MathUtils.clamp(value, 0, 1);
    if (this.capabilities.reducedMotion) this.progress = this.targetProgress;
  }

  resize() {
    const width = window.innerWidth;
    const height = window.innerHeight;
    this.camera.aspect = width / height;
    this.camera.updateProjectionMatrix();
    const dpr = Math.min(window.devicePixelRatio, this.capabilities.maxDpr);
    this.renderer.setPixelRatio(dpr);
    this.renderer.setSize(width, height);
    this.composer?.setSize(width, height);
    this.path.refresh();
  }

  loop = () => {
    this.raf = requestAnimationFrame(this.loop);
    if (!this.running) return;
    const delta = this.clock.getDelta();
    const time = this.clock.elapsedTime;
    const smoothing = this.capabilities.reducedMotion ? 1 : 1 - Math.exp(-8 * delta);
    this.progress += (this.targetProgress - this.progress) * smoothing;

    this.look.copy(this.path.apply(this.progress, this.mouse, this.capabilities.reducedMotion));
    this.world.update(this.progress, time, this.capabilities.reducedMotion);

    this.keyLight.position.copy(this.camera.position).add(new THREE.Vector3(2.2, 3.4, 2.4));
    this.keyLight.target.position.copy(this.look);
    this.keyLight.target.updateMatrixWorld();
    this.blueLight.position.set(this.look.x + 1.2, this.look.y + 1.4, this.look.z + 1.5);
    this.greenLight.position.set(this.look.x - 1.6, this.look.y + 1.1, this.look.z - 0.8);

    if (this.composer) this.composer.render();
    else this.renderer.render(this.scene, this.camera);
  };

  dispose() {
    this.running = false;
    cancelAnimationFrame(this.raf);
    window.removeEventListener('resize', this.onResize);
    document.removeEventListener('visibilitychange', this.onVisibility);
    window.removeEventListener('pointermove', this.onMouse);
    this.composer?.dispose();
    this.renderer.dispose();
  }
}
