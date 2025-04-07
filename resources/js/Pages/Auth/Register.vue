<template>
    <div class="bg-white min-h-screen py-10">
        <div class="max-w-4xl mx-auto bg-gray-50 rounded-lg shadow-lg overflow-hidden flex flex-col md:flex-row">
            <!-- Left Welcome Panel -->
            <div class="bg-gradient-to-b from-[#FF503F] to-[#010134] text-white p-8 md:w-1/3 text-center">
<!--                <img src="/assets/images/futurelogo.png" alt="Future Starr" class="mx-auto w-24 mb-4" />-->
                <h2 class="text-xl font-bold">Welcome</h2>
                <p class="text-sm mt-2">You are about to gain access to some of the best undiscovered Talent in the world</p>
                <button @click="emit('show-login')" class="mt-6 px-4 py-2 bg-white text-[#010134] font-semibold rounded-full">
                    Login
                </button>
            </div>

            <!-- Right Form Panel -->
            <div class="md:w-2/3 p-8">
                <!-- Tab Toggle -->
                <div class="flex justify-center mb-6 space-x-4">
                    <button
                            :class="tab === 'buyer' ? activeTabClass : inactiveTabClass"
                            @click="tab = 'buyer'"
                    >
                        Buyer
                    </button>
                    <button
                            :class="tab === 'seller' ? activeTabClass : inactiveTabClass"
                            @click="tab = 'seller'"
                    >
                        Seller
                    </button>
                </div>

                <!-- Buyer Form -->
                <form v-if="tab === 'buyer'" @submit.prevent="submit('buyer')" class="space-y-4">
                    <input type="hidden" name="role_id" :value="3" />
                    <RegisterFields v-model="form" :errors="errors" />

                    <div class="text-center">
                        <button type="submit" class="bg-red-600 text-white font-bold py-2 px-6 rounded hover:bg-red-700">
                            Register
                        </button>
                    </div>
                </form>

                <!-- Seller Form -->
                <form v-if="tab === 'seller'" @submit.prevent="submit('seller')" class="space-y-4">
                    <input type="hidden" name="role_id" :value="4" />
<!--                    <RegisterFields v-model="form" :errors="errors" />-->

                    <div class="text-center">
                        <button type="submit" class="bg-green-600 text-white font-bold py-2 px-6 rounded hover:bg-green-700">
                            Create your FutureStarr Talent account
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, reactive } from 'vue'
import { router, usePage } from '@inertiajs/vue3'
import { route } from 'ziggy-js'
// import RegisterFields from './RegisterFields.vue'

const emit = defineEmits(['show-login'])
const tab = ref('buyer')

const errors = usePage().props.errors || {}

const form = reactive({
	firstname: '',
	lastname: '',
	username: '',
	email: '',
	password: '',
	password_confirmation: '',
	cap: ''
})

function submit(role) {
	form.role_id = role === 'buyer' ? 3 : 4
	router.post(route('register'), { ...form })
}

const activeTabClass = 'px-6 py-2 font-bold rounded-full bg-[#010134] text-white'
const inactiveTabClass = 'px-6 py-2 font-bold rounded-full bg-white text-[#010134] border border-[#010134]'
</script>