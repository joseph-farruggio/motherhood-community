import Alpine from 'alpinejs'
import focus from '@alpinejs/focus'

Alpine.plugin(focus)

// Alpine single value store
Alpine.store('menuOpen', false)
Alpine.store('searchOpen', false)

Alpine.data('social', () => ({
    share: (url) => {
        var left = (screen.width - 570) / 2;
        var top = (screen.height - 570) / 2;
        var params = "menubar=no,toolbar=no,status=no,width=570,height=570,top=" + top + ",left=" + left;
        window.open(url, "NewWindow", params);
    }
}))

Alpine.data('navigatorShare', (title, text, url) => ({
    shareData: {
        title,
        text,
        url,
    },
    async shareThis() {
        try {
            await navigator.share(this.shareData);
        } catch (err) {
            console.log(`Error sharing content: ${err}`);
        }
    }
}))

Alpine.data('featuredPosts', (data) => ({
    posts: data,
    active: 0,
    prev() {
        this.active = this.active == 0 ? this.posts.length - 1 : this.active - 1;
    },
    next() {
        this.active = this.active < this.posts.length - 1 ? this.active + 1 : 0;
    }
}))


Alpine.magic('clipboard', () => subject => {
    navigator.clipboard.writeText(subject)
})

window.Alpine = Alpine

Alpine.start()