<template>
    <div class="container" :style="display">
        <div class="header-bar" :style="unauth">
            <div class="content-container">
                <div class="logo" @click="$router.push('/').catch(()=>{})">
                    <img class="logo-img" src="../assets/logo/logo.png" alt="logo" width="60" height="60">
                    ROOM PRO
                </div>
                <div class="nav-bar">
                    <div class="nav-item" :style="home" v-on:click="routeTo('/')">HOME</div>
                    <div class="nav-item" :style="room" v-on:click="routeTo('/room')">ROOM</div>
                    <div class="nav-item" :style="reservation" v-on:click="routeTo('/reservation')">RESERVATION</div>
                    <div class="nav-item" :style="news" v-on:click="routeTo('/news')">NEWS</div>
                </div>
                <div class="menu">
                    <md-icon class=" menu-icon md-size-2x">
                        menu
                    </md-icon>
                    <div class="list">
                        <div class="item" v-on:click="routeTo('/')">Home</div>
                        <div class="divider"></div>
                        <div class="item" v-on:click="routeTo('/room')">Room</div>
                        <div class="divider"></div>
                        <div class="item" v-on:click="routeTo('/reservation')">Reservation</div>
                        <div class="divider"></div>
                        <div class="item" v-on:click="routeTo('/news')">News</div>
                        <div class="divider"></div>
                        <div class="item" v-on:click="routeTo('/auth/signup')">Sign In</div>
                        <div class="divider"></div>
                        <div class="item" v-on:click="routeTo('/auth/signin')">Sign Up</div>
                    </div>
                </div>
                <div class="buttons">
                    <theme-button v-bind="{
                        msg: 'Sign Up',
                        height: '30px',
                        width: '100px',
                        border_radius: '15px'
                    }"
                    @click.native="$router.push('/auth/signup').catch(()=>{})"/>
                    <theme-button v-bind="{
                        msg: 'Sign In',
                        background_color: 'var(--theme_jade)',
                        height: '30px',
                        width: '100px',
                        border_radius: '15px'
                    }"
                    @click.native="$router.push('/auth/signin').catch(()=>{})"/>
                </div>
            </div>
        </div>
        <div class="header-bar" :style="auth">
            <div class="content-container">
                <div class="logo" @click="$router.push('/').catch(()=>{})">
                    <img class="logo-img" src="../assets/logo/logo.png" alt="logo" width="60" height="60">
                    ROOM PRO
                </div>
                <div class="nav-bar">
                    <div class="nav-item" :style="home" v-on:click="routeTo('/')">HOME</div>
                    <div class="nav-item" :style="room" v-on:click="routeTo('/room')">ROOM</div>
                    <div class="nav-item" :style="reservation" v-on:click="routeTo('/reservation')">RESERVATION</div>
                    <div class="nav-item" :style="news" v-on:click="routeTo('/news')">NEWS</div>
                </div>
                <div class="menu">
                    <md-icon class=" menu-icon md-size-2x">
                        menu
                    </md-icon>
                    <div class="list">
                        <div class="item" v-on:click="routeTo('/')">Home</div>
                        <div class="divider"></div>
                        <div class="item" v-on:click="routeTo('/room')">Room</div>
                        <div class="divider"></div>
                        <div class="item" v-on:click="routeTo('/reservation')">Reservation</div>
                        <div class="divider"></div>
                        <div class="item" v-on:click="routeTo('/news')">News</div>
                        <div class="divider"></div>
                        <div class="item" v-on:click="routeTo('/profile')">Profile</div>
                        <div class="divider"></div>
                        <div class="item" v-on:click="1">Sign Out</div>
                    </div>
                </div>
                <div class="buttons">
                    <div class="avt-button">
                        <div class="avt">
                            <img v-bind:src="avt" alt="avt" :style="avt_style">
                        </div>
                        <div class="username" :style="manager">
                            Numcumeo
                        </div>
                        <md-icon class="expand-icon" :style="manager">
                            expand_more
                        </md-icon>
                        <div class="list">
                            <div class="item" v-on:click="routeTo('/profile')">Profile</div>
                            <div class="divider"></div>
                            <div class="item" @click="1">Sign Out</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import ThemeButton from './ThemeButton.vue';

    export default {
        components: { ThemeButton },
        name: 'ModalTemplate',
        props: {
            isAuth: {
                type: Boolean,
                default: true,
            },
            isManager: {
                type: Boolean,
                default: false,
            },
            avt: {
                type: String,
                default: "",
            },
            route: {
                type: String,
                default: "",
            }
        },
        computed: {
            auth: function(){
                return {
                    "display": this.isAuth ? "flex" : "none",
                }
            },
            unauth: function(){
                return {
                    "display": this.isAuth ? "none" : "flex",
                }
            },
            manager: function(){
                return {
                    "color": this.isManager ? "var(--theme_jade)" : "var(--theme_white)"
                }
            },
            display: function() {
                return {
                    "display": this.route.split('/')[1] === 'auth' ? "none" : "flex"
                }
            },
            avt_style: function(){
                return {
                    "width": "100%",
                    "object-fit": "cover",
                    "display": this.avt === "" ? "none" : "inline",
                }
            },
            home: function() {
                return {
                    "color": this.route === "/" || this.route === "/management" ? "var(--theme_jade)" : "var(--theme_black)",
                    "text-decoration": this.route === "/" || this.route === "/management" ? "underline" : "none",
                }
            },
            room: function(){
                var index = this.route.split('/')[1] === 'management' ? 2 : 1
                var splitRoute = this.route.split('/')[index]
                return {
                    "color": splitRoute === "room" ? "var(--theme_jade)" : "var(--theme_black)",
                    "text-decoration": splitRoute === "room" ? "underline" : "none",
                }
            },
            reservation: function(){
                var index = this.route.split('/')[1] === 'management' ? 2 : 1
                var splitRoute = this.route.split('/')[index]
                return {
                    "color": splitRoute === "reservation" ? "var(--theme_jade)" : "var(--theme_black)",
                    "text-decoration": splitRoute === "reservation" ? "underline" : "none",
                }
            },
            news: function(){
                var index = this.route.split('/')[1] === 'management' ? 2 : 1
                var splitRoute = this.route.split('/')[index]
                return {
                    "color": splitRoute === "news" ? "var(--theme_jade)" : "var(--theme_black)",
                    "text-decoration": splitRoute === "news" ? "underline" : "none",
                }
            },

        },
        methods: {
            routeTo: function(path) {
                this.$router.push(path).catch(()=>{});
            }
        }

    }
