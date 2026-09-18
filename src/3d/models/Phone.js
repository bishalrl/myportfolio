import * as THREE from 'three';
import { RoundedBoxGeometry } from 'three/addons/geometries/RoundedBoxGeometry.js';

function lens(radius, useGlass) {
  const group = new THREE.Group();
  const ring = new THREE.Mesh(
    new THREE.CylinderGeometry(radius, radius, 0.018, 24),
    new THREE.MeshPhysicalMaterial({
      color: 0x1f2937,
      metalness: 0.95,
      roughness: 0.18,
    })
  );
  ring.rotation.x = Math.PI / 2;
  group.add(ring);

  const glass = new THREE.Mesh(
    new THREE.CircleGeometry(radius * 0.72, 24),
    new THREE.MeshPhysicalMaterial({
      color: 0x0f2744,
      metalness: 0.2,
      roughness: 0.05,
      transmission: useGlass ? 0.35 : 0,
      thickness: 0.02,
      ior: 1.5,
    })
  );
  glass.position.z = 0.01;
  group.add(glass);

  const glare = new THREE.Mesh(
    new THREE.CircleGeometry(radius * 0.22, 12),
    new THREE.MeshBasicMaterial({ color: 0x93c5fd, transparent: true, opacity: 0.45 })
  );
  glare.position.set(-radius * 0.2, radius * 0.18, 0.012);
  group.add(glare);
  return group;
}

export function createPhone({
  variant = 'ios',
  screenMap = null,
  lowPower = false,
} = {}) {
  const group = new THREE.Group();
  const isIos = variant === 'ios';
  const width = isIos ? 0.71 : 0.74;
  const height = isIos ? 1.48 : 1.58;
  const depth = isIos ? 0.086 : 0.09;
  const radius = isIos ? 0.08 : 0.09;
  const useGlass = !lowPower;

  const body = new THREE.Mesh(
    new RoundedBoxGeometry(width, height, depth, 6, radius),
    new THREE.MeshPhysicalMaterial({
      color: isIos ? 0xc5ccd4 : 0x111318,
      metalness: 0.92,
      roughness: 0.22,
      clearcoat: 0.55,
      clearcoatRoughness: 0.18,
    })
  );
  body.castShadow = true;
  body.receiveShadow = true;
  group.add(body);

  const bezel = new THREE.Mesh(
    new RoundedBoxGeometry(width * 0.945, height * 0.96, 0.012, 5, radius * 0.75),
    new THREE.MeshStandardMaterial({ color: 0x050608, roughness: 0.45, metalness: 0.2 })
  );
  bezel.position.z = depth / 2 + 0.001;
  group.add(bezel);

  const screenWidth = width * 0.88;
  const screenHeight = height * 0.905;
  const screen = new THREE.Mesh(
    new THREE.PlaneGeometry(screenWidth, screenHeight),
    new THREE.MeshPhysicalMaterial({
      map: screenMap,
      emissiveMap: screenMap,
      emissive: new THREE.Color(0xffffff),
      emissiveIntensity: screenMap ? 0.55 : 0.12,
      color: screenMap ? 0xffffff : 0x0b1220,
      roughness: 0.18,
      metalness: 0.05,
    })
  );
  screen.position.z = depth / 2 + 0.01;
  screen.name = 'screen';
  group.add(screen);

  if (isIos) {
    const island = new THREE.Mesh(
      new RoundedBoxGeometry(0.18, 0.046, 0.012, 3, 0.02),
      new THREE.MeshStandardMaterial({ color: 0x050505, roughness: 0.3 })
    );
    island.position.set(0, screenHeight / 2 - 0.07, depth / 2 + 0.016);
    group.add(island);

    const bump = new THREE.Mesh(
      new RoundedBoxGeometry(0.28, 0.28, 0.03, 3, 0.06),
      new THREE.MeshPhysicalMaterial({
        color: 0xb7bec6,
        metalness: 0.9,
        roughness: 0.25,
      })
    );
    bump.position.set(-0.14, 0.46, -depth / 2 - 0.012);
    bump.castShadow = true;
    group.add(bump);
    const l1 = lens(0.055, useGlass);
    l1.position.set(-0.2, 0.53, -depth / 2 - 0.028);
    const l2 = lens(0.055, useGlass);
    l2.position.set(-0.08, 0.4, -depth / 2 - 0.028);
    group.add(l1, l2);

    const flash = new THREE.Mesh(
      new THREE.CircleGeometry(0.016, 12),
      new THREE.MeshStandardMaterial({
        color: 0xfde68a,
        emissive: 0xfde68a,
        emissiveIntensity: 0.6,
      })
    );
    flash.position.set(-0.04, 0.54, -depth / 2 - 0.028);
    flash.rotation.y = Math.PI;
    group.add(flash);
  } else {
    const punch = new THREE.Mesh(
      new THREE.CircleGeometry(0.018, 16),
      new THREE.MeshStandardMaterial({ color: 0x020203 })
    );
    punch.position.set(0, screenHeight / 2 - 0.06, depth / 2 + 0.016);
    group.add(punch);

    const bar = new THREE.Mesh(
      new RoundedBoxGeometry(0.56, 0.16, 0.028, 3, 0.06),
      new THREE.MeshPhysicalMaterial({
        color: 0x0b0d12,
        metalness: 0.85,
        roughness: 0.28,
      })
    );
    bar.position.set(0, 0.58, -depth / 2 - 0.012);
    bar.castShadow = true;
    group.add(bar);
    const l1 = lens(0.042, useGlass);
    l1.position.set(-0.16, 0.58, -depth / 2 - 0.028);
    const l2 = lens(0.042, useGlass);
    l2.position.set(0, 0.58, -depth / 2 - 0.028);
    const l3 = lens(0.042, useGlass);
    l3.position.set(0.16, 0.58, -depth / 2 - 0.028);
    group.add(l1, l2, l3);
  }

  const buttonMat = new THREE.MeshStandardMaterial({
    color: isIos ? 0xb0b7bf : 0x1f2937,
    metalness: 0.8,
    roughness: 0.3,
  });
  const power = new THREE.Mesh(new THREE.BoxGeometry(0.012, 0.12, 0.03), buttonMat);
  power.position.set(width / 2 + 0.004, 0.22, 0);
  const volUp = new THREE.Mesh(new THREE.BoxGeometry(0.012, 0.09, 0.026), buttonMat);
  volUp.position.set(-width / 2 - 0.004, 0.28, 0);
  const volDown = new THREE.Mesh(new THREE.BoxGeometry(0.012, 0.09, 0.026), buttonMat);
  volDown.position.set(-width / 2 - 0.004, 0.16, 0);
  group.add(power, volUp, volDown);

  const port = new THREE.Mesh(
    new THREE.BoxGeometry(0.12, 0.016, 0.02),
    new THREE.MeshStandardMaterial({ color: 0x111111, metalness: 0.7, roughness: 0.35 })
  );
  port.position.set(0, -height / 2 + 0.01, depth / 2 - 0.02);
  group.add(port);

  group.userData.restScale = 1;
  group.userData.variant = variant;
  return group;
}

export function setPhoneScreen(phone, map) {
  const screen = phone.getObjectByName('screen');
  if (!screen || !map) return;
  screen.material.map = map;
  screen.material.emissiveMap = map;
  screen.material.emissiveIntensity = 0.55;
  screen.material.needsUpdate = true;
}
