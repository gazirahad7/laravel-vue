<template>
    <div class="container my-5">
        <h2 class="">Employee list</h2>
        <div class="my-5 p-4 border rounded-4">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">SL</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Website</th>

                        <th scope="col " class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody v-if="employees.length > 0">
                    <tr v-for="(user, index) in employees" :key="user.id">
                        <td>{{ index + 1 }}</td>
                        <td>{{ user.name }}</td>
                        <td>{{ user.email }}</td>
                        <td>{{ user.phone }}</td>
                        <td>{{ user.website }}</td>

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
</template>

<script setup>
import axios from "axios";
import { onMounted, ref } from "vue";
import router from "../../router";

let employees = ref([]);
onMounted(async () => {
    getEmployees();
});

const onShow = (id) => {
    //  router.push("/employees/show" + id);
};

const getEmployees = async () => {
    let res = await axios.get("/api/get-employees");
    // let res = await axios.get("api/employees");
    console.log({ res });
    employees.value = res.data.employees;
};
</script>
