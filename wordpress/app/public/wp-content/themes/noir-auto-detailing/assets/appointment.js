(() => {
  const summary = document.getElementById('request-errors');
  if (summary) summary.focus();
  summary?.addEventListener('click', (event) => {
    const link = event.target.closest('a[href^="#request-"]');
    if (!link) return;
    const field = document.getElementById(link.hash.slice(1));
    const target = field?.matches('fieldset') ? field.querySelector('input') : field;
    target?.focus();
  });
})();
