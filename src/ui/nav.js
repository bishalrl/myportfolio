export function setupNav(lenis) {
  const hamburger = document.querySelector('.hamburger');
  const navMenu = document.querySelector('.nav-menu');
  const links = document.querySelectorAll('.nav-link, .btn[href^="#"]');

  hamburger?.addEventListener('click', () => {
    navMenu.classList.toggle('active');
    hamburger.classList.toggle('active');
  });

  const scrollToId = (id) => {
    const target = document.querySelector(id);
    if (!target) return;
    const top = target.offsetTop - 12;
    if (lenis) lenis.scrollTo(top, { duration: 1.15 });
    else window.scrollTo({ top, behavior: 'smooth' });
  };

  links.forEach((link) => {
    link.addEventListener('click', (event) => {
      const href = link.getAttribute('href');
      if (!href?.startsWith('#')) return;
      event.preventDefault();
      navMenu?.classList.remove('active');
      hamburger?.classList.remove('active');
      scrollToId(href);
    });
  });

  const sections = [...document.querySelectorAll('section[id]')];
  const onScroll = () => {
    const y = window.scrollY + window.innerHeight * 0.35;
    let current = sections[0]?.id;
    sections.forEach((section) => {
      if (y >= section.offsetTop) current = section.id;
    });
    document.querySelectorAll('.nav-link').forEach((link) => {
      link.classList.toggle('is-active', link.getAttribute('href') === `#${current}`);
    });
    document.querySelector('.navbar')?.classList.toggle('is-scrolled', window.scrollY > 40);
  };

  window.addEventListener('scroll', onScroll, { passive: true });
  onScroll();
}
