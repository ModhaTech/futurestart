// vite.config.mjs
import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'
import laravel from 'laravel-vite-plugin'

export default defineConfig({
	plugins: [
		laravel({
			input: ['resources/css/app-v2.css', 'resources/js/app-v2.js'],
		}),
		vue(),
	],
	css: {
		postcss: './postcss.config.mjs',
	},
	resolve: {
		alias: {
			'@': '/resources/js',
			'@images': '/resources/images',
			'@video': '/resources/videos',
		},
	},
	build: {
		manifest: true,
		outDir: 'public/build',
		rollupOptions: {
			input: 'resources/js/app-v2.js',
		},
	},
	server: {
		watch: {
			ignored: ['**/public/**', '**/.git/**', '**/storage/**', '**/.idea/**']
		}
	}
})
