<template>
    <section class="bg-gradient-to-b from-gray-50 via-white to-gray-100 text-black py-20">
        <div class="container mx-auto px-4">
            <h2 class="text-center text-3xl md:text-4xl font-bold mb-4 animate__animated animate__fadeInDown">Explore</h2>
            <p class="text-center text-gray-600 mb-12 max-w-3xl mx-auto animate__animated animate__fadeInUp">
                Explore, acquire, and engage your clients or mentor's dreams and targeted audiences with our customized online campaigns. Grow your career with Future Starr’s marketplace.
            </p>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                <MarketplaceCard :url="route('search.index', {'slug': 'comedy'})" :video="comedy" title="Comedy" desc="Become the Best Standup Comedian. It takes hard work and determination for comedians to get their careers off the ground." />
                <MarketplaceCard :url="route('search.index', {'slug': 'food'})" :video="food" title="Food" desc="Turn your cooking talent into a digital business. Future Starr reaches chefs and food creatives wanting to earn from their passion." />
                <MarketplaceCard :url="route('search.index', {'slug': 'photography'})" :video="photography" title="Photography" desc="Embrace different types of photography. Future Starr connects visual artists to fans and clients alike." />
                <MarketplaceCard :url="route('search.index', {'slug': 'cosmetics'})" :video="cosmetics" title="Cosmetics" desc="Sell your camera-ready looks! Upcoming makeup artists can launch beauty careers here." />
                <MarketplaceCard :url="route('search.index', {'slug': 'mathematics'})" :video="math" title="Mathematics" desc="Math tutors can earn and reach students directly. Become a self-employed educator with Future Starr." />
                <MarketplaceCard :url="route('search.index', {'slug': 'science'})" :video="science" title="Science" desc="Advance your science career online. Upload lessons or conduct online demos." />
                <MarketplaceCard :url="route('search.index', {'slug': 'fashion-designer'})" :video="fashion" title="Fashion Designer" desc="Fashion creators can showcase lookbooks, styling reels, and sell their creations." />
                <MarketplaceCard :url="route('search.index', {'slug': 'music'})" :video="music" title="Music" desc="Sell your lyrics, beats, and tracks online. Connect with global music lovers and buyers." />
            </div>
        </div>
    </section>
</template>

<script setup>
import comedy from '@video/talentmallpage-categ-Comedy.mp4'
import food from '@video/talentmallpage-categ-Food.mp4'
import photography from '@video/talentmallpage-categ-Photography.mp4'
import cosmetics from '@video/talentmallpage-categ-Cosmetics.mp4'
import math from '@video/talentmallpage-categ-Math.mp4'
import science from '@video/talentmallpage-categ-Science.mp4'
import fashion from '@video/talentmallpage-categ-Fashion.mp4'
import music from '@video/talentmallpage-categ-Music.mp4'
import MarketplaceCard from './MarketplaceCard.vue';
</script>


<style scoped>
@import 'animate.css';
</style>