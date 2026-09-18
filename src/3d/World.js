import * as THREE from 'three';
import { createPhone } from './models/Phone.js';
import { createLaptop, createDesk } from './models/Laptop.js';
import { createPortrait } from './models/Portrait.js';
import {
  createChip,
  createEnvelope,
  createFlutterMark,
  createNode,
  createStatBlock,
  createTerminalPanel,
} from './models/props.js';

const PROJECT_XS = [0, 2.25, 4.5, 6.75, 9];

export class World {
  constructor(scene, assets, capabilities) {
    this.scene = scene;
    this.assets = assets;
    this.capabilities = capabilities;
    this.root = new THREE.Group();
    scene.add(this.root);

    this.heroPhones = [];
    this.projectPhones = [];
    this.chips = [];
    this.stats = [];
    this.nodes = [];
    this.floaters = [];

    this.#buildHero();
    this.#buildAbout();
    this.#buildProjects();
    this.#buildSkills();
    this.#buildContact();
  }

  #buildHero() {
    const group = new THREE.Group();
    group.position.set(1.35, 0, -1.1);

    this.portrait = createPortrait({
      map: this.assets.portraitMap,
      lowPower: this.capabilities.lowPower,
    });
    this.portrait.position.set(0.15, 1.55, -0.35);
    group.add(this.portrait);
    this.#float(this.portrait, 0.06, 0.6);

    const ios = createPhone({
      variant: 'ios',
      screenMap: this.assets.projectScreens.voicestamp,
      lowPower: this.capabilities.lowPower,
    });
    ios.position.set(-0.95, 1.35, 0.35);
    ios.rotation.set(-0.12, 0.45, 0.08);
    const android = createPhone({
      variant: 'android',
      screenMap: this.assets.projectScreens.whynew,
      lowPower: this.capabilities.lowPower,
    });
    android.position.set(1.05, 1.28, 0.45);
    android.rotation.set(-0.1, -0.5, -0.06);

    this.heroPhones.push(ios, android);
    group.add(ios, android);
    this.#float(ios, 0.08, 0.9, 0.15);
    this.#float(android, 0.07, 0.75, -0.12);

