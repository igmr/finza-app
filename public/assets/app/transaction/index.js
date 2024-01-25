/*
Id
Account from
Account to
Amount
Created at
User
Status
*/
const table = new NioApp.DataTable(".list", {
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
    ajax: `${baseUrlTransaction}/datatable`,
    columns: [
        {
            title: "#",
            data: "tra_id",
        },
        {
            title: "Concept",
            data: null,
            render: (data) => {
                return `<a href="${baseUrlTransaction}/${data.tra_id}">${data.concept}</a>`;
            },
        },
        {
            title: "Account from",
            data: null,
            render: (data) => {
                return `${data.account_from} / ${data.bank_from}`;
            },
        },
        {
            title: "Account to",
            data: null,
            render: (data) => {
                return `${data.account_to} / ${data.bank_to}`;
            },
        },
        {
            title: "Amount",
            class: "text-right",
            data: null,
            render: (data) => {
                let amount = currencyFormatter({
                    currency: "MXN",
                    value: data.amount,
                });
                return amount;
            },
        },
        {
            title: "Created at",
            data: "created_at",
            render: (data) => {
                return dateFormatter({ locate: "en-US", value: data });
            },
        },
        {
            title: "Status",
            data: null,
            render: (data) => {
                let statusClass = "text-danger";
                if (data.status == "Activo") {
                    statusClass = "text-success";
                }
                return `<span class="tb-status ${statusClass}">${data.status}</span>`;
            },
        },
    ],
    order: [[0, "desc"]],
});
