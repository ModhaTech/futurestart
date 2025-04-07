<template>
    <a :href="blogUrl" class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow animate__animated animate__fadeInUp">
        <img :src="image" :alt="title" class="w-full h-60 object-cover" />
        <div class="p-5">
            <h3 class="font-semibold text-lg mb-2 leading-tight line-clamp-2">{{ title }}</h3>
            <p class="text-sm text-gray-600 mb-4 line-clamp-3" v-html="summary"></p>
            <div class="text-xs text-gray-500 flex items-center justify-between">
                <span>By {{ author }}</span>
                <span>{{ date }}</span>
            </div>
        </div>
    </a>
</template>

<script setup>
import { computed } from 'vue';

const props = defineProps({
    blog: Object,
	image: String,
	title: String,
	summary: String,
	author: String,
	date: String
})

const blogUrl = computed(() => {
	const firstCategory = props.blog.get_blog_catagories.name
	return `/blog/${firstCategory}/${props.blog.slug}`
})
</script>

<style scoped>
@import 'animate.css';
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
