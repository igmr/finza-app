const form = document.querySelector("form");
const btnBack = document.querySelector("#btnBack");
const genderId = getId();
const inputCode = document.querySelector("#code");
const inputName = document.querySelector("#name");
const inputObservation = document.querySelector("#observation");

form.addEventListener("submit", async (e) => {
    try {
        e.preventDefault();
        const formData = new FormData(form);
        const payload = formDataToObject(formData);
        const { status, data } = await updateGender(
            payload,
            getToken(),
            genderId
        );
        if (status == 200) {
            window.location.href = `${baseUrlGender}/${genderId}`;
            return;
        }
        console.log(status);
        console.log(data);
        showErrorsGenderForm(data.errors);
        return;
    } catch (exception) {
        console.log(exception);
    }
});

btnBack.addEventListener("click", () => {
    window.location.href = `${baseUrlGender}/${genderId}`;
});

const loadForm = async () => {
    const data = await findByIdGender(genderId);
    // console.log(data);
    inputCode.value = "";
    inputName.value = "";
    inputObservation.value = "";
    if (data.code) {
        inputCode.value = data.code;
    }
    if (data.gender) {
        inputName.value = data.gender;
    }
    if (data.observation) {
        inputObservation.value = data.observation;
    }
    return;
};

(() => {
    loadForm();
    alertError.classList.add("d-none");
})();
