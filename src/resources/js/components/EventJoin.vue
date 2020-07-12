<template>
  <div>
    <span>参加人数 ：{{ countJoin }}人　</span>
    <button
      type="button"
      class="btn m-0 p-1 shadow-none"
    >
      <i class="far fa-calendar-check"
            :class="{'green-text':this.isJoinedBy}"
            @click="clickJoin"
        />
    </button>
    {{ countJoin }}
  </div>
</template>

<script>
export default {
    props: {
      initialIsJoinedBy: {
        type: Boolean,
        default: false,
      },
      initialCountJoin: {
        type: Number,
        default: 0,
      },
      authorized: {
        type: Boolean,
        default: false,
      },
      endpoint: {
        type: String,
      },
    },
    data() {
      return {
        isJoinedBy: this.initialIsJoinedBy,
        countJoin: this.initialCountJoin,
      }
    },
    methods: {
      clickJoin() {
        if (!this.authorized) {
          alert('イベント申し込みはログイン中のみ使用できます')
          return
        }

        this.isJoinedBy
          ? this.unjoin()
          : this.join()
      },
      async join() {
        const response = await axios.put(this.endpoint)

        this.isJoinedBy = true
        this.countJoin = response.data.countJoin
      },
      async unjoin() {
        const response = await axios.delete(this.endpoint)

        this.isJoinedBy = false
        this.countJoin = response.data.countJoin
      },
    },
  }
</script>