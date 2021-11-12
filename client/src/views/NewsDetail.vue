<template>
  <div class="news-detail">
    <div class="page-container">
      <page-title title="News" v-bind:isBack="true"/>
      <div class="main">
        <div class="image-container">
          <div class="image-box">
            <picture-frame v-bind="{
              width: '100%',
              width_img: '95.83%',
              height: '100%',
              height_img: '95.83%',
              border_radius: '7vw'
            }"/>
          </div>
          <div class="bt-container">
            <theme-button v-bind="{
              msg: 'Comments',
              background_color: 'var(--theme_jade)',
              height: '40px',
              width: '100%',
              border_radius: '15px'
            }"></theme-button>
          </div>
        </div>
        <div class="content-box">
            <div class="news-title">Một số nghiên cứu chỉ ra rằng, ăn tiết canh có thể trị được bệnh ung thư.</div>
            <div class="date">Modified: <span class="bold">20/10/2021</span></div>
            <div class="news-content">
              {{`
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.\n\n
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.\n\n
              `}}
            </div>
            <div class="bot-bt-container">
              <theme-button v-bind="{
                msg: 'Comments',
                background_color: 'var(--theme_jade)',
                height: '40px',
                width: '100%',
                border_radius: '15px'
              }"></theme-button>
            </div>
        </div>
      </div>
      <modal-template  v-bind="{
        title: 'Comments',
        step: -1,
        buttonTitle: ['Next']
      }">
        <div slot="1" class="slot">
          <comment-box v-bind="{
            comments: comments
          }"
          />
        </div>
      </modal-template>
    </div>
  </div>
</template>

<script>
  import CommentBox from '../components/modals/news/CommentBox.vue'
  import ModalTemplate from '../components/ModalTemplate.vue'
  import PageTitle from '../components/PageTitle.vue'
  import PictureFrame from '../components/PictureFrame.vue'
import ThemeButton from '../components/ThemeButton.vue'

  export default {
    name: 'Room',
    components: {
      ModalTemplate,
      CommentBox,
      PageTitle,
      PictureFrame,
        ThemeButton,
    },
    data() {
      return {
        comments: [
          {
            name: 'Num',
            time: new Date(),
            content: 'Loremipsum ba chon heo',
            img: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRddkWsqQoGL8aY3bzzCdNCDYyK4zvW4yTL_Q&usqp=CAU'
          },
          {
            name: 'Duke',
            time: new Date(),
            content: 'Loremipsum ba chon heo',
            img: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRddkWsqQoGL8aY3bzzCdNCDYyK4zvW4yTL_Q&usqp=CAU'
          },
          {
            name: 'Hoang',
            time: new Date(),
            content: 'Loremipsum ba chon heo',
            img: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRddkWsqQoGL8aY3bzzCdNCDYyK4zvW4yTL_Q&usqp=CAU'
          }
        ],
      }
    }
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