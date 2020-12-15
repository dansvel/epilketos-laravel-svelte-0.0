<script>
    import { Inertia } from '@inertiajs/inertia'

    export let errors = {}
    export let message
    let token = ''
    let values = {
        token: null
    }
    $: values.token = token.toUpperCase()
    $: console.log(message, errors)
    function handleSubmit() {
        Inertia.post('/login', values)
    }
</script>

<style lang="postcss">
    :global(body) {
        background-color: #9921e8;
        background-image: linear-gradient(315deg, #9921e8 0%, #5f72be 74%);
        @apply min-h-screen pt-12 pb-6 px-2;
    }
    @screen md {
        :global(body) {
            @apply pt-12 px-0;
        }
    }
</style>

<header class="max-w-lg mx-auto">
    <h1 class="text-4xl font-bold text-white text-center">e-PilKetOs 2020</h1>
    <h1 class="text-4xl font-bold text-white text-center">Sekolah Misterius</h1>
</header>

<main class="bg-white max-w-lg mx-auto p-8 md:p-12 my-10 rounded-lg shadow-2xl">
    <section>
        <h3 class="text-gray-700 font-bold text-2xl text-center">Selamat datang</h3>
    </section>

    <section class="mt-10">
        <form class="flex flex-col" on:submit|preventDefault={handleSubmit}>
            <div class="mb-6 pt-3 rounded bg-gray-200">
                <label class="block {errors.token ? 'text-red-700' : 'text-gray-700'} text-sm font-bold mb-2 mx-3 flex justify-between" for="token">
                    <span>Masukkan Token</span>
                    {#if errors.token}<div>{errors.token}</div>{/if}
                </label>
                <input class="bg-gray-200 rounded w-full text-gray-700 focus:outline-none border-b-4 border-gray-300 uppercase
                       focus:border-purple-600 transition duration-500 px-3 pb-3 {errors.token ? 'border-red-600' : ''}"
                       type="text" id="token" bind:value={token}>

            </div>
            <button class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 rounded shadow-lg hover:shadow-xl transition duration-200"
                    type="submit">
                Masuk
            </button>
        </form>
    </section>
</main>

<footer class="max-w-lg mx-auto flex justify-center text-white">
    &copy; 2020 | Sekolah Misterius
</footer>
