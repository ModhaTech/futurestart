// composables/useDialog.js
import { ref } from 'vue'

export function useDialog(initial = false) {
	const isOpen = ref(initial)
	const closeable = ref(true)

	const open = () => {
		isOpen.value = true
	}

	const close = () => {
		isOpen.value = false
	}

	const toggle = () => {
		isOpen.value = !isOpen.value
	}

	const setCloseable = (value) => {
		closeable.value = value
	}

	const handleDialogClose = () => {
		if (closeable.value) {
			close()
		}
	}

	return {
		isOpen,
		open,
		close,
		toggle,
		closeable,
		setCloseable,
		handleDialogClose,
	}
}