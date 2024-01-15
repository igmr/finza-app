const form = document.querySelector("form");
const accountFrom = document.querySelector("#account_from");
const accountTo = document.querySelector("#account_to");
const classification = document.querySelector("#classification");
const category = document.querySelector("#category");
const saving = document.querySelector("#saving");
const debt = document.querySelector("#debt");

form.addEventListener("submit", async (e) => {
    e.preventDefault();
    const formData = new FormData(form);
    const payload = formDataToObject(formData);
    const { status, data } = await storeTransaction(payload, getToken());
    console.log(status);
    console.log(data);
    if (status == 201) {
        window.location.href = baseUrlTransaction;
        return;
    } else {
        console.log(data);
        showErrorsTransactionForm(data.errors);
        return;
    }
});

const buildSelect = async () => {
    /* ========================================================= */
    /* Category                                           */
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
    /* Classifications                                           */
    /* ========================================================= */
    const dataClassification = await selectClassification();
    classification.innerHTML = "";
    dataClassification.forEach((item) => {
        const option = document.createElement("option");
        option.value = item.id;
        option.text = item.name;
        classification.add(option);
    });
    /* ========================================================= */
    /* Accounts [From || To]                                     */
    /* ========================================================= */
    const dataAccount = await selectAccount();
    accountFrom.innerHTML = "";
    dataAccount.forEach((item) => {
        const option = document.createElement("option");
        option.value = item.id;
        option.text = `${item.account} - ${item.bank}`;
        accountFrom.add(option);
    });
    accountTo.innerHTML = "";
    dataAccount.forEach((item) => {
        const option = document.createElement("option");
        option.value = item.id;
        option.text = `${item.account} - ${item.bank}`;
        accountTo.add(option);
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
