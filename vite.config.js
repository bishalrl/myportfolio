import { defineConfig } from 'vite';

const SOURCE_SCRIPT = '/src/main.js';
const PAGES_SCRIPT = './docs/assets/app.js';

function githubPagesDevPlugin() {
  return {
    name: 'github-pages-dev-script',
    transformIndexHtml: {
      order: 'pre',
      handler(html) {
        if (html.includes(PAGES_SCRIPT)) {
          return html.replaceAll(PAGES_SCRIPT, SOURCE_SCRIPT);
        }
        return html;
      },
    },
  };
}

export default defineConfig({
  base: './',
  publicDir: 'public',
  plugins: [githubPagesDevPlugin()],
  server: {
    port: 3001,
    host: true,
    watch: {
      ignored: ['**/cv and image/**', '**/dist/**', '**/docs/**'],
    },
  },
  preview: {
    port: 4173,
  },
  build: {
    outDir: 'docs',
    emptyOutDir: true,
    assetsInlineLimit: 0,
    sourcemap: false,
    rollupOptions: {
      output: {
        entryFileNames: 'assets/app.js',
        chunkFileNames: 'assets/[name].js',
        assetFileNames: 'assets/[name][extname]',
        manualChunks: {
          three: ['three'],
        },
      },
    },
  },
});