</script>

<style scoped>
    .header-bar {
        min-width: 320px;
        position: fixed;
        z-index: 99;
        left: 0;
        top: 0;
        width: 100vw;
        height: 100px;
        overflow: none;
        background-color: var(--theme_white);
        box-shadow: 0 1px 2px 0px rgba(17, 17, 17, 0.1);
        padding: 0 20px;
        justify-content: center;
    }

    .container {
        width: 100vw;
        height: 100px;
    }

    .content-container {
        height: 100%;
        display: flex;
        max-width: 1140px;
        width: 100%;
        align-items: center;
        justify-content: space-between;
    }

    .logo {
        display: flex;
        align-items: center;
        font-family: Poppins;
        font-size: 24px;
        font-weight: 300;
        width: 200px;
    }

    .logo:hover {
        cursor: pointer;
    }

    .logo-img {
        margin-right: 10px;
    }

    .nav-bar {
        display: flex;
        width: calc(100% - 424px);
        justify-content: right;
    }

    .nav-item {
        font-weight: 600;
        margin-right: 5%;
    }

    .nav-item:hover {
        cursor: pointer;
    }

    .buttons {
        width: 224px;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .avt-button {
        display: flex;
        width: 100%;
        height: 60px;
        border-radius: 30px 0 15px 30px;
        background-color: var(--theme_brown);
        padding: 4px;
        align-items: center;
    }

    .avt-button:hover {
        cursor: pointer;
    }

    .avt-button:hover .username, .avt-button:hover .expand-icon {
        opacity: 0.5;
    }

    .avt-button:hover .list {
        display: flex;
    }

    .avt {
        width: 52px;
        height: 52px;
        border-radius: 50%;
        background-color: var(--theme_jade);
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .username {
        width: 130px;
        display: flex;
        justify-content: center;
        font-weight: 600;
    }

    .menu {
        width: 60px;
        height: 60px;
        display: none;
        color: var(--theme_black);
        border-radius: 10px;
    }

    .menu-icon {
        color: var(--theme_gray) !important;
    }

    .list {
        position: fixed;
        top: 80px;
        right: max(calc(50vw - 570px), 20px);
        border-radius: 15px 0;
        background-color: var(--theme_white);
        width: 200px;
        box-shadow: 0px 1px 2px 1px rgba(17, 17, 17, 0.1);
        display: none;
        flex-direction: column;
    }

    .divider {
        height: 2px;
        width: 100%;
        background-color: var(--theme_fore);
    }

    .item {
        width: 100%;
        height: 40px;
        font-weight: 600;
        font-size: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .item:hover,.item:active {
        background-color: var(--theme_fore);
        cursor: pointer;
    }

    @media only screen and (max-width: 768px) {
        .nav-bar {
            display: none;
        }

        .buttons {
            display: none;
        }

        .menu {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .menu:hover {
            background-color: var(--theme_fore);
        }

        .menu:hover .list {
            display: inline;
        }

    }

    @media only screen and (max-width: 480px) {
        
    }
</style>