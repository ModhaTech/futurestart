import { build } from 'esbuild'
import fs from 'fs'
import { execSync } from 'child_process'
import postcss from 'postcss'
import purgecssModule from '@fullhuman/postcss-purgecss'
const purgecss = purgecssModule.default

console.log('🚀 Bundling vendor.js from app.js')

await build({
	entryPoints: ['resources/js/app.js'],
	bundle: true,
	minify: true,
	outfile: 'public/assets/prod/js/vendor.min.js',
})

console.log('🧩 Concatenating legacy JS into main.min.js')

const legacyJSFiles = [
	'public/assets/js/pusher.min.js',
	'public/assets/js/chat.js',
	'public/assets/js/custom.js',
]

const legacyJSOutput = legacyJSFiles
	.map(f => fs.readFileSync(f, 'utf-8'))
	.join('\n\n')

fs.writeFileSync('public/assets/prod/js/main.min.js', legacyJSOutput)

console.log('🎨 Concatenating legacy CSS into main.min.css')

const legacyCSSFiles = [
	'public/assets/css/bootstrap/bootstrap.min.css',
	'public/assets/prod/cssmove/style.min.css',
	'public/assets/css/style.css',
	'public/assets/css/custom.css',
	'public/assets/css/cart/style.css',
	'public/css/lightslider.css',
	'public/assets/admin/css/croppie.css',
	'public/assets/lightbox.css',
	'public/assets/css/owl.carousel.min.css',
	'public/assets/css/toaster.css',
	'public/assets/css/register.css',
	'public/assets/css/animate.css',
	'public/assets/css/style.css',
	'public/assets/css/buyer-dashboard/style.css',
]

const legacyCSSOutput = legacyCSSFiles
	.map(f => `/* ${f} */\n` + fs.readFileSync(f, 'utf-8'))
	.join('\n\n')

const cssOutputPath = 'public/assets/prod/css/main.min.css'

// Write combined CSS first (pre-purge)
fs.writeFileSync(cssOutputPath, legacyCSSOutput)

console.log('🧼 Purging unused CSS from main.min.css')

// const result = await postcss([
// 	purgecss({
// 		content: [
// 			'./resources/views/**/*.blade.php',
// 			'./resources/js/**/*.vue',
// 			'./resources/js/**/*.js',
// 		],
// 		defaultExtractor: content => content.match(/[\w-/:%]+(?<!:)/g) || [],
// 		safelist: ['active', /^show/, /^modal/, /^toast/],
// 	}),
// ]).process(legacyCSSOutput, { from: undefined })
//
// fs.writeFileSync(cssOutputPath, result.css)

console.log('📁 Copying TinyMCE')

execSync('cp -R vendor/tinymce/tinymce public/js/tinymce')

console.log('✅ Legacy build complete')