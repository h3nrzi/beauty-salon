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
  update();
  comparison.classList.add("comparison-enhanced");
  control.hidden = false;
});
