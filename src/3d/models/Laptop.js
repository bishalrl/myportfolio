import * as THREE from 'three';
import { RoundedBoxGeometry } from 'three/addons/geometries/RoundedBoxGeometry.js';

export function createLaptop({ screenMap = null, lowPower = false } = {}) {
  const group = new THREE.Group();

  const base = new THREE.Mesh(
    new RoundedBoxGeometry(2.05, 0.06, 1.36, 3, 0.04),
    new THREE.MeshPhysicalMaterial({
      color: 0x9aa3ad,
      metalness: 0.88,
      roughness: 0.28,
      clearcoat: 0.3,
    })
  );
  base.castShadow = true;
  base.receiveShadow = true;
  group.add(base);

  const deck = new THREE.Mesh(
    new THREE.PlaneGeometry(1.92, 1.18),
    new THREE.MeshStandardMaterial({ color: 0x1f2937, roughness: 0.55, metalness: 0.2 })
  );
  deck.rotation.x = -Math.PI / 2;
  deck.position.y = 0.032;
  group.add(deck);

  const keyGeo = new THREE.BoxGeometry(0.11, 0.012, 0.11);
  const keyMat = new THREE.MeshStandardMaterial({ color: 0x111827, roughness: 0.4 });
  const keys = new THREE.InstancedMesh(keyGeo, keyMat, 56);
  keys.instanceMatrix.setUsage(THREE.DynamicDrawUsage);
  const dummy = new THREE.Object3D();
  let i = 0;
  for (let row = 0; row < 4; row += 1) {
    for (let col = 0; col < 14; col += 1) {
      dummy.position.set(-0.78 + col * 0.12, 0.04, -0.08 + row * 0.13);
      dummy.updateMatrix();
      keys.setMatrixAt(i, dummy.matrix);
      i += 1;
    }
  }
  keys.castShadow = true;
  group.add(keys);

  const trackpad = new THREE.Mesh(
    new RoundedBoxGeometry(0.72, 0.01, 0.42, 2, 0.03),
    new THREE.MeshStandardMaterial({ color: 0x374151, roughness: 0.35, metalness: 0.4 })
  );
  trackpad.position.set(0, 0.038, 0.38);
  group.add(trackpad);

  const lid = new THREE.Group();
  lid.position.set(0, 0.03, -0.64);
  lid.rotation.x = -1.18;

  const lidBack = new THREE.Mesh(
    new RoundedBoxGeometry(2.05, 1.3, 0.05, 3, 0.04),
    new THREE.MeshPhysicalMaterial({
      color: 0x9aa3ad,
      metalness: 0.88,
      roughness: 0.28,
    })
  );
  lidBack.position.y = 0.65;
  lidBack.castShadow = true;
  lid.add(lidBack);

  const bezel = new THREE.Mesh(
    new THREE.PlaneGeometry(1.92, 1.16),
    new THREE.MeshStandardMaterial({ color: 0x05070b, roughness: 0.4 })
  );
  bezel.position.set(0, 0.65, 0.028);
  lid.add(bezel);

  const screen = new THREE.Mesh(
    new THREE.PlaneGeometry(1.82, 1.06),
    new THREE.MeshPhysicalMaterial({
      map: screenMap,
      emissiveMap: screenMap,
      emissive: new THREE.Color(0xffffff),
      emissiveIntensity: 0.45,
      color: 0xffffff,
      roughness: 0.2,
      metalness: 0.05,
      transmission: lowPower ? 0 : 0.08,
    })
  );
  screen.position.set(0, 0.65, 0.032);
  lid.add(screen);

  const cameraDot = new THREE.Mesh(
    new THREE.CircleGeometry(0.012, 12),
    new THREE.MeshStandardMaterial({ color: 0x111827 })
  );
  cameraDot.position.set(0, 1.22, 0.03);
  lid.add(cameraDot);

  group.add(lid);
  group.userData.lid = lid;
  return group;
}

export function createDesk() {
  const group = new THREE.Group();
  const top = new THREE.Mesh(
    new RoundedBoxGeometry(3.4, 0.08, 1.7, 3, 0.04),
    new THREE.MeshStandardMaterial({
      color: 0x1e293b,
      roughness: 0.45,
      metalness: 0.25,
    })
  );
  top.castShadow = true;
  top.receiveShadow = true;
  top.position.y = 0.78;
  group.add(top);

  const legGeo = new THREE.CylinderGeometry(0.04, 0.05, 0.74, 12);
  const legMat = new THREE.MeshStandardMaterial({ color: 0x0f172a, metalness: 0.7, roughness: 0.35 });
  const offsets = [
    [-1.45, 0.37, -0.68],
    [1.45, 0.37, -0.68],
    [-1.45, 0.37, 0.68],
    [1.45, 0.37, 0.68],
  ];
  offsets.forEach(([x, y, z]) => {
    const leg = new THREE.Mesh(legGeo, legMat);
    leg.position.set(x, y, z);
    leg.castShadow = true;
    group.add(leg);
  });

  return group;
}
