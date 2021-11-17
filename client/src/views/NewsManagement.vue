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
              value=""
            />
            <theme-input
              class="input-box"
              type="date"
              label="To:"
              value=""
            />
          </div>
          <div class="bt-bar">
            <theme-button class="bt" v-bind="{
              msg: 'Filt',
              height: '40px',
              width: '100%',
              border_radius: '15px'
            }"></theme-button>
            <theme-button class="bt" v-bind="{
              msg: 'Create',
              background_color: 'var(--theme_jade)',
              height: '40px',
              width: '100%',
              border_radius: '15px'
            }"
            @click.native="setModalStep(0)"></theme-button>
          </div>
        </div>
        <div class="list-box">
          <div class="list">
            <news-card class="margin-item" v-for="(news, index) in newsList" :key="index" v-bind="{
              id: news.id,
              img: news.img,
              title: news.title,
              uploaddate: dateString(news.uploadDate),
              modified: dateString(news.modified),
            }"/>
          </div>
        </div>
      </div>
      
      <modal-template  v-bind="{
        title: 'News',
        step: modalStep,
        buttonTitle: ['Create']
      }"
      @onClose="setModalStep(-1)"
      @onCancel="setModalStep(modalStep - 1)"
      @onNextStep="function () {
        setModalStep(-1)
        $router.push($router.history.current.path + '/' + '4').catch(()=>{});
      }">
        <div slot="1" class="slot">
          <create-edit-news
            v-bind="{
              checked: check,
            }"
            @on-check="setCheck"
          />
        </div>
      </modal-template>
    </div>
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
    },
    data() {
      return {
        check: false,
        newsList: [
          {
            id: 1,
            title: "Một số nghiên cứu chỉ ra rằng, ăn tiết canh có thể trị được bệnh ung thư.",
            img: "https://picsum.photos/200/300",
            uploadDate: new Date(),
            modified: new Date(),
          },
          {
            id: 2,
            title: "Một số nghiên cứu chỉ ra rằng, ăn tiết canh có thể trị được bệnh ung thư.",
            img: "https://picsum.photos/200/300",
            uploadDate: new Date(),
            modified: new Date(),
          },
          {
            id: 3,
            title: "Một số nghiên cứu chỉ ra rằng, ăn tiết canh có thể trị được bệnh ung thư.",
            img: "https://picsum.photos/200/300",
            uploadDate: new Date(),
            modified: new Date(),
          }
        ],
        modalStep: -1,
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
      }
    }
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
    padding: 18px 18px;
    border-radius: 10px;
  }

  .margin-item {
    margin-bottom: 18px
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