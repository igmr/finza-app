const form = document.querySelector("form");
const transactionId = getId();
const amount = document.querySelector("#amount");
const concept = document.querySelector("#concept");
const reference = document.querySelector("#reference");
const accountFrom = document.querySelector("#account_from");
const accountTo = document.querySelector("#account_to");
const description = document.querySelector("#description");
const classification = document.querySelector("#classification");
const category = document.querySelector("#category");
const saving = document.querySelector("#saving");
const debt = document.querySelector("#debt");
const observation = document.querySelector("#observation");

form.addEventListener("submit", async (e) => {
    e.preventDefault();
    const formData = new FormData(form);
    const payload = formDataToObject(formData);
    const { status, data } = await updateTransaction(
        payload,
        getToken(),
        transactionId
    );
    console.log(status);
    console.log(data);
    
    if (status == 200) {
        window.location.href = `${baseUrlTransaction}/${transactionId}`;
        return;
    } else {
        console.log(data);
        showErrorsIngressForm(data.errors);
        return;
    }
});

const loadForm = async () => {
    const data = await findByIdTransaction(transactionId);
    console.log(data);
    await buildSelect(
        data.acc_egr_id,
        data.acc_ing_id,
        data.cls_id,
        data.cat_id,
        data.sav_id,
        data.deb_id
    );
    amount.value = data.amount;
    concept.value = data.concept;
    reference.value = data.reference;
    description.value = data.description;
    classification.value = data.classification;
    observation.value = data.observation;
};

const buildSelect = async (
    accountFromSelected,
    accountToSelected,
    classificationSelected,
    categorySelected,
    savingSelected,
    debtSelected
) => {
    const dataAccount = await selectAccount();
    console.log(dataAccount);
    dataAccount.forEach((item) => {
        const option = document.createElement("option");
        option.value = item.id;
        option.text = `${item.account} - ${item.bank}`;
        if (item.id == accountFromSelected) {
            option.selected = true;
        }
        accountFrom.add(option, null);
    });
    dataAccount.forEach((item) => {
        const option = document.createElement("option");
        option.value = item.id;
        option.text = `${item.account} - ${item.bank}`;
        if (item.id == accountToSelected) {
            option.selected = true;
        }
        accountTo.add(option, null);
    });
    const dataClassification = await selectClassification();
    console.log(dataClassification);
    dataClassification.forEach((item) => {
        const option = document.createElement("option");
        option.value = item.id;
        option.text = item.name;
        if (item.id == classificationSelected) {
            option.selected = true;
        }
        classification.add(option, null);
    });
    const dataCategory = await selectCategory();
    console.log(dataCategory);
    dataCategory.forEach((item) => {
        const option = document.createElement("option");
        option.value = item.id;
        option.text = `${item.category} - ${item.gender}`;
        if (item.id == categorySelected) {
            option.selected = true;
        }
        category.add(option, null);
    });
    const dataSaving = await selectSaving();
    console.log(dataSaving);
    dataSaving.forEach((item) => {
        const option = document.createElement("option");
        option.value = item.id;
        option.text = item.name;
        if (item.id == savingSelected) {
            option.selected = true;
        }
        saving.add(option, null);
    });
    const dataDebt = await selectDebt();
    console.log(dataDebt);
    dataDebt.forEach((item) => {
        const option = document.createElement("option");
        option.value = item.id;
        option.text = item.name;
        if (item.id == debtSelected) {
            option.selected = true;
        }
        debt.add(option, null);
    });
};

(() => {
    loadForm();
    alertError.classList.add("d-none");
})();
