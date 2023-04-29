<template>
  <div>
    <div class="row">
        <div class="col-1">
          &nbsp;
        </div>
        <div class="col-10">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    Letter Counts
                </div>
                <div class="card-body">
                    <bar-chart v-if="charLoaded" :chart-data="letterCountsChart" />
                </div>
            </div>
        </div>
        <div class="col-1">
          &nbsp;
        </div>
    </div>
    <div class="row">
        <div class="col-1">
          &nbsp;
        </div>
        <div class="col-10">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    Code Word Counts
                </div>
                <div class="card-body">
                    <bar-chart v-if="codeLoaded === true" :chart-data="codewordChart" />
                </div>
            </div>
        </div>
        <div class="col-1">
          &nbsp;
        </div>
    </div>
    <div class="row">
        <div class="col-1">
          &nbsp;
        </div>
        <div class="col-10">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    Messages Per Day
                </div>
                <div class="card-body">
                    <bar-chart v-if="perdayLoaded === true" :chart-data="dailyChart" />
                </div>
            </div>
        </div>
        <div class="col-1">
          &nbsp;
        </div>
    </div>
  </div>
</template>

<script>
import BarChart from "./BarChart";
import LineChart from "./LineChart";

export default {
  components: {
    BarChart,
    LineChart
  },
  data: () => ({
    charLoaded: false,
    codeLoaded: false,
    perdayLoaded: false,
    letterCountsChart: null,
    codewordChart: null,
    dailyChart: null
  }),
  async mounted () {
    this.loaded = false

    try {
      axios.get('/api/charts/character-count')
            .then(response => {
              this.letterCountsChart = this.prepareBarChartData(response.data, "Letter Counts")
              this.charLoaded = true;
      });
      axios.get('/api/charts/codeword-count')
            .then(response => {
              this.codewordChart = this.prepareBarChartData(response.data, "Code Word Counts")
              this.codeLoaded = true;
      });
      axios.get('/api/charts/daily-count')
            .then(response => {
              this.dailyChart = this.prepareLineChartData(response.data, "Messages Per Day")
              this.perdayLoaded = true;
      });
    } catch (e) {
      console.error(e)
    }
  },
  methods: {
    prepareLineChartData(data) {

      // Initialize arrays to hold the chart data
      const dates = [];
      const messageCounts = {};

      Object.keys(data).forEach(date => {
        dates.push(date);
        const counts = data[date];
        Object.keys(counts).forEach(type => {
          if (!messageCounts[type]) {
            messageCounts[type] = [];
          }
          messageCounts[type].push(counts[type]);
        });
      });

      // Initialize the chart data
      const chartData = {
        labels: dates,
        datasets: []
      };

      Object.keys(messageCounts).forEach(type => {
        chartData.datasets.push({
          label: type,
          backgroundColor: this.getRandomColor(),
          data: messageCounts[type]
        });
      });
      return chartData;
    },

    getRandomColor() {
      const letters = "0123456789ABCDEF";
      let color = "#";
      for (let i = 0; i < 6; i++) {
        color += letters[Math.floor(Math.random() * 16)];
      }
      return color;
    },

    prepareBarChartData(data, label) {
      const keys = Object.keys(data).map((key) => key.replace(/_letter$/, ""));
      return {
        labels: keys,
        datasets: [
          {
            label,
            backgroundColor: "#4caf50",
            data: Object.values(data),
          },
        ],
      };
    },
  },
};
</script>
