import Alpine from 'alpinejs'
import focus from '@alpinejs/focus'

Alpine.plugin(focus)

// Alpine single value store
Alpine.store('menuOpen', false)
Alpine.store('searchOpen', false)

Alpine.data('social', () => ({
    socialWindow: (url) => {
        var left = (screen.width - 570) / 2;
        var top = (screen.height - 570) / 2;
        var params = "menubar=no,toolbar=no,status=no,width=570,height=570,top=" + top + ",left=" + left;
        window.open(url, "NewWindow", params);
    }
}))

Alpine.magic('clipboard', () => subject => {
    navigator.clipboard.writeText(subject)
})

window.Alpine = Alpine

Alpine.start()