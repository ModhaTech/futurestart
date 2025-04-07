<template>
    <footer class="bg-[#151829] text-white py-10 px-6">
        <div class="max-w-7xl mx-auto grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-10">

            <!-- Quick Links -->
            <div>
                <h4 class="text-lg font-semibold mb-4 text-red-400">Quick Links</h4>
                <ul class="space-y-2 text-sm text-gray-300">
                    <li><Link :href="route('home')" class="hover:text-amber-400">Home</Link></li>
                    <li><Link :href="route('about-us')" class="hover:text-amber-400">About Us</Link></li>
                    <li><a :href="route('search.index')" class="hover:text-amber-400">Starr Search</a></li>
                    <li><a :href="route('talent.index')" class="hover:text-amber-400">Talent Mall</a></li>
                    <li><a :href="route('blog.index')" class="hover:text-amber-400">Blog</a></li>
                    <li><a :href="route('contact-us.index')" class="hover:text-amber-400">Contact Us</a></li>
                </ul>
            </div>

            <!-- Terms & Privacy -->
            <div>
                <h4 class="text-lg font-semibold mb-4 text-red-400">Terms & Privacy</h4>
                <ul class="space-y-2 text-sm text-gray-300">
                    <li><a :href="route('privacy-policy')" class="hover:text-amber-400">Privacy Policy</a></li>
                    <li><a :href="route('term-conditions')" class="hover:text-amber-400">Terms and Conditions</a></li>
                    <li><a :href="route('refund-policy')" class="hover:text-amber-400">Refund Policy</a></li>
                </ul>
            </div>

            <!-- Contact Info -->
            <div>
                <h4 class="text-lg font-semibold mb-4 text-red-400">Contact Us</h4>
                <p class="text-sm text-gray-300 leading-relaxed">
                    <span class="block">Phone: <a :href="`tel:${siteConfig.contact_number}`" class="hover:text-amber-400">{{ siteConfig.contact_number }}</a></span>
                    <span v-html="siteConfig.address"></span>
                </p>
            </div>

            <!-- Social & App -->
            <div>
                <h4 class="text-lg font-semibold mb-4 text-red-400">Connect with Us</h4>
                <div class="flex space-x-4 mb-4 text-xl">
                    <a :href="siteConfig.facebook" target="_blank" class="bg-white hover:bg-red-600 rounded-full px-3 py-1 transition-all">
                        <font-awesome-icon :icon="['fab', 'facebook-f']" class=" text-black"></font-awesome-icon>
                    </a>
                    <a :href="siteConfig.twitter" target="_blank" class="bg-white hover:bg-red-600 rounded-full px-2 py-1 transition-all">
                        <font-awesome-icon :icon="['fab', 'twitter']" class="text-black"></font-awesome-icon>
                    </a>
                    <a :href="siteConfig.linkedin" target="_blank"  class="bg-white hover:bg-red-600 rounded-full px-2.5 py-1 transition-all">
                        <font-awesome-icon  :icon="['fab', 'linkedin']" class="text-black"></font-awesome-icon>
                    </a>
                    <a href="https://feeds.feedburner.com/futurestarr/KCicQxJTEqv" target="_blank"  class="bg-white hover:bg-red-600 rounded-full px-2.5 py-1 transition-all">
                        <font-awesome-icon icon="fa-rss" class="text-black"></font-awesome-icon>
                    </a>
                </div>

                <a href="https://play.google.com/store/apps/details?id=com.futurestarrmarketplace&pli=1" target="_blank">
                    <img :src="googlePlayImage" alt="Google Play" class="w-36">
                </a>
            </div>

        </div>

        <!-- Footer Bottom -->
        <div class="mt-10 border-t border-gray-700 pt-6 text-center text-xs text-gray-400">
            &copy; {{ new Date().getFullYear() }} Future Starr Media LLC. All rights reserved.
        </div>

        <BackToTop />
    </footer>
</template>

<script setup>
import googlePlayImage from '@images/webp/google-play.webp'
import { computed, onMounted } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';

import { useHelpCrunch } from '@/composables/useHelpCrunch'
import BackToTop from '@/components/layouts/BackToTop.vue';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';

const { loadHelpCrunch } = useHelpCrunch()


onMounted(() => {
	loadHelpCrunch()
})

const page = usePage()
const siteConfig = computed(() => page.props.siteConfig)
const routes = computed(() => page.props.ziggy.routes)
</script>