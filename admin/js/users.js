$(document).ready(function() {
    $(".btn-delete").on("click", function() {
        $(".alert-heading span").html(this.dataset.order);
        $(".alert-box").removeClass("invisible opacity-0");
        $(".alert-box").addClass("visible opacity-1");
    });

    $(".btn-cancel").on("click", function() {
        $(".alert-box").removeClass("visible opacity-1");
        $(".alert-box").addClass("invisible opacity-0");
    });

    $(".btn-accept").on("click", function() {
        $(".alert-box").removeClass("visible opacity-1");
        $(".alert-box").addClass("invisible opacity-0");

        $.ajax({
            url: "/CMS_CRUD/admin/handleDeleteUser.php",
            method: 'POST',
            dataType: 'json',
            data: {
                id: $(".alert-heading span").text()
            },
            success: function(response) {
                if (!response.error) {
                    $(".message").html("Xóa thành công");
                    $("tbody.table-body").html(response.map(({ id, first_name, last_name, email, type, deleted }) => {
                        return `
                        <tr>
                            <td>${first_name} ${last_name}</td>
                            <td>${email}</td>
                            <td>${ type === 2 ? "Author" : type === 1 ? "Admin" : "Unknown" }</td>
                            <td>${ deleted === 1 ? "Inactive" : deleted === 0 ? "Active" : "Unknown" }</td>
                            <td class="text-center d-flex align-items-center justify-content-between flex-1">
                                <a href="./add_users.php?id=${id}" class="btn btn-sm btn-warning text-white w-100 me-2">Edit</a>
                                <button class="btn-delete btn btn-sm btn-danger text-white w-100" data-order=${id}>Delete</button>
                            </td>
                        </tr>
                        `;
                    }));
                }
                else {
                    $(".message").html("Xóa thất bại");
                }
            },
        });
    });
})