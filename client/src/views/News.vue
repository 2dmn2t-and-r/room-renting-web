<template>
  <div class="news">
    <div class="page-container">
      <page-title title="News"/>
      <div class="main">
        <news-card class="margin-item" v-for="(news, index) in newsListFilter" :key="index" v-bind="{
          id: news.newsId,
          img: news.image,
          title: news.title,
          uploaddate: dateString(new Date(news.createDate)),
          modified: dateString(new Date(news.modifyDate)),
        }"/>
      </div>
      <div style="min-height: 20px"> </div>
      <theme-pagination v-bind="{
        totalItem: newsList.length,
        pageItem: pageItem,
      }" :curPage.sync="curPageChangable"
      />
    </div>
  </div>
</template>

<script>
  import CommentBox from '../components/modals/news/CommentBox.vue';
  import CreateEditNews from '../components/modals/news/CreateEditNews.vue';
  import ModalTemplate from '../components/ModalTemplate.vue';
  import NewsCard from '../components/NewsCard.vue';
  import PageTitle from '../components/PageTitle.vue';
  import ThemePagination from '../components/ThemePagination.vue';
  import { getDataAPI, postDataAPI } from '../utils/fetchData';

  export default {
    name: 'News',
    components: {
      ModalTemplate,
      CommentBox,
      PageTitle,
      CreateEditNews,
      NewsCard,
      refresh: 0,
      ThemePagination,
    },
    data() {
      return {
        newsList: [],
        curPage: 1,
        pageItem: 5,
        refresh: 0,
      }
    },
    computed: {
      curPageChangable: {
        get() {return this.curPage},
        set(val) {this.curPage = val; this.refresh = 1 - this.refresh;}
      },
      firstItem() {
        return (this.curPage - 1) * this.pageItem;
      },
      lastItem() {
        return this.curPage * this.pageItem - 1;
      },
      newsListFilter() {
        return this.newsList.filter((_, i) => (i >= this.firstItem && i <= this.lastItem))
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
          this.newsList = res.data["news"].sort((a, b) => {
            return (new Date(b.modifyDate)).getTime() - (new Date(a.modifyDate)).getTime()
          });;
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
    padding: 18px 18px 0px 18px;
    border-radius: 10px;
    display: flex;
    flex-direction: column;
  }

  .margin-item {
    margin-bottom: 18px
  }
</style>