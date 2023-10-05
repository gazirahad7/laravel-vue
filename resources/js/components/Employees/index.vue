<script setup>
import useSWRV from "swrv";
import { ref } from "vue";
import { apis } from "../../apis/apiEndPoint";

//import Modal from "../../components/common/MyModal.vue";

import axios from "axios";
import Modal from "../../components/common/CusModal.vue";

async function fetcher(url) {
    const response = await fetch(url);
    const data = await response.json();
    return data;
}
const { employeeAPI } = apis;

const {
    data: employees,
    error,
    isLoading,
    mutate,
} = useSWRV(employeeAPI.getEmployees, fetcher);

//

const showModal = ref(false);
const employee = ref({});
const openModal = (getId) => {
    // alert(getId);
    console.log(`/${apis.employeeAPI.getEmployee}/${getId}`);
    showModal.value = true;
    const fetchUserList = async () => {
        const response = await fetch(
            `${apis.employeeAPI.getEmployee}/${getId}`
        );
        const data = await response.json();
        //employee.value = data;

        console.log(data[0].id);

        employee.value = {
            id: data[0].id,
            name: data[0].name,
            email: data[0].email,
            age: data[0].age,
            gender: data[0].gender,
        };
        return data;
    };

    fetchUserList();
};
//
const confirmDelete = async (id) => {
    const confirmed = window.confirm(
        "Are you sure you want to delete this user?"
    );
    if (confirmed) {
        await axios.delete(`${apis.employeeAPI.delete}/${id}`);
    }
};

// for update employee

const updateEmployee = async () => {
    try {
        const res = await axios.put(
            `${apis.employeeAPI.update}/${employee.value.id}`,
            employee.value
        );

        console.log({ res });
        if (res.status == 200) {
            mutate(apis.employeeAPI.getEmployees, fetcher);
            showModal.value = false;
        }
    } catch (error) {
        console.error("error", error);
    }
};

// const openModal = () => {
//     const modal = document.getElementById("myModal");
//     modal.classList.add("show");
//     modal.style.display = "block";
//     modal.style.backgroundColor = "rgba(0, 0, 0, 0.5)";

//     document.body.classList.add("modal-open");

//     // show the overlay
//     const overlay = document.getElementById("overlay");
//     overlay.style.display = "block";
// };

// const closeModal = () => {
//     const modal = document.getElementById("myModal");
//     modal.classList.remove("show");
//     modal.style.display = "none";

//     // hide the   overlay
//     const overlay = document.getElementById("overlay");
//     overlay.style.display = "none";
// };
</script>

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
                                @click="openModal(user.id)"
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

    <!-- <button @click="openModal()" class="btn btn-warning">Open modal</button> -->

    <!-- View single employee  modal  -->

    <!-- <component
        :is="Modal"
        :show="showModal"
        :eId="getId"
        @close="showModal = false"
    >
        <div>
            <h4>Single employee information:</h4>
        </div>

        <div>
            <div v-if="employee?.length > 0">
                <div v-for="(user, index) in employee" :key="user.id">
                    <p>{{ user.id }}</p>
                    <p>{{ user.name }}</p>
                    <p>{{ user.email }}</p>
                    <p>{{ user.age }}</p>
                    <p>{{ user.website || "$0" }}</p>
                </div>
            </div>

            <div v-else>
                <p>No matching users found.</p>
            </div>
        </div>
    </component> -->
    <component
        :is="Modal"
        :show="showModal"
        :eId="getId"
        @close="showModal = false"
    >
        <div>
            <h4>Single employee information:</h4>

            <form @submit.prevent="updateEmployee">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input
                        type="text"
                        class="form-control"
                        id="name"
                        v-model="employee.name"
                    />
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input
                        type="email"
                        class="form-control"
                        id="email"
                        v-model="employee.email"
                    />
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Age</label>
                    <input
                        type="number"
                        class="form-control"
                        v-model="employee.age"
                    />
                </div>
                <div class="mb-3">
                    <label class="form-label">Gender</label> <br />
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </component>
</template>
