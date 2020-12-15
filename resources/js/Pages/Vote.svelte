<script>
    import marked from 'marked'
    import {Inertia} from "@inertiajs/inertia";
    import { fade } from 'svelte/transition';

    export let candidates, voter
    let modal = false
    let success

    function handleVote(candidate) {
        document.body.classList.toggle('modal-active')
        modal = candidate
    }
    function voteConfirmed(candidateID) {
        Inertia.post('/vote', { candidate_id: candidateID })
        modal = false
        success = true
        document.body.classList.toggle('modal-active')
    }
    const closeModal = function() {
        modal = false
        document.body.classList.toggle('modal-active')
    }
</script>

<style lang="postcss">
    .btn {
        @apply w-auto bg-purple-600 text-white p-2 rounded shadow-lg transition duration-200;
        &:hover {
            @apply bg-purple-700 shadow-xl;
        }
    }
    .modal {
        transition: opacity 0.25s ease;
    }
    :global(body).modal-active {
        overflow-x: hidden;
        overflow-y: visible !important;
    }
</style>
<header class="max-w-6xl mx-auto mb-6">
    <h1 class="text-4xl font-bold text-white text-center">Kandidat e-PilKetOs 2020</h1>
    <h1 class="text-4xl font-bold text-white text-center">Sekolah Misterius</h1>
    <h1 class="text-2xl font-bold text-white text-center">{voter}</h1>
</header>
<div class="max-w-6xl mx-auto">
    <div class="grid grid grid-cols-2 md:grid-cols-3 gap-3">
        {#each candidates as candidate}
            <div class="max-w-sm w-full">
                <div class="h-48 md:h-64 flex-none bg-cover rounded-t-lg text-center overflow-hidden bg-white {candidate.showDetail ? 'hidden' : ''}"
                     style="background-image: url('/images/candidates/{candidate.number}.jpg'); background-position: center;"
                     title="{candidate.name}">
                </div>
                <div class="border-r border-b border-l border-gray-400 bg-white {candidate.showDetail ? 'rounded-lg' : 'rounded-b-lg'} p-4 flex flex-col justify-between leading-normal">
                    <div class="text-gray-900 font-bold text-2xl tracking-wider">{candidate.number}. {candidate.name}</div>
                    {#if !candidate.showDetail}
                        <div class="grid grid-cols-2 gap-2 mt-2">
                            <button class="btn" on:click={() => candidate.showDetail = true}>
                                Visi Misi
                            </button>
                            <button class="btn" on:click={handleVote(candidate)}>
                                Pilih
                            </button>
                        </div>
                    {:else}
                        <div class="h-48 md:h-64 overflow-x-hidden mt-1">
                            <p class="text-lg font-bold mb-2 text-justify">Visi</p>
                            {candidate.vision}
                            <p class="text-lg font-bold my-2">Misi</p>
                            <div class="marked">
                                {@html marked(candidate.mission)}
                            </div>
                        </div>
                        <button on:click={() => candidate.showDetail = false} class="btn mt-1">
                            tutup
                        </button>
                    {/if}
                </div>
            </div>
        {/each}
    </div>
</div>

<!--Modal-->
{#if modal}
<div class="modal fixed w-full h-full top-0 left-0 flex items-center justify-center z-50" in:fade out:fade>
    <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50" on:click={closeModal}></div>
    <div class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">
        <!-- Add margin if you want to see some of the overlay behind the modal-->
        <div class="modal-content py-4 text-left px-6">
            <!--Title-->
            <div class="">
                    <p class="text-lg font-bold">Berikan suara untuk</p>
                    <p class="text-2xl font-bold">{modal.name}</p>
            </div>
            <!--Footer-->
            <div class="flex justify-end pt-2">
                <button class="px-4 bg-transparent py-2 rounded-lg text-white bg-indigo-500 hover:bg-indigo-400 mr-2 w-20" on:click={voteConfirmed(modal.id)}>Iya</button>
                <button class="modal-close px-4 bg-red-500 py-2 rounded-lg text-white hover:bg-red-400 w-20" on:click={closeModal}>Batal</button>
            </div>
        </div>
    </div>
</div>
{/if}
    <!--Modal-->
{#if success}
<div class="modal fixed w-full h-full top-0 left-0 flex items-center justify-center z-50" in:fade out:fade>
    <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>
    <div class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded z-50 overflow-y-hidden">
        <!-- Add margin if you want to see some of the overlay behind the modal-->
        <div class="modal-content py-4 text-left px-6">
            <!--Title-->
            <div class="">
                <p class="text-lg font-bold">Terima kasih telah menggunakan hak suara anda</p>
                <p class="text-2xl font-bold">Silakan kembali ke kegiatanmu</p>
            </div>
        </div>
    </div>
</div>
{/if}
