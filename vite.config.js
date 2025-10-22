import { defineConfig } from 'vite'
import laravel from 'laravel-vite-plugin'
import tailwindcss from '@tailwindcss/vite'

export default defineConfig({
  plugins: [
    laravel({
      // Solo el JS. El CSS entra porque lo importas dentro de app.js
      input: ['resources/js/app.js'],
      refresh: true,
      buildDirectory: 'build',
    }),
    tailwindcss(),
  ],
  build: {
    outDir: 'public/build',
    manifest: true,      // <— obliga a crear public/build/manifest.json
    emptyOutDir: true,
  },
})
