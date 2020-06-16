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
    };
  },
  mounted() {
    this.$http
      .get(`/api/ranking?tag=${this.tag}`)
      .then(response => {
        this.tagranking = response.data;
        //alert(this.tagranking.tagPostRankingData.name);
        this.setRanking();
      })
      .catch(error => {
        alert(error);
    });
    this.renderChart(
      //this.tagranking,
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
  },
  methods: {
    setRanking() {
      var labels = [];
      var datas = [];
      for(var i = 0; i < this.tagranking.tagPostRankingData.name.length; i++){
        labels.push(this.tagranking.tagPostRankingData.name[i]);
      }
      //alert(labels);
      for(var i = 0; i < this.tagranking.tagPostRankingData.tag_post_count.length; i++){
        datas.push(this.tagranking.tagPostRankingData.tag_post_count[i]);
      }
      //alert(datas);

      this.tagranking = Object.assign({}, this.tagranking, {
        //labelsはユーザー名を格納する
        labels: labels,
        datasets: [
          {
            label: ["投稿数"],
            backgroundColor: "rgba(0, 170, 248, 0.47)",
            //指定したタグの記事を投稿したユーザーごとの投稿数を格納する
            data: datas
          }
        ]
      });
    }
  },
};
</script>