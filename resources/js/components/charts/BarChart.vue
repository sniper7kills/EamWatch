<template>
  <bar :options="options" :data="chartData" />
</template>

<script>
import { Bar } from 'vue-chartjs'
import { Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale } from 'chart.js'

import zoomPlugin from 'chartjs-plugin-zoom';

ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale, zoomPlugin)

export default {
  name: "BarChart",
  components: { Bar },
  props: ["chartData", "chartOptions"],
  data: () => ({
    options: {
        scales: {
            x: {
                stacked: true,
            },
            yAxes: [{
                ticks: {
                    stepSize: 1
                }
            }]
        },
        plugins: {
            zoom: {
                zoom: {
                    wheel: {
                        enabled: true,
                    },
                    pinch: {
                        enabled: true
                    },
                    mode: 'x',
                },
                pan: {
                    enabled: true
                },
                limits: {
                    y: {min: 0}
                },
            }
        }
    }
  })
};
</script>
