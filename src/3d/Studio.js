import * as THREE from 'three';
import { Reflector } from 'three/addons/objects/Reflector.js';
import { RoomEnvironment } from 'three/addons/environments/RoomEnvironment.js';

export function createStudio(scene, renderer, { lowPower = false } = {}) {
  scene.background = new THREE.Color(0x07080c);
  scene.fog = new THREE.Fog(0x07080c, 14, 42);

  const pmrem = new THREE.PMREMGenerator(renderer);
  const env = pmrem.fromScene(new RoomEnvironment(), 0.04).texture;
  scene.environment = env;
  if ('environmentIntensity' in scene) scene.environmentIntensity = 0.55;
  pmrem.dispose();

  const studio = new THREE.Group();
  studio.name = 'studio';

  const floorMat = new THREE.MeshStandardMaterial({
    color: 0x0c1018,
    metalness: 0.55,
    roughness: 0.28,
  });
  const floor = new THREE.Mesh(new THREE.PlaneGeometry(48, 72), floorMat);
  floor.rotation.x = -Math.PI / 2;
  floor.position.set(3, 0, -18);
  floor.receiveShadow = true;
  studio.add(floor);

  if (!lowPower) {
    const reflector = new Reflector(new THREE.PlaneGeometry(48, 72), {
      textureWidth: 1024,
      textureHeight: 1024,
      color: 0x151820,
    });
    reflector.rotation.x = -Math.PI / 2;
    reflector.position.set(3, 0.01, -18);
    studio.add(reflector);
  }

  const grid = new THREE.GridHelper(70, 70, 0x1e3a5f, 0x111827);
  grid.position.set(3, 0.02, -18);
  grid.material.transparent = true;
  grid.material.opacity = 0.18;
  studio.add(grid);

  const stripMat = new THREE.MeshStandardMaterial({
    color: 0xffffff,
    emissive: 0xbfdbfe,
    emissiveIntensity: 1.8,
  });
  for (let i = 0; i < 9; i += 1) {
    const strip = new THREE.Mesh(new THREE.BoxGeometry(10, 0.04, 0.16), stripMat);
    strip.position.set(2.2, 4.6, 5 - i * 5.5);
    studio.add(strip);
  }

  const hemi = new THREE.HemisphereLight(0x94a3b8, 0x020617, 0.45);
  studio.add(hemi);

  const key = new THREE.DirectionalLight(0xf8fafc, 1.15);
  key.position.set(4, 8, 6);
  key.castShadow = !lowPower;
  key.shadow.mapSize.set(lowPower ? 512 : 2048, lowPower ? 512 : 2048);
  key.shadow.camera.near = 0.5;
  key.shadow.camera.far = 40;
  key.shadow.camera.left = -10;
  key.shadow.camera.right = 10;
  key.shadow.camera.top = 10;
  key.shadow.camera.bottom = -10;
  key.shadow.bias = -0.0002;
  studio.add(key);
  studio.add(key.target);

  const blue = new THREE.PointLight(0x3b82f6, 6, 14, 2);
  blue.position.set(2, 2.4, 0);
  studio.add(blue);
  const green = new THREE.PointLight(0x10b981, 4.5, 12, 2);
  green.position.set(-1, 2.2, -10);
  studio.add(green);

  scene.add(studio);

  return { studio, key, blue, green };
}
