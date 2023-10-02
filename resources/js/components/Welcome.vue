<template>
    <div class="container mt-5">
        <div class="col-12 text-center">
            <h1>Welcome</h1>
        </div>

        <div>
            <button @click="showModal = true">Show Modal</button>
            <!-- <Modal :show="showModal" @close="showModal = false">
                <div>
                    <h2>This is the modal content</h2>
                    <p>Any HTML elements or components can go here.</p>

                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit.
                        Praesentium accusantium nobis quod eos inventore
                        asperiores vero, minima iusto dolorem maiores. Hic
                        aliquid eum iste ipsa neque perferendis itaque ipsam
                        delectus.
                    </p>
                </div>
            </Modal> -->
            <component :is="Modal" :show="showModal" @close="showModal = false">
                <div>
                    <h2>This is the modal content</h2>
                    <p>Any HTML elements or components can go here.</p>

                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit.
                        Praesentium accusantium nobis quod eos inventore
                        asperiores vero, minima iusto dolorem maiores. Hic
                        aliquid eum iste ipsa neque perferendis itaque ipsam
                        delectus.
                    </p>
                </div>
            </component>
        </div>
    </div>
</template>

<!-- <script>
import Modal from "./common/CusModal.vue";

export default {
    components: {
        Modal,
    },
    data() {
        return {
            showModal: false,
        };
    },
};
</script> -->
<script setup>
import { ref } from "vue";
import Modal from "./common/CusModal.vue";

const showModal = ref(false);
</script>

<script>
import Modal from "./common/CusModal.vue";

export default {
    components: {
        Modal,
    },
    data() {
        return {
            showModal: false,
        };
    },
};
</script>
