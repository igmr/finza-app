const formDataToObject = (formData) => {
    let object = {};
    formData.forEach((value, key) => (object[key] = value));
    return object;
};

const getToken = () => {
    return document.querySelector('[name="_token"]').value;
};
