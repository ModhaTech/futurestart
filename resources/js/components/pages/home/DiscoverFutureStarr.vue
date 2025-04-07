<template>
    <section class="bg-black text-white py-20">
        <div class="container mx-auto flex flex-col lg:flex-row items-center px-6 gap-10">
            <!-- Left: Text Block -->
            <div class="w-full lg:w-1/2 max-w-2xl">
                <h3 class="text-sm text-red-500 font-semibold uppercase mb-2">Discover</h3>
                <h2 class="text-3xl md:text-4xl font-bold mb-6">Future Starr</h2>
                <p class="text-lg leading-relaxed mb-4">
                    Future Starr is a unique talent platform that ensures direct engagement between creators and audiences.
                    Upload your videos, PDFs, or MP3s — we’ll help you share and monetize your talent.
                </p>
                <p class="text-lg leading-relaxed mb-6">
                    Become a global star by connecting with real fans. Showcase your talent, grow your audience, and get rewarded for your creativity.
                </p>
                <a
                        href="https://play.google.com/store/apps/details?id=com.futurestarrmarketplace&pli=1"
                        target="_blank"
                        class="inline-block bg-red-500 hover:bg-red-600 text-white px-6 py-3 rounded-full font-semibold transition"
                >
                    Get the App
                </a>
            </div>


            <!-- Right: Mobile App Image -->
            <a href="https://play.google.com/store/apps/details?id=com.futurestarrmarketplace&pli=1" target="_blank" class="w-full lg:w-1/2 flex justify-center">
                <img
                        :src="futureStarrAppPromoImage"
                        alt="Future Starr App"
                        class="max-w-xl w-full rounded-xl shadow-lg"
                />
            </a>
        </div>
    </section>
</template>
<script setup>
import futureStarrAppPromoImage from '@images/webp/playstore-image.webp'
</script>