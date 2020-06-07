<script>
import { Bar } from "vue-chartjs";
export default {
  extends: Bar,
  mounted() {
    this.renderChart(
      {
        labels: ["yamadataro", "suzukiziro", "tanakasaburo", "satohanako"],
        datasets: [
          {
            label: "投稿数",
            backgroundColor: "rgba(0, 170, 248, 0.47)",
            data: [7, 5, 3, 1]
          }
        ]
      },
      {
        scales: {
          yAxes: [
            {
              ticks: {
                beginAtZero: true,
                min: 0,
                max: 10,
              }
            }
          ]
        }
      }
    );
  }
};
</script>