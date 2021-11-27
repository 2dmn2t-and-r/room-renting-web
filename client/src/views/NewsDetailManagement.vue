<template>
  <div class="news-detail-management">
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
              height: '40px',
              width: '45%',
              border_radius: '15px'
            }"
            @click.native="loadComments()"></theme-button>
            <theme-button v-bind="{
                msg: 'Edit',
                background_color: 'var(--theme_jade)',
                height: '40px',
                width: '45%',
                border_radius: '15px'
              }"
              @click.native="setEditModalStep(0)"
            >
            </theme-button>
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
              height: '40px',
              width: '100%',
              border_radius: '15px'
            }"
            @click.native="loadComments()"
            ></theme-button>
            <theme-button v-bind="{
              msg: 'Edit',
              background_color: 'var(--theme_jade)',
              height: '40px',
              width: '100%',
              border_radius: '15px'
            }"
            @click.native="setEditModalStep(0)"
            ></theme-button>
          </div>
        </div>
      </div>
      <modal-template  v-bind="{
        title: 'Comments',
        step: commentsModalStep,
        buttonTitle: ['Send']
      }"
      @onClose="setCommentsModalStep(-1)"
      @onCancel="setCommentsModalStep(commentsModalStep - 1)"
      @onNextStep="upLoadComment()"
      >
        <div slot="1" class="slot">
          <comment-box v-bind="{
            comments: comments,
            manager: true,
          }"
          :newComment.sync="newComment"
          @onDelete="(index) => {
            deleteComment(index)
          }"
          />
        </div>
      </modal-template>
      <modal-template  v-bind="{
        title: 'News',
        step: editModalStep,
        buttonTitle: ['Edit']
      }"
      @onClose="setEditModalStep(-1)"
      @onCancel="setEditModalStep(editModalStep - 1)"
      @onNextStep="upLoadNews()"
      >
        <div slot="1" class="slot">
          <create-edit-news
            :checked="check"
            :content.sync="content"
            :title.sync="title"
            :img="image"
            @on-check="setCheck"
            @chooseImage="triggerImage"
          />
        </div>
      </modal-template>
    </div>
    <input type="file" ref="file" @change="changeImage" style="display: none"/>
  </div>
</template>

<script>
  import CommentBox from '../components/modals/news/CommentBox.vue';
  import CreateEditNews from '../components/modals/news/CreateEditNews.vue';
  import ModalTemplate from '../components/ModalTemplate.vue';
  import PageTitle from '../components/PageTitle.vue';
  import PictureFrame from '../components/PictureFrame.vue';
  import ThemeButton from '../components/ThemeButton.vue';
  import { getDataAPI, postDataAPI } from '../utils/fetchData';
  import { uploadImage } from '../utils/uploadImage';

  export default {
    name: 'NewsDetailManagement',
    components: {
      ModalTemplate,
      CommentBox,
      PageTitle,
      PictureFrame,
      ThemeButton,
      CreateEditNews,
    },
    data() {
      return {
        check: false,
        news: {
          newsId: "",
          title: "",
          createDate: "2001-01-01",
          modifyDate: "2001-01-01",
          image: "",
          content: ""
        },
        title: "",
        content: "",
        image: "",
        comments: [],
        newComment: "",
        commentsModalStep: -1,
        editModalStep: -1,
      }
    },
    methods: {
      setCheck(state) {
        this.check = state;
      },
      setCommentsModalStep(val) {
        this.commentsModalStep = val;
      },
      setEditModalStep(val) {
        if (val === 0) {
          this.content = this.news.content;
          this.title = this.news.title;
        }
        this.editModalStep = val;
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
      async loadComments() {
        var token = localStorage.getItem("token");
        let res = await getDataAPI('news/comments/load/' + this.$route.params.newsId, token);
        if (res.data["status"] === 200) {
          this.comments = res.data["news_comments"]
          this.setCommentsModalStep(0);
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
            this.newComment = "";
            this.setCommentsModalStep(-1);
          }
        }
      },
      async upLoadNews() {
        if (this.title !== "") {
          var date = (new Date()).toISOString().split('T')[0]
          var token = localStorage.getItem("token");
          let res = await postDataAPI('news/upload', {
            title: this.title,
            image: this.image,
            content: this.content,
            modifyDate: date,
            newsId: this.$route.params.newsId,
            public: this.check ? '1' : '0',
          }, token);
          if (res.data["status"] === 200) {
            this.news = {
              newsId: this.newsId,
              title: this.title,
              createDate: this.news.createDate,
              modifyDate: date,
              image: this.image,
              content: this.content,
            }
            this.setEditModalStep(-1);
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
      },
      changeImage: function(e) {
        var files = e.target.files || e.dataTransfer.files;
        if (!files.length)
        return;
        var file = files[0];
        uploadImage(file, `news/${Date()}`, (value) => {
          (async() => {
            this.image = value;
          })();
        });
      },
      triggerImage() {
        this.$refs.file.click();
      },
    },
    mounted() {
      (async () => {
        var token = localStorage.getItem("token");
        let res = await getDataAPI('news/load/' + this.$route.params.newsId, token);
        if (res.data["status"] === 200) {
          
          this.news = res.data["news"];
          this.content = this.news.content;
          this.title = this.news.title;
          this.image = this.news.image;
          this.check = this.news.public === '1';
        }
      })()
    },
  }
</script>


<style scoped>
  .news-detail-management {
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
    display: flex;
    justify-content: space-between ;
    margin-top: 20px;
    width: 100%;
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
      display: flex;
      height: 90px;
      flex-direction: column;
      justify-content: space-between;
    }
  }

  @media only screen and (max-width: 480px) {
      
  }
</style>