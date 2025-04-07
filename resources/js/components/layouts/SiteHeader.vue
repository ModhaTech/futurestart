<template>
    <nav :class="[
          'fixed top-0 left-0 right-0 z-50 transition-all duration-300',

        ]"
    >
        <div class="container mx-auto px-4 flex items-center justify-between h-16">
            <!-- Logo / Toggle -->
            <div class="flex items-center">
                <button
                        class="flex flex-col justify-center items-center mr-4 md:hidden"
                        @click="isMobileMenuOpen = !isMobileMenuOpen"
                >
                    <span class="w-6 h-0.5 bg-white mb-1"></span>
                    <span class="w-6 h-0.5 bg-white mb-1"></span>
                    <span class="w-6 h-0.5 bg-white"></span>
                </button>
                <a :href="'/'" :class="user ? 'text-white font-bold' : 'text-white'">
                    <img
                            class="h-10 cursor-pointer"
                            :src="siteConfig.logo || '/assets/images/futurelogo.png'"
                            :class="user ? 'mt-1' : 'ml-2'"
                            alt="futurestarr logo"
                    />
                </a>
            </div>

            <!-- Nav Items -->
            <div class="hidden md:flex items-center space-x-4 bg-black rounded-full pl-4">
                <Link
                        :class="[
    'text-sm hover:text-yellow-400 transition-all duration-200 cursor-pointer',
    currentRoute === 'home' ? 'text-amber-400' : 'text-white'
  ]"
                        href="/"
                >
                    HOME
                </Link>

                <a
                        :class="[
    'text-sm hover:text-yellow-400 transition-all duration-200 cursor-pointer',
    currentRoute === 'search.index' ? 'text-amber-400' : 'text-white'
  ]"
                        :href="route('search.index')"
                >
                    STARR SEARCH
                </a>

                <a
                        :class="[
    'text-sm hover:text-yellow-400 transition-all duration-200 cursor-pointer',
    currentRoute === 'talent.index' ? 'text-amber-400' : 'text-white'
  ]"
                        :href="route('talent.index')"
                >
                    TALENT MALL
                </a>

                <a
                        :class="[
    'text-sm hover:text-yellow-400 transition-all duration-200 cursor-pointer',
    (currentRoute === 'blog.index' || currentRoute === 'blog.detailed') ? 'text-amber-400' : 'text-white'
  ]"
                        :href="route('blog.index')"
                >
                    BLOG
                </a>

                <!-- Dropdown -->
                <div v-if="user && user.role_id !== 1" class="relative group">
                    <button class="text-white text-sm hover:text-yellow-400 flex items-center cursor-pointer">
                        <img v-if="user.profile_pic" :src="user.profile_pic" class="w-6 h-6 rounded-full mr-2"/>
                        My Account
                        <svg class="w-4 h-4 ml-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                  d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414L10 13.414 5.293 8.707a1 1 0 010-1.414z"
                                  clip-rule="evenodd"/>
                        </svg>
                    </button>
                    <ul class="absolute top-full left-0 bg-white text-black rounded-md shadow-md p-2 w-48 z-10 hidden group-hover:block">
                        <li><a class="block py-1 hover:bg-gray-100 cursor-pointer" :href="manageProfileLink">Manage Public Profile</a>
                        </li>
                        <li><a class="block py-1 hover:bg-gray-100 cursor-pointer" :href="route('user.delete-account')">Delete
                            Account</a></li>
                        <li v-if="user.role_id == 3"><a class="block py-1 hover:bg-gray-100 cursor-pointer"
                                                        :href="route('buyer.edit')">Account Info</a></li>
                        <li v-if="user.role_id == 3"><a class="block py-1 hover:bg-gray-100 cursor-pointer"
                                                        :href="route('buyer.billing.account')">Billing Account</a></li>
                        <li v-if="user.role_id == 3"><a class="block py-1 hover:bg-gray-100 cursor-pointer"
                                                        :href="route('buyer.changePassword')">Security</a></li>
                        <li v-if="user.role_id == 3"><a class="block py-1 hover:bg-gray-100 cursor-pointer"
                                                        :href="route('buyer.t-shirt')">T-Shirt</a></li>
                        <li v-if="user.role_id == 3"><a class="block py-1 hover:bg-gray-100 cursor-pointer"
                                                        :href="route('buyer.checkout.show')">T-Shirt-Checkout</a></li>
                        <li v-if="user.role_id == 4"><a class="block py-1 hover:bg-gray-100 cursor-pointer"
                                                        :href="route('seller.edit')">Account Info</a></li>
                        <li v-if="user.role_id == 4"><a class="block py-1 hover:bg-gray-100 cursor-pointer"
                                                        :href="route('seller.changePassword')">Security</a></li>
                        <li><a class="block py-1 hover:bg-gray-100 cursor-pointer" href="#" @click.prevent="logout">Logout</a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <a class="text-sm hover:text-yellow-400 transition-all duration-200 cursor-pointer"
                   :href="route('contact-us.index')">
                    CONTACT US
                </a>

                <SearchDropdown class="-mr-1">
                    <template #input="{ query, handleFocus, debouncedSearch }">
                        <div class="w-[220px] bg-amber-400 pl-8 pr-6 py-4 rounded-full flex items-center">
                            <input
                                    type="text"
                                    name="qTalent"
                                    id="qTalent"
                                    :value="query"
                                    @focus="handleFocus"
                                    @keydown.enter.prevent
                                    @input="(e) => debouncedSearch(e.target.value)"
                                    placeholder="Search"
                                    data-lpignore="true"
                                    autocomplete="off"
                                    class="w-full ring-0 outline-0"
                                    ref="searchInput"
                            />
                            <font-awesome-icon icon="fa-magnifying-glass" class="text-white cursor-pointer" @click="debouncedSearch(searchInput.value)"></font-awesome-icon>
                        </div>
                    </template>
                    <template #dropdown="{isMobile, isOpen, query, hasResults, results, loading }">
                        <div
                                v-if="!isMobile && isOpen && query.length > 1 && hasResults"
                                class="absolute -left-[130px] mt-0 w-[350px] bg-white rounded-lg shadow-lg z-50 max-h-96 overflow-y-auto space-y-4 p-4 hidden md:block"
                        >
                            <SearchResults :results="results" :loading="loading" :query="query"/>
                        </div>
                    </template>
                </SearchDropdown>
            </div>
        </div>

        <!-- Mobile Menu -->
        <transition name="fade">
            <div v-if="isMobileMenuOpen"
                 class="md:hidden fixed top-16 left-0 right-0 bg-black/90 text-white py-6 z-40 animate__animated animate__fadeIn">
                <div class="flex flex-col items-center space-y-4">
                    <a class="text-lg hover:text-yellow-400 transition-all cursor-pointer" href="/">HOME</a>
                    <a class="text-lg hover:text-yellow-400 transition-all cursor-pointer" :href="route('search.index')">STARR
                        SEARCH</a>
                    <a class="text-lg hover:text-yellow-400 transition-all cursor-pointer" :href="route('talent.index')">TALENT
                        MALL</a>
                    <a class="text-lg hover:text-yellow-400 transition-all cursor-pointer" :href="route('blog.index')">BLOG</a>
                    <a class="text-lg hover:text-yellow-400 transition-all cursor-pointer"
                       :href="route('contact-us.index')">CONTACT</a>
                    <a v-if="user" class="text-lg hover:text-yellow-400 transition-all" href="#"
                       @click.prevent="logout">LOGOUT</a>
                </div>
            </div>
        </transition>
    </nav>
