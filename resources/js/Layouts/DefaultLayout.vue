<template>
    <div>
        <SiteHeader />

        <main>
            <slot />
        </main>

        <SiteFooter />
    </div>
</template>

<script setup>
// You can import composables, stores, etc., here if needed
import SiteHeader from '@/components/layouts/SiteHeader.vue';
import SiteFooter from '@/components/layouts/SiteFooter.vue';
</script>