// vite.config.js
import { defineConfig } from 'vite'
import laravel from 'laravel-vite-plugin'
import tailwindcss from '@tailwindcss/vite'
import '../css/app.css'

export default defineConfig({
  plugins: [
    laravel({
      input: ['resources/css/app.css', 'resources/js/app.js'],
      refresh: true,
    }),
    tailwindcss(),
  ],
  build: {
    manifest: true,          // genera public/build/manifest.json
    outDir: 'public/build',
    emptyOutDir: true,
  },
})
