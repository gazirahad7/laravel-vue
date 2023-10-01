<template>
    <div class="container my-5">
        <div class="d-flex justify-content-between">
            <h2 class="">Employee list</h2>

            <router-link to="/employees/create">
                <button class="btn btn-primary">Add Employee</button>
            </router-link>
        </div>
        <div class="my-5 p-4 border rounded-4">
            <!-- Loading state -->
            <div v-if="!employees" class="text-center">Loading...</div>

            <!-- Error state -->
            <div v-else-if="error" class="text-center text-danger">
                {{ error }}
            </div>

            <!-- Data state -->
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
                <tbody v-if="employees?.length > 0">
                    <tr v-for="(user, index) in employees" :key="user.id">
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
    </div>

    <!-- Teleport modal -->
    <button id="show-modal" @click="showModal = true">Show Modal</button>

    <Teleport to="body">
        <!-- use the modal component, pass in the prop -->
        <modal :show="showModal" @close="showModal = false">
            <template #header>
                <h3>custom header</h3>
            </template>
        </modal>
    </Teleport>
    <!-- view component -->

    <component :is="Test" />

    <button @click="openModal()" class="btn btn-warning">Open modal</button>

    <!--  Markup  Modal-->
    <div>
        <div class="overlay" id="overlay"></div>

        <!-- Modal component -->
        <div class="modal" id="myModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            Update User Info for '{{ singleUser?.name }}'
                        </h5>
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
                        <!-- Modal content goes here -->

                        <form>
                            <div class="mb-3">
                                <label
                                    for="exampleInputEmail1"
                                    class="form-label"
                                    >Name</label
                                >
                                <input type="text" class="form-control" />
                            </div>

                            <div class="mb-3">
                                <label
                                    for="exampleInputEmail1"
                                    class="form-label"
                                    >Email</label
                                >
                                <input type="email" class="form-control" />
                            </div>

                            <div class="mb-3">
                                <label
                                    for="exampleInputEmail1"
                                    class="form-label"
                                    >Phone</label
                                >
                                <input type="tel" class="form-control" />
                            </div>
                            <div class="mb-3">
                                <label
                                    for="exampleInputEmail1"
                                    class="form-label"
                                    >Website</label
                                >
                                <input type="text" class="form-control" />
                            </div>

                            <button
                                @click.prevent="updateUser()"
                                type="submit"
                                class="btn btn-primary"
                            >
                                Update
                            </button>
                        </form>
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
    </div>
</template>

<script setup>
import { onMounted, ref } from "vue";
import useSWRV from "swrv";
import { apis } from "../../apis/apiEndPoint";

import Test from "../../components/common/Test.vue";
import Modal from "../../components/common/MyModal.vue";

const { employeeAPI } = apis;

//const fetcher = (...args) => fetch(...args).then((res) => res.json());
const fetcher = function (url) {
    return fetch(url).then((r) => r.json());
};
onMounted(async () => {
    //  getEmployees();
});
const { data: employees, error, isLoading } = useSWRV(employeeAPI.getEmployees);

//

const showModal = ref(false);

//

const openModal = () => {
    const modal = document.getElementById("myModal");
    modal.classList.add("show");
    modal.style.display = "block";
    modal.style.backgroundColor = "rgba(0, 0, 0, 0.5)";

    document.body.classList.add("modal-open");

    // show the overlay
    const overlay = document.getElementById("overlay");
    overlay.style.display = "block";
};

const closeModal = () => {
    const modal = document.getElementById("myModal");
    modal.classList.remove("show");
    modal.style.display = "none";

    // hide the   overlay
    const overlay = document.getElementById("overlay");
    overlay.style.display = "none";
};
</script>
