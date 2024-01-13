const form = document.querySelector("form");
const category = document.querySelector("#category");
const account = document.querySelector("#account");
const saving = document.querySelector("#saving");
const debt = document.querySelector("#debt");

form.addEventListener("submit", async (e) => {
    e.preventDefault();
    const formData = new FormData(form);
    const payload = formDataToObject(formData);
    const { status, data } = await storeEgress(payload, getToken());
    if (status == 201) {
        window.location.href = baseUrlEgress;
        return;
    } else {
        console.log(data);
        showErrorsEgressForm(data.errors);
        return;
    }
});

const buildSelect = async () => {
    /* ========================================================= */
    /* Categories                                                */
    /* ========================================================= */
    const dataCategory = await selectCategory();
    category.innerHTML = "";
    dataCategory.forEach((item) => {
        const option = document.createElement("option");
        option.value = item.id;
        option.text = `${item.category} - ${item.gender}`;
        category.add(option);
    });
    /* ========================================================= */
    /* Accounts                                            */
    /* ========================================================= */
    const dataAccount = await selectAccount();
    account.innerHTML = "";
    dataAccount.forEach((item) => {
        const option = document.createElement("option");
        option.value = item.id;
        option.text = `${item.account} - ${item.bank}`;
        account.add(option);
    });
    /* ========================================================= */
    /* Savings                                                   */
    /* ========================================================= */
    const dataSaving = await selectSaving();
    saving.innerHTML = "";
    dataSaving.forEach((item) => {
        const option = document.createElement("option");
        option.value = item.id;
        option.text = item.name;
        saving.add(option);
    });
    /* ========================================================= */
    /* Debts                                                     */
    /* ========================================================= */
    const dataDebt = await selectDebt();
    debt.innerHTML = "";
    dataDebt.forEach((item) => {
        const option = document.createElement("option");
        option.value = item.id;
        option.text = item.name;
        debt.add(option);
    });
};

(async () => {
    await buildSelect();
})();
