<template>
    <transition name="fade">
        <button
                v-if="isVisible"
                @click="scrollToTop"
                class="fixed bottom-6 right-6 z-50 bg-red-600 text-white p-3 rounded-full shadow-lg hover:bg-red-700 focus:outline-none"
                aria-label="Back to top"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
            </svg>
        </button>
    </transition>
</template>

<script setup>
import { ref, onMounted, onBeforeUnmount } from 'vue'

const isVisible = ref(false)

const toggleVisibility = () => {
	isVisible.value = window.scrollY > 200
}

const scrollToTop = () => {
	window.scrollTo({ top: 0, behavior: 'smooth' })
}

onMounted(() => {
	window.addEventListener('scroll', toggleVisibility)
})

onBeforeUnmount(() => {
	window.removeEventListener('scroll', toggleVisibility)
})
</script>

<style scoped>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.3s ease;
}
.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
</style>