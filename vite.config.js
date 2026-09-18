import { defineConfig } from 'vite';

export default defineConfig({
  base: './',
  publicDir: 'public',
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
        manualChunks: {
          three: ['three'],
        },
      },
    },
  },
});
