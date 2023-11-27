import router from "../router/index.js"


export const addInput = (emailsData) => {
    emailsData.value.push('')
}

export const removeInput = (emailsData) => {
    if (emailsData.value.length > 1) {
        emailsData.value.pop();
    }
}

export const addPhoneInput = (phonesData) => {
    phonesData.value.push('');
}

export const removePhoneInput = (phonesData) => {
    if (phonesData.value.length > 1) {
        phonesData.value.pop();
    }
}

export const postImage = async (photoData) => {
    if (photoData.value && photoData.value.files && photoData.value.files[0]) {
        let response = await axios.post('/upload-image',
            {
                image_path: photoData.value.files[0]
            },
            {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
    }
}
export const errorSameEmail = (emailsData, errorSameEmailError) => {
    let uniqueEmails = new Set(emailsData.value);

    if (uniqueEmails.size !== emailsData.value.length) {
        errorSameEmailError.value = 'Nem adhatsz meg ugyan olyan email címet';
    } else {
        errorSameEmailError.value = '';
    }
}

export const errorSamePhone = (phonesData, errorSamePhoneError) => {
    let uniquePhones = new Set(phonesData.value);

    if (uniquePhones.size !== phonesData.value.length) {
        errorSamePhoneError.value = 'Nem adhatsz meg ugyan olyan telefonszámot';
    } else {
        errorSamePhoneError.value = '';
    }
}

export const getErrorMessage = (error, field, index = null) => {
    if (index !== null && error[`${field}.${index}`] && error[`${field}.${index}`].length > 0) {
        return error[`${field}.${index}`][0];
    }
    if (error[field] && error[field].length > 0) {
        return error[field][0];
    }
    return '';
}

export const mainPage = async () => {
    await router.push("/")
}
