<template>
  <div class="news-management">
    <div class="page-container">
      <page-title title="News"/>
      <div class="main">
        <div class="action-side">
          <div class="title">Date Filter</div>
          <div class="date-input">
            <theme-input
              class="input-box"
              label="From:"
              type="date"
              :value.sync="from"
            />
            <theme-input
              class="input-box"
              type="date"
              label="To:"
              :value.sync="to"
            />
          </div>
          <div class="bt-bar">
            <theme-button class="bt" v-bind="{
              msg: 'Filt',
              height: '40px',
              width: '100%',
              border_radius: '15px'
            }"
            @click.native="filt()"/>
            <theme-button class="bt" v-bind="{
              msg: 'Create',
              background_color: 'var(--theme_jade)',
              height: '40px',
              width: '100%',
              border_radius: '15px'
            }"
            @click.native="setModalStep(0)"/>
          </div>
        </div>
        <div class="list-box">
          <div class="list">
            <div v-for="(news, index) in newsList.filter((_, i) => (i >= this.firstItem && i <= this.lastItem))" :key="index">
              <news-card class="margin-item" v-bind="{
                id: news.newsId,
                img: news.image,
                title: news.title,
                uploaddate: dateString(new Date(news.createDate)),
                modified: dateString(new Date(news.modifyDate)),
              }"/>
              <div style="min-height: 18px"> </div>
            </div>
          </div>
          <div style="min-height: 20px"> </div>
          <theme-pagination v-bind="{
            totalItem: newsList.length,
            pageItem: pageItem,
          }" :curPage.sync="curPageChangable"
          />
        </div>
      </div>
      
      <modal-template  v-bind="{
        title: 'News',
        step: modalStep,
        buttonTitle: ['Create']
      }"
      @onClose="setModalStep(-1)"
      @onCancel="setModalStep(modalStep - 1)"
      @onNextStep="upLoadNews()">
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
  import CommentBox from '../components/modals/news/CommentBox.vue'
  import CreateEditNews from '../components/modals/news/CreateEditNews.vue'
  import ModalTemplate from '../components/ModalTemplate.vue'
  import NewsCard from '../components/NewsCard.vue'
  import PageTitle from '../components/PageTitle.vue'
  import ThemeButton from '../components/ThemeButton.vue'
  import ThemeInput from '../components/ThemeInput.vue'
  import ThemePagination from '../components/ThemePagination.vue'
  import { getDataAPI, postDataAPI } from '../utils/fetchData';
  import { uploadImage } from '../utils/uploadImage';

  export default {
    name: 'NewsManagement',
    components: {
      ModalTemplate,
      CommentBox,
      PageTitle,
      CreateEditNews,
      NewsCard,
      ThemeInput,
      ThemeButton,
      ThemePagination,
    },
    data() {
      return {
        check: false,
        newsList: [],
        newsCache: [],
        modalStep: -1,
        title: "",
        content: "",
        image: "",
        from: "",
        to: "",
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
      setCheck(state) {
        this.check = state
      },
      setModalStep(val) {
        this.modalStep = val;
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
      async upLoadNews() {
        if (this.title !== "") {
          var date = (new Date()).toISOString().split('T')[0]
          var token = localStorage.getItem("token");
          let res = await postDataAPI('news/upload', {
            title: this.title,
            image: this.image,
            content: this.content,
            modifyDate: date,
            createDate: date,
            public: this.check ? '1' : '0',
          }, token);
          if (res.data["status"] === 200) {
            let loadRes = await getDataAPI('news/load', token);
            if (loadRes.data["status"] === 200) {
              this.newsList = loadRes.data["news"].sort((a, b) => {
                return (new Date(b.modifyDate)).getTime() - (new Date(a.modifyDate)).getTime();
              });
              this.newsCache = this.newsList;
              this.from = "";
              this.to = "";
            }
            this.setModalStep(-1);
          }
        }
      },
      filt () {
        var temp = this.newsCache
        if (this.from !== "") {
          temp = temp.filter((ele) => {
            return (new Date(ele.modifyDate)).getTime() >= (new Date(this.from)).getTime()
          })
        }
        if (this.to !== "") {
          temp = temp.filter((ele) => {
            return (new Date(ele.modifyDate)).getTime() <= (new Date(this.to)).getTime()
          })
        }
        this.newsList = temp;
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
        let res = await getDataAPI('news/load', token);
        if (res.data["status"] === 200) {
          this.newsList = res.data["news"].sort((a, b) => {
            return (new Date(b.modifyDate)).getTime() - (new Date(a.modifyDate)).getTime()
          });
          this.newsCache = this.newsList;
        }
      })()
    },
  }
</script>


<style scoped>
  .news-management {
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
    display: flex;
  }

  .list-box {
    width: calc(100% - 220px);
    padding-left: 20px;
  }

  .list {
    width: 100%;
    background-color: var(--theme_fore);
    padding: 18px 18px 0px 18px;
    border-radius: 10px;
  }

  .margin-item {
    margin-bottom: 0px
  }

  .slot {
    width: 100%;
  }

  .action-side {
    width: 220px;
    display: flex;
    flex-direction: column;
    align-items: center;
  }

  .title {
    width: 100%;
    font-size: 24px;
    line-height: 28px;
    font-weight: 600;
    margin-bottom: 16px;
  }

  .date-input {
    width: 100%;
    margin-bottom: 40px;
  }

  .bt-bar {
    width: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    margin-bottom: 40px;
  }

  .bt {
    margin-top: 10px;
  }

  @media only screen and (max-width: 768px) {
    .main {
      flex-direction: column-reverse;
    }

    .list-box {
      width: 100%;
      padding-left: 0px;
    }

    .title {
      display: none;
    }

    .action-side {
      width: 100%;
    }
    
    .date-input {
      margin-top: 20px;
      flex-direction: row;
      display: flex;
      justify-content: space-between;
    }

    .input-box {
      width: 45%;
    }
  }

  @media only screen and (max-width: 480px) {
      
  }
</style>