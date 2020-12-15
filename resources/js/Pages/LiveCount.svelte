<script>
    import Bar from 'svelte-chartjs/src/Bar.svelte'
    import { Inertia } from '@inertiajs/inertia'

    // const getData = setTimeout(function(){
    //     Inertia.reload({ only: ['votes'] })
    // }, 3000);
    setInterval(function () {
        Inertia.reload({ only: ['votes'] })
        .catch( function(error) {
            return
        })
    }, 15000)

    const randomColor = require('randomcolor')
    export let votes

    let data = []
    let dataset = []
    const colors = randomColor({luminosity: 'light',count: 5})
    $: {
        dataset = []
        votes.forEach(function(data) {
            dataset.push({
                label: data.number + '. ' + data.name,
                data: [data.votes],
                backgroundColor: colors[data.number - 1],
                fill:false,
            })
        })
        data = {
            labels: ['2020'],
            datasets: dataset,
        };
    }

    const option = {
        animation: false,
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        },
        legend: {
            position: 'bottom'
        },
        maintainAspectRatio: false
    }
</script>

<style lang="postcss">
    .chart {
        height: 50vh;
    }
</style>

<header class="max-w-6xl mx-auto mb-6">
    <h1 class="text-4xl font-bold text-white text-center">Live Count e-PilKetOs 2020</h1>
    <h1 class="text-4xl font-bold text-white text-center">Sekolah Misterius</h1>
</header>
<div class="chart max-w-6xl bg-white mx-auto">
    <Bar
            data={data}
            options={option}
    />
</div>

<footer class="max-w-lg mx-auto flex justify-center text-white mt-12">
    &copy; 2020 | Sekolah Misterius
</footer>
