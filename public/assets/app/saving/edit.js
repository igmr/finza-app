const form = document.querySelector("form");
const btnBack = document.querySelector("#btnBack");
const savingId = getId();
const inputName = document.querySelector('[name="name"]');
const inputAmount = document.querySelector('[name="amount"]');
const inputDateFinish = document.querySelector('[name="date_finish"]');
const inputObservation = document.querySelector('[name="observation"]');

form.addEventListener("submit", async (e) => {
    e.preventDefault();
    const formData = new FormData(form);
    const payload = formDataToObject(formData);
    
    const { status, data } = await updateSaving(payload, getToken(), savingId);
    if (status == 200) {
        window.location.href = `${baseUrlSaving}/${savingId}`;
        return;
    } else {
        console.log(data);
        showErrorsBudgetForm(data.errors);
        return;
    }
});

btnBack.addEventListener("click", () => {
    window.location.href = `${baseUrlSaving}/${savingId}`;
    return;
});

const loadForm = async () => {
    const data = await findByIdSaving(savingId);
    inputName.value = data.saving;
    inputAmount.value = data.amount;
    inputObservation.value = data.observation;
    const _dateFinish = new Date(data.date_finish);
    $("#date_finish").datepicker("setDate", _dateFinish);
};

(() => {
    loadForm();
    alertError.classList.add("d-none");
})();
