// استمع لكل الأزرار accept / reject / status-change
document.addEventListener("click", async function(e) {
    if (!e.target.matches(".btn-status")) return;

    e.preventDefault();
    const btn = e.target;
    const type = btn.dataset.type;       // e.g. 'user', 'post', 'request'
    const id   = btn.dataset.id;
    const status = btn.dataset.status;   // e.g. 'Approved', 'Inactive', 'Removed'

    const res = await fetch(`?url=AdminController/updateStatus&action=update${capitalize(type)}Status&id=${id}&status=${status}`);
    const data = await res.json();
    if (data.success) {
        // تحديث الواجهة تبعاً لنوع الـtype ...
        // مثلاً لو user -> غيّر لون الصف، عدّل عداد المستخدمين في dashboard ...
    }
});

function capitalize(s) {
    return s.charAt(0).toUpperCase() + s.slice(1);
}
