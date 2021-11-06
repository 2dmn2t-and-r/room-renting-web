<template>
  <div class="home">
    <div>Page này của Trung</div>
    <theme-button msg="Button"/>
    <section-1/>
    <theme-footer/>
    <description-comment-box
      floor=12
      seat=80
      status='Unavailable'
      type='Hall'
      address='Lorem ipsum'
      description='Lorem ipsum.'
      :comments="[
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
      ]"
    />
  </div>
</template>

<script>
// @ is an alias to /src
import HelloWorld from '@/components/HelloWorld.vue'
import PictureFrame from '@/components/PictureFrame.vue'
import ThemeButton from '@/components/ThemeButton.vue'
import ThemeFooter from '@/components/ThemeFooter.vue'
import Section1 from '@/components/home/Section1.vue'
import DescriptionCommentBox from '../components/modals/reserve/DescriptionCommentBox.vue'

export default {
  name: 'Home',
  components: {
    HelloWorld,
    PictureFrame,
    ThemeButton,
    ThemeFooter,
    Section1,
    DescriptionCommentBox
  }
}
</script>
<style scoped>
.ho
    DescriptionCommentBoxme {
  background-color:aquamarine;
}
</style>
