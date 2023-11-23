import router from "../router/index.js"


export const addInput = async (emailsData) => {
    emailsData.value.push('')
};

export const addPhoneInput = async (phonesData) => {
    phonesData.value.push('');
};

export const errorSameEmail = async (emailsData, errorSameEmailError) => {
    let uniqueEmails = new Set(emailsData.value);

    if (uniqueEmails.size !== emailsData.value.length) {
        errorSameEmailError.value = 'Nem adhatsz meg ugyan olyan email címet';
    } else {
        errorSameEmailError.value = '';
    }
};

export const errorSamePhone = async (phonesData, errorSamePhoneError) => {
    let uniquePhones = new Set(phonesData.value);

    if (uniquePhones.size !== phonesData.value.length) {
        errorSamePhoneError.value = 'Nem adhatsz meg ugyan olyan telefonszámot';
    } else {
        errorSamePhoneError.value = '';
    }
};

export const getErrorMessage = (error, field, index = null) => {
    if (index !== null && error[`${field}.${index}`] && error[`${field}.${index}`].length > 0) {
        return error[`${field}.${index}`][0];
    }
    if (error[field] && error[field].length > 0) {
        return error[field][0];
    }
    return '';
};

export const mainPage = async () => {
    await router.push("/")
}
