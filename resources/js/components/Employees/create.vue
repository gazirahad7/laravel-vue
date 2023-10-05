<script setup>
import axios from "axios";
import { useForm, Form, Field, ErrorMessage } from "vee-validate";
import { ref } from "vue";

import * as yup from "yup";
import { apis } from "../../apis/apiEndPoint";

const formValues = ref({});

const schema = {
    gender: (value) => {
        if (value) {
            return true;
        }

        return "You must choose a drink";
    },
};
const { errors, handleSubmit, defineInputBinds } = useForm({
    validationSchema: yup.object({
        name: yup.string().required(),
        email: yup.string().email().required(),
        age: yup.number().required(),
        // gender: yup.string(),
    }),
});

const createUser = handleSubmit(async (values) => {
    const fromData = JSON.stringify(values, null, 2);
    //console.log(fromData);

    // console.log(JSON.parse(fromData));

    try {
        const res = await axios.post(
            `${apis.employeeAPI.create}`,
            JSON.parse(fromData)
        );
        console.log({ res });
    } catch (error) {
        console.error("error", error);
    }
});

const name = defineInputBinds("name");
const email = defineInputBinds("email");
const age = defineInputBinds("age");
//const gender = defineInputBinds("gender");
</script>

<template>
    <div class="container">
        <h2>Create A User</h2>

        <form :validation-schema="schema" @submit="createUser">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input
                    type="text"
                    class="form-control"
                    id="name"
                    v-bind="name"
                />
                <p class="text-danger">{{ errors.name }}</p>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input
                    type="email"
                    class="form-control"
                    id="email"
                    v-bind="email"
                />
                <p class="text-danger">{{ errors.email }}</p>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Age</label>
                <input type="number" class="form-control" v-bind="age" />

                <p class="text-danger">{{ errors.age }}</p>
            </div>
            <div class="mb-3">
                <label class="form-label">Gender</label> <br />

                <Field name="gender" type="radio" value="" />
                Male
                <Field name="gender" type="radio" value="Tea" /> Female
                <Field name="gender" type="radio" value="Coffee" /> Other
                <ErrorMessage name="gender" />
            </div>
            <button type="submit" class="btn btn-primary">Create User</button>
        </form>
    </div>
</template>

<!-- 
                <div class="form-check">
                    <input
                        class="form-check-input"
                        type="radio"
                        value="male"
                        name="gender"
                    />
                    <label class="form-check-label" for="exampleRadios1">
                        Male
                    </label>
                </div>
                <div class="form-check">
                    <input
                        class="form-check-input"
                        type="radio"
                        value="female"
                        name="gender"
                    />
                    <label class="form-check-label" for="exampleRadios1">
                        Female
                    </label>
                </div>
                <div class="form-check">
                    <input
                        class="form-check-input"
                        type="radio"
                        value="other"
                        name="gender"
                    />
                    <label class="form-check-label" for="exampleRadios1">
                        Other
                    </label>
                </div> -->
