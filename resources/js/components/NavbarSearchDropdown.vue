<template>
    <div class="relative inline-block text-left">
        <Menu as="div" class="relative">
            <div>
                <slot name="activator">
                    <MenuButton class="inline-flex justify-center py-2 text-sm font-medium text-white rounded-md hover:bg-gray-700 focus:outline-none">
                        SEARCH
                    </MenuButton>
                </slot>
            </div>

            <Transition
                    enter="transition ease-out duration-100"
                    enter-from="transform opacity-0 scale-95"
                    enter-to="transform opacity-100 scale-100"
                    leave="transition ease-in duration-75"
                    leave-from="transform opacity-100 scale-100"
                    leave-to="transform opacity-0 scale-95"
            >
                <MenuItems
                        v-slot="{ open }"
                        static
                        class="absolute left-1/2 -translate-x-1/2 mt-2 origin-top rounded-md shadow-lg ring-0 focus:outline-none z-50 w-[95vw] max-w-md max-h-[80vh] overflow-y-hidden"
                >
                    <div class="py-3 w-full bg-white" v-if="open">
                        <SearchDropdown clas
                                        s="px-4"  />
                    </div>
                </MenuItems>
            </Transition>
        </Menu>
    </div>
</template>

<script setup>
import { Menu, MenuButton, MenuItems } from '@headlessui/vue'
import { Transition } from 'vue'
import SearchDropdown from './SearchDropdown.vue'
</script>

<style scoped>
/* Optional: style overrides */
</style>
