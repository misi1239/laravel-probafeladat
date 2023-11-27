<script setup>

import router from "../../router/index.js"
import {onMounted, ref} from "vue"

let id = ref(null)

onMounted(() => {
    deleteData()
});
const deleteData = async () => {
    id.value = router.currentRoute.value.params.id;
    let response = await axios.delete(`/api/delete-name/${id.value}`);

    if (response.data.status === 200) {
        await router.push('/');
    }
}
</script>

<template></template>
