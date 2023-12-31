const period = document.querySelector('[name="period"]');
const account = document.querySelector('[name="account"]');
const form = document.querySelector("form");

form.addEventListener("submit", async (e) => {
    e.preventDefault();
    const formData = new FormData(form);
    const payload = formDataToObject(formData);
    const { status, data } = await storeBudget(payload, getToken());
    if (status == 201) {
        window.location.href = baseUrlBudget;
        return;
    } else {
        console.log(data);
        showErrorsBudgetForm(data.errors);
        return;
    }
});

const buildSelects = async () => {
    const data = periods();
    data.forEach((item) => {
        const option = document.createElement("option");
        option.value = item.id;
        option.text = item.text;
        period.add(option, null);
    });
    const accounts = await selectAccount();

    accounts.forEach((item) => {
        const opt = document.createElement("option");
        opt.value = item.id;
        opt.text = `${item.account} - ${item.bank}`;
        account.add(opt, null);
    });
};

(async () => {
    buildSelects();
})();
