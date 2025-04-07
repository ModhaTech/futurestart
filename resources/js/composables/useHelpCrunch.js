let scriptLoaded = false

export function useHelpCrunch() {
	const loadHelpCrunch = () => {
		if (typeof window === 'undefined') return

		// Already loaded
		if (scriptLoaded || window.HelpCrunch?.initialized) {
			window.HelpCrunch('showChatWidget')
			return
		}

		// Init the queue if not defined
		if (!window.HelpCrunch) {
			window.HelpCrunch = function () {
				window.HelpCrunch.q.push(arguments)
			}
			window.HelpCrunch.q = []
		}

		// Init config call BEFORE script loads (queued)
		window.HelpCrunch('init', 'futurestarr', {
			applicationId: 1,
			applicationSecret:
				'Ns0ynOloC5Af/kb8xI3/UkQQ3XHJACiejXZ8LorjMvcLvuPvyxErFgv2kTtzR3KunGaM+IB6exYVq3CK4r/K2w==',
		})

		// Also queue showing the widget
		window.HelpCrunch('showChatWidget')

		const script = document.createElement('script')
		script.async = true
		script.src = 'https://widget.helpcrunch.com/'
		script.onload = () => {
			scriptLoaded = true
			// Still call showChatWidget to ensure it's flushed
			window.HelpCrunch('showChatWidget')
		}

		document.body.appendChild(script)
	}

	return {
		loadHelpCrunch,
	}
}