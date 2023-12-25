const formDataToObject = (formData) => {
    let object = {};
    formData.forEach((value, key) => (object[key] = value));
    return object;
};

const getToken = () => {
    return document.querySelector('[name="_token"]').value;
};

const getId = () => {
    const arrayUrl = window.location.href.split("/");
    const auxId = arrayUrl[arrayUrl.length - 1];
    if (isNaN(Number(auxId))) {
        return arrayUrl[arrayUrl.length - 2];
    }
    return arrayUrl[arrayUrl.length - 1];
};
