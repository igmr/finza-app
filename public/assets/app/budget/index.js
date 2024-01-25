

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
    ajax: `${baseUrlBudget}/datatable`,
    columns: [
        {
            title: "#",
            data: "budget_id",
        },
        {
            title: "Saving",
            data: null,
            render: (data) => {
                return `<a href="${baseUrlBudget}/${data.budget_id}">${data.budget}</a>`;
            },
        },
        {
            title: "Period",
            data: "period",
        },
        {
            title: "Account/Bank",
            data: null,
            render: (data) => {
                return `${data.account}/${data.bank}`;
            },
        },
        {
            title: "Amount",
            class: "text-right",
            data: "amount",
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
});