    this.root.add(group);
    this.hero = group;
  }

  #buildAbout() {
    const group = new THREE.Group();
    group.position.set(1.45, 0, -10.2);

    const desk = createDesk();
    group.add(desk);

    this.laptop = createLaptop({
      screenMap: this.assets.codeScreen,
      lowPower: this.capabilities.lowPower,
    });
    this.laptop.position.set(0.05, 0.84, 0.05);
    this.laptop.rotation.y = -0.18;
    group.add(this.laptop);

    const stats = [
      { value: '5+', label: 'Apps published', pos: [1.35, 1.55, 0.35] },
      { value: '1', label: 'Full-stack site', pos: [1.55, 2.15, -0.15] },
      { value: '100%', label: 'Production ready', pos: [-1.4, 1.7, 0.2] },
    ];
    stats.forEach((item) => {
      const block = createStatBlock(item.value, item.label);
      block.position.fromArray(item.pos);
      group.add(block);
      this.stats.push(block);
      this.#float(block, 0.05, 0.7 + Math.random() * 0.4);
    });

    this.root.add(group);
    this.about = group;
  }

  #buildProjects() {
    const group = new THREE.Group();
    group.position.set(0, 0, -20);
    const screens = this.assets.projectScreens;
    const ids = ['voicestamp', 'whynew', 'esawari', 'tejbi', 'guitarhub'];
    const variants = ['ios', 'android', 'android', 'android', 'android'];

    ids.forEach((id, index) => {
      const phone = createPhone({
        variant: variants[index],
        screenMap: screens[id],
        lowPower: this.capabilities.lowPower,
      });
      phone.position.set(PROJECT_XS[index], 1.25, 0);
      phone.rotation.y = -0.18;
      phone.userData.baseX = PROJECT_XS[index];
      phone.userData.index = index;
      group.add(phone);
      this.projectPhones.push(phone);
    });

    this.root.add(group);
    this.projects = group;
  }

  #buildSkills() {
    const group = new THREE.Group();
    group.position.set(1.5, 1.45, -30);

    this.flutterMark = createFlutterMark();
    group.add(this.flutterMark);

    const chips = [
      ['Flutter', 'Mobile', '#38bdf8'],
      ['Dart', 'Language', '#22d3ee'],
      ['Firebase', 'Backend', '#fbbf24'],
      ['FastAPI', 'API', '#34d399'],
      ['OpenAI', 'Whisper', '#a78bfa'],
      ['Maps', 'Realtime', '#60a5fa'],
      ['Supabase', 'Data', '#4ade80'],
      ['Node.js', 'Services', '#86efac'],
    ];
    chips.forEach((chip, i) => {
      const mesh = createChip(chip[0], chip[1], chip[2]);
      const angle = (i / chips.length) * Math.PI * 2;
      mesh.userData.angle = angle;
      mesh.userData.radius = 2.35;
      mesh.position.set(Math.cos(angle) * 2.35, Math.sin(angle * 2) * 0.35, Math.sin(angle) * 2.35);
      group.add(mesh);
      this.chips.push(mesh);
    });

    for (let i = 0; i < 16; i += 1) {
      const node = createNode(i % 2 ? 0x10b981 : 0x3b82f6);
      node.userData.angle = (i / 16) * Math.PI * 2;
      node.userData.radius = 1.35 + (i % 3) * 0.25;
      group.add(node);
      this.nodes.push(node);
    }

    this.root.add(group);
    this.skills = group;
  }

  #buildContact() {
    const group = new THREE.Group();
    group.position.set(1.35, 0, -39.2);

    this.terminal = createTerminalPanel(this.assets.terminal);
    this.terminal.position.set(0.15, 1.45, -0.2);
    this.terminal.rotation.y = -0.2;
    group.add(this.terminal);

    this.envelope = createEnvelope();
    this.envelope.position.set(-1.15, 1.15, 0.45);
    this.envelope.rotation.set(-0.4, 0.5, 0.15);
    group.add(this.envelope);
    this.#float(this.envelope, 0.09, 0.85, 0.2);

    const mini = createPhone({
      variant: 'ios',
      screenMap: this.assets.projectScreens.tejbi,
      lowPower: this.capabilities.lowPower,
    });
    mini.scale.setScalar(0.72);
    mini.position.set(1.35, 1.05, 0.55);
    mini.rotation.set(-0.2, -0.4, 0.1);
    group.add(mini);
    this.#float(mini, 0.06, 0.7);

    this.root.add(group);
    this.contact = group;
  }

  #float(obj, amp, speed, rot = 0) {
    this.floaters.push({ obj, amp, speed, rot, baseY: obj.position.y });
  }

  update(progress, time, reducedMotion) {
    if (!reducedMotion) {
      this.floaters.forEach((item, i) => {
        const t = time * item.speed + i;
        item.obj.position.y = item.baseY + Math.sin(t) * item.amp;
        if (item.rot) item.obj.rotation.y += item.rot * 0.003;
      });

      this.heroPhones.forEach((phone, i) => {
        phone.rotation.y += (i ? -1 : 1) * 0.0025;
      });

      this.chips.forEach((chip) => {
        chip.userData.angle += 0.003;
        const a = chip.userData.angle;
        const r = chip.userData.radius;
        chip.position.set(Math.cos(a) * r, Math.sin(a * 2) * 0.32, Math.sin(a) * r);
        chip.rotation.set(0, -a + Math.PI / 2, 0);
      });

      this.nodes.forEach((node) => {
        node.userData.angle += 0.006;
        const a = node.userData.angle;
        const r = node.userData.radius;
        node.position.set(Math.cos(a) * r, Math.cos(a * 3) * 0.45, Math.sin(a) * r);
      });

      this.flutterMark.rotation.y = time * 0.35;
      this.stats.forEach((stat, i) => {
        stat.rotation.y = Math.sin(time * 0.6 + i) * 0.15;
      });
    }

    const projectStart = 0.34;
    const projectEnd = 0.74;
    const local = THREE.MathUtils.clamp((progress - projectStart) / (projectEnd - projectStart), 0, 1);
    const active = local * (this.projectPhones.length - 1);
    this.projectPhones.forEach((phone, index) => {
      const closeness = 1 - Math.min(1, Math.abs(active - index));
      const targetZ = closeness * 0.55;
      const targetScale = 1 + closeness * 0.12;
      phone.position.z += (targetZ - phone.position.z) * 0.08;
      const s = phone.scale.x + (targetScale - phone.scale.x) * 0.08;
      phone.scale.setScalar(s);
      phone.rotation.y += ((-0.12 + closeness * 0.2) - phone.rotation.y) * 0.08;
    });
  }
}
