<template>
  <div class="home">
    <section-1
    v-bind="{
      title: title1,
      content: content1,
      img: image1,
    }"
    />
    <section-2/>
    <section-3
    v-bind="{
      title: title2,
      content: content2,
      img: image2,
    }"
    />
    <div class="button">
      <theme-button 
        v-bind="{
          msg: 'Edit page',
          height: '40px',
          width: '200px',
          border_radius: '15px',
          background_color: 'var(--theme_jade)',
        }"
        @click.native="setEditModalStep(1)"
      />
    </div>
    <modal-template  v-bind="{
        title: 'Edit page',
        step: editModalStep,
        buttonTitle: ['Next', 'Next', 'Edit']
      }"
      @onClose="setEditModalStep(-1)"
      @onCancel="() => {
        if (editModalStep === 1) setEditModalStep(-1);
        else setEditModalStep(editModalStep - 1);
      }"
      @onNextStep="onSubmit"
      >
        <div slot="1" class="slot">
          <div class="slot-content">
            <div class="image-box">
              <picture-frame v-bind="{
                  width: '100%',
                  width_img: '95.83%',
                  height: '100%',
                  height_img: '95.83%',
                  border_radius: '7vw',
                  background_img: modal_image1
              }"/>
            </div>
            <div class="form-box">
              <theme-textarea v-bind="{
                  height: '60px',
                  label: 'Title 1:',
              }"
              :value.sync="modal_title1"/>
              <div class="divider"></div>
              <theme-textarea v-bind="{
                  height: '150px',
                  label: 'Content 1:',
              }"
              :value.sync="modal_content1"/>
              <div class="large-divider"></div>
              <theme-button 
                v-bind="{
                  msg: 'Edit image',
                  height: '40px',
                  width: '100%',
                  border_radius: '15px',
                  background_color: 'var(--theme_jade)',
                }"
                @click.native="1"
              />
            </div>
          </div>
          
        </div>
        <div slot="2" class="slot">
          <div class="slot-content">
            <div class="image-box">
              <picture-frame v-bind="{
                  width: '100%',
                  width_img: '95.83%',
                  height: '100%',
                  height_img: '95.83%',
                  border_radius: '7vw',
                  background_img: modal_image2,
              }"/>
            </div>
            <div class="form-box">
              <theme-textarea v-bind="{
                  height: '60px',
                  label: 'Title 2:',
              }"
              :value.sync="modal_title2"/>
              <div class="divider"></div>
              <theme-textarea v-bind="{
                  height: '150px',
                  label: 'Content 2:',
              }"
              :value.sync="modal_content2"/>
              <div class="large-divider"></div>
              <theme-button 
                v-bind="{
                  msg: 'Edit image',
                  height: '40px',
                  width: '100%',
                  border_radius: '15px',
                  background_color: 'var(--theme_jade)',
                }"
                @click.native="1"
              />
            </div>
          </div>
          
        </div>
        <div slot="3" class="slot change-form">
          <theme-input
            label="Company address:"
            type="text"
            :value.sync="modal_address"
            v-bind:disable="true"
          />
          <div class="divider"></div>
          <theme-input
            label="Company email:"
            type="text"
            :value.sync="modal_email"
            v-bind:disable="true"
          />
          <div class="divider"></div>
          <theme-input
            label="Company phone:"
            type="text"
            :value.sync="modal_phone"
            v-bind:disable="true"
          />
          <div class="divider"></div>
          <theme-input
            label="Facebook:"
            type="text"
            :value.sync="modal_facebook"
            v-bind:disable="true"
          />
          <div class="divider"></div>
          <theme-input
            label="Twitter:"
            type="text"
            :value.sync="modal_twitter"
            v-bind:disable="true"
          />
          <div class="divider"></div>
          <theme-input
            label="Instagram:"
            type="text"
            :value.sync="modal_instagram"
            v-bind:disable="true"
          />
          <div class="divider"></div>
          <theme-input
            label="Tik Tok:"
            type="text"
            :value.sync="modal_tiktok"
            v-bind:disable="true"
          />
        </div>
    </modal-template>
  </div> 
</template>

<script>
import Section1 from '@/components/home/Section1.vue';
import Section4 from '../components/home/Section4.vue';
import Section2 from '../components/home/Section2.vue';
import Section3 from '../components/home/Section3.vue';
import ThemeButton from '../components/ThemeButton.vue';
import ModalTemplate from '../components/ModalTemplate.vue';
import PictureFrame from '../components/PictureFrame.vue';
import ThemeTextarea from '../components/ThemeTextarea.vue';
import ThemeInput from '../components/ThemeInput.vue';
import {getDataAPI, postDataAPI} from '../utils/fetchData';

