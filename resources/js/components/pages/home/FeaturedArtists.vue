<template>
    <section class="bg-gradient-to-b from-black via-gray-900 to-black text-white py-20">
        <div class="container mx-auto px-4">
            <!-- Why Choose Section -->
            <div class="text-center mb-16 animate__animated animate__fadeInUp">
                <h2 class="text-3xl md:text-4xl font-bold mb-10">WHY CHOOSE FUTURE STARR</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                    <div class="bg-white text-black rounded-xl p-6 shadow-md text-center animate__animated animate__fadeInUp">
                        <div class="text-4xl mb-4">🚀</div>
                        <h3 class="font-semibold text-lg mb-2">Take Control</h3>
                        <p class="text-sm">Turn your entertainment journey into a business. From rookie to star, our tools support every step.</p>
                    </div>
                    <div class="bg-white text-black rounded-xl p-6 shadow-md text-center animate__animated animate__fadeInUp animate__delay-1s">
                        <div class="text-4xl mb-4">🔍</div>
                        <h3 class="font-semibold text-lg mb-2">Explore Talent</h3>
                        <p class="text-sm">Discover and support emerging artists, helping them reach new heights.</p>
                    </div>
                    <div class="bg-white text-black rounded-xl p-6 shadow-md text-center animate__animated animate__fadeInUp animate__delay-2s">
                        <div class="text-4xl mb-4">📈</div>
                        <h3 class="font-semibold text-lg mb-2">Earn Your Stardom</h3>
                        <p class="text-sm">Build your fanbase and monetize your content — your career, your rules.</p>
                    </div>
                    <div class="bg-white text-black rounded-xl p-6 shadow-md text-center animate__animated animate__fadeInUp animate__delay-3s">
                        <div class="text-4xl mb-4">🏆</div>
                        <h3 class="font-semibold text-lg mb-2">Get Rewarded</h3>
                        <p class="text-sm">Showcase your uniqueness, grow your audience and earn — while you create.</p>
                    </div>
                </div>
            </div>

            <!-- Featured Artists Section -->
            <div class="text-center bg-gray-950 py-16 rounded-xl animate__animated animate__fadeInUp">
                <h2 class="text-3xl md:text-4xl font-bold mb-10">FEATURED ARTISTS</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-10">
                    <!-- Artist 1 -->
                    <div class="text-center animate__animated animate__fadeInUp">
                        <img :src="featuredArtist3Image" alt="Jazzy B" class="mx-auto rounded-full w-32 h-32 sm:w-36 sm:h-36 md:w-40 md:h-40 object-cover mb-4">
                        <h3 class="font-bold text-lg">JAZZY B</h3>
                        <p class="text-sm mt-2 px-2 md:px-4">High-energy Atlanta hip-hop artist with an intense following. Known for her dynamic stage presence.</p>
<!--                        <div class="flex justify-center space-x-3 mt-4">-->
<!--                            <button class="bg-purple-600 hover:bg-purple-500 px-4 py-2 rounded-full text-white text-sm">Watch</button>-->
<!--                            <button class="bg-gray-800 hover:bg-gray-700 px-4 py-2 rounded-full text-white text-sm">Follow</button>-->
<!--                        </div>-->
                    </div>

                    <!-- Artist 2 -->
                    <div class="text-center animate__animated animate__fadeInUp animate__delay-1s">
                        <img :src="featuredArtist2Image" alt="DJ BeatMaster B" class="mx-auto rounded-full w-32 h-32 sm:w-36 sm:h-36 md:w-40 md:h-40 object-cover mb-4">
                        <h3 class="font-bold text-lg">DJ BEATMASTER B</h3>
                        <p class="text-sm mt-2 px-2 md:px-4">Atlanta-based DJ known for electrifying beats and epic party vibes, spinning tracks that ignite the crowd.</p>
<!--                        <div class="flex justify-center space-x-3 mt-4">-->
<!--                            <button class="bg-purple-600 hover:bg-purple-500 px-4 py-2 rounded-full text-white text-sm">Watch</button>-->
<!--                            <button class="bg-gray-800 hover:bg-gray-700 px-4 py-2 rounded-full text-white text-sm">Follow</button>-->
<!--                        </div>-->
                    </div>

                    <!-- Artist 3 -->
                    <div class="text-center animate__animated animate__fadeInUp animate__delay-2s">
                        <img :src="featuredArtist1Image" alt="Rhythm and Flow" class="mx-auto rounded-full w-32 h-32 sm:w-36 sm:h-36 md:w-40 md:h-40 object-cover mb-4">
                        <h3 class="font-bold text-lg">RHYTHM & FLOW</h3>
                        <p class="text-sm mt-2 px-2 md:px-4">A hip-hop duo that skyrocketed to fame with their engaging performances and powerful lyrical flow.</p>
<!--                        <div class="flex justify-center space-x-3 mt-4">-->
<!--                            <button class="bg-purple-600 hover:bg-purple-500 px-4 py-2 rounded-full text-white text-sm">Watch</button>-->
<!--                            <button class="bg-gray-800 hover:bg-gray-700 px-4 py-2 rounded-full text-white text-sm">Follow</button>-->
<!--                        </div>-->
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
import featuredArtist1Image from '@images/webp/featured-artists-1.webp'
import featuredArtist2Image from '@images/webp/featured-artists-2.webp'
import featuredArtist3Image from '@images/webp/featured-artists-3.webp'
</script>

<style scoped>
@import 'animate.css';
</style>