const form = document.querySelector("form");
const classification = document.querySelector("#classification");
const account = document.querySelector("#account");
const saving = document.querySelector("#saving");
const debt = document.querySelector("#debt");

form.addEventListener("submit", async (e) => {
    e.preventDefault();
    const formData = new FormData(form);
    const payload = formDataToObject(formData);
    const { status, data } = await storeIngress(payload, getToken());
    if (status == 201) {
        window.location.href = baseUrlIngress;
        return;
    } else {
        console.log(data);
        showErrorsIngressForm(data.errors);
        return;
    }
});

const buildSelect = async () => {
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
