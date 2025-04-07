import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers'
import DefaultLayout from './Layouts/DefaultLayout.vue'
import { ZiggyVue } from 'ziggy-js';

import '../css/app-v2.css'

import { library } from '@fortawesome/fontawesome-svg-core'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

// Add only the icons you use for tree-shaking
import { faUser, faLock, faEye, faEyeSlash, faMagnifyingGlass, faRss } from '@fortawesome/free-solid-svg-icons'
import { faFacebookF, faTwitter, faLinkedin } from '@fortawesome/free-brands-svg-icons'

library.add(faUser, faLock, faEye, faEyeSlash, faMagnifyingGlass, faFacebookF, faTwitter, faLinkedin, faRss)

createInertiaApp({
	resolve: name => {
		const page = resolvePageComponent(
			`./Pages/${name}.vue`,
			import.meta.glob("./Pages/**/*.vue")
		);
		page.then((module) => {
			module.default.layout = module.default.layout || DefaultLayout;
		});
		return page;
	},
	setup({ el, App, props, plugin }) {
		const app = createApp({
			render: () => h(App, props),
		})
		app.component('font-awesome-icon', FontAwesomeIcon)
		app.use(plugin)
			.use(ZiggyVue)
			.mount(el)
	}
})
