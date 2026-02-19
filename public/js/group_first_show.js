document.getElementById('clone-previous-month').addEventListener('click', function() {
    const groupId = this.dataset.groupId;

    if(!confirm("O‘tgan oy attendance yozuvlarini yangi oyga ko‘chirmoqchimisiz?")) return;

    fetch(`/group/${groupId}/clone-previous-month`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Content-Type': 'application/json'
        }
    })
    .then(res => res.json())
    .then(data => {
        if(data.success) {
            alert(data.message);
            location.reload(); // sahifani yangilash, yangi oy darslarini ko‘rsatish uchun
        } else {
            alert(data.message);
        }
    })
    .catch(err => console.error(err));
});


const rows = document.querySelectorAll("tbody tr");
const dateInputs = document.querySelectorAll(".lesson-date");

function updateTotal() {
    let total = 0;
    document.querySelectorAll(".paid-sum").forEach(input => {
        total += parseFloat(input.value) || 0;
    });
    document.getElementById("total-paid").textContent = total.toFixed(2);
}
updateTotal();

rows.forEach(row => {
    const studentId = row.dataset.studentId;

    // ===== Attendance status =====
    row.querySelectorAll(".status-input").forEach((input, index) => {
        input.addEventListener("change", function () {
            const status = this.value;
            const lessonDate = dateInputs[index].value;
            if (!lessonDate) { alert("Avval sanani kiriting!"); this.value=''; return; }

            fetch(routes.attendance_save, {
                method: "POST",
                headers: { 
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content 
                },
                body: JSON.stringify({
                    student_id: studentId,
                    group_id: groupId,
                    lesson_date: lessonDate,
                    status: status
                })
            })
            .then(res => res.json())
            .then(data => console.log("Davomat saqlandi:", data))
            .catch(err => console.error(err));
        });
    });

    // ===== Lesson date =====
    dateInputs.forEach((input, index) => {
        input.addEventListener("change", function () {
            const oldDate = this.dataset.oldDate;
            const newDate = this.value;

            fetch(routes.lesson_date_update, {
                method: "POST",
                headers: { 
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content 
                },
                body: JSON.stringify({
                    group_id: groupId,
                    old_date: oldDate,
                    new_date: newDate
                })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) { 
                    console.log("Sana yangilandi:", newDate); 
                    input.dataset.oldDate = newDate; 
                } else alert("Sana saqlashda xatolik!");
            })
            .catch(err => console.error(err));
        });
    });

    // ===== Course price, debt, paid_sum =====
    row.querySelectorAll(".course-price, .debt1, .debt2, .paid-sum").forEach(input => {
        input.addEventListener("change", function () {
            const field = this.dataset.field;
            const value = this.value;

            fetch(routes.student_update_payment, {
                method: "POST",
                headers: { 
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content 
                },
                body: JSON.stringify({
                    student_id: studentId,
                    field: field,
                    value: value
                })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) { 
                    console.log(field + " updated:", data.student[field]); 
                    updateTotal(); 
                } else alert("Xatolik: " + data.message);
            })
            .catch(err => console.error(err));
        });
    });

    // Izohni saqlash
    rows.forEach(row => {
        const studentId = row.dataset.studentId;

        const commentInput = row.querySelector('textarea[name="comment"]');
        if (commentInput) {
            commentInput.addEventListener("change", function() {
                const comment = this.value;

                fetch(routes.student_update_comment, {
                    method: "POST",
                    headers: { 
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content 
                    },
                    body: JSON.stringify({
                        student_id: studentId,
                        comment: comment
                    })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        console.log("Izoh yangilandi:", data.student.comment);
                    } else {
                        alert("Xatolik: " + data.message);
                    }
                })
                .catch(err => console.error(err));
            });
        }
    });

});
