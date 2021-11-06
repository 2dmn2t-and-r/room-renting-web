<template>
    <div class="modal" :style="modal">
        <div class="modal-container">
            <div class="modal-header">
                <div class="icon-bt"></div>
                <div class="modal-title">{{title}}</div>
                <div class="icon-bt"><theme-icon-button icon="clear"/></div>
            </div>
            <stepper v-bind:step="step"/>
            <div class="modal-content">
                <div :style="slot_1">
                    <slot name="1"></slot>
                </div>
                <div :style="slot_2">
                    <slot name="2"></slot>
                </div>
                <div :style="slot_3">
                    <slot name="3"></slot>
                </div>
            </div>
            <div class="modal-button-bar">
                <theme-button v-bind="{
                    msg: 'Cancel',
                    height: '40px',
                    width: '140px',
                    border_radius: '15px'
                }"></theme-button>
                <theme-button theme-button v-bind="{
                    msg: buttonTitle ? ((step === 0) ? buttonTitle[0] || '' : buttonTitle[step - 1] || '' ) : 'OK',
                    background_color: 'var(--theme_jade)',
                    height: '40px',
                    width: '140px',
                    border_radius: '15px'
                }"></theme-button>
            </div>
        </div>
    </div>
</template>

<script>
    import ThemeIconButton from './ThemeIconButton.vue';
    import Stepper from './Stepper.vue';
    import ThemeButton from './ThemeButton.vue';

    export default {
        components: { ThemeIconButton, ThemeButton, Stepper },
        name: 'ModalTemplate',
        props: {
            title: String,
            step: Number,
            buttonTitle: Array,
        },
        computed: {
            slot_1: function(){
                var isDisplay = (this.step !== 2) && (this.step !== 3)
                return {
                    "display": isDisplay ? "flex" : "none",
                    "width": "100%",
                    "justify-content": "center",
                }
            },
            slot_2: function(){
                var isDisplay = this.step === 2
                return {
                    "display": isDisplay ? "flex" : "none",
                    "width": "100%",
                    "justify-content": "center",
                }
            },
            slot_3: function(){
                var isDisplay = this.step === 3;
                return {
                    "display": isDisplay ? "flex" : "none",
                    "width": "100%",
                    "justify-content": "center",
                }
            },
            modal: function() {
                var isDisplay = (this.step !== undefined) && (this.step >= 0);
                return {
                    "display": isDisplay ? "flex" : "none",
                }
            }
        },
        data() {
            return {
                child: 123,
            }
        }
    }
</script>


<style scoped>
    .modal {
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100vh;
        overflow: none;
        background-color: rgba(17,17,17, 0.4);
        justify-content: center;
        align-items: center;
    }

    .modal-container {
        background-color: var(--theme_white);
        width: 80%;
        height: 80vh;
        max-width: 1080px;
        border-radius: 20px;
        padding-top: 20px;
        display: flex;
        flex-direction: column;
        align-items: center;
        min-height: 400px;
    }

    .modal-header {
        display: flex;
        align-items: center;
        width: 100%;
        padding: 0 20px;
        justify-content: space-between;
    }

    .icon-bt {
        width: 40px;
        height: 40px;
        display: flex;
        justify-content: center;
    }

    .modal-title {
        color: var(--theme_black);
        font-size: 32px;
        line-height: 40px;
        font-weight: 600;
    }

    .modal-content {
        display: flex;
        justify-content: center;
        padding: 0 60px;
        overflow: overlay;
        height: calc(100% - 188px);
        margin-bottom: 20px;
    }

    .modal-button-bar {
        display: flex;
        max-width: 800px;
        width: 100%;
        padding: 0 60px;
        justify-content: space-between;
    }
</style>