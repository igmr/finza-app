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

const currencyFormatter = ({ currency, value }) => {
    const formatter = new Intl.NumberFormat("es-MX", {
        style: "currency",
        minimumFractionDigits: 2,
        currency,
    });
    return formatter.format(value);
};

const periods = () => {
    return [
        { id: "Diary", text: "Diary" },
        { id: "Weekly", text: "Weekly" },
        { id: "Biweekly", text: "Biweekly" },
        { id: "Monthly", text: "Monthly" },
        { id: "Annual", text: "Annual" },
    ];
};