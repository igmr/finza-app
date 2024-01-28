const table = new NioApp.DataTable(".info", {
    scrollX: true,
    scrollY: 200,
    progressing: true,
    autoWidth: false,
    pageLength: 5,
    lengthMenu: [
        [5, 10, 20, -1],
        [5, 10, 20, "All"],
    ],
    paging: true,
    responsive: {
        details: true,
    },
    buttons: ["copy", "excel", "csv", "pdf"],
    ajax: `${baseUrlSaving}/detail/${getId()}`,
    columns: [
        {
            title: "Account/Bank",
            data: null,
            render: (data) => {
                if (data.account == data.bank) {
                    return data.account;
                }
                return `${data.account}/${data.bank}`;
            },
        },
        {
            title: "Debt",
            data: "debt",
        },
        {
            title: "Classification/Category - Bank",
            data: "description",
        },
        {
            title: "Amount",
            class: "text-right",
            data: null,
            render: (data) => {
                let amount = data.amount;
                let color = "success";
                if (data.type == "egress") {
                    amount = parseFloat(data.amount) * -1;
                    color = "danger";
                }
                amount = currencyFormatter({
                    currency: "MXN",
                    value: amount,
                });
                return `<span class="text-${color}">${amount}</span>`;
            },
        },
        {
            title: "Created at",
            class: "text-right",
            data: "created_at",
            render: (data) => {
                return dateFormatter({ locate: "en-US", value: data });
            },
        },
    ],
});

const id = document.querySelector("#id");
const name = document.querySelector("#name");
const amount = document.querySelector("#amount");
const status = document.querySelector("#status");
const savingId = getId();
const btnDelete = document.querySelector("#btnDelete");
const btnRestore = document.querySelector("#btnRestore");
const btnEdit = document.querySelector("#btnEdit");
const btnBack = document.querySelector("#btnBack");

btnRestore.addEventListener("click", async () => {
    const response = await restoreSaving(savingId, getToken());
    await loadInfo();
    showAlertSuccess(response.success, response.data.general[0]);
});

formDelete.addEventListener("submit", async (e) => {
    e.preventDefault();
    const response = await deleteSaving(savingId, getToken());
    await loadInfo();
    showAlertSuccess(response.success, response.data.general[0]);
});

btnBack.addEventListener("click", async () => {
    window.location.href = `${baseUrlSaving}`;
    return;
});

btnEdit.addEventListener("click", async (e) => {
    e.preventDefault();
    window.location.href = `${baseUrlSaving}/${savingId}/edit`;
    return;
});

const loadInfo = async () => {
    const data = await findByIdSaving(savingId);
    const _amount = currencyFormatter({ currency: "MXN", value: data.amount });
    id.value = savingId;
    name.innerText = data.saving;
    amount.innerText = "";
    if (data.amount) {
        amount.innerHTML = `${_amount} <span>/MXN</span>`;
    }
    setDelete(data.status);
    // console.log(data);
};

const setDelete = (statusValue) => {
    btnRestore.classList.remove("d-none");
    btnRestore.classList.remove("d-block");
    btnDelete.classList.remove("d-none");
    btnDelete.classList.remove("d-block");
    status.innerText = "";
    status.classList.remove("badge-primary");
    status.classList.remove("badge-danger");
    status.classList.remove("badge-success");
    if (statusValue === "Activo") {
        // console.log("Activo");
        status.innerText = "Active";
        status.classList.add("badge-success");
        btnRestore.classList.add("d-none");
        btnDelete.classList.add("d-block");
        return;
    } else {
        // console.log("Inactivo");
        status.innerText = "Inactive";
        status.classList.add("badge-danger");
        btnDelete.classList.add("d-none");
        btnRestore.classList.add("d-block");
        return;
    }
};

(() => {
    loadInfo();
})();
