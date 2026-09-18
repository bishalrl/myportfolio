import { defineConfig } from 'vite';

export default defineConfig({
  base: '/',
  publicDir: 'public',
  server: {
    port: 3001,
    host: true,
    watch: {
      ignored: ['**/cv and image/**', '**/dist/**'],
    },
  },
  preview: {
    port: 4173,
  },
  build: {
    outDir: 'dist',
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
