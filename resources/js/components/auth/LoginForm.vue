<template>
    <div class="flex flex-col md:flex-row bg-[#050223] text-white rounded-lg overflow-hidden w-full max-w-4xl">
        <!-- Left: Login Form -->
        <div class="flex-1 p-6 md:p-10">
            <h3 class="text-white text-2xl font-bold mb-6">Login</h3>

            <form @submit.prevent="submit" class="space-y-4">
                <Alert v-if="hasErrors && errors.email" variant="error" >
                    {{ errors.email }}
                </Alert>
                <!-- Email -->
                <div class="flex items-center bg-white text-black rounded overflow-hidden">
                      <span class="bg-[#ff503f] px-4 py-3 text-white">
                        <font-awesome-icon icon="user" class="text-text-white"/>
                      </span>
                    <input
                            v-model="form.email"
                            type="text"
                            placeholder="User name OR Email"
                            required
                            class="w-full px-4 py-3 outline-none"
                    />
                </div>

                <!-- Password -->
                <div class="flex items-center bg-white text-black rounded overflow-hidden">
                  <span class="bg-[#ff503f] px-4 py-3 text-white">
                     <font-awesome-icon icon="lock" class="text-white"/>
                  </span>

                    <input
                            :type="showPassword ? 'text' : 'password'"
                            v-model="form.password"
                            placeholder="Password"
                            required
                            class="w-full px-4 py-3 outline-none"
                    />
                    <button
                            type="button"
                            @click="showPassword = !showPassword"
                            class="px-3 text-gray-500 hover:text-gray-700"
                    >
                        <i :class="showPassword ? 'fa fa-eye-slash' : 'fa fa-eye'"></i>
                    </button>
                </div>

                <!-- Remember + Forgot -->
                <div class="flex justify-between items-center text-sm">
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" v-model="form.remember"/>
                        <span>Remember Password</span>
                    </label>

                    <a
                            v-if="forgotPasswordUrl"
                            :href="forgotPasswordUrl"
                            class="text-[#ff503f] hover:underline"
                    >
                        Forgot Password?
                    </a>
                </div>

                <!-- Login Button -->
                <button
                        type="submit"
                        class="bg-[#ff503f] hover:bg-[#e04333] text-white w-full py-3 rounded font-bold"
                >
                    LOG IN
                </button>
            </form>

            <!-- Social -->
            <div class="mt-8 text-center">
                <p class="mb-3">Sign In with</p>
                <div class="flex justify-center gap-4">
                    <a :href="route('signin_with_facebook')"
                       class="bg-[#ff503f] text-white font-bold py-2 px-4 rounded">
                        LOGIN WITH FACEBOOK
                    </a>
                    <a :href="route('signin_with_linkedin')"
                       class="bg-[#ff503f] text-white font-bold py-2 px-4 rounded cursor-pointer">
                        LOGIN WITH LINKEDIN
                    </a>
                </div>
            </div>
        </div>

        <!-- Right: Image -->
        <div class="hidden md:block flex-1">
            <img
                    :src="news21Image"
                    alt="Login Visual"
                    class="h-full w-full object-cover"
            />
        </div>
    </div>
</template>

<script setup>
import { computed, ref } from 'vue';
import { router } from '@inertiajs/vue3';
import { route } from 'ziggy-js';
import news21Image from '@images/webp/news-21.webp';
import Alert from '@/components/ui/Alert.vue';
import { usePage } from '@inertiajs/vue3';

const forgotPasswordUrl = route('password.request');

const form = ref({
	email: '',
	password: '',
	remember: false
});

const showPassword = ref(false);

const errors = computed(() => usePage().props.errors || {});

const hasErrors = computed(() => {
	return Object.keys(errors.value).length > 0
})

const submit = () => {
	router.post(route('login'), form.value);
};
</script>
