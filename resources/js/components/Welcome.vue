<template>
    <div class="container mt-5">
        <div class="col-12 text-center">
            <h1>Welcome</h1>
        </div>
        <div>
            <button
                @click="
                    showModal = true;
                    getId = '3';
                "
            >
                Show Modal
            </button>

            <!-- <button @click="openModal">Show Modal</button> -->
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
            <component
                :is="Modal"
                :show="showModal"
                :eId="getId"
                @close="showModal = false"
            >
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

                <div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">SL</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Age</th>
                                <th scope="col">Salary</th>

                                <th scope="col " class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody v-if="employee?.length > 0">
                            <tr
                                v-for="(user, index) in employee"
                                :key="user.id"
                            >
                                <td>{{ index + 1 }}</td>
                                <td>{{ user.name }}</td>
                                <td>{{ user.email }}</td>
                                <td>{{ user.age }}</td>
                                <td>{{ user.website || "$0" }}</td>
                                <td
                                    class="text-center d-flex gap-2 justify-content-center"
                                >
                                    <RouterLink
                                        :to="`/employees/show/${user.id}`"
                                        class="btn btn-success"
                                    >
                                        View</RouterLink
                                    >
                                    <button
                                        @click="onShow(user.id)"
                                        class="btn btn-warning"
                                    >
                                        Edit
                                    </button>

                                    <button
                                        @click="confirmDelete(user.id)"
                                        class="btn btn-danger"
                                    >
                                        Delete
                                    </button>
                                </td>
                            </tr>
                        </tbody>

                        <tbody v-else>
                            <tr>
                                <td colspan="5">No matching users found.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </component>
        </div>
    </div>

    <button @click="openModal(1)">get Id</button>
</template>
<script setup>
import useSWRV from "swrv";
import { onMounted, ref } from "vue";
import { apis } from "../apis/apiEndPoint";
import Modal from "./common/CusModal.vue";

const showModal = ref(false);

const employee = ref(null);
const openModal = (getId) => {
    // alert(getId);
    console.log(`/${apis.employeeAPI.getEmployee}/${getId}`);

    showModal.value = true;
    // Define your API request function
    const fetchUserList = async () => {
        const response = await fetch(
            `${apis.employeeAPI.getEmployee}/${getId}`
        );
        const data = await response.json();

        console.log(data);

        employee.value = data;

        return data;
    };

    fetchUserList();
    // const {
    //     data: employee,
    //     error,
    //     isLoading,
    // } = useSWRV("employee", `${apis.employeeAPI.getEmployee}/1`);

    console.log(employee);
};
</script>
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
<!-- <script setup>
import { ref } from "vue";
import Modal from "./common/CusModal.vue";
const showModal = ref(false);
const getId = ref(null);
</script> -->

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
