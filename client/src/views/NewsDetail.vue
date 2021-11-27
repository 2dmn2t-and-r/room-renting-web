<template>
  <div class="news-detail">
    <div class="page-container">
      <page-title title="News" v-bind:isBack="true" @onBack="$router.go(-1)"/>
      <div class="main">
        <div class="image-container">
          <div class="image-box">
            <picture-frame v-bind="{
              width: '100%',
              width_img: '95.83%',
              height: '100%',
              height_img: '95.83%',
              border_radius: '7vw'
            }" :background_img="news.image"/>
          </div>
          <div class="bt-container">
            <theme-button v-bind="{
              msg: 'Comments',
              background_color: 'var(--theme_jade)',
              height: '40px',
              width: '100%',
              border_radius: '15px'
            }"
            @click="loadComments()"></theme-button>
          </div>
        </div>
        <div class="content-box">
          <div class="news-title">{{news.title}}</div>
          <div class="date">Created: <span class="bold">{{dateString(new Date(news.createDate))}}</span></div>
          <div class="date">Modified: <span class="bold">{{dateString(new Date(news.modifyDate))}}</span></div>
          <div class="news-content">
            {{news.content}}
          </div>
          <div class="bot-bt-container">
            <theme-button v-bind="{
              msg: 'Comments',
              background_color: 'var(--theme_jade)',
              height: '40px',
              width: '100%',
              border_radius: '15px'
            }"
            @click="loadComments()"/>
          </div>
        </div>
      </div>
      <modal-template  v-bind="{
        title: 'Comments',
        step: modalStep,
        buttonTitle: ['Send'],
      }"
      @onClose="setModalStep(-1)"
      @onCancel="setModalStep(modalStep - 1)"
      @onNextStep="upLoadComment"
      >
        <div slot="1" class="slot">
          <comment-box v-bind="{
            comments: comments,
            manager: false,
            userId: userId,
          }"
          :newComment.sync="newComment"
          @onDelete="(index) => {
            deleteComment(index)
          }"
          />
        </div>
      </modal-template>
    </div>
  </div>
</template>

<script>
  import CommentBox from '../components/modals/news/CommentBox.vue';
  import ModalTemplate from '../components/ModalTemplate.vue';
  import PageTitle from '../components/PageTitle.vue';
  import PictureFrame from '../components/PictureFrame.vue';
  import ThemeButton from '../components/ThemeButton.vue';
  import { getDataAPI, postDataAPI } from '../utils/fetchData';

  export default {
    name: 'NewsDetail',
    components: {
      ModalTemplate,
      CommentBox,
      PageTitle,
      PictureFrame,
      ThemeButton,
    },
    data() {
      return {
        news: {
          newsId: "",
          title: "",
          createDate: "2001-01-01",
          modifyDate: "2001-01-01",
          image: "",
          content: ""
        },
        newComment: "",
        comments: [],
        modalStep: -1,
        userId: "",
      }
    },
    methods: {
      setModalStep(val) {
        this.modalStep = val;
      },
      async loadComments() {
        var token = localStorage.getItem("token");
        let res = await getDataAPI('news/comments/load/' + this.$route.params.newsId, token);
        if (res.data["status"] === 200) {
          this.comments = res.data["news_comments"]
          this.setModalStep(0);
        }
      },
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
      async upLoadComment() {
        if (this.newComment !== "") {
          var token = localStorage.getItem("token");
          let res = await postDataAPI('news/comment/upload', {
            content: this.newComment,
            date: (new Date()).toISOString().split('T')[0],
            newsId: this.$route.params.newsId,
          }, token);
          if (res.data["status"] === 200) {
            this.setModalStep(-1);
          }
        }
      },
      async deleteComment(index) {
        var token = localStorage.getItem("token");
        let res = await postDataAPI('news/comment/delete', {
          commentId: this.comments[index]['commentId'],
        }, token);
        if (res.data["status"] === 200) {
          this.comments.splice(index, 1);
        }
      }
    },
    mounted() {
      (async () => {
        var token = localStorage.getItem("token");
        let res = await getDataAPI('news/load/' + this.$route.params.newsId, token);
        if (res.data["status"] === 200) {
          this.news = res.data["news"];
        }
        res = await getDataAPI('auth/get', token);
        if (res.data["status"] === 200) {
          this.userId = res.data["user"]["userId"];
        }
      })()
    },
  }
</script>


<style scoped>
  .news-detail {
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

  .slot {
    width: 100%;
  }

  .main {
    display: flex;

  }

  .image-container {
    height: 100%;
    width: 50%;
    padding-right: 10px;
    display: flex;
    flex-direction: column;
    align-items: center;
  }

  .image-box {
    width: 100%;
    height: 35vw;
    max-height: 400px;
  }

  .bt-container {
    margin-top: 20px;
    width: 100%;
    max-width: 300px;
  }

  .content-box {
    width: 50%;
    padding-left: 10px;
  }

  .news-title {
    font-size: 22px;
    font-weight: 600;
    text-align: justify;
    line-height: 30px;
  }
  .date {
    margin-top: 8px;
    font-size: 14px;
    text-align: justify;
  }

  .news-content {
    margin-top: 20px;
    font-size: 18px;
    white-space: pre-line;
    line-height: 30px;
    text-align: justify;
  }

  .bot-bt-container {
    display: none;
  }

  @media only screen and (max-width: 768px) {
    .main {
      flex-direction: column;
    }

    .image-container {
      width: 100%;
      padding: 0;
      margin-bottom: 20px;
    }

    .image-box {
      height: 60vw;
      max-height: 60vw;
    }
    
    .content-box {
      width: 100%;
      padding: 0;
    }

    .bt-container {
      display: none;
    }

    .bot-bt-container {
      margin: 20px 0;
      width: 100%;
      display: block;
    }
  }

  @media only screen and (max-width: 480px) {
      
  }
</style>