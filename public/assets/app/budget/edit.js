const form = document.querySelector("form");
const btnBack = document.querySelector("#btnBack");
const budgetId = getId();
const inputAccount = document.querySelector('[name="account"]');
const inputPeriod = document.querySelector('[name="period"]');
const inputName = document.querySelector('[name="name"]');
const inputAmount = document.querySelector('[name="amount"]');
const inputObservation = document.querySelector('[name="observation"]');

form.addEventListener("submit", async (e) => {
    e.preventDefault();
    const formData = new FormData(form);
    const payload = formDataToObject(formData);
    const { status, data } = await updateBudget(payload, getToken(), budgetId);
    if (status == 200) {
        window.location.href = `${baseUrlBudget}/${budgetId}`;
        return;
    } else {
        console.log(data);
        showErrorsBudgetForm(data.errors);
        return;
    }
});

btnBack.addEventListener("click", () => {
    window.location.href = `${baseUrlBudget}/${budgetId}`;
    return;
});

const loadForm = async () => {
    const data = await findByIdBudget(budgetId);
    await buildSelect(data.gender_id);
    inputName.value = data.budget;
    inputAmount.value = data.amount;
    inputObservation.value = data.observation;
};

const buildSelect = async (accountSelected, periodSelected) => {
    const data = periods();
    data.forEach((item) => {
        const option = document.createElement("option");
        option.value = item.id;
        option.text = item.text;
        if (item.id == periodSelected) {
            option.selected = true;
        }
        period.add(option, null);
    });

    const accounts = await selectAccount();
    accounts.forEach((item) => {
        const opt = document.createElement("option");
        opt.value = item.id;
        opt.text = `${item.account} - ${item.bank}`;
        if (item.id == accountSelected) {
            opt.selected = true;
        }
        account.add(opt, null);
    });
};

(() => {
    loadForm();
    alertError.classList.add("d-none");
})();
