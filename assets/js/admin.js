
document.addEventListener("DOMContentLoaded", function () {
  // click for delete buttons in admin pages
  document.querySelectorAll("form[onsubmit]").forEach(function (form) {
    form.addEventListener("submit", function (e) {
      if (!confirm("Are you sure you want to delete?")) {
        e.preventDefault();
      }
    });
  });
});
