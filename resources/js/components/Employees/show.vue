<template>
    <h3>show sing employee</h3>
</template>

<script setup>
import axios from "axios";
import { onMounted, ref } from "vue";

let form = ref({ id: "" });

const props = defineProps({
    id: {
        type: String,
        default: "",
    },
});

onMounted(async () => {
    getEmployee();
});

const getEmployee = async () => {
    console.log("id", props.id);

    let res = await axios.get(`/api/get-employee/${props.id}`);

    console.log(res.data.employees);
};
</script>
