const fs = require('fs')
const path = require('path')
const sharp = require('sharp')

// Folder with your PNGs
const inputDir = '../resources/images'
const outputDir = '../resources/images/webp'

// Make sure output directory exists
if (!fs.existsSync(outputDir)) fs.mkdirSync(outputDir)

fs.readdirSync(inputDir)
	.filter(file => file.endsWith('.png'))
	.forEach(file => {
		const inputPath = path.join(inputDir, file)
		const outputPath = path.join(outputDir, file.replace('.png', '.webp'))

		sharp(inputPath)
			.webp({ quality: 80 }) // adjust quality (50-85 is typical)
			.toFile(outputPath)
			.then(() => console.log(`Converted: ${file} -> ${path.basename(outputPath)}`))
			.catch(err => console.error(`Error converting ${file}:`, err))
	})