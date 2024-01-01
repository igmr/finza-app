const form = document.querySelector("form");
const btnBack = document.querySelector("#btnBack");
const debtId = getId();
const inputCategory = document.querySelector('[name="category"]');
const inputPeriod = document.querySelector('[name="period"]');
const inputName = document.querySelector('[name="name"]');
const inputAmount = document.querySelector('[name="amount"]');
const inputObservation = document.querySelector('[name="observation"]');

form.addEventListener("submit", async (e) => {
    e.preventDefault();
    const formData = new FormData(form);
    const payload = formDataToObject(formData);
    const { status, data } = await updateDebt(payload, getToken(), debtId);
    console.log(status);
    console.log(data);
    if (status == 200) {
        window.location.href = `${baseUrlDebt}/${debtId}`;
        return;
    } else {
        console.log(data);
        showErrorsDebtForm(data.errors);
        return;
    }
     /**/
});

btnBack.addEventListener("click", () => {
    window.location.href = `${baseUrlDebt}/${debtId}`;
    return;
});

const loadForm = async () => {
    const data = await findByIdDebt(debtId);
    console.log(data);
    await buildSelect(data.cat_id, data.period);
    inputName.value = data.debt;
    inputAmount.value = data.amount;
    inputObservation.value = data.observation;
};

const buildSelect = async (categorySelected, periodSelected) => {
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

    const categories = await selectCategory();
    console.log(categories)
    categories.forEach((item) => {
        const opt = document.createElement("option");
        opt.value = item.id;
        opt.text = `${item.category} - ${item.gender}`;
        if (item.id == categorySelected) {
            opt.selected = true;
        }
        inputCategory.add(opt, null);
    });
};

(() => {
    loadForm();
    alertError.classList.add("d-none");
})();
