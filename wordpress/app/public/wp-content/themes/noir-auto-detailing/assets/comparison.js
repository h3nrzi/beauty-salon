document.querySelectorAll("[data-comparison]").forEach((comparison) => {
  const control = comparison.querySelector(".comparison-control");
  const range = control?.querySelector("input");
  if (!range || comparison.querySelectorAll("figure").length !== 2) return;
  const update = () => {
    comparison.style.setProperty("--reveal", `${range.value}%`);
    range.setAttribute(
      "aria-valuetext",
      range.dataset.valueLabel.replace("%s", range.value),
    );
  };
  range.addEventListener("input", update);
  // The after image is revealed from the right; keep horizontal keys aligned
  // with the visible handle even where native RTL range keys differ.
  range.addEventListener("keydown", (event) => {
    if (
      event.altKey ||
      event.ctrlKey ||
      event.metaKey ||
      !["ArrowLeft", "ArrowRight"].includes(event.key)
    )
      return;
    event.preventDefault();
    range.value = Math.max(
      0,
      Math.min(100, Number(range.value) + (event.key === "ArrowLeft" ? 1 : -1)),
    );
    update();
  });
  update();
  comparison.classList.add("comparison-enhanced");
  control.hidden = false;
});
