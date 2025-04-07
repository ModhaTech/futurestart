<template>
    <section class="bg-white text-black py-20">
        <div class="container mx-auto px-4">
            <h2 class="text-center text-sm text-gray-500 uppercase tracking-widest mb-2 animate__animated animate__fadeInDown">News</h2>
            <h3 class="text-center text-3xl md:text-4xl font-bold mb-12 animate__animated animate__fadeInDown animate__delay-1s">Latest Blogs</h3>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                <BlogCard
                        :blog="blog"
                        v-for="(blog, index) in blogs"
                        :key="index"
                        :image="`/${blog.blog_img}`"
                        :title="blog.title"
                        :summary="blog.content.slice(0, 120) + '...'"
                        :author="`${blog.author_first_name} ${blog.author_last_name}`"
                        :date="new Date(blog.date).toLocaleDateString('en-US', { month: 'short', day: '2-digit', year: 'numeric' })"
                />
            </div>
        </div>
    </section>
</template>

<script setup>
import BlogCard from '@/components/BlogCard.vue'

const props = defineProps({
	blogs: Array
})
</script>

<style scoped>
@import 'animate.css';
</style>