export default {
  name: 'Home',
  components: {
    Section1,
    Section4,
    Section2,
    Section3,
    ThemeButton,
    ModalTemplate,
    PictureFrame,
    ThemeTextarea,
    ThemeInput
  },
  data() {
    return {
      editModalStep: -1,
      title1: "",
      content1: "",
      image1: "",
      title2: "",
      content2: "",
      image2: "",
      address: "",
      email: "",
      phone: "",
      facebook: "",
      twitter: "",
      instagram: "",
      tiktok: "",
      modal_title1: "",
      modal_content1: "",
      modal_image1: "",
      modal_title2: "",
      modal_content2: "",
      modal_image2: "",
      modal_address: "",
      modal_email: "",
      modal_phone: "",
      modal_facebook: "",
      modal_twitter: "",
      modal_instagram: "",
      modal_tiktok: "",
    }
  },
  methods: {
    setEditModalStep(val) {
      if (val === -1) {
        this.modal_title1 = this.title1;
        this.modal_content1 = this.content1;
        this.modal_image1 = this.image1;
        this.modal_title2 = this.title2;
        this.modal_content2 = this.content2;
        this.modal_image2 = this.image2;
        this.modal_address = this.address;
        this.modal_email = this.email;
        this.modal_phone = this.phone;
        this.modal_facebook = this.facebook;
        this.modal_twitter = this.twitter;
        this.modal_instagram = this.instagram;
        this.modal_tiktok = this.tiktok;
      }
      this.editModalStep = val;
    },
    async onSubmit() {
        if (this.editModalStep === 3) {
          var token = localStorage.getItem("token");
          if (token) {
            let res = await postDataAPI('info', {
              title1: this.modal_title1,
              content1: this.modal_content1,
              image1: this.modal_image1,
              title2: this.modal_title2,
              content2: this.modal_content2,
              image2: this.modal_image2,
              address: this.modal_address,
              email: this.modal_email,
              phone: this.modal_phone,
              facebook: this.modal_facebook,
              twitter: this.modal_twitter,
              instagram: this.modal_instagram,
              tiktok: this.modal_tiktok,
            }, token);
            console.log(res);
            if (res.data["status"] === 200) {
              this.title1 = this.modal_title1;
              this.content1 = this.modal_content1;
              this.image1 = this.modal_image1;
              this.title2 = this.modal_title2;
              this.content2 = this.modal_content2;
              this.image2 = this.modal_image2;
              this.address = this.modal_address;
              this.email = this.modal_email;
              this.phone = this.modal_phone;
              this.facebook = this.modal_facebook;
              this.twitter = this.modal_twitter;
              this.instagram = this.modal_instagram;
              this.tiktok = this.modal_tiktok;
              this.setEditModalStep(-1);
            }
          }
        }
        else this.setEditModalStep(this.editModalStep + 1);
    }
  },
  mounted() {
    (async () => {
      let res = await getDataAPI('info', undefined);
      if (res.data["status"] === 200) {
        this.title1 = res.data["info"]["title1"];
        this.content1 = res.data["info"]["content1"];
        this.image1 = res.data["info"]["image1"];
        this.title2 = res.data["info"]["title2"];
        this.content2 = res.data["info"]["content2"];
        this.image2 = res.data["info"]["image2"];
        this.address = res.data["info"]["address"];
        this.email = res.data["info"]["email"];
        this.phone = res.data["info"]["phone"];
        this.facebook = res.data["info"]["facebook"];
        this.twitter = res.data["info"]["twitter"];
        this.instagram = res.data["info"]["instagram"];
        this.tiktok = res.data["info"]["tiktok"];
        this.modal_title1 = this.title1;
        this.modal_content1 = this.content1;
        this.modal_image1 = this.image1;
        this.modal_title2 = this.title2;
        this.modal_content2 = this.content2;
        this.modal_image2 = this.image2;
        this.modal_address = this.address;
        this.modal_email = this.email;
        this.modal_phone = this.phone;
        this.modal_facebook = this.facebook;
        this.modal_twitter = this.twitter;
        this.modal_instagram = this.instagram;
        this.modal_tiktok = this.tiktok;
      }
    })()
  },
}
</script>
<style scoped>
.button {
  display: flex;
  justify-content: center;
  background-color: var(--theme_white);
  padding-bottom: 20px;
}
.slot {
  width: 100%;
}
.slot-content {
  width: 100%;
  min-height: 100%;
  display: flex;
}

.image-box {
  width: 50%;
  height: 30vw;
  max-height: 400px;
  padding-right: 10px;
}

.form-box {
  width: 50%;
  padding-left: 10px;
}

.divider {
  margin-top: 10px;
}

.large-divider {
  margin-top: 40px;
}

.change-form {
  width: 100%;
  padding: 2px 0px 0px 0px;
  max-width: 800px;
  width: 100%;
}

@media only screen and (max-width: 768px) {
  .slot-content {
    flex-direction: column;
  }

  .image-box {
    width: 100%;
    padding: 0;
    height: calc(50vw);
    max-height: calc(50vw);
  }
        
  .form-box {
    width: 100%;
    padding: 0;
  }
}

@media only screen and (max-width: 480px) {
  
}
</style>
