import * as THREE from 'three';

export const BEATS = {
  home: { pos: [0.12, 1.58, 4.35], look: [1.35, 1.38, -1.05] },
  about: { pos: [0.18, 1.42, -6.15], look: [1.45, 1.12, -10.15] },
  'project-voicestamp': { pos: [-0.55, 1.4, -16.15], look: [0.05, 1.24, -19.85] },
  'project-whynew': { pos: [1.7, 1.4, -16.15], look: [2.3, 1.24, -19.85] },
  'project-esawari': { pos: [3.95, 1.4, -16.15], look: [4.55, 1.24, -19.85] },
  'project-tejbi': { pos: [6.2, 1.4, -16.15], look: [6.8, 1.24, -19.85] },
  'project-guitarhub': { pos: [8.45, 1.4, -16.15], look: [9.05, 1.24, -19.85] },
  skills: { pos: [1.15, 2.15, -25.4], look: [1.5, 1.5, -30] },
  contact: { pos: [0.15, 1.48, -34.6], look: [1.32, 1.28, -39.1] },
};

function easeInOutCubic(t) {
  return t < 0.5 ? 4 * t * t * t : 1 - (-2 * t + 2) ** 3 / 2;
}

export class CameraPath {
  constructor(camera) {
    this.camera = camera;
    this.keyframes = [];
    this.look = new THREE.Vector3();
    this.pos = new THREE.Vector3();
    this.fromPos = new THREE.Vector3();
    this.toPos = new THREE.Vector3();
    this.fromLook = new THREE.Vector3();
    this.toLook = new THREE.Vector3();
    this.parallax = new THREE.Vector2();
    this.refresh();
  }

  refresh() {
    const max = Math.max(1, document.documentElement.scrollHeight - window.innerHeight);
    this.keyframes = Object.entries(BEATS)
      .map(([id, transform]) => {
        const el = document.getElementById(id);
        const t = el ? THREE.MathUtils.clamp(el.offsetTop / max, 0, 1) : 0;
        return {
          id,
          t,
          pos: new THREE.Vector3(...transform.pos),
          look: new THREE.Vector3(...transform.look),
        };
      })
      .sort((a, b) => a.t - b.t);

    if (this.keyframes[0]) this.keyframes[0].t = 0;
    const last = this.keyframes[this.keyframes.length - 1];
    if (last) last.t = 1;
  }

  apply(progress, mouse, reducedMotion) {
    if (!this.keyframes.length) return this.look;

    let i = 0;
    while (i < this.keyframes.length - 2 && progress > this.keyframes[i + 1].t) {
      i += 1;
    }
    const a = this.keyframes[i];
    const b = this.keyframes[i + 1] || a;
    const span = Math.max(0.0001, b.t - a.t);
    const u = easeInOutCubic(THREE.MathUtils.clamp((progress - a.t) / span, 0, 1));

    this.pos.lerpVectors(a.pos, b.pos, u);
    this.look.lerpVectors(a.look, b.look, u);

    if (!reducedMotion) {
      this.pos.x += mouse.x * 0.18;
      this.pos.y += mouse.y * 0.1;
    }

    this.camera.position.copy(this.pos);
    this.camera.lookAt(this.look);
    return this.look;
  }
}
