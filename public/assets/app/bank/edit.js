const form = document.querySelector("form");
const inputAbbreviature = document.querySelector("#abbreviature");
const inputName = document.querySelector("#name");
const inputObservation = document.querySelector("#observation");

form.addEventListener("submit", async (e) => {
    try {
        e.preventDefault();
        const formData = new FormData(form);
        const payload = formDataToObject(formData);
        const { status, data } = await updateBank(payload, getToken(), getId());
        if (status == 200) {
            window.location.href = `${baseUrlBank}/${getId()}`;
            return;
        }
        console.log(status);
        console.log(data);
        showErrorsBankForm(data.errors);
        return;
    } catch (exception) {
        console.log(exception);
    }
});

btnBack.addEventListener("click", () => {
    window.location.href = `${baseUrlBank}/${getId()}`;
});

const loadForm = async () => {
    const BankId = getId();
    const data = await findByIdBank(BankId);
    // console.log(data);
    inputName.value = "";
    inputAbbreviature.value = "";
    inputObservation.value = "";

    if (data.bank) {
        inputName.value = data.bank;
    }
    if (data.abbreviature) {
        inputAbbreviature.value = data.abbreviature;
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
