import * as THREE from 'three';
import { RoundedBoxGeometry } from 'three/addons/geometries/RoundedBoxGeometry.js';
import { createLabelTexture, createStatTexture, createTerminalTexture } from '../textures.js';

export function createStatBlock(value, label, accent = 0x3b82f6) {
  const group = new THREE.Group();
  const map = createStatTexture(value, label);
  const mesh = new THREE.Mesh(
    new RoundedBoxGeometry(0.9, 0.9, 0.12, 3, 0.08),
    new THREE.MeshPhysicalMaterial({
      map,
      emissiveMap: map,
      emissive: new THREE.Color(accent),
      emissiveIntensity: 0.25,
      color: 0xffffff,
      metalness: 0.15,
      roughness: 0.28,
    })
  );
  mesh.castShadow = true;
  group.add(mesh);
  return group;
}

export function createChip(title, subtitle, accent = '#3b82f6') {
  const group = new THREE.Group();
  const map = createLabelTexture(title, subtitle, accent);
  const body = new THREE.Mesh(
    new RoundedBoxGeometry(1.15, 0.58, 0.08, 3, 0.08),
    new THREE.MeshPhysicalMaterial({
      map,
      emissiveMap: map,
      emissive: new THREE.Color(0xffffff),
      emissiveIntensity: 0.22,
      metalness: 0.2,
      roughness: 0.3,
      color: 0xffffff,
    })
  );
  body.castShadow = true;
  group.add(body);

  const pinGeo = new THREE.BoxGeometry(0.04, 0.02, 0.12);
  const pinMat = new THREE.MeshStandardMaterial({ color: 0xcbd5e1, metalness: 0.8, roughness: 0.3 });
  for (let i = 0; i < 6; i += 1) {
    const pin = new THREE.Mesh(pinGeo, pinMat);
    pin.position.set(-0.4 + i * 0.16, -0.31, 0);
    group.add(pin);
  }
  return group;
}

export function createFlutterMark() {
  const group = new THREE.Group();
  const matA = new THREE.MeshPhysicalMaterial({
    color: 0x42a5f5,
    metalness: 0.2,
    roughness: 0.25,
    emissive: 0x1d4ed8,
    emissiveIntensity: 0.35,
  });
  const matB = new THREE.MeshPhysicalMaterial({
    color: 0x0ea5e9,
    metalness: 0.2,
    roughness: 0.25,
    emissive: 0x0369a1,
    emissiveIntensity: 0.3,
  });

  const wing = new THREE.Mesh(new THREE.BoxGeometry(0.55, 0.18, 0.08), matA);
  wing.rotation.z = Math.PI / 4;
  wing.position.set(-0.05, 0.22, 0);
  const wing2 = new THREE.Mesh(new THREE.BoxGeometry(0.55, 0.18, 0.08), matB);
  wing2.rotation.z = -Math.PI / 4;
  wing2.position.set(-0.05, -0.08, 0);
  const tip = new THREE.Mesh(new THREE.BoxGeometry(0.34, 0.16, 0.08), matA);
  tip.rotation.z = Math.PI / 4;
  tip.position.set(0.22, -0.28, 0);
  group.add(wing, wing2, tip);
  group.scale.setScalar(1.35);
  return group;
}

export function createEnvelope() {
  const group = new THREE.Group();
  const paper = new THREE.Mesh(
    new RoundedBoxGeometry(1.15, 0.72, 0.04, 2, 0.03),
    new THREE.MeshStandardMaterial({ color: 0xe7e5e4, roughness: 0.55, metalness: 0.05 })
  );
  paper.castShadow = true;
  group.add(paper);

  const flap = new THREE.Mesh(
    new THREE.PlaneGeometry(1.12, 0.48),
    new THREE.MeshStandardMaterial({ color: 0xf5f5f4, roughness: 0.5, side: THREE.DoubleSide })
  );
  flap.position.set(0, 0.18, 0.03);
  flap.rotation.x = -0.85;
  group.add(flap);

  const stamp = new THREE.Mesh(
    new THREE.PlaneGeometry(0.22, 0.18),
    new THREE.MeshStandardMaterial({ color: 0x3b82f6, emissive: 0x1d4ed8, emissiveIntensity: 0.4 })
  );
  stamp.position.set(0.38, 0.18, 0.024);
  group.add(stamp);
  return group;
}

export function createTerminalPanel(map) {
  const group = new THREE.Group();
  const body = new THREE.Mesh(
    new RoundedBoxGeometry(2.2, 1.35, 0.12, 3, 0.06),
    new THREE.MeshPhysicalMaterial({
      color: 0x111827,
      metalness: 0.45,
      roughness: 0.3,
    })
  );
  body.castShadow = true;
  group.add(body);

  const screen = new THREE.Mesh(
    new THREE.PlaneGeometry(2.02, 1.18),
    new THREE.MeshPhysicalMaterial({
      map: map || createTerminalTexture(),
      emissiveMap: map,
      emissive: new THREE.Color(0x67e8f9),
      emissiveIntensity: 0.35,
      color: 0xffffff,
      roughness: 0.2,
    })
  );
  screen.position.z = 0.07;
  group.add(screen);
  return group;
}

export function createNode(color = 0x38bdf8) {
  const mesh = new THREE.Mesh(
    new THREE.SphereGeometry(0.06, 16, 16),
    new THREE.MeshStandardMaterial({
      color,
      emissive: color,
      emissiveIntensity: 0.6,
      roughness: 0.25,
      metalness: 0.3,
    })
  );
  return mesh;
}
