<template>
    <h2>Employee list</h2>
</template>

<script setup>
import axios from "axios";
import { onMounted, ref } from "vue";

onMounted(async () => {
    getEmployees();
});

const getEmployees = async () => {
    //let res = await axios.get("api/get-employees");
    let res = await axios.get("api/employees");

    console.log({ res });
};
</script>
