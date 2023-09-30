import axios from "axios";
import { ref } from "vue";

const fetchData = async (url) => {
    try {
        const response = await axios.get(url);
        return { loading: false, error: null, data: response.data };
    } catch (error) {
        console.error(`Error fetching data from ${url}: ${error}`);
        return { loading: false, error: error.message, data: null };
    }
};

const useFetch = (url) => {
    const data = ref(null);
    const response = ref(null);
    const error = ref(null);
    const loading = ref(false);

    const fetch = async () => {
        loading.value = true;

        try {
            const result = await axios.request(url);
            response.value = result;
            data.value = result.data.employees;
        } catch (err) {
            error.value = err;
        } finally {
            loading.value = false;
        }
    };

    fetch();
    return { response, error, data, loading, fetch };
};

export { fetchData, useFetch };
