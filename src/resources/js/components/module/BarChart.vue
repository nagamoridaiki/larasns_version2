<script>
import { Bar } from "vue-chartjs";
export default {
  extends: Bar,
  props: {
    tag: {
      type: String
    }
  },
  data() {
    return{
      ranking: {},
      tagranking:{},
      tag:"",
    };
  },
  mounted() {
    getRanking()
    this.renderChart(
      this.tagranking,
      /*{
        labels: ["yamadataro", "suzukiziro", "tanakasaburo", "satohanako"],
        datasets: [
          {
            label: "投稿数",
            backgroundColor: "rgba(0, 170, 248, 0.47)",
            data: [7, 5, 3, 1]
          }
        ]
      },*/
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
  },
  methods: {
    async getRanking () {
    const response = await axios.get(`/api/ranking?tag=${this.tag}`)
    this.ranking = response.data;
    this.setRanking();
    },
    setRanking() {
      this.tagranking = Object.assign({}, this.tagranking, {
        //labelsはユーザー名を格納する
        labels: this.ranking.tagPostRankingData.name,
        datasets: [
          {
            label: ["投稿数"],
            backgroundColor: "rgba(0, 170, 248, 0.47)",
            //指定したタグの記事を投稿したユーザーごとの投稿数を格納する
            data: this.ranking.tagPostRankingData.tag_post_count
          }
        ]
      });
    }
  },
};
</script>