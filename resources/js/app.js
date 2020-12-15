// require('./bootstrap');
import { App } from '@inertiajs/inertia-svelte'

const el = document.getElementById('app')
import { InertiaProgress } from '@inertiajs/progress'

InertiaProgress.init({
    // The color of the progress bar.
    color: '#c53030',
})
new App({
    target: el,
    props: {
        initialPage: JSON.parse(el.dataset.page),
        resolveComponent: name => require(`./Pages/${name}.svelte`),
    },
})