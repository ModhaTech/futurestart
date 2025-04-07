<template>
    <section class="bg-white text-black py-20">
        <div class="container mx-auto px-4 flex flex-col md:flex-row items-center gap-12">
            <!-- Image stack -->
            <div class="relative w-full md:w-1/2 flex justify-center animate__animated animate__fadeInLeft">
                <img :src="sideImage" alt="Front selfie" class="w-72 md:-80 rounded-lg shadow-2xl relative z-10">
            </div>

            <!-- Text block -->
            <div class="w-full md:w-1/2 animate__animated animate__fadeInRight">
                <h2 class="text-3xl md:text-4xl font-bold mb-6">Let's <span class="text-red-500">get Started!</span></h2>
                <div class="space-y-12">
                    <div>
                        <h3 class="font-semibold text-lg">🌐 How to use FutureStarr.com</h3>
                        <p class="text-sm mt-1">First, create an account. Once set up, use your talent dashboard to discover and view other talent, upload your own, and create an artist page.</p>
                    </div>
                    <div>
                        <h3 class="font-semibold text-lg">🎬 Visit upcoming talent on FutureStarr.com</h3>
                        <p class="text-sm mt-1">Discover songs, books, or videos uploaded by unsigned talents across various genres. It's free and inspiring.</p>
                    </div>
                    <div>
                        <h3 class="font-semibold text-lg">🛠 Create an artist page on FutureStarr.com</h3>
                        <p class="text-sm mt-1">Your Artist Page lets you showcase images, videos, eBooks, and up to five MP3s — all in one place.</p>
                    </div>
                    <a href="/register" class="bg-black text-white px-6 py-3 rounded-full text-sm hover:bg-gray-900 transition-all">CLICK HERE TO CREATE PAGE</a>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
import sideImage from '@images/webp/get-started-front.webp'
</script>

<style scoped>
@import 'animate.css';
</style>
