<template>
    <TransitionRoot appear :show="modelValue" as="template">
        <Dialog
                as="div"
                class="relative z-50"
                @close="handleClose"
        >
            <!-- Backdrop -->
            <TransitionChild
                    as="template"
                    enter="ease-out duration-300"
                    enter-from="opacity-0"
                    enter-to="opacity-100"
                    leave="ease-in duration-200"
                    leave-from="opacity-100"
                    leave-to="opacity-0"
            >
                <div class="fixed inset-0 bg-black/50"/>
            </TransitionChild>

            <!-- Dialog panel -->
            <div class="fixed inset-0 overflow-y-auto">
                <div class="flex min-h-full items-center justify-center p-4">
                    <TransitionChild
                            as="template"
                            enter="ease-out duration-300"
                            enter-from="opacity-0 scale-95"
                            enter-to="opacity-100 scale-100"
                            leave="ease-in duration-200"
                            leave-from="opacity-100 scale-100"
                            leave-to="opacity-0 scale-95"
                    >
                        <DialogPanel
                                class="w-full flex justify-center transform overflow-hidden rounded-lg text-left align-middle shadow-xl transition-all"
                                :class="[
                                    naked ? '' : 'p-6 bg-white',
                                    transparent ? 'bg-transparent': 'bg-white'
                                 ]"
                        >
                            <!-- Optional Title Slot -->
                            <slot name="title">
                                <DialogTitle v-if="$slots.title" class="text-lg font-medium text-gray-900 mb-2">
                                    Dialog Title
                                </DialogTitle>
                            </slot>

                            <!-- Main Content Slot -->
                            <div class="mt-2">
                                <slot :close="() => $emit('update:modelValue', false)" />
                            </div>

                            <!-- Optional Actions Slot -->
                            <div v-if="$slots.actions" class="mt-4 flex justify-end gap-2">
                                <slot name="actions"/>
                            </div>

                        </DialogPanel>
                    </TransitionChild>
                </div>
            </div>
        </Dialog>
    </TransitionRoot>
</template>

<script setup>
import { TransitionRoot, TransitionChild, Dialog, DialogPanel, DialogTitle } from '@headlessui/vue';

const props = defineProps({
	naked: {
		type: Boolean,
		default: false
	},
	transparent: {
		type: Boolean,
		default: false
	},
	modelValue: Boolean,
	closeable: {
		type: Boolean,
		default: true
	}
});


const emit = defineEmits(['update:modelValue'])

function handleClose() {
	if (props.closeable) {
        emit('update:modelValue', false)
    }
}
</script>

<style scoped>
/* You can add any base modal styles here if needed */
</style>
