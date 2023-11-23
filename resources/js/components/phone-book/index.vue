<script setup>
    import { onMounted, ref } from "vue"
    import { useRouter } from "vue-router"

    const router = useRouter();

    let phoneBook = ref([])

    onMounted( ()=> {
        getPhonebook()
    })

    const getPhonebook = async () => {
        let response = await axios.get("/api/get-phone-book")
        phoneBook.value = response.data.phoneBook
    }

    const newPhoneBook = async () => {
        await router.push("/phone-book/create")
    }

    const updatePhoneBook = async (item) => {
        await router.push(`/phone-book/update/${item.id}`);
    }

    const deletePhoneBook = async (item) => {
        await router.push(`/phone-book/delete/${item.id}`);
    }

</script>

<template>
    <div class="container mx-auto px-4 sm:px-8">
        <div class="py-8">
            <div>
                <h2 class="text-2xl font-semibold leading-tight text-center">Telefonkönyv</h2>
            </div>
            <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                <button class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 my-3 px-4 border border-blue-500 hover:border-transparent rounded" @click = "newPhoneBook">
                    Telefonkönyv létrehozása
                </button>
                <div class="inline-block min-w-full shadow-md rounded-lg overflow-hidden">
                    <table class="min-w-full leading-normal">
                        <thead>
                        <tr>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Név
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Lakcím
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Levelezési cím
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Email cím
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Telefonszám
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100"></th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100"></th>
                        </tr>
                        </thead>
                        <tbody v-for="item in phoneBook" :key="item.id" v-if="phoneBook.length > 0">
                            <tr>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <div class="flex">
                                        <div class="flex-shrink-0 w-10 h-10">
                                            <img class="w-full h-full rounded-full"
                                                src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2.2&w=160&h=160&q=80"
                                                alt=""
                                            />
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-gray-900 whitespace-no-wrap">{{ item.name }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">{{ item.address }}</p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">{{ item.mailing_address }}</p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">{{ item.emails.map(email => email.email_address).join(', ') }}</p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-left">
                                    <p class="text-gray-900 whitespace-no-wrap">{{ item.phones.map(phone => phone.phone_number).join(', ') }}</p>
                                </td>
                                <td class="border-b border-gray-200 bg-white text-sm text-left">
                                    <button class="bg-transparent hover:bg-orange-500 text-orange-700 font-semibold hover:text-white py-2 my-3 px-4 border border-orange-500 hover:border-transparent rounded" @click="() => updatePhoneBook(item)">Frissítés</button>
                                </td>
                                <td class="border-b border-gray-200 bg-white text-sm text-left">
                                    <button class="bg-transparent hover:bg-red-500 text-red-700 font-semibold hover:text-white py-2 my-3 px-4 border border-red-500 hover:border-transparent rounded" @click="() => deletePhoneBook(item)">Törlés</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>
