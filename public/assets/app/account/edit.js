const form = document.querySelector("form");
const btnBack = document.querySelector("#btnBack");
const accountId = getId();
const inputName = document.querySelector("#name");
const inputBank = document.querySelector("#bank");
const inputObservation = document.querySelector("#observation");

form.addEventListener("submit", async (e) => {
    try {
        e.preventDefault();
        const formData = new FormData(form);
        const payload = formDataToObject(formData);
        const { status, data } = await updateAccount(payload, getToken(), accountId);
        if (status == 200) {
            window.location.href = `${baseUrlAccount}/${accountId}`;
            return;
        }
        console.log(status);
        console.log(data);
        showErrorsAccountForm(data.errors);
        return;
    } catch (exception) {
        console.log(exception);
    }
});


btnBack.addEventListener("click", () => {
    window.location.href = `${baseUrlAccount}/${accountId}`;
    return;
});

const loadForm = async () => {
    const data = await findByIdAccount(accountId);
    await buildSelect(data.bank_id);
    inputName.value = data.account;
    inputObservation.value = data.observation;
};

const buildSelect = async (selected) => {
    const data = await selectBank();
    inputBank.innerHTML = "";
    data.forEach((item) => {
        const option = document.createElement("option");
        option.value = item.id;
        option.text = item.name;
        if (item.id == selected) {
            option.selected = true;
        }
        inputBank.add(option);
    });
};

(() => {
    loadForm();
    alertError.classList.add("d-none");
})();
