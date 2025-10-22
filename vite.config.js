import { defineConfig } from 'vite'
import laravel from 'laravel-vite-plugin'
import tailwindcss from '@tailwindcss/vite'

export default defineConfig({
  plugins: [
    laravel({
      input: ['resources/js/app.js'],
      refresh: true,
      buildDirectory: 'build',
    }),
    tailwindcss(),
  ],
  build: {
    outDir: 'public/build',
    manifest: true,       // <-- obliga a crear public/build/manifest.json
    emptyOutDir: true,
  },
})
