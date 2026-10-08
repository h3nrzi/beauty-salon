document.querySelectorAll("[data-gallery]").forEach((gallery) => {
  const controls = gallery.querySelector("[data-gallery-filters]");
  const status = gallery.querySelector("[data-gallery-count]");
  const cards = [...gallery.querySelectorAll("[data-project]")];
  const buttons = [
    ...(controls?.querySelectorAll("button[data-filter]") || []),
  ];
  if (!controls || !status || !cards.length || !buttons.length) return;
  const update = (selected) => {
    const filter = selected.dataset.filter;
    let count = 0;
    cards.forEach((card) => {
      const matches =
        filter === "all" ||
        card.dataset.memberships.split(/\s+/).includes(filter);
      card.hidden = !matches;
      if (matches) count++;
    });
    buttons.forEach((button) =>
      button.setAttribute("aria-pressed", String(button === selected)),
    );
    status.textContent = status.dataset.message
      .replace("%1$d", count)
      .replace("%2$d", cards.length);
  };
  buttons.forEach((button) =>
    button.addEventListener("click", () => update(button)),
  );
  const all = buttons.find((button) => button.dataset.filter === "all");
  if (!all) return;
  update(all);
  controls.hidden = false;
  status.hidden = false;
});
