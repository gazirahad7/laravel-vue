<template>
    <div class="container my-5">
        <h2 class="">Employee list</h2>
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
                        <th scope="col">Phone</th>
                        <th scope="col">Website</th>

                        <th scope="col " class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody v-if="employees?.length > 0">
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
import { onMounted, ref } from "vue";
import useSWRV from "swrv";
import { apis } from "../../apis/apiEndPoint";
const { employeeAPI } = apis;

//const fetcher = (...args) => fetch(...args).then((res) => res.json());
const fetcher = function (url) {
    return fetch(url).then((r) => r.json());
};
onMounted(async () => {
    //  getEmployees();
});
const { data: employees, error, isLoading } = useSWRV(employeeAPI.getEmployees);
</script>
