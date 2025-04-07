<template>
    <div class="bg-white text-gray-800">
        <!-- Hero Banner -->
        <section
                class="relative h-[300px] bg-cover bg-center flex items-center justify-center"
                :style="{ backgroundImage: `url(${bannerImage})` }"
        >
            <div class="absolute inset-0 bg-black/40"></div>
            <h1 class="relative z-10 text-white text-4xl font-bold">About Us</h1>
        </section>

        <section class="max-w-7xl mx-auto px-4 py-20 grid md:grid-cols-2 gap-12">
            <!-- Image -->
            <div class="rounded-xl overflow-hidden shadow-md">
                <img :src="aboutImage" alt="Future Starr Artists" class="w-full h-full object-cover" />
            </div>

            <!-- Content -->
            <div class="space-y-6">
                <h2 class="text-3xl font-bold text-[#050223]">Do you want to be successful?</h2>

                <p class="text-gray-700">
                    It is not enough to want success, you must be passionate about it, you must be determined and ready to make
                    sacrifices to achieve what you want. Before we look at what successful celebrities have in common, let's take a
                    look at what is stopping you from achieving the type of success you want.
                </p>

                <p class="text-gray-700">
                    Most people just want to be famous, they don't care how they achieve it. They dabble in whatever they think could
                    bring them fame. If you want to be successful, concentrate on what you want to be known for.
                </p>

                <div class="space-y-5">
                    <div>
                        <h3 class="text-[#ff503f] text-xl font-semibold">Talent Can Become Successfully Driven with Future Starr</h3>
                        <p class="text-gray-700">
                            The Talent Alliance uses standardized tests to assess abilities and match people with appropriate employers.
                            It started as a job bank and evolved into a full talent assessment platform.
                        </p>
                    </div>

                    <div>
                        <h3 class="text-[#ff503f] text-xl font-semibold">Motivation</h3>
                        <p class="text-gray-700">
                            Atlanta is competitive, but with talent and determination, you can succeed with Future Starr. Upload your best
                            work and monetize it directly.
                        </p>
                    </div>

                    <div>
                        <h3 class="text-[#ff503f] text-xl font-semibold">Compensation</h3>
                        <p class="text-gray-700">
                            Our platform helps you earn by showcasing your photos, media, or services. It's an opportunity to be discovered
                            without relying on agencies.
                        </p>
                    </div>

                    <div>
                        <h3 class="text-[#ff503f] text-xl font-semibold">Retention</h3>
                        <p class="text-gray-700">
                            Retaining top talent is vital. We help candidates get familiar with company culture and expectations early,
                            improving satisfaction and reducing churn.
                        </p>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-wrap gap-4 pt-4">
                    <template v-if="isAuthenticated">
                        <a
                                :href="route('buyer.dashboard')"
                                class="px-6 py-3 bg-red-600 text-white rounded hover:bg-red-700 transition"
                        >
                            BUY TALENT
                        </a>
                        <a :href="route('seller.dashboard')" class="about-us-sm read-more-btn-onslider about-us-color">SELL YOUR TALENT</a>
                    </template>
                    <template v-else>
                        <a
                                :href="route('register')"
                                class="px-6 py-3 bg-red-600 text-white rounded hover:bg-red-700 transition"
                        >
                            BUY TALENT
                        </a>
                        <a
                                :href="route('register')"
                                class="px-6 py-3 bg-amber-400 text-black rounded hover:bg-amber-500 transition"
                        >
                            SELL YOUR TALENT
                        </a>
                    </template>
                </div>
            </div>
        </section>
    </div>
</template>

<script setup>
import bannerImage from '@images/webp/welcome-banner.webp'
import aboutImage from '@images/webp/welcome.webp'
import { computed } from 'vue'
import { usePage } from '@inertiajs/vue3'

const page = usePage()
const isAuthenticated = computed(() => page.props.auth?.user)
</script>

<style scoped>
/* additional spacing or transitions if needed */
</style>