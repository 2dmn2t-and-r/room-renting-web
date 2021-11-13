<template>
    <div class="bare_footer" :style="display">
        <div class="inner_footer" >
            <div style="width: 1%"></div>
            <div class="logo"></div>
            <div class="divider"></div>
            <div class="contactus">
                <div class="texttitle">Contact Us</div>
                <div class="textcontent">Linh Trung, Thu Duc</div>
                <div class="textcontent">Ho Chi Minh City</div>
                <div class="textcontent">nhduc2001kt@gmail.com</div>
                <div class="textcontent">0935735723</div>
            </div>
            <div class="followus">
                <div class="texttitle">Follow Us</div>
                <div class="socialrow">
                    <md-button class="md-icon-button social" v-on:click="openLink('https://www.facebook.com/GCollectors')">
                        <img src="../assets/icon/facebook.png" alt="None">
                    </md-button>
                    <md-button class="md-icon-button social" v-on:click="openLink('https://www.facebook.com/GCollectors')">
                        <img src="../assets/icon/twitter.png" alt="None">
                    </md-button>
                    <md-button class="md-icon-button social" v-on:click="openLink('https://www.facebook.com/GCollectors')">
                        <img src="../assets/icon/insta.png" alt="None">
                    </md-button>
                    <md-button class="md-icon-button social" v-on:click="openLink('https://www.facebook.com/GCollectors')">
                        <img src="../assets/icon/tiktok.png" alt="None">
                    </md-button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        route: {
            type: String,
            default: "",
        }
    },
    methods: {
      openLink: function (link) {   
          window.open(link, "_blank");    
      }
    },
    computed: {
        display: function() {
            return {
                "display": this.route.split('/')[1] === 'auth' ? "none" : "flex"
            }
        },
    },
}
</script>

<style scoped>
.bare_footer {
    background-color: var(--theme_fore);
    height: 420px;
    width: 100%;
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: center;
}

.inner_footer {
    height: 280px;
    width: 100%;
    max-width: 1140px;
    display: flex;
    flex-direction: row;
    align-items: flex-start;
}

.logo {
    align-self: flex-start;
    width: 228px;
    height: 100%;
    background-image: url('../assets/logo/full.png');
    background-size: contain;
    background-repeat: no-repeat;
}

.followus {
    height: 100%;
    width: 228px;
}

.socialrow {
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    justify-content: left;
    width: 100%;
}
.social {
    background-color: #dddddd;
}
.social:hover {
    background-color: var(--theme_jade);
}
.md-icon-button {
    margin: 0px;
    margin-right: 3%;
}

.contactus {
    height: 100%;
    width: 250px;
}

.icon {
    background-size: 80%;
    background-repeat: no-repeat;
}

.social > img {
    width: 100%;
    height: 100%;
}

.texttitle {
    font-size: 24px;
    font-weight: bold;
    line-height: 3;
    color: var(--theme_black);
}

.textcontent {
    font-size: 17px;
    color: var(--theme_gray);
    line-height: 1.8;
}

.divider {
    display: flex;
    flex: 1;
}

@media only screen and (max-width: 768px) {
    .divider {
        display: none;
    }
    .bare_footer {
        height: fit-content;
        padding: 20px;
    }
    .inner_footer {
        height: fit-content;
        flex-direction: column;
    }
    .logo {
        height: 78px;
    }
}
</style>