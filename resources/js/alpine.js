import Alpine from 'alpinejs'
import focus from '@alpinejs/focus'

Alpine.plugin(focus)

// Alpine single value store
Alpine.store('menuOpen', false)
Alpine.store('searchOpen', false)

window.Alpine = Alpine

Alpine.start()