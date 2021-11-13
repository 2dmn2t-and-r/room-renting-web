<template>
  <div class="home">
    <!-- <div>Page này của Trung</div>
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
    <room-card
      :name="'Hall2'"
      :floor="10"
      :seat="50"
      :address="'98 Thu Duc Tan Binh'"
      :status="'Available'"
    />
    <reservation-info/>
    <div style="display: flex; flex-direction: row;">
      <reservation-block/>
      <information-block/>
    </div>
    <section-4/> -->
    <section-1/>
    <section-2/>
    <section-3/>
    <section-4/>
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
import RoomCard from '../components/RoomCard.vue'
import ReservationInfo from '../components/ReservationInfo.vue'
import ReservationBlock from '../components/ReservationBlock.vue'
import InformationBlock from '../components/InformationBlock.vue'
import Section4 from '../components/home/Section4.vue'
import Section2 from '../components/home/Section2.vue'
import Section3 from '../components/home/Section3.vue'

export default {
  name: 'Home',
  components: {
    HelloWorld,
    PictureFrame,
    ThemeButton,
    ThemeFooter,
    Section1,
    DescriptionCommentBox,
    RoomCard,
    ReservationInfo,
    ReservationBlock,
    InformationBlock,
    Section4,
    Section2,
    Section3
  }
}
</script>
<style scoped>

</style>
