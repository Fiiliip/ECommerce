import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'
import path from 'path'

import Components from 'unplugin-vue-components/vite'

// https://vitejs.dev/config/
export default defineConfig({
  plugins: [
    vue(),

    Components({
			dirs: ['src/plugins']
		})
  ],
  resolve: {
    alias: {
      '@': path.resolve(__dirname, './src')
    }
  },
  // server: {
	// 	proxy: {
	// 		'/api/': {
	// 			target: 'http://127.0.0.1:8000/',
	// 			changeOrigin: true,
	// 			secure: false
	// 		},
	// 	}
	// }
})
