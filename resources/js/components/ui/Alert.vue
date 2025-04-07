<template>
    <transition name="fade" mode="out-in">
        <div
                v-if="visible"
                :class="[
        'w-full rounded-md p-4 flex items-start justify-between',
        variantClasses[variant],
      ]"
                role="alert"
        >
            <!-- Prepend Slot (left) -->
            <div class="flex items-center justify-center mr-4">
                <slot name="prepend" />
            </div>

            <!-- Alert Content -->
            <div class="flex-1">
                <slot />
            </div>

            <!-- Append Slot (right) -->
            <div class="flex items-center justify-center ml-4">
                <slot name="append" />
            </div>

            <!-- Dismiss Button -->
            <button
                    v-if="dismissable"
                    @click="visible = false"
                    class="ml-4 text-white font-bold focus:outline-none hover:opacity-80"
                    aria-label="Dismiss"
            >
                &times;
            </button>
        </div>
    </transition>
</template>

<script setup>
import { ref, onMounted, watch } from 'vue'

const props = defineProps({
	modelValue: {
		type: Boolean,
		default: true
	},
	dismissable: {
		type: Boolean,
		default: false
	},
	variant: {
		type: String,
		default: 'info', // success | error | warning | info
		validator: (val) =>
			['success', 'error', 'warning', 'info'].includes(val)
	},
	duration: {
		type: Number,
		default: 5000 // ms before auto-dismiss (only if not dismissable)
	}
})

const emit = defineEmits(['update:modelValue'])

const visible = ref(props.modelValue)

watch(visible, (val) => {
	emit('update:modelValue', val)
})

watch(() => props.modelValue, (val) => {
	visible.value = val
})

onMounted(() => {
	if (!props.dismissable && props.duration > 0) {
		setTimeout(() => {
			visible.value = false
		}, props.duration)
	}
})

const variantClasses = {
	success: 'bg-green-500 text-white',
	info: 'bg-blue-500 text-white',
	error: 'bg-red-500 text-white',
	warning: 'bg-orange-400 text-white'
}
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