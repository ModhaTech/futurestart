<template>
    <div>
        <!-- Talents -->
        <div v-if="results.talents?.length">
            <h4 class="text-xs font-bold text-gray-400 uppercase mb-2">Talents</h4>
            <div
                    v-for="(talent, i) in results.talents"
                    :key="'t-' + i"
                    class="flex items-center gap-3 px-2 py-1 hover:bg-gray-100 rounded"
            >
                <img :src="talent.avatar || '/images/default-avatar.png'" class="w-8 h-8 rounded-full object-cover"/>
                <div>
                    <p class="font-semibold text-sm">{{ talent.title }}</p>
                    <p class="text-xs text-gray-500">Talent</p>
                </div>
            </div>
        </div>

        <!-- Categories -->
        <div v-if="results.categories?.length">
            <h4 class="text-xs font-bold text-gray-400 uppercase mb-2">Categories</h4>
            <div
                    v-for="(cat, i) in results.categories"
                    :key="'c-' + i"
                    class="flex items-center gap-3 px-2 py-1 hover:bg-gray-100 rounded"
            >
                <div
                        class="w-8 h-8 rounded-full bg-gray-300 flex items-center justify-center text-xs font-bold"
                >
                    📁
                </div>
                <div>
                    <p class="font-semibold text-sm">{{ cat.name }}</p>
                    <p class="text-xs text-gray-500">Category</p>
                </div>
            </div>
        </div>

        <!-- Sellers -->
        <div v-if="results.sellers?.length">
            <h4 class="text-xs font-bold text-gray-400 uppercase mb-2">Sellers</h4>
            <div
                    v-for="(seller, i) in results.sellers"
                    :key="'s-' + i"
                    class="flex items-center gap-3 px-2 py-1 hover:bg-gray-100 rounded"
            >
                <img :src="seller.profile_pic || '/images/default-avatar.png'"
                     class="w-8 h-8 rounded-full object-cover"/>
                <div>
                    <p class="font-semibold text-sm">{{ seller.username }}</p>
                    <p class="text-xs text-gray-500">Seller</p>
                </div>
            </div>
        </div>

        <!-- Buyers -->
        <div v-if="results.buyers?.length">
            <h4 class="text-xs font-bold text-gray-400 uppercase mb-2">Buyers</h4>
            <div
                    v-for="(buyer, i) in results.buyers"
                    :key="'b-' + i"
                    class="flex items-center gap-3 px-2 py-1 hover:bg-gray-100 rounded"
            >
                <img :src="buyer.profile_pic || '/images/default-avatar.png'"
                     class="w-8 h-8 rounded-full object-cover"/>
                <div>
                    <p class="font-semibold text-sm">{{ buyer.username }}</p>
                    <p class="text-xs text-gray-500">Buyer</p>
                </div>
            </div>
        </div>

        <!-- No results -->
        <div
                v-if="query.length > 1 && !hasResults && !loading"
                class="text-center text-gray-500 text-sm pt-8"
        >
            No results found.
        </div>
    </div>
</template>

<script setup>
import { computed } from 'vue';

const props = defineProps({
	results: Object,
	query: String,
	loading: Boolean
});

const hasResults = computed(() => {
	return (
		props.results.talents?.length ||
		props.results.categories?.length ||
		props.results.sellers?.length ||
		props.results.buyers?.length
	);
});
</script>
