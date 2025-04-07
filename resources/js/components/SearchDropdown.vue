<template>
    <div  ref="dropdownRef" @submit.prevent class="relative">
        <!-- Search input trigger -->
        <slot name="input" v-bind="{query, handleFocus, debouncedSearch}">
            <input
                    type="text"
                    name="qTalent"
                    id="qTalent"
                    v-model="query"
                    @focus="handleFocus"
                    @keydown.enter.prevent
                    @input="debouncedSearch"
                    placeholder="Search talent..."
                    data-lpignore="true"
                    autocomplete="off"
                    class="w-full px-4 py-2 rounded-full border shadow"
            />
        </slot>


        <!-- Desktop dropdown panel -->
        <slot name="dropdown" v-bind="{isMobile, isOpen, query, hasResults, results, loading }">
            <div
                    v-if="!isMobile && isOpen && query.length > 1 && hasResults"
                    class="absolute left-0 mt-2 w-full bg-white rounded-lg shadow-lg z-50 max-h-96 overflow-y-auto space-y-4 p-4 hidden md:block"
            >
                <SearchResults :results="results" :loading="loading" :query="query" />
            </div>
        </slot>


        <!-- Teleported Mobile Overlay -->
        <teleport to="body">
            <transition name="fade">
                <div
                        v-if="isMobile && isMobileOpen && query.length > 1"
                        class="fixed inset-0 z-[9999] bg-white flex flex-col md:hidden"
                >
                    <div class="flex items-center justify-between p-4 border-b">
                        <input
                                v-model="query"
                                @input="debouncedSearch"
                                @keydown.enter.prevent
                                placeholder="Search talent..."
                                class="flex-1 text-lg px-4 py-2 border rounded-full"
                        />
                        <button @click="closeMobile" class="text-xl font-bold ml-2">&times;</button>
                    </div>

                    <div class="overflow-y-auto flex-1 p-4 space-y-6">
                        <SearchResults :results="results" :loading="loading" :query="query" />
                    </div>
                </div>
            </transition>
        </teleport>
    </div>
</template>

<script setup>
import { ref, onMounted, onBeforeUnmount, computed } from 'vue'
import debounce from 'lodash/debounce'
import SearchResults from './SearchResults.vue';

const query = ref('')
const results = ref({ talents: [], categories: [], sellers: [], buyers: [] })
const loading = ref(false)
const isMobileOpen = ref(false)
const isMobile = ref(window.innerWidth < 768)
const isOpen = ref(false)
const dropdownRef = ref(null)

const handleClickOutside = (event) => {
	if (dropdownRef.value && !dropdownRef.value.contains(event.target)) {
		isOpen.value = false
	}
}

const updateIsMobile = () => {
	isMobile.value = window.innerWidth < 768
}

onMounted(() => {
	document.addEventListener('keydown', (e) => {
		if (e.key === 'Escape') isOpen.value = false
	})
	document.addEventListener('click', handleClickOutside)
	window.addEventListener('resize', updateIsMobile)
	window.addEventListener('submit', preventUnexpectedSubmit, true)
})

onBeforeUnmount(() => {
	document.removeEventListener('click', handleClickOutside)
	window.removeEventListener('resize', updateIsMobile)
	window.removeEventListener('submit', preventUnexpectedSubmit, true)
})

function preventUnexpectedSubmit(e) {
	if ( e.target && e.target.contains(document.getElementById('qTalent')) ) {
		e.preventDefault()
		e.stopImmediatePropagation()
	}
}

const handleFocus = () => {
	if (isMobile.value) {
		isMobileOpen.value = true
	} else if (hasResults.value) {
		isOpen.value = true
	}
}

const getCsrfToken = () => document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''

const fetchResults = async (input = query.value) => {
	if (input.length < 2) {
		results.value = { talents: [], categories: [], sellers: [], buyers: [] }
        isOpen.value = false
		return
	}

	loading.value = true

	try {
		const response = await fetch('/search', {
			method: 'POST',
			headers: {
				'Content-Type': 'application/json',
				'X-CSRF-TOKEN': getCsrfToken(),
				Accept: 'application/json'
			},
			credentials: 'same-origin',
			body: JSON.stringify({ search: input })
		})

		const data = await response.json()
		results.value = data.results || {}
        isOpen.value = hasResults.value
	} catch (err) {
		console.error('Search failed:', err)
		results.value = { talents: [], categories: [], sellers: [], buyers: [] }
	} finally {
		loading.value = false
	}
}

const debouncedSearch = debounce((val) => {
	query.value = val
	fetchResults(val)
}, 300)

const hasResults = computed(() => {
	return (
		results.value.talents?.length ||
		results.value.categories?.length ||
		results.value.sellers?.length ||
		results.value.buyers?.length
	)
})

const closeMobile = () => {
	isMobileOpen.value = false
	query.value = ''
	results.value = { talents: [], categories: [], sellers: [], buyers: [] }
}
</script>

<style scoped>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.2s ease;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
</style>
