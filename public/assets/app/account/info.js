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
    ajax: `${baseUrlAccount}/detail/${getId()}`,
    columns: [
        {
            title: "Bank",
            data: "bank",
        },
        {
            title: "Saving",
            data: "saving",
        },
        {
            title: "Debt",
            data: "debt",
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
const status = document.querySelector("#status");
const accountId = getId();
const btnDelete = document.querySelector("#btnDelete");
const btnRestore = document.querySelector("#btnRestore");
const btnEdit = document.querySelector("#btnEdit");
const btnBack = document.querySelector("#btnBack");

btnRestore.addEventListener("click", async () => {
    const response = await restoreAccount(accountId, getToken());
    await loadInfo();
    showAlertSuccess(response.success, response.data.general[0]);
});

formDelete.addEventListener("submit", async (e) => {
    e.preventDefault();
    const response = await deleteAccount(accountId, getToken());
    await loadInfo();
    showAlertSuccess(response.success, response.data.general[0]);
});

btnBack.addEventListener("click", async () => {
    window.location.href = `${baseUrlAccount}`;
    return;
});

btnEdit.addEventListener("click", async (e) => {
    e.preventDefault();
    window.location.href = `${baseUrlAccount}/${accountId}/edit`;
    return;
});

const loadInfo = async () => {
    const data = await findByIdAccount(accountId);
    id.value = accountId;
    name.innerText = `${data.account}/${data.bank}`;
    if(data.account == data.bank)
    {
        name.innerText = data.account;
    }
    setDelete(data.status);
    //console.log(data);
};

const setDelete = (statusValue) => {
    btnRestore.classList.remove("d-none");
    btnRestore.classList.remove("d-block");
    btnDelete.classList.remove("d-none");
    btnDelete.classList.remove("d-block");
    status.classList.remove("dot-danger");
    status.classList.remove("dot-success");
    if (statusValue === "Activo") {
        // console.log("Activo");
        status.classList.add("dot-success");
        btnRestore.classList.add("d-none");
        btnDelete.classList.add("d-block");
        return;
    } else {
        // console.log("Inactivo");
        status.classList.add("dot-danger");
        btnDelete.classList.add("d-none");
        btnRestore.classList.add("d-block");
        return;
    }
};

(() => {
    loadInfo();
})();