</template>

<script setup>
import { ref, computed, onMounted, onBeforeUnmount } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';
import NavbarSearchDropdown from '../NavbarSearchDropdown.vue';
import { MenuButton } from '@headlessui/vue';
import SearchDropdown from '../SearchDropdown.vue';
import SearchResults from '../SearchResults.vue';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';


const isMobileMenuOpen = ref(false);
const hasScrolled = ref(false);
const searchInput = ref();

const handleScroll = () => {
	hasScrolled.value = window.scrollY > 10;
};

onMounted(() => {
	window.addEventListener('scroll', handleScroll);
});

onBeforeUnmount(() => {
	window.removeEventListener('scroll', handleScroll);
});

const page = usePage();

const user = computed(() => page.props.auth?.user || null);
const siteConfig = computed(() => page.props.site_config || {});
const currentRoute = route().current();
const routes = computed(() => page.props.routes || {});

console.log(currentRoute);

const manageProfileLink = computed(() => {
	if ( !user.value ) return '#';
	return user.value.role_id === 4
		? routes.value['seller.public.profile']
		: routes.value['buyer.public.profile'];
});

const logout = () => {
	const form = document.createElement('form');
	form.method = 'POST';
	form.action = routes.value['logout'];

	const token = document.createElement('input');
	token.type = 'hidden';
	token.name = '_token';
	token.value = page.props.csrf || '';

	form.appendChild(token);
	document.body.appendChild(form);
	form.submit();
};
</script>

<style>
@import 'animate.css';

.fade-enter-active, .fade-leave-active {
    transition: opacity 0.3s ease;
}

.fade-enter-from, .fade-leave-to {
    opacity: 0;
}
</style>
