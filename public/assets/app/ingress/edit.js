const form = document.querySelector("form");
const btnBack = document.querySelector("#btnBack");
const ingressId = getId();
const inputAmount = document.querySelector('[name="amount"]');
const inputConcept = document.querySelector('[name="concept"]');
const inputReference = document.querySelector('[name="reference"]');
const selectedClassification = document.querySelector(
    '[name="classification"]'
);
const selectedAccount = document.querySelector('[name="account"]');
const textareaDescription = document.querySelector('textarea[name="description"]');
const selectedSaving = document.querySelector('[name="saving"]');
const selectedDebt = document.querySelector('[name="debt"]');
const inputObservation = document.querySelector('[name="observation"]');

form.addEventListener("submit", async (e) => {
    e.preventDefault();
    const formData = new FormData(form);
    const payload = formDataToObject(formData);
    const { status, data } = await updateIngress(
        payload,
        getToken(),
        ingressId
    );
    console.log(status);
    console.log(data);
    if (status == 200) {
        window.location.href = `${baseUrlIngress}/${ingressId}`;
        return;
    } else {
        console.log(data);
        showErrorsIngressForm(data.errors);
        return;
    }
    /**/
});

btnBack.addEventListener("click", () => {
    window.location.href = `${baseUrlIngress}/${ingressId}`;
    return;
});

const loadForm = async () => {
    const data = await findByIdIngress(ingressId);
    console.log(data);
    await buildSelect(data.cls_id, data.acc_id, data.sav_id, data.deb_id);
    inputAmount.value = data.amount;
    inputConcept.value = data.concept;
    inputReference.value = data.reference;
    textareaDescription.value = data.description;
    inputObservation.value = data.observation;
};

const buildSelect = async (
    classificationSelected,
    accountSelected,
    savingSelected,
    debtSelected
) => {
    const dataClassification = await selectClassification();
    console.log(dataClassification);
    dataClassification.forEach((item) => {
        const option = document.createElement("option");
        option.value = item.id;
        option.text = item.name;
        if (item.id == classificationSelected) {
            option.selected = true;
        }
        selectedClassification.add(option, null);
    });
    const dataAccount = await selectAccount();
    console.log(dataAccount);
    dataAccount.forEach((item) => {
        const option = document.createElement("option");
        option.value = item.id;
        option.text = `${item.account} - ${item.bank}`;
        if (item.id == accountSelected) {
            option.selected = true;
        }
        selectedAccount.add(option, null);
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
        selectedSaving.add(option, null);
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
        selectedDebt.add(option, null);
    });
};

(() => {
    loadForm();
    alertError.classList.add("d-none");
})();
