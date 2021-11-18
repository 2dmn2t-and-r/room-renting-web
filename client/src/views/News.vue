<template>
  <div class="news">
    <div class="page-container">
      <page-title title="News"/>
      <div class="main">
        <news-card class="margin-item" v-for="(news, index) in newsList" :key="index" v-bind="{
          id: news.newsId,
          img: news.image,
          title: news.title,
          uploaddate: dateString(new Date(news.createDate)),
          modified: dateString(new Date(news.modifyDate)),
        }"/>
      </div>
    </div>
  </div>
</template>

<script>
  import CommentBox from '../components/modals/news/CommentBox.vue';
  import CreateEditNews from '../components/modals/news/CreateEditNews.vue';
  import ModalTemplate from '../components/ModalTemplate.vue';
  import NewsCard from '../components/NewsCard.vue';
  import PageTitle from '../components/PageTitle.vue';
  import { getDataAPI, postDataAPI } from '../utils/fetchData';

  export default {
    name: 'News',
    components: {
      ModalTemplate,
      CommentBox,
      PageTitle,
      CreateEditNews,
      NewsCard,
    },
    data() {
      return {
        newsList: [],
      }
    },
    methods: {
      dateString(date) {
        if (date) {
          var year = date.getFullYear();
          var month = (1 + date.getMonth()).toString();
          month = month.length > 1 ? month : '0' + month;
          var day = date.getDate().toString();
          day = day.length > 1 ? day : '0' + day;
          return month + '/' + day + '/' + year;
        }
      },
    },
    mounted() {
      (async () => {
        var token = localStorage.getItem("token");
        let res = await getDataAPI('news/load', token);
        if (res.data["status"] === 200) {
          this.newsList = res.data["news"];
        }
      })()
    },
  }
</script>

<style scoped>
  .news {
    padding: 20px;
    background-color: var(--theme_white);
    min-height: calc(100vh - 100px);
    display: flex;
    flex-direction: column;
    align-items: center;
  }

  .page-container {
    width: 100%;
    max-width: 1140px;
  }

  .main {
    width: 100%;
    background-color: var(--theme_fore);
    padding: 18px 18px;
    border-radius: 10px;
    display: flex;
    flex-direction: column;
  }

  .margin-item {
    margin-bottom: 18px
  }
</style>