<template>
    <div class="container py-5">
        <h3>show single employee</h3>

        <!-- Loading state -->
        <div v-if="!employee" class="text-center">Loading...</div>

        <!-- Error state -->
        <div v-else-if="error" class="text-center text-danger">
            {{ error }}
        </div>

        <div v-for="el in employee" :key="el.id">
            <h4>{{ el.name }}</h4>
            <h4>{{ el.email }}</h4>
            <h4>{{ el.age }}</h4>
        </div>
    </div>
</template>
<script setup>
import useSWRV from "swrv";
import { onMounted, ref } from "vue";
import { apis } from "../../apis/apiEndPoint";
const { employeeAPI } = apis;
const props = defineProps({
    id: {
        type: String,
        default: "",
    },
});
onMounted(async () => {
    // await getEmployee();
});

const { data: employee, error } = useSWRV(
    `/${employeeAPI.getEmployee}/${props.id}`
);
</script>
