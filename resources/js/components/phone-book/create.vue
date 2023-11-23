<script setup>

    import { ref, onMounted } from "vue"
    import router from "../../router/index.js"
    import { addInput, addPhoneInput, errorSameEmail, errorSamePhone, getErrorMessage, mainPage } from '../../phone-book/sameFunction.js'

    let nameData = ref()
    let addressData = ref()
    let mailingAddressData = ref()
    let photoData = ref()
    let phonesData = ref([])
    let emailsData = ref([])
    let errorMessage = ref([])
    let errorSameEmailError = ref()
    let errorSamePhoneError = ref()
    let isChecked = ref(false)

    onMounted(() => {
        handleAddInput()
        handleAddPhoneInput()
    });

    const handleAddInput = () => {
        addInput(emailsData);
    };

    const handleAddPhoneInput = () => {
        addPhoneInput(phonesData);
    };

    const postData = async () => {
        await errorSameEmail(emailsData, errorSameEmailError);
        await errorSamePhone(phonesData, errorSamePhoneError);

        if (errorSameEmailError.value || errorSamePhoneError.value) {
            return;
        }

        let response = await axios.post('/api/create-name', {
            name: nameData.value,
            address: addressData.value,
            mailing_address: isChecked.value ? addressData.value : mailingAddressData.value,
            photo: photoData.value,
            emails: emailsData.value,
            phones: phonesData.value
        })

        if (response.data.status === 200) {
            await router.push('/');
        }
        errorMessage.value = response.data.error_message
    }
</script>

<template>
    <div class="bg-blue-200 min-h-screen flex items-center">
        <div class="w-full">
            <h2 class="text-center text-blue-400 font-bold text-2xl uppercase mb-10">Telefonkönyv létrehozása</h2>
            <div class="bg-white p-10 rounded-lg shadow md:w-3/4 mx-auto lg:w-1/2">
                <button class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 my-3 px-4 border border-blue-500 hover:border-transparent rounded" @click = "mainPage">Vissza</button>
                <div class="mb-5">
                    <label for="name" class="block mb-2 font-bold text-gray-600">Név</label>
                    <input type="text" id="name" name="name" placeholder="" class="border border-gray-300 shadow p-3 w-full rounded mb-" v-model="nameData">
                    <span class="text-sm text-red-600">{{ getErrorMessage(errorMessage, 'name') }}</span>
                </div>

                <div class="mb-5">
                    <label for="address" class="block mb-2 font-bold text-gray-600">Cím</label>
                    <input type="text" id="address" name="address" placeholder="" class="border border-gray-300 shadow p-3 w-full rounded mb-" v-model="addressData">
                </div>

                <div class="mb-5">
                    <input id="default-checkbox" type="checkbox" value="" v-model = "isChecked" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="default-checkbox" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Pipáld be ha a postázási címnek is ezt szeretnéd megadni</label>
                </div>

                <div class="mb-5">
                    <label for="mailingAddress" class="block mb-2 font-bold text-gray-600">Postázási cím</label>
                    <input type="text" id="mailingAddress" name="mailingAddress" placeholder="" class="border border-gray-300 shadow p-3 w-full rounded mb-" v-model="mailingAddressData">
                </div>

                <div class="mb-5">
                    <label for="photos" class="block mb-2 font-bold text-gray-600">Fotó</label>
                </div>

                <div class="mb-5">
                    <label for="emails" class="block mb-2 font-bold text-gray-600">Email cím</label>
                    <span v-for="(email, index) in emailsData" :key="index">
                        <input type="text" v-model="emailsData[index]" class="border border-gray-300 shadow p-3 w-full rounded mt-3">
                        <span class="text-sm text-red-600">{{ getErrorMessage(errorMessage, 'emails', index) }}</span>
                    </span>
                    <span class="text-sm text-red-600">{{ errorSameEmailError }}</span>
                    <button @click="handleAddInput" class="block bg-blue-500 text-white font-bold p-2 mt-2">További email címek hozzáadása</button>
                </div>

                <div class="mb-5">
                    <label for="phones" class="block mb-2 font-bold text-gray-600">Telefonszám</label>
                    <span v-for="(phone, index) in phonesData" :key="index">
                        <input type="text" v-model="phonesData[index]" class="border border-gray-300 shadow p-3 w-full rounded mt-3">
                        <span class="text-sm text-red-600">{{ getErrorMessage(errorMessage, 'phones', index) }}</span>
                    </span>
                    <span class="text-sm text-red-600">{{ errorSamePhoneError }}</span>
                    <button @click="handleAddPhoneInput" class="block bg-blue-500 text-white font-bold p-2 mt-2">További telefonszámok hozzáadása</button>
                </div>

                <button @click="postData" type="submit" class="block w-full bg-blue-500 text-white font-bold p-4 rounded-lg">Létrehozás</button>
            </div>
        </div>
    </div>
</template>
