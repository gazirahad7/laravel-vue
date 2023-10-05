<!-- Modal.vue -->
<template>
    <!-- <div class="modal" v-if="show">
            <div class="modal-content">
                <p>header</p>
                <slot></slot>
                <button @click="closeModal">Close Modal</button>
            </div>
        </div> -->

    <div class="modal" v-if="show" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update User Info:</h5>
                    <button
                        type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Close"
                        @click="closeModal"
                    >
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <slot></slot>
                </div>
                <div class="modal-footer">
                    <button
                        class="btn btn-secondary"
                        data-dismiss="modal"
                        @click="closeModal"
                    >
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Modal",
    props: {
        show: Boolean,
    },
    methods: {
        closeModal() {
            this.$emit("close");
        },
    },
};
</script>

<script setup>
import { ref, defineProps, defineEmits } from "vue";

// let props = defineProps({
//     show: Boolean,
// });

// console.log(props.show);

// const closeModal = () => {
//     //  props.show = false;

//     const hasModalElement = document.querySelector('[class*="modal"]') !== null;
// };
</script>

<style scoped>
.modal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 1000;
}

.modal-content {
    background-color: white;
    padding: 20px;
    border-radius: 5px;
}
</style>
