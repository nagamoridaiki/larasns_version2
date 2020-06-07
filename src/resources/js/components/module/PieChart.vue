<script>
import { Pie } from "vue-chartjs";
export default {
  extends: Pie,
  mounted() {
    this.renderChart(
        {
            labels: ["laravel", "PHP", ],
            datasets: [
            {
            label: "タグ履歴",
            backgroundColor: ["#00D8FF", "#E46651"],
            data: [80,20]
            }
            ],
        },
        {
            borderWidth: "10px",
            hoverBackgroundColor: "red",
            hoverBorderWidth: "10px"
        }
    );
  }
};
</script>