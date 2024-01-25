
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
    ajax: `${baseUrlDebt}/datatable`,
    columns: [
        {
            title: "#",
            data: "debt_id",
        },
        {
            title: "Debt",
            data: null,
            render: (data) => {
                return `<a href="${baseUrlDebt}/${data.debt_id}">${data.debt}</a>`;
            },
        },
        {
            title:'Period',
            data:'period',
        },
        {
            title:'Category/Gender',
            data:null,
            render: (data) => {
                return `${data.category}/${data.gender}`;
            },
        },
        {
            title: "Amount",
            class: 'text-right',
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
