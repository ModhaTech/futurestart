// postcss.purgecss.config.js
const purgecss = require('@fullhuman/postcss-purgecss')

module.exports = {
	plugins: [
		purgecss({
			content: [
				'./resources/views/**/*.blade.php',
				'./resources/js/**/*.vue',
				'./resources/js/**/*.js',
			],
			defaultExtractor: content => content.match(/[\w-/:%]+(?<!:)/g) || [],
		}),
	],
}