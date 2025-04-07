<template>
    <div class="relative min-h-screen bg-cover bg-center flex items-center justify-center" :style="{ backgroundImage: `url('${backgroundImage}')` }">
        <!-- Overlay -->
        <div class="absolute inset-0 bg-black/20 z-10"></div>
        <!-- Hero content -->
        <div class="relative z-20 flex flex-col items-center justify-center text-center text-white px-4">
           <div class="bg-black max-w-[90%] md:max-w-[550px] md:min-w-[550px] -skew-y-12 py-6 relative">
               <LoginDialog>
                   <template #activator="{ loginDialog }">
                       <button
                               class="relative bg-amber-400 px-10 py-4 text-3xl w-[245px] cursor-pointer -top-[60px] md:hidden"
                               @click="loginDialog.open()"
                       >
                           SIGN IN
                       </button>
                   </template>
               </LoginDialog>
               <div class="relative -top-[22px] md:top-0">
                   <span class="text-5xl text-bold">FUTURE</span><span class="text-amber-400 text-5xl text-bold">STARR</span>
                   <p class="mt-4 text-2xl">
                       THE ULTIMATE TALENT MARKETPLACE
                   </p>
               </div>

               <div class="mt-4 text-center md:flex justify-center gap-4 absolute bottom-[-30px] md:bottom-[-60px] left-[20px] left-[50%] ml-[-50%] w-full">
                   <a href="/register" class="bg-blue-400 px-10 py-4 text-3xl w-[245px] mr-0"> EARN NOW </a>
                   <LoginDialog>
                       <template #activator="{ loginDialog }">
                           <button
                                   class="bg-amber-400 px-10 py-4 text-3xl w-[245px] cursor-pointer hidden md:block"
                                   @click="loginDialog.open()"
                           >
                               SIGN IN
                           </button>
                       </template>
                   </LoginDialog>

               </div>
           </div>
        </div>
    </div>

    <FeaturedArtists />
    <LetsGetStarted />
    <DiscoverFutureStarr />
    <ExploreMarketplace />
    <BlogListings :blogs="blogs"/>
</template>

<script setup>
import { ref, onMounted, onBeforeUnmount } from 'vue';
import heroDesktop from '@images/webp/hero-bg-new.webp';
import heroMobile from '@images/webp/hero-bg-new-mobile.webp';
import FeaturedArtists from '@/components/pages/home/FeaturedArtists.vue';
import DiscoverFutureStarr from '@/components/pages/home/DiscoverFutureStarr.vue';
import LetsGetStarted from '../components/pages/home/LetsGetStarted.vue';
import ExploreMarketplace from '../components/pages/home/ExploreMarketplace.vue';
import BlogListings from '../components/BlogListings.vue';
import { usePage } from '@inertiajs/vue3';

import LoginDialog from '../components/dialogs/LoginDialog.vue';

const backgroundImage = ref('')
const showDialog = ref(false)

// Method to update background based on screen width
const updateBackground = () => {
	backgroundImage.value = window.innerWidth < 768 ? heroMobile : heroDesktop
}

onMounted(() => {
	updateBackground()
	window.addEventListener('resize', updateBackground)
})

onBeforeUnmount(() => {
	window.removeEventListener('resize', updateBackground)
})

const blogs = usePage().props.blogs
</script>

<style>
@import 'animate.css';

body {
    font-family: 'Inter', sans-serif;
}

.fade-enter-active, .fade-leave-active {
    transition: opacity 0.3s ease;
}
.fade-enter-from, .fade-leave-to {
    opacity: 0;
}
</style>
