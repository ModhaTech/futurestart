<template>
    <slot name="activator" v-bind="{ loginDialog }">
        <button @click="loginDialog.open">Login</button>
    </slot>

    <!-- FIX: pass .value -->
    <BaseDialog
            :modelValue="loginDialog.isOpen.value"
            :closeable="loginDialog.closeable.value"
            @update:modelValue="(val) => loginDialog.isOpen.value = val"
            @close="loginDialog.handleDialogClose"
            :transparent="true"
            :naked="true"
    >
        <template #default="{ close }">
            <div class="relative">
                <button
                        @click="close"
                        class="absolute top-0 right-4 text-white text-5xl font-bold cursor-pointer "
                >
                    &times;
                </button>
                <LoginForm />
            </div>
        </template>
    </BaseDialog>
</template>

<script setup>
import { useDialog } from '@/composables/useDialog'
import BaseDialog from '@/components/BaseDialog.vue'
import LoginForm from '@/components/auth/LoginForm.vue'

const loginDialog = useDialog()
</script>