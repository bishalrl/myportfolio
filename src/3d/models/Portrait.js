import * as THREE from 'three';
import { RoundedBoxGeometry } from 'three/addons/geometries/RoundedBoxGeometry.js';

export function createPortrait({ map = null, lowPower = false } = {}) {
  const group = new THREE.Group();

  const frame = new THREE.Mesh(
    new RoundedBoxGeometry(1.28, 1.92, 0.08, 3, 0.05),
    new THREE.MeshPhysicalMaterial({
      color: 0xd6d3d1,
      metalness: 0.85,
      roughness: 0.22,
      clearcoat: 0.4,
    })
  );
  frame.castShadow = true;
  group.add(frame);

  const inner = new THREE.Mesh(
    new THREE.PlaneGeometry(1.12, 1.76),
    new THREE.MeshStandardMaterial({ color: 0x020617, roughness: 0.5 })
  );
  inner.position.z = 0.042;
  group.add(inner);

  const photo = new THREE.Mesh(
    new THREE.PlaneGeometry(1.08, 1.72),
    new THREE.MeshPhysicalMaterial({
      map,
      color: map ? 0xffffff : 0x1e293b,
      roughness: 0.35,
      metalness: 0.05,
      emissive: new THREE.Color(0x334155),
      emissiveIntensity: 0.12,
    })
  );
  photo.position.z = 0.046;
  photo.name = 'photo';
  group.add(photo);

  const glow = new THREE.PointLight(0x60a5fa, 0.55, 4.5, 2);
  glow.position.set(0, 0, 0.6);
  group.add(glow);

  return group;
}
