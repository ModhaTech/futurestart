<template>
    <a :href="url" class="cursor-pointer d-block bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow animate__animated animate__fadeInUp">
        <video
                :src="video"
                autoplay
                muted
                loop
                playsinline
                class="w-full h-48 object-cover"
        ></video>
        <div class="p-4">
            <h3 class="text-lg font-bold mb-2">{{ title }}</h3>
            <p class="text-sm text-gray-600">{{ desc }}</p>
        </div>
    </a>
</template>
<script setup>
const props = defineProps(['video', 'title', 'desc', 'url'])
</script>