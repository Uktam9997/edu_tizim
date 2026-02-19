$(document).ready(function () {
    const searchInput = $('#studentSearch');
    const resultsBox = $('#searchToast');

    searchInput.on('keyup', function () {
        let query = $(this).val().trim();

        if (query.length > 2) {
            $.ajax({
                url: "/student/search",
                type: "GET",
                data: { q: query },
                success: function (data) {
                    resultsBox.empty().show();

                    if (data.length > 0) {
                        data.forEach(student => {
                            let groupsHtml = '';

                            if (student.groups && student.groups.length > 0) {
                                student.groups.forEach(group => {
                                    groupsHtml += `
                                        <div class="group-link"
                                            onclick="window.location.href='/group_first_show/${group.id}'">
                                            📘 ${group.group_name}
                                        </div>`;
                                });
                            } else {
                                groupsHtml = '<small><em>Guruh topilmadi</em></small>';
                            }

                            resultsBox.append(`
                                <div class="search-item">
                                    <strong>${student.fullname}</strong><br>
                                    <small>${student.phone ?? ''}</small>
                                    <div>${groupsHtml}</div>
                                </div>
                            `);
                        });
                    } else {
                        resultsBox.append(`
                            <div class="search-item">
                                <em>Natija topilmadi</em>
                            </div>
                        `);
                    }
                },
                error: function () {
                    resultsBox.empty().show().append(`
                        <div class="search-item text-danger">Xatolik yuz berdi</div>
                    `);
                }
            });
        } else {
            resultsBox.hide().empty();
        }
    });

    // Tashqariga bosganda yopiladi
    $(document).on('click', function (e) {
        if (!$(e.target).closest('.search-box').length) {
            resultsBox.hide().empty();
        }
    });
});
