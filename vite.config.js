import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import svgLoader from 'vite-svg-loader';

export default defineConfig({
  resolve: {
    alias: {
      '@': '/resources/js',
    },
  },
  build: {
    sourcemap: true,
  },
  server: {
    host: '0.0.0.0', // Bind to all network interfaces
    port: 5173, // Use the default Vite port
    strictPort: true, // Ensure Vite fails if the port is already in use
    hmr: {
      host: 'localhost', // Use 'localhost' or your dev server hostname
    },
    watch: {
      usePolling: true, // Enable polling for file changes in Docker
    },
  },
  plugins: [
    laravel({
      input: [
        'resources/js/app.js'
      ],
      refresh: true,
      // detectTls: 'hostname.test',
    }),
    vue({
      template: {
        transformAssetUrls: {
          // The Vue plugin will re-write asset URLs, when referenced
          // in Single File Components, to point to the Laravel web
          // server. Setting this to `null` allows the Laravel plugin
          // to instead re-write asset URLs to point to the Vite
          // server instead.
          base: null,

          // The Vue plugin will parse absolute URLs and treat them
          // as absolute paths to files on disk. Setting this to
          // `false` will leave absolute URLs un-touched so they can
          // reference assets in the public directory as expected.
          includeAbsolute: false,
        },
      },
    }),
    svgLoader()
  ],
});
