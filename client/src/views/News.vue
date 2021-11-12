<template>
  <div class="news">
    <div class="page-container">
      <page-title title="News"/>
      <div class="main">
        <news-card class="margin-item" v-for="(news, index) in newsList" :key="index" v-bind="{
          img: news.img,
          title: news.title,
          uploaddate: dateString(news.uploadDate),
          modified: dateString(news.modified),
        }"/>
      </div>
    </div>
  </div>
</template>

<script>
  import CommentBox from '../components/modals/news/CommentBox.vue'
  import CreateEditNews from '../components/modals/news/CreateEditNews.vue'
  import ModalTemplate from '../components/ModalTemplate.vue'
  import NewsCard from '../components/NewsCard.vue'
  import PageTitle from '../components/PageTitle.vue'

  export default {
    name: 'Room',
    components: {
      ModalTemplate,
      CommentBox,
      PageTitle,
      CreateEditNews,
      NewsCard,
    },
    data() {
      return {
        newsList: [
          {
            title: "Một số nghiên cứu chỉ ra rằng, ăn tiết canh có thể trị được bệnh ung thư.",
            img: "https://picsum.photos/200/300",
            uploadDate: new Date(),
            modified: new Date(),
          },
          {
            title: "Một số nghiên cứu chỉ ra rằng, ăn tiết canh có thể trị được bệnh ung thư.",
            img: "https://picsum.photos/200/300",
            uploadDate: new Date(),
            modified: new Date(),
          },
          {
            title: "Một số nghiên cứu chỉ ra rằng, ăn tiết canh có thể trị được bệnh ung thư.",
            img: "https://picsum.photos/200/300",
            uploadDate: new Date(),
            modified: new Date(),
          }
        ],
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
      }
    }
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
  }

  .margin-item {
    margin-bottom: 18px
  }
</style>