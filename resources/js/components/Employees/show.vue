<script setup>
import axios from "axios";
import { onMounted, ref } from "vue";
let employee = ref(null);
const props = defineProps({
    id: {
        type: String,
        default: "",
    },
});

onMounted(async () => {
    await getEmployee();
});

const getEmployee = async () => {
    // console.log("id", props.id);
    let res = await axios.get(`/api/get-employee/${props.id}`);
    // console.log(res.data.employee);
    employee.value = res.data.employee;

    console.log("Employee data:", employee.value);
};
</script>

<template>
    <div class="container py-5">
        <h3>show sing employee</h3>

        <div v-for="el in employee" :key="el.id">
            <h4>{{ el.name }}</h4>
            <h4>{{ el.email }}</h4>
            <h4>{{ el.age }}</h4>
        </div>
    </div>
</template>
